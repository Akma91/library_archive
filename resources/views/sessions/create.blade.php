@extends('layout')

@section('content')

<div class="form">
    <form id="loginForm" method="POST" action="/login">
        @csrf

        <label class="formLabel" for="email">E-mail</label>
        <input class="loginInput" name="email" type="email" autocomplete="username" required />
        @error('email')
            <p>{{ $message }}</p>
        @enderror
        <br/>

        <label class="formLabel" for="password">Lozinka</label>
        <input class="loginInput" name="password" type="password" autocomplete="current-password" required />
        @error('password')
            <p>{{ $message }}</p>
        @enderror
        <br/>
        <br/>
        <button class="submitButton" type="submit">Prijavi se</button>
    </form>
</div>

@endsection