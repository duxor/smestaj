<!--
         _____ _ _ __\/_____ __ _   ___ ___ ___ _ __\/___ _/___
        |_    | | |  ___/   |  \ | |   | __|   | |  ___/ |  __/
         _| | | | |___  | ^ | |  | | ^_| __| ^_| |___  | | |__
        |_____|_,_|_____|_|_|_|__| |_| |___|_|\ _|_____|_|____|

        Hvala što se interesujete za kod :)

        Kontakt za developere: kontakt@dusanperisic.com

-->

<!DOCTYPE html>
<html lang="sr" class="no-skrollr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <title>najSmestaj</title>
    {!! HTML::style('teme/osnovna-paralax/css/templejt.css') !!}
    {!! HTML::style('css/bootstrap.min.css') !!}
    {!! HTML::style('css/fontello.css') !!}
    {!! HTML::style('css/animation.css') !!}
    {!! HTML::style('teme/osnovna-paralax/css/parallax.css') !!}
    {!! HTML::style('css/datepicker.css') !!}

    {!! HTML::script('js/jquery-3.0.js') !!}
    {!! HTML::script('js/datepicker.js') !!}
    {!!HTML::script('js/map/modestmaps.js')!!}
    {!!HTML::script('js/map/modestmaps.markers.js')!!}
    {!!HTML::script('js/map/spotlight.js')!!}
    @yield('head')
</head>

<body>
{{--navigacija START::--}}
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div id="IznadNav" style="background-color: #fff;background-image:url('/teme/osnovna-paralax/slike/logo/urban-png-70x1920.jpg');height: 70px"><a href="/"><img src="/teme/osnovna-paralax/slike/logo/logo500x1201.png"></a></div>
    <script>
        $(document).scroll(function(){
            if($(document).scrollTop()<$(document).height()*0.1){
                $("#IznadNav").slideDown();
                $('#brend').fadeOut();
            }
            else if($(document).scrollTop()>$(document).height()*0.15) {
                $("#IznadNav").slideUp();
                $('#brend').fadeIn();
            }
        });
    </script>
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" id="brend" class="navbar-brand" style="display: none;margin-top: -15px">
                <img src="/teme/osnovna-paralax/slike/logo/logo50x200.jpg">
            </a>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="navbar">
            <ul class="nav navbar-nav">
                @foreach($podaci as $meni)
                    @if(isset($meni['vrsta_sadrzaja_id']))
                        @if($meni['vrsta_sadrzaja_id']<4)
                            <li><a href="/#{{$meni['slug']}}" @if(isset($podaci['pocetna'])) class="scroll-link" data-id="{{$meni['slug']}}" @endif><i class="{{$meni['icon']}}"></i> @if($meni['vrsta_sadrzaja_id']==1){!! $meni['naziv'] !!}@endif</a></li>
                        @endif
                    @endif
                @endforeach
                @if(\App\Security::autentifikacijaTest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Profil <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a @if(\App\Security::autentifikacijaTest(5)) href="/administracija" @else href="/moderator" @endif><i class="glyphicon glyphicon-cog"></i> Podešavanja</a></li>
                            <li><a href="/profil"><i class="glyphicon glyphicon-eye-open"></i> Pregled</a></li>
                            <li><a href="/profil/edit-nalog"><i class="glyphicon glyphicon-pencil"></i> Uredi</a></li>
                            <li><a href="{!!url('/log/logout')!!}" style="color:red"><i class="glyphicon glyphicon-off"></i> Odjava</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="/log/login"><i class="glyphicon glyphicon-log-in"></i> Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
{{--navigacija END::--}}

<div class="container">
    @yield('content')
</div>

@yield('body')
{!! HTML::script('teme/osnovna-paralax/js/skrollr.min.js') !!}
<script type="text/javascript">
    skrollr.init({
        smoothScrolling: false,
        mobileDeceleration: 0.004
    });
</script>

@if(!isset($podaci['pocetna']))
    <div class="footer">
        <div class="container">
            <div class="col-sm-10">
                <p class="text-muted">Autor: Dušan Perišić</p>
                <a href="http://dusanperisic.com" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-hand-right"></span> <i>dusanperisic.com</i></a>
            </div>
            <div class="col-sm-2">
                <a href="{!! url('/administracija') !!}" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-cog"></span> Administracija</a>
            </div>
        </div>
    </div>
@endif

{!! HTML::script('js/bootstrap.min.js') !!}
{!! HTML::script('js/funkcije.js') !!}

</body>
</html>