<!---
- Author: Linus Palm
- Date: 14.01.2022
--->
@extends('layouts.standard')

@section('title')
    Bewertungen
@endsection

@section('content')
    <h1>Bewertungen</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Bewertetes Gericht</th>
            <th scope="col">Bewertet als</th>
            <th scope="col">Bemerkung</th>
            <th scope="col">Bewertungszeitpunkt</th>
            @if($_SESSION['login_ok'] && $admin == 1)
                <th></th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($bewertungen as $bewertung)
            <tr @if($bewertung['hervorheben']==1) class="table-warning" @endif>
                <td>{{$bewertung['name']}}</td>
                <td>{{$bewertung['sternebewertung']}}</td>
                <td>{{$bewertung['bemerkung']}}</td>
                <td>{{$bewertung['bewertungszeitpunkt']}}</td>
                @if($_SESSION['login_ok'] && $admin == 1)
                    @if($bewertung['hervorheben']==0)
                        <td>
                            <form method="POST" action="bewertung_hervorheben">
                                <input type="number" name="bewertungsid" value="{{$bewertung['id']}}" hidden>

                                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#Modal{{$bewertung['id']}}">
                                    Hervorheben
                                </button>

                                <div class="modal fade" id="Modal{{$bewertung['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Bist du dir sicher?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Wenn du diesen Vorgang bestätigst, wird die ausgewählte Bewertung hervorgehoben und auf der Startseite angezeigt.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                                                <button type="submit" class="btn btn-outline-dark">Bewertung hervorheben</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    @else
                        <td>
                            <form method="POST" action="bewertung_hervorheben_abwaehlen">
                                <input type="number" name="bewertungsid" value="{{$bewertung['id']}}" hidden>

                                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#Modal{{$bewertung['id']}}">
                                    Hervorhebung abwählen
                                </button>

                                <div class="modal fade" id="Modal{{$bewertung['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Bist du dir sicher?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Wenn du diesen Vorgang bestätigst, wird die ausgewählte Bewertung nicht mehr hervorgehoben und auf der Startseite angezeigt.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                                                <button type="submit" class="btn btn-outline-dark">Hervorhebung abwählen</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    @endif
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    <div id="farewell">
        <h1>Wir freuen uns auf Ihren Besuch!</h1>
    </div>
@endsection