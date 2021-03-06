<!---
- Author: Linus Palm
- Date: 14.01.2022
--->
@extends('layouts.standard')

@section('title')
    Wunschgericht
@endsection

@section('content')
    <div id="wishes">
        <h1>Hier werden wünsche wahr! Was fehlt noch auf der Speisekarte?</h1>
        <form method="post" action="/neues_wunschgericht">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="foodname" name="foodname" placeholder="Name des Gerichts" required>
                <label for="foodname">Name des Gerichts</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="descr" name="descr" placeholder="Beschreibung" required>
                <label for="descr">Beschreibung</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Dein Name">
                <label for="name">Dein Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Deine E-Mail" required>
                <label for="name">Deine E-Mail</label>
            </div>
            <button type="submit" class="btn btn-outline-dark">Wunsch abschicken</button>
        </form>
    </div>
    <div id="farewell">
        <h1>Wir freuen uns auf Ihren Besuch!</h1>
    </div>
@endsection