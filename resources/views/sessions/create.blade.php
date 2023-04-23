@extends('layout')

@section('content')

<div class="form">
    <form id="loginForm" method="POST" action="/login?redirect={{Request::get('redirect')}}">
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
        <div id="publishButtonSection">
            <button id="publishButton" type="submit">Prijavi se</button>
        </div>
    </form>
</div>

@endsection