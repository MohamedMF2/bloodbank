<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class AdminController extends Controller
{
    public function edit(){
        $user = User::where('id', auth()->user()->id );
        return view('admin.edit',compact('user'));
    }

    public function store(Request $request ){
      $data= request()->validate([
            'password' => 'required|confirmed',
       ]);
     $user = User::where('id',auth()->user()->id)->first();
     $request ->merge( ['password' => bcrypt($request->password) ] );
     $user->update($request->all());
        flash()->success(' password changed successfully');
        return redirect(route('admin.edit'));
       
    }
}
