<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }

    public function store()
    {
        $attributes=request()->validate([
            'name'=>'required|max:255',
            'username'=>'required|max:255|unique:users,username',
            'email'=>'required|email|max:255|unique:users,email',
            'password'=>'required'
        ]);

        $user=User::create($attributes);

        //log the user in after create the account
        auth()->login($user);

        // redirect home with a flash message of success
        return redirect('/')->with('success', 'Your account has been created. ');
    }
}
