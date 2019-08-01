<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index(Request $request)
   {
       $clients=Client::where(function ($query) use ($request){
           if($request->has('search')){
               $query->whereHas('city',function ($city) use($request){
                   $city->where('name','like','%'.$request->search.'%');
               });
               $query->orWhere(function ($query) use($request){
                   $query->where('name','like','%'.$request->search.'%')
                         ->orWhere('phone','like','%'.$request->search.'%');
               });
               $query->orWhereHas('bloodType',function ($bloodType) use($request){
                $bloodType->where('type','like','%'.$request->search.'%');
            });
            $query->orWhereHas('bloodType',function ($bloodType) use($request){
                $bloodType->where('type','like','%'.$request->search.'%');
            });
               
           }
       })->latest()->paginate();


       return view('clients.index',compact('clients'));
   }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show( Client $client)
    {
       return view('clients.show',compact('client'));
    }


    public function edit($id)
    {
       $client = Client::findOrFail($id);
       return view ('clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client ->update($request->all());
        flash()->success('edited successfully');
        return redirect(route('client.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        flash()->success('Client Deleted Successfully');
        return back();
    }


   /* public function search (Request $request){
        $request ->validate([
            'query'=> 'required|min:3',
        ]);
        $query =$request->input('query');
        $clients = Client::where('name','like',"%$query%")->paginate(10);
        return view('clients.search',compact('clients'));
    }*/
}
