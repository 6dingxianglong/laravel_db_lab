<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //todo: 目前使用明碼，之後改成Bcrypt 

        $credentials = $request->only('account', 'password');
        $role = $request->input('role');

        if (strtoupper(substr($credentials['account'], 0, 1)) == 'M') {
        
            $user = Student::where('sid', $credentials['account'])->first();
        
            if ($user && $user->password === $credentials['password']) {
                Auth::guard('student')->login($user); 
                session()->flash('login_success', true);
                return redirect()->intended('/learn');
            }
        } 
        if (strtoupper(substr($credentials['account'], 0, 1)) == 'T') {
        
            $user = Teacher::where('tid', $credentials['account'])->first();
            if ($user && $user->password === $credentials['password']) {
                Auth::guard('teacher')->login($user); 
                session()->flash('login_success', true);
                return redirect()->intended('/teach');
            }
        }

        return back()->withErrors(['account' => '學號或教職編號及密碼錯誤']);
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        Auth::guard('teacher')->logout();
        return redirect('/');
    }
}
