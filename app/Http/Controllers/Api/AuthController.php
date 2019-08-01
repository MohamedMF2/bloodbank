<?php

namespace App\Http\Controllers\Api;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use Illuminate\Validation\Rule;
use App\Token ;

class AuthController extends Controller
{
                                     // Register
//---------------------------------------------------------------------------------------
    public function register(Request $request){
       $validator = validator()->make($request->all() ,[
           'name'=>     'required',
           'email'=>    'required',
           'password'=> 'required',
           'email'=>    'required|email|unique:clients',
           'city_id'=>  'required',
           'phone' =>   'required|unique:clients',
           'date_of_last_donation' =>'required',
           'blood_type_id'=>'required',
           'activated'=>'required',
       ] ); 

    if ($validator->fails()){
        $val =$validator->errors()->first();
        return responseJson(0 ,$val,$validator->errors());
    }
    $request->merge([ 'password' => bcrypt($request->password)]) ;

   $client = Client::create($request->all());
   $client->api_token =str_random(60);
   $client->save();
    return responseJson(1 ,"success",[
        'api_token' =>$client->api_token,
        'client'=>$client
    ]);

}


                                                // Login 
// ------------------------------------------------------------------------------------------------------
public function login(Request $request){
    $validator =validator()->make($request->all() ,[
        'phone' =>'required',
        'password'=>'required',
    ] ); 

    if ($validator ->fails()){
        return responseJson ( 0 , $validator->errors()->first() , $validator->errors() );
    }

    $client = Client::where ('phone' , $request->phone ) ->first();
    if($client){

            if(Hash::check($request->password , $client->password)){
                return responsejson(1 , "successful login",[
                    'api_token'=>$client->api_token ,
                    'client' =>$client
                ]);
            }else{
                return responsejson(0 , "unsuccessful login");
            }

    }else{
        return responseJson(0 , "unsuccessful login ");
    }

}
                                                    // Reset password

//----------------------------------------------------------------------------------------------------
public function reset_password (Request $request){
    $validator =validator()->make($request->all() ,[
        'phone' =>'required',
    ] ); 

    if ($validator ->fails()){
        return responseJson ( 0 , $validator->errors()->first() , $validator->errors() );
    }

    $user = Client::where ('phone' , $request->phone ) ->first();
    if($user){
        $code = rand(11111,999999);
        $update = $user -> update ( ['pin_code' => $code] );

        if($update){
            Mail::to($user->email )
                    ->bcc('furious_fouad@yahoo.com')
                    ->send(new ResetPassword($code));   
                    return responseJson ( 1 , " sending you a verification code", ['pin_code_for_test' => $code]  );
        }

    }else{
        return responseJson(0 , "wrong number " ,$request->phone);
    }
}

                            // new password
    //----------------------------------------------------------------------------------------------------------


public function new_password (Request $request){
    $validator = Validator::make($request->all() ,[

            'pin_code' =>'required',
            'password' => 'required |confirmed',
            'password_confirmation' =>'required'
    ]);

    if($validator ->fails()){
        return responseJson(0, $validator->errors()->first() , $validator->errors());
    }
    $user = Client::where('pin_code',$request->pin_code)->first();
    if($user){
       
            $user->password =bcrypt( $request->password) ;
            $user->pin_code = null;

            if  ( $user->save() ){
                return responseJson(1, 'Your Password Have been changed Successfully',$user->name);
            }else{
                        return responseJson(0, 'Something went wrong try again');
            }

    }else{
            return responseJson(0, 'This Pin Code is incorrect');
    }
}
//----------------- Profile ------------------

public function profile(Request $request){
    
     //profile validation rules
     $validator = validator()->make($request ->all() ,
     [
        'phone'=> Rule::unique('clients')->ignore($request->user()->id),
        'password'=>'confirmed'

     ]);

     //error messages
     if ($validator ->fails()){
        return responseJson ( 0 , $validator->errors()->first() , $validator->errors() );
    }
    //encrypt password
    $request->merge(['password'=>bcrypt($request->password)]);
    
    //update clients
    $user = request()->user();
    $user ->update($request->all());

    return responseJson(1, 'your profile has been edited successfully',[
        'api_token'=>$user->api_token,
        'client'=>$user
    ]);

}
//----------------- Contacts ------------------

public function contacts (Request $request){
    $validator = Validator::make($request->all(),[
        'title'=> 'required',
        'message' => 'required'
    ]);

    if($validator->fails()){
        return responseJson(0 ,$validator->errors()->first(),$validator->errors() );
    }
    $contacts = $request->user()->contacts()->create($request->all());
    return responseJson(1,"success",$contacts);
}


 // ----------- Notification Settings --------------

 public function notification_setting (request $request){

    $validator = Validator::make($request->all() ,[

        'blood_types.*' => 'required|exists:blood_types,id',
        'governorates.*' => 'required|exists:governorates,id',
        ]);

        if ($validator ->fails()){
            return responseJson(0 ,$validator->errors()->first(),$validator->errors());
        }
        $client = $request->user();
        $governorate =$client->governorates()->sync($request->governorates);
        $blood_type =$client->blood_types()->sync($request->blood_types);
        $data =[
            'governorates' => $client ->governorates()->pluck('governorates.id')->toArray() ,
            'blood_types'  => $client ->blood_types()->pluck('blood_types.id')->toArray() 
        ];
        return responseJson(1 ,'success',$data);
        
    }

    //------------------ Register Token-----------------
    public function registerToken( Request $request){
        $validator = validator::make($request->all(),[
            'token' =>'required',
            'platform' =>'required|in:android,ios',
        ]);

        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        Token::where('token',$request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return responseJson(1,'token created successfully');

    }

        //------------------ Remove Token-----------------

    public function removeToken(Request $request){
        $validator = validator::make($request->all(),[
            'token' =>'required',
        ]);

        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        Token::where('token',$request->token)->delete();
         return responseJson(1,'token deleted successfully');
    }

    //----------------- create donation request & query of possible donners ------------------

public function donation_request(Request $request ){

    $validator = Validator::make($request->all(),[
        'patient_name'=>'required',
        'patient_age'=>'required',
        'hospital_name'=>'required',
        'hospital_address'=>'required',
        'phone'=>'required',
        'latitude'=>'required',
        'longitude'=>'required',
        'bags_number'=>'required',
        'city_id'=>'required',
        'blood_type_id'=>'required',
        'notes'=>'nullable'

    ]);
   
    if ($validator->fails()){
        return  responseJson(0 , $validator->errors()->first() ,  $validator->errors()) ;
    }

    // create donation request 
    $donationRequest = $request->user()->donationRequests()->create($request->all());
     // find clients suitable for this blood donation
     $clientsIds = $donationRequest->city->governorate
     ->clients()->whereHas('bloodType',function($q) use($request){
         $q->where('blood_types.id',$request->blood_type_id); 
     })->pluck('clients.id')->toArray();

//dd($clientsIds);
     
     if(count($clientsIds)){
         //create notification on database
         $notification = $donationRequest->notifications()->create([
             'title' => ' توجد حالة بحاجه الى تبرع بالدم',
             'content'=>  $donationRequest->bloodType->type,

         ]);

         // attach clients to this notification
         $notification->clients()->attach($clientsIds);

         //get tokens for FCM (push notification using FireBase Cloud)
         $tokens = Token::whereIn('client_id',$clientsIds)->where('token','!=',null)->pluck('token')->toArray();
            if (count($tokens)){
                $title= $notification->title ;
                $body =  $notification->content ;
                $data =[
                    'donation_request_id' => $donationRequest->id
                ];
                $send =notifyByFireBase( $title , $body ,$tokens ,$data);
            }


     }


     return responseJson(1,"success", "donation request created successfully and sent to possible donners");

}

}