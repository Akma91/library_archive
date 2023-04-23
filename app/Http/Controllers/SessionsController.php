<?php

namespace App\Http\Controllers;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $loginFormValues = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt($loginFormValues)){
            session()->regenerate();

            return redirect(request()->query('redirect') ? request()->query('redirect') : '/')
                ->with('success', 'Uspješno ste prijavljeni!');
        }

        return back()
                ->withInput()
                ->withErrors(['email' => 'Korisnik s navedenim podatcima ne postoji u sustavu!']);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Uspješno ste odjavljeni!');
    }
}
