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
    {!! HTML::style('css/fontello.css') !!}
    {!! HTML::style('css/animation.css') !!}
    {!! HTML::style('css/pregled_smestaja.css') !!}
    {!! HTML::script('js/jquery-3.0.js') !!}
    {!! HTML::script('js/funkcije.js') !!}
    {!! HTML::script('js/pregled_smestaja.js') !!}
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
            <a href="/" id="brend" class="navbar-brand" style="margin-top: -15px">
                <img src="/teme/osnovna-paralax/slike/logo/logo50x200.jpg">
            </a>
        </div>
        <div id="dMenija" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(\App\Security::autentifikacijaTest(4))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-toggle="tooltip" data-placement="bottom" id="mailbox" title="Poruke"><i class="glyphicon glyphicon-envelope"></i>@if(\App\OsnovneMetode::brojNeprocitanihPoruka()>0)<i class="badge">{{\App\OsnovneMetode::brojNeprocitanihPoruka()}}</i>@endif</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Poruke</li>
                            <li class="divider"></li>
                            <li><a href="/moderator/mailbox/kreiraj"><i class="glyphicon glyphicon-edit"></i> Kreiraj poruku</a></li>
                            <li><a href="/moderator/mailbox/inbox"><i class="glyphicon glyphicon-log-in"></i> Inbox @if(\App\OsnovneMetode::brojNeprocitanihPoruka()>0)<i class="badge">{{\App\OsnovneMetode::brojNeprocitanihPoruka()}}</i>@endif </a></li>
                            <li><a href="/moderator/mailbox/poslate"><i class="glyphicon glyphicon-share"></i> Poslate</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="osnovno" data-toggle="tooltip" data-placement="bottom" title="Osnovno"><i class="glyphicon glyphicon-cog"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Osnovno</li>
                            <li class="divider"></li>
                            <li><a href="{!!url('/moderator/podesavanja')!!}"><i class="glyphicon glyphicon-wrench"></i> Podešavanja</a></li>
                            <li><a href="{!!url('/moderator/sadrzaji')!!}"><i class="glyphicon glyphicon-pencil"></i> Sadržaji</a></li>
                            <li><a href="{!!url('/moderator/u-pripremi')!!}"><i class="glyphicon glyphicon-comment"></i> Komentari</a></li>
                            <li><a href="{!!url('/moderator/u-pripremi')!!}"><i class="glyphicon glyphicon-envelope"></i> Newsletter</a></li>
                        </ul>{{--/moderator/komentari--}}
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="objekti" data-toggle="tooltip" data-placement="bottom" title="Objekti"><i class="glyphicon glyphicon-home"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Objekti</li>
                            <li class="divider"></li>
                            <li><a href="{!!url('/moderator/pregled')!!}"><i class="icon-commerical-building "></i> Pregled objekata</a></li>
                            <li><a href="{!!url('/moderator/novi-objekat')!!}"><i class="icon-building"></i> Novi objekat</a></li>
                            <li><a href="{!!url('/moderator/smestaj')!!}"><i class="icon-th-large-outline"></i> Pregled smeštaja</a></li>
                            <li><a href="{!!url('/moderator/novi-smestaj')!!}"><i class="icon-hospital"></i> Novi smeštaj</a></li>
                            <li><a href="{!!url('/moderator/u-pripremi')!!}"><i class="icon-lodging"></i> Slobodni</a></li>
                            <li><a href="{!!url('/moderator/u-pripremi')!!}"><i class="icon-cancel-circled"></i> Zauzeti</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="rezervacije" data-toggle="tooltip" data-placement="bottom" title="Rezervacije"><i class="glyphicon glyphicon-list-alt"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Rezervacije</li>
                            <li class="divider"></li>
                            <li><a href="{!!url('/rezervacija/aktuelne')!!}"><i class="glyphicon glyphicon-check"></i> Aktuelne</a></li>
                            <li><a href="{!!url('/moderator/u-pripremi')!!}"><i class="glyphicon glyphicon-floppy-saved"></i> Arhiva</a></li>
                            <li><a href="{!!url('/moderator/u-pripremi')!!}"><i class="glyphicon glyphicon-user"></i> Gosti</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="saradnja" data-toggle="tooltip" data-placement="bottom" title="Saradnja"><i class="glyphicon glyphicon-briefcase"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Saradnja</li>
                            <li class="divider"></li>
                            <li><a href="{!!url('/moderator/u-pripremi')!!}"><i class="glyphicon glyphicon-eye-open"></i> Aktuelno</a></li>
                            <li><a href="{!!url('/moderator/u-pripremi')!!}"><i class="glyphicon glyphicon-zoom-in"></i> Pretraga</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="galerija" data-toggle="tooltip" data-placement="bottom" title="Galerija"><i class="glyphicon glyphicon-picture"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Galerija</li>
                            <li class="divider"></li>
                            @if(\App\OsnovneMetode::aplikacije())
                            @foreach(\App\OsnovneMetode::aplikacije() as $aplikacije)
                                <li><a href="/moderator/{{$aplikacije['slug']}}/galerije">{{$aplikacije['naziv']}}</a></li>
                            @endforeach
                            @else
                                <li>Ne postoji ni jedna aplikacija u evidenciji.</li>
                            @endif
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="analitika" data-toggle="tooltip" data-placement="bottom" title="Analitika"><i class="glyphicon glyphicon-stats"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Analitika</li>
                            <li class="divider"></li>
                            <li><a href="{!!url('/moderator/u-pripremi')!!}"><i class="glyphicon glyphicon-euro"></i> Finansije</a></li>
                            <li><a href="{!!url('/moderator/u-pripremi')!!}"><i class="glyphicon glyphicon-user"></i> Korisnici</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="profil" data-toggle="tooltip" data-placement="bottom" title="Profil"><i class="glyphicon glyphicon-user"></i></a>
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
<script>
    $(function(){$('#osnovno').tooltip()})
    $(function(){$('#objekti').tooltip()})
    $(function(){$('#rezervacije').tooltip()})
    $(function(){$('#saradnja').tooltip()})
    $(function(){$('#galerija').tooltip()})
    $(function(){$('#analitika').tooltip()})
    $(function(){$('#profil').tooltip()})
    $(function(){$('#mailbox').tooltip()})
</script>

<div class="container">
    @yield('content')
</div>

@yield('body')

{!! HTML::script('js/bootstrap.min.js') !!}
</body>
</html>
