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
    {!!HTML::style('css/bootstrap.min.css')!!}
    {!!HTML::style('css/templejtBackEnd.css')!!}
    {!!HTML::script('js/jquery-3.0.js')!!}
    {!!HTML::style('css/fontello.css')!!}
    {!!HTML::style('css/animation.css')!!}
    {!!HTML::script('js/funkcije.js')!!}
    {!!HTML::script('tinymce/tinymce.min.js')!!}
    {!!HTML::style('css/datepicker.css')!!}
    {!!HTML::script('js/datepicker.js')!!}
     {!!HTML::script('js/CircularLoader.js')!!}
    {!!HTML::style('css/bootstrap-social.css')!!}
    {!! HTML::style('css/bootstrap-switch.css') !!}
    {!!HTML::style('css/font-awesome.css')!!}

    {!!HTML::script('js/bootstrap-switch.js')!!}
</head>
<body style=" width:100%;  height:100%; border-bottom:2px solid #b5b1b1; background: url(/galerije/korisnik/teme/paralax-1/pozadine-1/contact_bg.jpg) no-repeat center center fixed;">

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
                @if(\App\Security::autentifikacijaTest(2))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-toggle="tooltip" data-placement="bottom" id="mailbox" title="Poruke"><i class="glyphicon glyphicon-envelope"></i>@if(\App\OsnovneMetode::brojNeprocitanihPoruka()>0)<i class="badge">{{\App\OsnovneMetode::brojNeprocitanihPoruka()}}</i>@endif</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Poruke</li>
                            <li class="divider"></li>
                            <li><a href="/korisnik/mailbox/kreiraj"><i class="glyphicon glyphicon-edit"></i> Kreiraj poruku</a></li>
                            <li><a href="/korisnik/mailbox"><i class="glyphicon glyphicon-log-in"></i> Inbox @if(\App\OsnovneMetode::brojNeprocitanihPoruka()>0)<i class="badge">{{\App\OsnovneMetode::brojNeprocitanihPoruka()}}</i>@endif </a></li>
                            <li><a href="/korisnik/mailbox/poslate"><i class="glyphicon glyphicon-share"></i> Poslate</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="smestaj" data-toggle="tooltip" data-placement="bottom" title="Smeštaj"><i class="glyphicon glyphicon-home"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Smeštaj</li>
                            <li class="divider"></li>
                            <li><a href="{!!url('/korisnik/u-pripremi')!!}"><i class="glyphicon glyphicon-search"></i> Pretraga</a></li>
                            <li><a href="{!!url('/korisnik/u-pripremi')!!}"><i class="glyphicon glyphicon-thumbs-up"></i> Preporuke</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="popusti" data-toggle="tooltip" data-placement="bottom" title="Popusti"><i class="glyphicon glyphicon-sort-by-attributes-alt"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Popusti</li>
                            <li class="divider"></li>
                            <li><a href="{!!url('/korisnik/u-pripremi')!!}"><i class="glyphicon glyphicon-bookmark"></i> Bonus</a></li>
                            <li><a href="{!!url('/korisnik/u-pripremi')!!}"><i class="glyphicon glyphicon-search"></i> Pretraga</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="posete" data-toggle="tooltip" data-placement="bottom" title="Posete"><i class="glyphicon glyphicon-globe"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Posete</li>
                            <li class="divider"></li>
                            <li><a href="{!!url('/korisnik/u-pripremi')!!}"><i class="glyphicon glyphicon-eye-open"></i> Pregled</a></li>
                            <li><a href="{!!url('/aplikacija/lista-zelja')!!}"><i class="glyphicon glyphicon-heart-empty"></i> Lista želja</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="rezervacije" data-toggle="tooltip" data-placement="bottom" title="Rezervacije"><i class="glyphicon glyphicon-list-alt"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Rezervacije</li>
                            <li class="divider"></li>
                            <li><a href="{!!url('/rezervacije/aktivne')!!}"><i class="glyphicon glyphicon-wrench"></i> Aktivne</a></li>
                            <li><a href="{!!url('/korisnik/u-pripremi')!!}"><i class="glyphicon glyphicon-pencil"></i> Arhiva</a></li>
                        </ul>
                    </li>
                    <li><a href="{!!url('korisnik/u-pripremi')!!}" id="galerija" data-toggle="tooltip" data-placement="bottom" title="Galerija"><i class="glyphicon glyphicon-picture"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="analitika" data-toggle="tooltip" data-placement="bottom" title="Analitika"><i class="glyphicon glyphicon-stats"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Analitika</li>
                            <li class="divider"></li>
                            <li><a href="{!!url('/korisnik/u-pripremi')!!}"><i class="glyphicon glyphicon-euro"></i> Finansije</a></li>
                            <li><a href="{!!url('/korisnik/u-pripremi')!!}"><i class="glyphicon glyphicon-user"></i> Korisnici</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="profil" data-toggle="tooltip" data-placement="bottom" title="Profil"><i class="glyphicon glyphicon-user"></i></a>
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
<script>
    $(document).ready(function(){
        $('#smestaj').tooltip();
        $('#popusti').tooltip();
        $('#posete').tooltip();
        $('#rezervacije').tooltip();
        $('#poruke').tooltip();
        $('#profil').tooltip();
        $('#galerija').tooltip();
        $('#analitika').tooltip();
        $('#mailbox').tooltip();
    


    });
</script>

<div class="container">
    @yield('content')
</div>

@yield('body')

{!! HTML::script('js/bootstrap.min.js') !!}


</body>
</html>
