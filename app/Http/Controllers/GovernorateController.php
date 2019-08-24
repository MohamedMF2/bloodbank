<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Governorate ;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $governorates =Governorate::paginate(20);
        return view('governorates.index',compact('governorates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('governorates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->validate([
            'name'=>'required|min:3'
        ]);
         
        Governorate::create($data);
        flash()->success('A New Governorate ( '. $request->name.' ) has been added successfully ');
        return redirect(route('governorate.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $governorate = Governorate::findOrFail($id);
       return view ('governorates.edit',compact('governorate'));
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
        $governorate = Governorate::findOrFail($id);
        $governorate ->update($request->all());
        flash()->success('edited successfully');
        return redirect(route('governorate.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $governorate = Governorate::findOrFail($id);
         $governorate->delete();
         flash()->success('Item Deleted Successfully');
         return back();
    }
}
