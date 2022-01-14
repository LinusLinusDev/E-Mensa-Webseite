<!---
- Author: Linus Palm
- Date: 14.01.2022
--->
@extends('layouts.standard')

@section('title')
    Meine Bewertungen
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
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($bewertungen as $bewertung)
            <tr>
                <td>{{$bewertung['name']}}</td>
                <td>{{$bewertung['sternebewertung']}}</td>
                <td>{{$bewertung['bemerkung']}}</td>
                <td>{{$bewertung['bewertungszeitpunkt']}}</td>
                <td>
                    <form method="POST" action="bewertung_loeschen">
                        <input type="number" name="bewertungsid" value="{{$bewertung['id']}}" hidden>

                        <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#Modal{{$bewertung['id']}}">
                            Löschen
                        </button>

                        <div class="modal fade" id="Modal{{$bewertung['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Bist du dir sicher?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Wenn du diesen Vorgang bestätigst, wird die ausgewählte Bewertung unwiderruflich gelöscht.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                                        <button type="submit" class="btn btn-outline-dark">Bewertung löschen</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div id="farewell">
        <h1>Wir freuen uns auf Ihren Besuch!</h1>
    </div>
@endsection