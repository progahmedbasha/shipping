<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;

class LoginController extends Controller
{
    
    public function loginForm()
    {
        return \view('admin.auth.login');
    }

    public function login(AdminLoginRequest $request)
    {
        // return $request;
        
        $remmberMe = $request->has('remember_me') ? true : false;

        if(Auth::guard('admin')->attempt(['email' =>$request->email,'password' =>$request->password]))
        {
            return redirect()->route('Dashboard');
        }
        return back()->with(['error' => 'البيانت غير صحيحة']);
    }

    public function logout()
    {
        \auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }


    
}
