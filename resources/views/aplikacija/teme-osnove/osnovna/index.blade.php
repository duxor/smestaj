@extends('aplikacija.teme-osnove.osnovna.master')

@section('body')
    {{--pocetna START::--}}
    <div
            class="parallax-image-wrapper parallax-image-wrapper-100"
            data-anchor-target="#{{$podaci[0]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 150%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-100"
                style="background-image:url('{{$podaci['pozadine'][0]['sadrzaj']}}')"
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
                style="background-image:url('{{$podaci['pozadine'][1]['sadrzaj']}}')"
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
                style="background-image:url('{{$podaci['pozadine'][2]['sadrzaj']}}')"
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
                style="background-image:url('{{$podaci['pozadine'][3]['sadrzaj']}}')"
                data-anchor-target="#{{$podaci[3]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -60%, 0px);"
                data-top-bottom="transform: translate3d(0px, 60%, 0px);"
                ></div>
    </div>
    {{--Kontakt END::--}}

    <div id="skrollr-body">
        {{--pocetna START::--}}
        <div class="content content-full" id="{{$podaci[0]['slug']}}">
            <div style="margin-left: -1em;position: absolute;width: 100%;height: 100%">
                <img style="height: 100%;width: 100%" src="/teme/osnovna-paralax/slike/pozadina/<?php echo rand(1,5)?>.jpg">
            </div>
            <div class="container">
                <div class="col-sm-5 pretraga">
                    <div style="
                        padding: 10px 30px;
                        background-color: #262626;
                        color:#fff;
                        -webkit-border-radius: 10px;
                        -moz-border-radius: 10px;
                        border-radius: 10px;
                    ">
                        <p><i class="glyphicon glyphicon-search"></i> Pronađite savršen smeštaj</p>
                        <div role="tabpanel">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab-rezervacije" aria-controls="tab-rezervacije" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i> Rezervacije</a></li>
                                <li role="presentation"><a href="#tab-objekti" aria-controls="tab-objekti" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-home"></i> Objekti</a></li>
                            </ul>
                            <div class="tab-content" style="padding:0 10px">
                                <div role="tabpanel" class="tab-pane fade in active" id="tab-rezervacije">
                                    {!!Form::open(['url'=>'/pretraga','class'=>'form-horizontal'])!!}
                                    {!!Form::hidden('tacan_broj',1)!!}
                                    <div class="form-group">
                                        {!!Form::label('lgrad','Grad',['class'=>'control-label'])!!}
                                        {!!Form::select('grad_id',$podaci['grad'],1,['class'=>'form-control'])!!}
                                    </div>
                                    <div class="form-group" id="datarange">
                                        {!!Form::label('lperiod','Izaberite period',['class'=>'control-label'])!!}
                                        <div class="input-daterange input-group col-sm-12" id="datepicker">
                                            {!! Form::text('datumOd',null,['class'=>'input-sm form-control','placeholder'=>'od...']) !!}
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
                                        var d = new Date();
                                        $('input[name=datumOd]').datepicker('setDate',d);
                                        d.setDate(d.getDate()+1);
                                        $('input[name=datumDo]').datepicker('setDate', d);
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
                                <div role="tabpanel" class="tab-pane fade" id="tab-objekti">
                                    Pretraga po nazivu objekta (brenda).
                                    {!!Form::open(['url'=>'/pretraga/smestaji','class'=>'form-horizontal'])!!}
                                    <div class="form-group">
                                        {!!Form::label('lnaziv','Naziv',['class'=>'col-sm-3'])!!}
                                        <div class="col-sm-9">
                                            {!!Form::text('naziv',null,['class'=>'form-control'])!!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9">
                                            {!!Form::button('Pretraži',['type'=>'submit','class'=>'form-control'])!!}
                                        </div>
                                    </div>
                                    {!!Form::close()!!}
                                </div>
                            </div>

                        </div>

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
        <div class="content-full container" id="{{$podaci[1]['slug']}}">
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
                <div class="col-sm-7">{!!$podaci[3]['sadrzaj']!!}</div><i class='icon-spin6 animate-spin' style="color: rgba(0,0,0,0)"></i>
                <div id="wait" style="display:none"><center><i class='icon-spin6 animate-spin' style="font-size: 350%"></i></center></div>
                <div id="kontaktForma" class="col-sm-5 form-horizontal">
                    <div id="_poruka" style="display: none"></div>
                    {!!Form::open(['id'=>'frm_id'])!!}
                    {!!Form::hidden('_token',csrf_token())!!}
                    {!!Form::hidden('user',Session::get('username'))!!}
                    <div id="dprezime" class="form-group has-feedback">{!!Form::text('prezime',null,['placeholder'=>'Prezime','class'=>'form-control','id'=>'prezime'])!!}<span id="sprezime" class="glyphicon form-control-feedback"></span></div>
                    <div id="dime" class="form-group has-feedback">{!!Form::text('ime',null,['placeholder'=>'Ime','class'=>'form-control','id'=>'ime'])!!}<span id="sime" class="glyphicon form-control-feedback"></span></div>
                    <div id="demail" class="form-group has-feedback">{!!Form::email('email',null,['placeholder'=>'Email','class'=>'form-control','id'=>'email'])!!}<span id="semail" class="glyphicon form-control-feedback"></span></div>
                    <div class="form-group">{!!Form::select('kome',['tehno'=>'Tehnička podrška','info'=>'Informacije','sugestije'=>'Sugestije'],null,['placeholder'=>'Prezime','class'=>'form-control','id'=>'prezime'])!!}</div>
                    <div id="dporuka" class="form-group has-feedback">{!!Form::textarea('poruka',null,['placeholder'=>'Poruka','class'=>'form-control','id'=>'poruka'])!!}<span id="sporuka" class="glyphicon form-control-feedback"></span></div>
                    <div class="form-group">{!!Form::button('<i class="glyphicon glyphicon-envelope"></i> Pošalji',['class'=>'btn btn-lg btn-default','id'=>'kontakt_btn'])!!}</div>
                    <script>
                        $('#kontakt_btn').click(function(){
                            if(!SubmitForm.check('frm_id')){ alert('Popunite sve podatke i pokušajte ponovo.'); return; }
                            Komunikacija.posalji('/aplikacija/kontaktiraj-administraciju','kontaktForma','_poruka','wait','frm_id');
                        });
                    </script>
                </div>
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
@endsection