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
    {!!HTML::style('css/bootstrap.min.css')!!}
    {!!HTML::style('css/fontello.css')!!}
    {!!HTML::style('css/animation.css')!!}
    {!!HTML::style('teme/paralax-1/css/parallax.css')!!}
    {!!HTML::style('css/datepicker.css')!!}
    {!!HTML::style('css/responsive-calendar.css')!!}
    {!!HTML::style('teme/paralax-1/css/templejt.css')!!}
    {!! HTML::style('css/slider.css') !!}



    {!!HTML::script('js/jquery-3.0.js')!!}
    {!!HTML::script('js/datepicker.js')!!}
    {!!HTML::script('js/komentari.js')!!}
    {!!HTML::script('js/map/modestmaps.js')!!}
    {!!HTML::script('js/map/modestmaps.markers.js')!!}
    {!!HTML::script('js/map/spotlight.js')!!}
    {!!HTML::script('js/responsive-calendar.js')!!}


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
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" id="brend" class="navbar-brand" style="display: none;margin-top: -15px">
                <img src="/teme/osnovna-paralax/slike/logo/logo50x200.jpg">
            </a>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @foreach($podaci as $meni)
                    @if(isset($meni['vrsta_sadrzaja_id']))
                        @if($meni['vrsta_sadrzaja_id']<4)
                            <li><a href="/{{$podaci['app']['slug']}}/#{{$meni['slug']}}" @if(isset($podaci['pocetna'])) class="scroll-link" data-id="{{$meni['slug']}}" @endif @if($meni['slug']=='kontakt') data-toggle="modal" data-target="#posaljiMail" @endif><i class="{{$meni['icon']}}"></i> @if($meni['vrsta_sadrzaja_id']==1){!!$meni['naziv']!!}@endif</a></li>
                        @endif
                    @endif
                @endforeach
                @if(\App\Security::autentifikacijaTest(2,'min'))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Profil <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="/{{\App\OsnovneMetode::osnovniNav()}}"><i class="glyphicon glyphicon-cog"></i> Podešavanja</a></li>
                            <li><a href="/{{\App\OsnovneMetode::osnovniNav()}}/profil"><i class="glyphicon glyphicon-eye-open"></i> Pregled</a></li>
                            <li><a href="/{{\App\OsnovneMetode::osnovniNav()}}/profil/edit-nalog"><i class="glyphicon glyphicon-pencil"></i> Uredi</a></li>
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

<div class="container odmak">
    @yield('content')
</div>

@yield('body')
{{--MODAL:: posalji mail START::--}}
<div class="modal fade" id="posaljiMail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2>Kontaktirajte nas putem email-a</h2>
            </div>
            <div class="modal-body"><i class='icon-spin6 animate-spin' style="color: rgba(0,0,0,0)"></i>
                <div id="_poruka" style="display: none"></div>
                <div id="wait" style="display:none"><center><i class='icon-spin6 animate-spin' style="font-size: 350%"></i></center></div>
                {!! Form::open(['class'=>'form-horizontal','id'=>'kontaktForma']) !!}
                {!!Form::hidden('app',$podaci['app']['id'])!!}
                {!!Form::hidden('korisnik',Session::get('id'))!!}
                <div id="dprezime" class="form-group has-feedback">
                    {!! Form::label('lprezime','Prezime',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('prezime', null, ['class'=>'form-control', 'placeholder'=>'Prezime', 'id'=>'prezime']) !!}
                        <span id="sprezime" class="glyphicon form-control-feedback"></span>
                    </div>
                </div>
                <div id="dime" class="form-group has-feedback">
                    {!! Form::label('lime','Ime',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('ime', null, ['class'=>'form-control', 'placeholder'=>'Ime', 'id'=>'ime']) !!}
                        <span id="sime" class="glyphicon form-control-feedback"></span>
                    </div>
                </div>
                <div id="demail" class="form-group has-feedback">
                    {!! Form::label('lemail','Email',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email','id'=>'email']) !!}
                        <span id="semail" class="glyphicon form-control-feedback"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('ltelefon','Telefon',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('telefon', null, ['class'=>'form-control', 'placeholder'=>'Telefon']) !!}
                    </div>
                </div>
                <div id="dporuka" class="form-group has-feedback">
                    {!! Form::label('lporuka','Poruka',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('poruka', null, ['class'=>'form-control', 'placeholder'=>'Poruka','id'=>'poruka']) !!}
                        <span id="sporuka" class="glyphicon form-control-feedback"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::button('<span class="glyphicon glyphicon-envelope"></span> Pošalji', ['class'=>'btn btn-lg btn-primary posalji']) !!}
                {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Obriši sve', ['class'=>'btn btn-lg btn-danger', 'type'=>'reset']) !!}
                {!! Form::close() !!}
                <script>
                    $('button.posalji').click(function(){
                        if(!SubmitForm.check('kontaktForma')){ alert('Proverite sve podatke i pokušajte ponovo.'); return; }
                        Komunikacija.posalji('/aplikacija/kontaktiraj-moderatora','kontaktForma','_poruka','wait','kontaktForma');
                    });
                </script>
            </div>
        </div>
    </div>
</div>
{{--MODAL:: posalji mail END::--}}
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
