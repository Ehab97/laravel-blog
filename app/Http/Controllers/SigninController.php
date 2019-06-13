<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SigninController extends Controller
{
    public function signin(Request $request){
//        dd('our own auth');
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(Auth::attempt([
                          'email'=>$request->input('email'),
                          'password'=>$request->input('password')],
                           $request->has('remember'))){
            return redirect()->route('admin.index');
        }
        return redirect()->back()->with('fail','Authentication failed');
    }
}
