<!---
- Praktikum DBWT. Autoren:
- Linus, Palm, 3271087
- David, Rechkemmer, 3074595
--->
@extends('layouts.standard')

@section('title')
    Newsletteranmeldungen
@endsection

@section('content')
    <div id="newsletter">
        <h1>Newsletteranmeldungen</h1>
        <form method="get">
            <label for="filter">Filter</label>
            <input id="filter" type="text" name="filter" value="">
            <select id="sort" name="sort">
                <option value="" selected>Anmeldedatum</option>
                <option value="name">Vorname</option>
                <option value="familyname">Nachname</option>
                <option value="email">E-Mail</option>
                <option value="lang">Sprache</option>
            </select>
            <input type="submit" value="Sortieren">
        </form>
        <br>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Vorname</th>
                <th scope="col">Nachname</th>
                <th scope="col">Email</th>
                <th scope="col">Sprache</th>
            </tr>
            </thead>
            <tbody>
            @foreach($entrys as $entry)
                <tr>
                    <td>{{$entry['name']}}</td>
                    <td>{{$entry['familyname']}}</td>
                    <td>{{$entry['email']}}</td>
                    <td>{{$entry['lang']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div id="farewell">
        <h1>Wir freuen uns auf Ihren Besuch!</h1>
    </div>
@endsection