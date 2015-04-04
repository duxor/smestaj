@extends('master')

<?php
$gMapa = "<div id='googleMap' style='height:300px;'></div>";
?>


@section('body')
    <!--pocetna START::-->
    <div
            class="parallax-image-wrapper parallax-image-wrapper-100"
            data-anchor-target="#{{$meni[0]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 150%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-100"
                style="background-image:url({!! $pozadina[4] !!})"
                data-anchor-target="#{{$meni[0]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -80%, 0px);"
                data-top-bottom="transform: translate3d(0px, 80%, 0px);"
                ></div>
    </div>
    <!--pocetna END::-->

    <!-- START::-->
    <div
            class="parallax-image-wrapper parallax-image-wrapper-100"
            data-anchor-target="#{{$meni[1]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 200%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-100"
                style="background-image:url({!! $pozadina[5] !!})"
                data-anchor-target="#{{$meni[1]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -80%, 0px);"
                data-top-bottom="transform: translate3d(0px, 80%, 0px);"
                ></div>
    </div>
    <!-- START::-->

    <!-- START::-->
    <div
            class="parallax-image-wrapper parallax-image-wrapper-50"
            data-anchor-target="#{{$meni[2]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 350%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-50"
                style="background-image:url({!! $pozadina[6] !!})"
                data-anchor-target="#{{$meni[2]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -60%, 0px);"
                data-top-bottom="transform: translate3d(0px, 60%, 0px);"
                ></div>
    </div>
    <!-- END::-->

    <!-- START::-->
    <div
            class="parallax-image-wrapper parallax-image-wrapper-100"
            data-anchor-target="#{{$meni[3]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 300%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-50"
                style="background-image:url({!! $pozadina[7] !!})"
                data-anchor-target="#{{$meni[3]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -60%, 0px);"
                data-top-bottom="transform: translate3d(0px, 60%, 0px);"
                ></div>
    </div>
    <!-- END::-->

    <!-- START::-->
    <div
            class="parallax-image-wrapper parallax-image-wrapper-100"
            data-anchor-target="#{{$meni[4]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 300%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-50"
                style="background-image:url({!! $pozadina[8] !!})"
                data-anchor-target="#{{$meni[4]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -60%, 0px);"
                data-top-bottom="transform: translate3d(0px, 60%, 0px);"
                ></div>
    </div>
    <!-- END::-->

    <!--Kontakt START::-->
    <div
            class="parallax-image-wrapper parallax-image-wrapper-50"
            data-anchor-target="#{{$meni[5]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 300%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-50"
                style="background-image:url({!! $pozadina[9] !!})"
                data-anchor-target="#{{$meni[5]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -60%, 0px);"
                data-top-bottom="transform: translate3d(0px, 60%, 0px);"
                ></div>
    </div>
    <!--Kontakt END::-->

    <div id="skrollr-body">


        {{--pocetna START::--}}
        <div id="{{$meni[0]['slug']}}">
            <?php require_once'php/slideshow.php'?>
        </div>
        <div class="gap gap-100"></div>
        {{--pocetna END::--}}

        {{--O nama START::--}}
        <div class="content" id="{{$meni[1]['slug']}}">
            <div class="container">
                <h1>{!! $podaci[1]['naslov'] !!}</h1>
                {!! $podaci[1]['sadrzaj'] !!}
            </div>
        </div>
        <div class="gap gap-100"></div>
        {{--O nama END::--}}

        {{-- START::--}}
        <div class="content content-full" id="{{$meni[2]['slug']}}">
            <div class="container">

            </div>
        </div>
        <div class="gap gap-50"></div>
        {{-- END::--}}

        {{-- START::--}}
        <div class="content" id="{{$meni[3]['slug']}}">
            <div class="container">

            </div>
        </div>
        <div class="gap gap-100"></div>
        {{-- END::--}}

        {{-- START::--}}
        <div class="content" id="{{$meni[4]['slug']}}">
            <div class="container">

            </div>
        </div>
        <div class="gap gap-100"></div>
        {{-- END::--}}

        {{--kontakt START::--}}
        <div class="content content-full" id="{{$meni[5]['slug']}}">
            <div class="container">
                <h1>{!! $podaci[5]['naslov'] !!}</h1>
                <div id='googleMap' style='height:300px;'></div>
                {!! $podaci[5]['sadrzaj'] !!}
                <p>Kontaktirajte nas putem <a href="#" data-toggle="modal" data-target="#posaljiMail" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-envelope"></span> email-a</a></p>
            </div>
        </div>
        <div class="gap gap-100"></div>
        {{--kontakt END::--}}

        {{--footer START::--}}
        <div class="content" id="done" style="height: 200px;">
            <div class="container">
                <div class="col-sm-10">
                    <p>Autor: Dušan Perišić</p>
                    <p>web developer & dizajner</p>
                    <a href="http://dusanperisic.com" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-hand-right"></span> <i>dusanperisic.com</i></a>
                </div>
                <div class="col-sm-2">
                    <a href="/administracija" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-cog"></span> Administracija</a>
                </div>
            </div>
        </div>
        {{--footer END::--}}
    </div>


    {{--MODAL:: posalji mail START::--}}
    <div class="modal fade" id="posaljiMail">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2>Kontaktirajte nas putem email-a</h2>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url'=>'/posalji-email','class'=>'form-horizontal','id'=>'kontaktForma']) !!}
                    <div id="dk_ime" class="form-group has-feedback">
                        {!! Form::label('lime','Ime',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('k_ime', null, ['class'=>'form-control', 'placeholder'=>'Ime i Prezime', 'id'=>'k_ime']) !!}
                            <span id="sk_ime" class="glyphicon form-control-feedback"></span>
                        </div>
                    </div>

                    <div id="dk_email" class="form-group has-feedback">
                        {!! Form::label('lemail','Email',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::email('k_email', null, ['class'=>'form-control', 'placeholder'=>'Email','id'=>'k_email']) !!}
                            <span id="sk_email" class="glyphicon form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('ltelefon','Telefon',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('telefon', null, ['class'=>'form-control', 'placeholder'=>'Telefon']) !!}
                        </div>
                    </div>

                    <div id="dk_poruka" class="form-group has-feedback">
                        {!! Form::label('lporuka','Poruka',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea('k_poruka', null, ['class'=>'form-control', 'placeholder'=>'Poruka','id'=>'k_poruka']) !!}
                            <span id="sk_poruka" class="glyphicon form-control-feedback"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::button('<span class="glyphicon glyphicon-envelope"></span> Pošalji', ['class'=>'btn btn-lg btn-success', 'onClick'=>'SubmitForma.submit(\'kontaktForma\')']) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Obriši sve', ['class'=>'btn btn-lg btn-danger', 'type'=>'reset']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    {{--MODAL:: posalji mail END::--}}
@endsection