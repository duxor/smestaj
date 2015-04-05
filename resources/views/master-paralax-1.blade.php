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

    <title>[NASLOV]</title>
    {!! HTML::style('teme/osnovna-paralax/css/templejt.css') !!}
    {!! HTML::style('css/bootstrap.min.css') !!}
    {!! HTML::style('teme/osnovna-paralax/css/parallax.css') !!}
    {!! HTML::style('css/datepicker.css') !!}

    {!! HTML::script('js/jquery-3.0.js') !!}
    @if(isset($podaci['x']))
        {!! HTML::script('http://maps.googleapis.com/maps/api/js') !!}
        <script>var mx="{{$podaci['x']}}", my="{{$podaci['y']}}";</script>
        {!! HTML::script('js/gmap1.js') !!}
    @endif
    {!! HTML::script('js/datepicker.js') !!}
    <style>@yield('style')</style>
</head>

<body>
{{--navigacija START::--}}
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">
                <span class="glyphicon glyphicon-home"></span> [NASLOV]
            </a>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @foreach($podaci as $k => $meni)
                    @if(isset($meni['vrsta_sadrzaja_id']))
                        @if($meni['vrsta_sadrzaja_id']==1)
                            <li><a href="/#{{$meni['slug']}}" class="scroll-link" data-id="{{$meni['slug']}}"><i class="{{$podaci['icon'][$k]}}"></i> {!! $meni['naziv'] !!}</a></li>
                        @endif
                    @endif
                @endforeach
                <li><a href="#"><i class="glyphicon glyphicon-log-in"></i> Login</a></li>
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

@if(!isset($podaci['foother']))
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