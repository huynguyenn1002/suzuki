<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLoginForm()
    {
        return view("login.login");
    }

    public function adminLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::guard("admin")->attempt($credentials)) {
            return redirect()->route("contract.list.get");
        }
        return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
    
        session()->flush();
    
        return redirect('/login');
    }

}
