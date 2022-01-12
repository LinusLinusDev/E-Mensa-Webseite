<!---
- Praktikum DBWT. Autoren:
- Linus, Palm, 3271087
- David, Rechkemmer, 3074595
--->
@extends('layouts.standard')

@section('title')
    Profil
@endsection

@section('content')
    <div class="profile">
        <h4>Eingeloggt als</h4>
        <h6>E-Mail: {{$data['email']}}</h6>
        <h6>
            Benutzerrolle:
            @if($data['admin'])
                Administrator
            @else
                Benutzer
            @endif
        </h6>
        <h6>Anzahl der Anmeldungen: {{$data['anzahlanmeldungen']}}</h6>
    </div>
@endsection