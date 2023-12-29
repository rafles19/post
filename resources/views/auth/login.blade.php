@extends('layouts.master')

@section('content')
    <h2>Login</h2>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @auth
    @else
        <form method="POST" action="{{ url('/login') }}">
            @csrf

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>

            <button type="submit">Login</button>
            <a href="/register">ga punya akun?bikin disini aja</a>
        </form>   
    @endauth
@endsection