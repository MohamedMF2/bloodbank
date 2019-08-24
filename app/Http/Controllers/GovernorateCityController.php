<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Governorate ;
use App\City ;

class GovernorateCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $governorate_id )
    {
        $governorate = Governorate::find($governorate_id);
        $cities =$governorate->cities()->paginate(10);
        return view ('cities.index',compact('governorate_id','cities','governorate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($governorate_id)
    {
        $governorate = Governorate::find($governorate_id);
        
        return view('cities.create',compact('governorate_id','governorate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($governorate_id ,Request $request )
    {
        City::create($request->all() + ['governorate_id' => $governorate_id]);
        return redirect(route('governorate.city.index', $governorate_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $governorate_id , City $city )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $governorate_id ,City $city )
    {
        return view('cities.edit', compact('governorate_id', 'city'));  
      }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $governorate_id,Request $request,City $city )
    {
        $city->update($request->all());
        return redirect(route('governorate.city.index', $governorate_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($governorate_id,City $city)
    {
        $city->delete();
        return redirect(route('governorate.city.index', $governorate_id));
    }
}
