<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function showCorrectHomepage() {
        if (auth()->check()) {
            return view('index');
        } else {
            return view('auth.login');
        }
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $requests){
        $req = $requests->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200']
        ]);

        $req['password'] = bcrypt($req['password']);
        $user = User::create($req);
        //auth()->login($user);
        return redirect('/login');
    }
}
