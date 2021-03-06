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
    {!!HTML::style('css/fontello.css')!!}
    {!!HTML::style('css/animation.css')!!}
    {!! HTML::script('js/funkcije.js') !!}
    {!! HTML::script('tinymce/tinymce.min.js') !!}
    {!!HTML::style('css/bootstrap-social.css')!!}
    {!! HTML::style('css/bootstrap-switch.css') !!}
    {!!HTML::style('css/font-awesome.css')!!}



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
            <a href="/" id="brend" class="navbar-brand" style="margin-top: -15px">
                <img src="/teme/osnovna-paralax/slike/logo/logo50x200.jpg">
            </a>
        </div>
        <div id="dMenija" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(\App\Security::autentifikacijaTest(5,'min'))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-toggle="tooltip" data-placement="bottom" id="mailbox" title="Poruke"><i class="glyphicon glyphicon-envelope"></i>@if(\App\OsnovneMetode::brojNeprocitanihPoruka()>0)<i class="badge">{{\App\OsnovneMetode::brojNeprocitanihPoruka()}}</i>@endif</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Poruke</li>
                            <li class="divider"></li>
                            <li><a href="/administracija/mailbox/kreiraj"><i class="glyphicon glyphicon-edit"></i> Kreiraj poruku</a></li>
                            <li><a href="/administracija/mailbox"><i class="glyphicon glyphicon-log-in"></i> Inbox @if(\App\OsnovneMetode::brojNeprocitanihPoruka()>0)<i class="badge">{{\App\OsnovneMetode::brojNeprocitanihPoruka()}}</i>@endif </a></li>
                            <li><a href="/administracija/mailbox/poslate"><i class="glyphicon glyphicon-share"></i> Poslate</a></li>
                            <li><a href="/administracija/mailbox/mejl"><i class="glyphicon glyphicon-share"></i> Pošalji mejl</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Korisnici <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!!url('/administracija/korisnik')!!}"><i class="glyphicon glyphicon-eye-open"></i> Pregled</a></li>
                            <li><a href="{!!url('/administracija/korisnik/novi')!!}"><i class="glyphicon glyphicon-plus"></i> Novi</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-qrcode"></i> Aplikacije <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!!url('/administracija/nalog/sadrzaji/osnovna')!!}"><i class="glyphicon glyphicon-cog"></i> Osnovna</a></li>
                            <li><a href="{!!url('/administracija/nalog')!!}"><i class="glyphicon glyphicon-eye-open"></i> Pregled</a></li>
                            <li><a href="{!!url('/administracija/nalog/nalog-novi')!!}"><i class="glyphicon glyphicon-plus"></i> Nova</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-text-height"></i>eme <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!!url('/administracija/aplikacija/tema')!!}"><i class="glyphicon glyphicon-eye-open"></i> Pregled</a></li>
                            <li><a href="{!!url('/administracija/aplikacija/tema-nova')!!}"><i class="glyphicon glyphicon-plus"></i> Nova</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-stats"></i> Analitika <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="glyphicon glyphicon-eye-open"></i> Piwik</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-plus"></i> Google</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-plus"></i> Log</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Profil <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="/{{\App\OsnovneMetode::osnovniNav()}}/profil"><i class="glyphicon glyphicon-eye-open"></i> Pregled</a></li>
                            <li><a href="/{{\App\OsnovneMetode::osnovniNav()}}/profil/edit-nalog"><i class="glyphicon glyphicon-pencil"></i> Uredi</a></li>
                            <li><a href="{!!url('/log/logout/end')!!}"><i class="glyphicon glyphicon-off"></i> Odjava</a></li>
                        </ul>
                    </li>
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
