<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
        $users = User::paginate(10);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         request()->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:3',
            'roles_list' => 'required'
        ]);

        $request-> merge([ 'password' =>Hash::make($request->password) ]);
       
        $user = User::create($request->except('roles_list'));
        $user ->roles()->attach($request->input('roles_list'));    
        flash()->success(' New User Has been created successfully');

        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
     request()->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|unique:users,email,'.$user->id,
            'password' => 'required|confirmed|min:3',
            'roles_list' => 'required'

        ]);
        $user ->roles()->sync($request->input('roles_list'));
        $request ->merge( ['password' => bcrypt($request->password) ] );
        $user ->update($request->all());
        flash()->success('User updated Successfully');
        return redirect(route('user.edit',$user->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        flash()->success($user->name.' deleted successfully');
        return(redirect(route('user.index')));
    }
 
}
