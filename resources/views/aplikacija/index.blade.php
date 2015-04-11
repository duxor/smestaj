@extends('master-paralax-1')

@section('body')
    {{--pocetna START::--}}
    <div
            class="parallax-image-wrapper parallax-image-wrapper-100"
            data-anchor-target="#{{$podaci[0]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 150%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-100"
                style="background-image:url('{{$podaci['pozadine'][0]}}')"
                data-anchor-target="#{{$podaci[0]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -80%, 0px);"
                data-top-bottom="transform: translate3d(0px, 80%, 0px);"
                ></div>
    </div>
    {{--pocetna END::--}}

    {{--Smestaj START::--}}
    <div
            class="parallax-image-wrapper parallax-image-wrapper-100"
            data-anchor-target="#{{$podaci[1]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 200%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-100"
                style="background-image:url('{{$podaci['pozadine'][1]}}')"
                data-anchor-target="#{{$podaci[1]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -80%, 0px);"
                data-top-bottom="transform: translate3d(0px, 80%, 0px);"
                ></div>
    </div>
    {{--Smestaj END::--}}

    {{--Rezervacije START::--}}
    <div
            class="parallax-image-wrapper parallax-image-wrapper-50"
            data-anchor-target="#{{$podaci[2]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 320%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-50"
                style="background-image:url('{{$podaci['pozadine'][2]}}')"
                data-anchor-target="#{{$podaci[2]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -60%, 0px);"
                data-top-bottom="transform: translate3d(0px, 60%, 0px);"
                ></div>
    </div>
    {{--Rezervacije END::--}}

    {{--Kontakt START::--}}
    <div
            class="parallax-image-wrapper parallax-image-wrapper-100"
            data-anchor-target="#{{$podaci[3]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 300%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-50"
                style="background-image:url('{{$podaci['pozadine'][3]}}')"
                data-anchor-target="#{{$podaci[3]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -60%, 0px);"
                data-top-bottom="transform: translate3d(0px, 60%, 0px);"
                ></div>
    </div>
    {{--Kontakt END::--}}

    <div id="skrollr-body">
        {{--pocetna START::--}}
        <div class="content content-full" id="{{$podaci[0]['slug']}}"><div id="map" style="height:650px;margin-top:-80px;width:104%;margin-left: -3%;"></div>
            <div class="container" style="margin-top: -500px">
                <div class="col-sm-5">
                    <div style="
                        padding: 10px 30px;
                        background-color: #262626;
                        color:#fff;
                        -webkit-border-radius: 10px;
                        -moz-border-radius: 10px;
                        border-radius: 10px;
                    ">
                        {!!Form::open(['url'=>'/pretraga','class'=>'form-horizontal'])!!}
                        <div class="form-group">
                            <p><i class="glyphicon glyphicon-search"></i> Pronađite savršen smeštaj</p>
                            {!!Form::label('lgrad','Grad',['class'=>'control-label'])!!}
                            {!!Form::select('grad_id',$podaci['grad'],1,['class'=>'form-control'])!!}
                        </div>
                        <div class="form-group" id="datarange">
                            {!!Form::label('lperiod','Izaberite period',['class'=>'control-label'])!!}
                            <div class="input-daterange input-group col-sm-12" id="datepicker">
                                {!! Form::text('datumOd', null, ['class'=>'input-sm form-control','placeholder'=>'od...']) !!}
                                <span class="input-group-addon">do</span>
                                {!! Form::text('datumDo', null, ['class'=>'input-sm form-control','placeholder'=>'do...']) !!}
                            </div>
                        </div>
                        <script>
                            $('#datarange .input-daterange').datepicker({
                                orientation: "top auto",
                                weekStart: 1,
                                startDate: "current",
                                todayBtn: "linked",
                                toggleActive: true,
                                format: "yyyy-mm-dd"
                            });
                        </script>
                        <div class="form-group">
                            {!!Form::label('lgrad','Broj osoba',['class'=>'control-label'])!!}
                            {!!Form::select('broj_osoba',[1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12],2,['class'=>'form-control'])!!}
                        </div>
                        <div class="form-group" style="text-align: right">
                            {!!Form::button('<i class="glyphicon glyphicon-search"></i> Pretraga',['class'=>'btn btn-lg btn-primary','type'=>'submit'])!!}
                        </div>
                        {!!Form::close()!!}

                    </div>
                </div>
                <div class="col-sm-7">
                    <div style="width: 100%; height: 500px"></div>
                </div>
            </div>
        </div>
        <div class="gap gap-100"></div>
        {{--pocetna END::--}}

        {{--Smestaj START::--}}
        <div class="content" id="{{$podaci[1]['slug']}}">
                <h1>{!!$podaci[1]['naziv']!!}</h1>
                {!!$podaci[1]['sadrzaj']!!}
        </div>
        <div class="gap gap-100"></div>
        {{--Smestaj END::--}}

        {{--Rezervacije START::--}}
        <div class="content content-full" id="{{$podaci[2]['slug']}}">
            <div class="container">
                <h1>{!!$podaci[2]['naziv']!!}</h1>
                {!!$podaci[2]['sadrzaj']!!}
            </div>
        </div>
        <div class="gap gap-50"></div>
        {{--Rezervacije END::--}}

        {{--Kontakt START::--}}
        <div class="content" id="{{$podaci[3]['slug']}}">
            <div class="container">
                <h1>{!!$podaci[3]['naziv']!!}</h1>
                {!!$podaci[3]['sadrzaj']!!}
            </div>
        </div>
        <div class="gap gap-100"></div>
        {{--Kontakt END::--}}

        {{--footer START::--}}
        <div class="content" id="done" style="height: 200px;">
            <div class="container">
                <div class="col-sm-10">
                    <p>Autor: Dušan Perišić</p>
                    <a href="http://dusanperisic.com" class="btn btn-lg btn-primary"><i>dusanperisic.com</i></a>
                </div>
                <div class="col-sm-2">
                    <a href="{!!url('/administracija')!!}" class="btn btn-lg btn-default"><i class="glyphicon glyphicon-cog"></i> Administracija</a>
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
                    {!! Form::button('<span class="glyphicon glyphicon-envelope"></span> Pošalji', ['class'=>'btn btn-lg btn-primary', 'onClick'=>'SubmitForma.submit("kontaktForma")']) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Obriši sve', ['class'=>'btn btn-lg btn-danger', 'type'=>'reset']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    {{--MODAL:: posalji mail END::--}}
@stop