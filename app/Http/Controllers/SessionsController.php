<?php

namespace App\Http\Controllers;


use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // validate the request
        $attributes=request()->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        // attempt to auth and login the user based on the provided credentials
        if(! auth()->attempt($attributes)){
            throw validationException::withMessages(
                ['email'=>'Your provided credentials could not be verified']);
        }

        //session fixation attack handling, prevent attacks to gain access of user account from the sessionId
        session()->regenerate();

        return redirect('/')->with('success', 'Welcome back');


    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye');
    }
}
