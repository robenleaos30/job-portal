<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    // Show register/create form
    public function create()
    {
        return view("users.register");
    }

    // Create New User
    public function store(Request $request)
    {  
        $formField = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required','min:6']
        ]);

        // Hash Password
        $formField['password'] = bcrypt($formField['password']);

        // Create User
        $user = User::create($formField);

        // Login
        auth()->login($user);

        return redirect('/')->with('message','User sign up sucessfully and log in!!');
    }

    // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message','You have been logged out!!');
    }

    // Login user
    public function login() {
        return view('users.login');
    }

    // Authenticate user
    public function authenticate(Request $request) {
        $formField = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($formField)) {
            $request->session()->regenerate();

            return redirect('/')->with('message','You have been authenticated!!');
        }

        return back()->withErrors(['email'=> 'Invalid credentials!!'])->onlyInput('email');
    }
}
