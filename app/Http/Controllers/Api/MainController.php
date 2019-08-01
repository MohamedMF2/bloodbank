<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Governorate ;
use App\City ;
use App\Post ;
use App\Category ;
use App\BloodType ;
use App\Setting ;
use App\DonationRequest;


class MainController extends Controller
{
   
    // -----------Governorates --------------
    
    public function governorates(){
        $governorate = Governorate::all();
        return  responseJson(1 , 'success' , $governorate) ;
    }

    // -----------Cities --------------

    public  function  Cities ( Request $request ) {
        $cities = City::where ( function($query) use($request) {
            if ( $request -> has ('governorate_id') ){
                $query->where ('governorate_id' , $request->governorate_id);
            }
        }) ->get();
        
        return  responseJson(1 , 'success' , $cities) ;
    }
// -----------Categories --------------

    public function categories(){
        $categories =Category::all();
        return responsejson ( 1 , " success " , $categories );
    }
    
// -----------Settings --------------

public function settings(){
    $settings =Setting::all();
    return responsejson ( 1 , " success " , $settings );
}


// -----------Blood Types --------------

    public function blood_types(){
        $bloodtypes =BloodType::all();
        return responsejson ( 1 , " success " , $bloodtypes );
    }


// -----------Posts --------------

  public function posts(Request $request){
        $posts = Post::where ( function($query) use($request){
            if($request ->has('category_id') ){
                $query->where('category_id', $request->category_id);
            }
            if ($request ->has('keyword')){
                $query ->where( 'title' , 'like',  '%'.$request->keyword.'%' )
                        ->orWhere('content', 'like',  '%'.$request->keyword.'%');
            }
        })->get();
        return  responseJson(1 , 'success' , $posts) ;
    }

    //--------------- Post --------------------
    public function post(Request $request ,$id){
        $post =$request->user()->posts()->find($id);
        if(!$post){
            return responseJson(0 ,'failed' );
        }
        return responseJson(1,'success',$post);


    }


      // -----------Favourite Posts  --------------

    public function favourite_posts(Request $request){
        $posts = $request->user()->posts()->latest()->paginate();
        if(!$posts){
            return responseJson(0 ,'failed' );
        }
        return responseJson(1,'success',$posts);

    }

      // ----------- toggle Favourite  --------------
      public function toggle_favourite (Request $request){
        $post = $request->user()->posts()->toggle($request->post_id);
        if(!$post){
            return responseJson(0 ,'failed' );
        }
        return responseJson(1,'success',$post);

    }
   
     
    // -----------donation Requests --------------

    public function donation_requests(Request $request){
        $donationrequests = DonationRequest::where( function($query) use($request){
            if($request->has('blood_type_id') ){
                $query->where('blood_type_id' ,'=',$request->blood_type_id);
            }
            if($request->has('city_id') ){
                $query->where('city_id' ,'=',$request->city_id);
            }
        })->get();

        return responseJson(1,'success',$donationrequests);
    }
    // ----------- Single donation Request --------------

    public function donation_request(Request $request ,$id){
        $donationrequest =DonationRequest::find($id);
        if(!$donationrequest){
            return responseJson(0 ,'failed' );
        }

        if($donationrequest->notification()->count()) {

            $request->user()->notifications()->updateExistingPivot($donationrequest->notification->id, [
 
                'is_read' => 1
 
            ]);
            return responseJson(1,'success',$donationrequest);
        }

        

    }
    public function count(Request $request){
        $count=$request->user()->notifications()->where(function ($query) {
           $query->where('is_read',0) ;
        })->count();
        return responseJson(1,'load',[
            'notifications_count' => $count
        ]);
    }

    
}
