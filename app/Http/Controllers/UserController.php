<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'=>['required','email'],
            'password'=>'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('users.index');
        }

        return back()->withErrors(['error'=>'Usuário ou senha Inválida']);
        
    }

    public function index()
    {
       
        $user = User::find(Auth::user()->id);

        $pollsUser = $user->polls()->get();
            
        return view('dashboard',['pollsUser'=>$pollsUser]);
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    protected function redirectTo($request)
    {
        return route('login');
    }
}
