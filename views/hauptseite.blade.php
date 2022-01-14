<!---
- Author: Linus Palm
- Date: 14.01.2022
--->
@extends('layouts.standard')

@section('title')
    Ihre E-Mensa
@endsection

@section('content')
    @if($message!='')
        @if($warning)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>
                    @if($deleted) Löschen
                    @else Speichern @endif
                    fehlgeschlagen!
                </strong>{{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(!$warning)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>
                    @if($deleted) Löschen
                    @else Speichern @endif
                    erfolgreich!
                </strong>{{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endif
    <div id="announcements">
        <h1>Bald gibt es Essen auch online!</h1>
        <div>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</div>
    </div>
    @if(sizeof($bewertungen)>0)
    <div id="reviews">
        <h1>Meinungen unserer Gäste</h1>
        <table class="table table-hover table-warning">
            <thead>
            <tr>
                <th scope="col">Bewertetes Gericht</th>
                <th scope="col">Bemerkung</th>
                <th scope="col">Bewertet als</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bewertungen as $bewertung)
                <tr>
                    <td>{{$bewertung['name']}}</td>
                    <td>{{$bewertung['bemerkung']}}</td>
                    <td>{{$bewertung['sternebewertung']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <div id="food">
        <h1>Köstlichkeiten, die Sie erwarten:</h1>
        <table class="table">
            <head>
                <tr>
                    <th scope="col">
                        <form method="GET" action="/">
                            <input type="checkbox" name="viewAll" checked hidden>
                            <button type="submit" class="btn btn-outline-dark">Alle Gerichte anzeigen</button>
                        </form>
                    </th>
                    <th scope="col">
                        <form method="GET" action="/">
                            <input type="checkbox" name="viewAll" hidden>
                            <button type="submit" class="btn btn-outline-dark">Fünf zufällige Gerichte anzeigen</button>
                        </form>
                    </th>
                </tr>
            </head>
        </table>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">Gericht</th>
                <th scope="col">(Allergene)</th>
                <th scope="col">Preise</th>
                @if(isset($_SESSION['login_ok']))
                    <th scope="col">Bewertungen</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($meals as $meal)
                <tr>
                    <td colspan="2"><img alt="{{$meal['name']}}.jpg" src="img/@if(isset($meal['bildname'])){{$meal['bildname']}}@else{{'00_image_missing.jpg'}}@endif"></td>
                    <td colspan="2">{{ $meal['name'] }}
                        @if(isset($meal['allergene']))
                            ({{$meal['allergene']}}})
                        @endif
                    </td>
                    <td>{{"intern: ".number_format($meal['preis_intern'],2,',')}} €<br>{{"extern: ".number_format($meal['preis_extern'],2,',')}} €</td>
                    @if(isset($_SESSION['login_ok']))
                        <td><a class="link" href="/bewertung?gerichtid={{$meal['id']}}">Bewertung abgeben</a></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <h4>Noch nicht überzeugt? Dann sieh dir unsere <a class="link" href="/bewertungen">Bewertungen</a> an!</h4>
        <h4>Oder ist dein Lieblingsgericht gar nicht dabei? Dann <a class="link" href="/wunschgericht">wünsche es dir</a> für die Zukunft!</h4>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Allergene
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Allergen</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allergene as $allergen)
                            <tr>
                                <td>{{ $allergen['code'] }}</td>
                                <td>{{ $allergen['name'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="data">
        <h1>E-Mensa in Zahlen:</h1>
        <table class="table table-borderless">
            <thead>
            <tr>
                <th scope="col">Besuche</th>
                <th scope="col"><a class="link" href="/newsletteranmeldungen">Anmeldungen zum Newsletter</a></th>
                <th scope="col">Speisen</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$visitors}}</td>
                <td>{{$newsletterCount}}</td>
                <td>{{$mealstotal}}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div id="contact">
        <h1>Interesse geweckt? Wir informieren Sie!</h1>
        <form method="post" action="/neue_newsletteranmeldung">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Vorname" required>
                <label for="name">Vorname</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="familyname" name="familyname" placeholder="Nachname" required>
                <label for="name">Nachname</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail" required>
                <label for="name">E-Mail</label>
            </div>
            <select class="form-select" aria-label="Default select example" id="language" name="language">
                <option value="Deutsch" selected>Deutsch</option>
                <option value="Englisch">Englisch</option>
                <option value="Französisch">Französisch</option>
            </select>
            <div>
                <input id="dataprotection" type="checkbox" name="dataprotection" required>
                <label for="dataprotection"> Den Datenschutzbestimmungen stimme ich zu</label>
            </div>
            <button type="submit" class="btn btn-outline-dark">Zum Newsletter anmelden</button>
        </form>
    </div>
    <div id="about">
        <h1>Das ist uns wichtig:</h1>
        <h3>- Beste frische saisonale Zutaten</h3>
        <h3>- Ausgewogene abwechslungsreiche Gerichte</h3>
        <h3>- Sauberkeit</h3>
    </div>
    <div id="farewell">
        <h1>Wir freuen uns auf Ihren Besuch!</h1>
    </div>
@endsection