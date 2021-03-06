<!---
- Author: Linus Palm
- Date: 14.01.2022
--->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">

    <title>@yield('title')</title>
    <link href="styles/standardstyle.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="img/logo.png" class="logo" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link grow" href="/#announcements">Home</a>
                </li>
                @if(isset($_SESSION['login_ok']))
                    <li class="nav-item">
                        <a class="nav-link grow" href="/profil">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link grow" href="/meinebewertungen">Meine Bewertungen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link grow" href="/logout">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link grow" href="/anmeldung">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container shadow-lg">
    @yield('content')
</div>
<footer class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/impressum">&copy; E-Mensa GmbH</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/LinusLinusDev">Linus Palm</a>
                </li>
            </ul>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>