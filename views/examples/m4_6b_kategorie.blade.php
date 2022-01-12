<!---
- Praktikum DBWT. Autoren:
- Linus, Palm, 3271087
- David, Rechkemmer, 3074595
--->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>m4_6b_kategorie</title>
</head>
<body>
    <ul>
        @foreach($names as $name)
            <li style="{{ $loop->odd ? 'font-weight: bold;' : '' }}"> {{ $name['name'] }} </li>
        @endforeach
    </ul>
</body>
</html>