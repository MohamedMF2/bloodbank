<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data = request()->validate([
           'name' =>'required|unique:roles,name',
           'display_name'=>'required',
          'permissions_list' =>'required|array' ,
        ]);

       $role= Role::create($request->all());
       $role->permissions()->attach($request->permissions_list);
        flash()->success('Role created successfully');
        
        return redirect(route('role.index'));
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
        $role = Role::findOrFail($id);
        return view('roles.edit',compact('role'));
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
        $data = request()->validate([
            'name' =>'required|unique:roles,name,'.$id,
            'display_name'=>'required',
            'permissions_list' => 'required|array'
            ]);
        
        $role =Role::findOrFail($id);
        $role->update($request->all());
        $role->permissions()->sync($request->permissions_list);
        flash()->success('updated successfully');
        return redirect(route('role.index'));
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role =Role::find($id);
        $role ->delete();
        flash()->success('Role deleted successfully');
        return redirect(route('role.index'));
    }
}
