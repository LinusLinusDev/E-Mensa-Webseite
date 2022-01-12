<!---
- Praktikum DBWT. Autoren:
- Linus, Palm, 3271087
- David, Rechkemmer, 3074595
--->
@extends('layouts.standard')

@section('title')
    Bewertung
@endsection

@section('content')
    <h1>Bewertung abgeben</h1>
    <h2>{{$name}}</h2>
    <img class="examplepicture" alt="{{$name}}.jpg" src="img/@if(isset($bildname)){{$bildname}}@else{{'00_image_missing.jpg'}}@endif">
    <form class="bewertungsform" method="post" action="/bewertung_speichern">
        <form method="post" action="/bewertung_speichern">
            <div class="form-floating mb-3">
                <textarea minlength="5" maxlength="500" class="form-control" id="bemerkung" name="bemerkung" placeholder="Bemerkung" rows="5" required></textarea>
                <label for="bemerkung">Bemerkung</label>
            </div>
            <div>
                <input type="number" name="gerichtid" value="{{$gerichtid}}" hidden>
                <input type="number" name="userid" value="{{$userid}}" hidden>
            </div>
            <select class="form-select" aria-label="Default select example" id="sternebewertung" name="sternebewertung">
                <option value="sehr gut" selected>sehr gut</option>
                <option value="gut" selected>gut</option>
                <option value="schlecht">schlecht</option>
                <option value="sehr schlecht">sehr schlecht</option>
            </select>
            <button type="submit" class="btn btn-outline-dark">Bewertung speichern</button>
        </form>
    </form>
@endsection