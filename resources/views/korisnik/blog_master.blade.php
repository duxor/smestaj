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
    <title>Blog</title>
    {!!HTML::style('css/bootstrap.min.css')!!}
    {!!HTML::script('js/jquery-3.0.js')!!}
    {!!HTML::style('css/fontello.css')!!}
    {!!HTML::style('css/animation.css')!!}

    {!!HTML::script('js/CircularLoader.js')!!}
    {!!HTML::style('css/bootstrap-social.css')!!}
    {!! HTML::style('css/bootstrap-switch.css') !!}
    {!!HTML::style('css/font-awesome.css')!!}

</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" >
    <div id="IznadNav" style="background-color: #fff;background-image:url('/teme/osnovna-paralax/slike/logo/urban-png-70x1920.jpg'); height: 70px;"><a href="/"><img src="/teme/osnovna-paralax/slike/logo/logo500x1201.png"></a></div>
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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" id="brend" class="navbar-brand" style="display: none;margin-top: -15px">
                    <img src="/teme/osnovna-paralax/slike/logo/logo50x200.jpg">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="#">Blog</a>
                    </li>
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
