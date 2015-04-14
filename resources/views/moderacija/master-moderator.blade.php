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
    <title>Moderacija</title>
    {!! HTML::style('css/bootstrap.min.css') !!}
    {!! HTML::style('css/templejtBackEnd.css') !!}
    {!! HTML::script('js/jquery-3.0.js') !!}
    {!! HTML::script('js/funkcije.js') !!}
    {!! HTML::script('tinymce/tinymce.min.js') !!}

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
            <a href="{!! url('/') !!}" class="navbar-brand">najSmeštaj</a>
        </div>
        <div id="dMenija" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(\App\Security::autentifikacijaTest(4))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!!url('/moderator/podesavanja')!!}"><i class="glyphicon glyphicon-wrench"></i> Podešavanja</a></li>
                            <li><a href="{!!url('')!!}"><i class="glyphicon glyphicon-pencil"></i> Sadržaji</a></li>
                            <li><a href="{!!url('')!!}"><i class="glyphicon glyphicon-comment"></i> Komentari</a></li>
                            <li><a href="{!!url('')!!}"><i class="glyphicon glyphicon-envelope"></i> Newsletter</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-home"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!!url('')!!}"><i class=""></i> Pregled</a></li>
                            <li><a href="{!!url('')!!}"><i class=""></i> Novi</a></li>
                            <li><a href="{!!url('')!!}"><i class=""></i> Pregled smeštaja</a></li>
                            <li><a href="{!!url('')!!}"><i class=""></i> Novi smeštaj</a></li>
                            <li><a href="{!!url('')!!}"><i class=""></i> Slobodni</a></li>
                            <li><a href="{!!url('')!!}"><i class=""></i> Zauzeti</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-list-alt"></i> Rezervacije <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!!url('')!!}"><i class=""></i> Aktuelne</a></li>
                            <li><a href="{!!url('')!!}"><i class=""></i> Arhiva</a></li>
                            <li><a href="{!!url('')!!}"><i class=""></i> Gosti</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-briefcase"></i> Saradnja <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!!url('')!!}"><i class=""></i> Aktuelno</a></li>
                            <li><a href="{!!url('')!!}"><i class=""></i> Pretraga</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-stats"></i> Analitika <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!!url('')!!}"><i class="glyphicon glyphicon-euro"></i> Finansije</a></li>
                            <li><a href="{!!url('')!!}"><i class="glyphicon glyphicon-user"></i> Korisnici</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Profil <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="/profil"><i class="glyphicon glyphicon-eye-open"></i> Pregled</a></li>
                            <li><a href="/profil/edit-nalog"><i class="glyphicon glyphicon-pencil"></i> Uredi</a></li>
                            <li><a href="{!!url('/log/logout')!!}"><i class="glyphicon glyphicon-off"></i> Odjava</a></li>
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
