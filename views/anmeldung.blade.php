<!---
- Author: Linus Palm
- Date: 14.01.2022
--->
@extends('layouts.standard')

@section('title')
    Anmeldung
@endsection

@section('content')
    @if(isset($msg))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{$msg}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="login">
        <h1>Login</h1>
        <form method="post" action="/anmeldung_verfizieren">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail" required>
                <label for="name">E-Mail</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Passwort" required>
                <label for="name">Passwort</label>
            </div>
            <button type="submit" class="btn btn-outline-dark">Einloggen</button>
        </form>
    </div>
@endsection