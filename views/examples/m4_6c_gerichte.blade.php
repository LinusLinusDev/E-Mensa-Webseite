<!---
- Praktikum DBWT. Autoren:
- Linus, Palm, 3271087
- David, Rechkemmer, 3074595
--->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>m4_6c_gerichte</title>
</head>
<body>
@empty($gerichte)
    <h1>Es sind keine Gerichte vorhanden</h1>
@endempty
<ul>
    @foreach($gerichte as $gericht)
        <li>Gericht: {{$gericht['name']}} , Preis: {{number_format($gericht['preis_intern'],2,'.')}} €</li>
    @endforeach
</ul>
</body>
</html>