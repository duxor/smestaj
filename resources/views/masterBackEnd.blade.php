<!--
         _____ _ _ __\/_____ __ _   ___ ___ ___ _ __\/___ _/___
        |_    | | |  ___/   |  \ | |   | __|   | |  ___/ |  __/
         _| | | | |___  | ^ | |  | | ^_| __| ^_| |___  | | |__
        |_____|_,_|_____|_|_|_|__| |_| |___|_|\ _|_____|_|____|

        Hvala što se interesujete za kod :)

        Kontakt za developere: kontakt@dusanperisic.com

-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Administracija</title>
    {!! HTML::style('css/bootstrap.min.css') !!}
    {!! HTML::style('css/templejtBackEnd.css') !!}
    {!! HTML::script('js/jquery-3.0.js') !!}
    {!! HTML::script('js/funkcije.js') !!}
    {!! HTML::script('tinymce/tinymce.min.js') !!}
    <style>h1,h2,p{text-align: center}</style>

</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#dMenija">
                <span class="sr-only">Prikaži menij</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{!! url('/') !!}" class="navbar-brand">[BREND]</a>
        </div>
        <div id="dMenija" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(\App\Security::autentifikacijaTest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Korisnici <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!!url('/administracija/korisnik')!!}"><i class="glyphicon glyphicon-eye-open"></i> Pregled</a></li>
                            <li><a href="{!!url('/administracija/korisnik/novi')!!}"><i class="glyphicon glyphicon-plus"></i> Dodaj novi</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-qrcode"></i> Aplikacije <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!!url('/administracija/aplikacija/tema')!!}"><i class="glyphicon glyphicon-eye-open"></i> Pregled tema</a></li>
                            <li><a href="{!!url('/administracija/aplikacija/tema-nova')!!}"><i class="glyphicon glyphicon-plus"></i> Nova tema</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> Osnovna <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="glyphicon glyphicon-eye-open"></i> Pregled</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-plus"></i> Dodaj novi</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-stats"></i> Analitika <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="glyphicon glyphicon-eye-open"></i> Piwik</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-plus"></i> Google</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-plus"></i> LOG</a></li>
                        </ul>
                    </li>
                    <li><a href="{!!url('/administracija/logout')!!}"><span class="glyphicon glyphicon-off"></span> Odjava</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

@yield('body')

{!! HTML::script('js/bootstrap.min.js') !!}
</body>
</html>
