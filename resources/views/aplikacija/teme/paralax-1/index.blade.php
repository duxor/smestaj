@extends('aplikacija.teme.paralax-1.master')

@section('body')
    {{--pocetna START::--}}
    <div
            class="parallax-image-wrapper parallax-image-wrapper-100"
            data-anchor-target="#{{$podaci[0]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 150%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-100"
                style="background-image:url('/{{$podaci['pozadine'][0]['sadrzaj']}}')"
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
                style="background-image:url('/{{$podaci['pozadine'][1]['sadrzaj']}}')"
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
                style="background-image:url('/{{$podaci['pozadine'][2]['sadrzaj']}}')"
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
                style="background-image:url('/{{$podaci['pozadine'][3]['sadrzaj']}}')"
                data-anchor-target="#{{$podaci[3]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -60%, 0px);"
                data-top-bottom="transform: translate3d(0px, 60%, 0px);"
                ></div>
    </div>
    {{--Kontakt END::--}}

    <div id="skrollr-body">
        <div class="content content-full" id="{{$podaci[0]['slug']}}">
            <div style="margin-left: -1em;position: absolute;width: 100%;height: 100%">
                <img style="height: 100%;width: 100%" src="/{{\App\OsnovneMetode::randomFoto('galerije/'.$podaci['app']['username'].'/aplikacije/'.$podaci['app']['slug'].'/'.$podaci['app']['slugTema'].'/pozadine-2')}}">
            </div>
            <div class="container">
                <div class="col-sm-5 pretraga">
                    <div style="
                        padding: 10px 30px;
                        background-color: rgba(38,38,38,0.7);
                        color:#fff;
                        -webkit-border-radius: 10px;
                        -moz-border-radius: 10px;
                        border-radius: 10px;
                    ">
                        <p><i class="glyphicon glyphicon-search"></i> Pronađite savršen smeštaj</p>
                        <div role="tabpanel">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab-rezervacije" aria-controls="tab-rezervacije" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i> Rezervacije</a></li>
                            </ul>
                            <div class="tab-content" style="padding:0 10px">
                                <div role="tabpanel" class="tab-pane fade in active" id="tab-rezervacije">
                                    {!!Form::open(['url'=>'/'.$podaci['app']['slug'].'/pretraga','class'=>'form-horizontal'])!!}
                                    {!!Form::hidden('tacan_broj',1)!!}
                                    {!!Form::hidden('aplikacija',$podaci['app']['id'])!!}
                                    <div class="form-group">
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
                                        $('#datarange .input-daterange').datepicker({orientation: "top auto",weekStart: 1,startDate: "current",todayBtn: "linked",toggleActive: true,format: "yyyy-mm-dd"});
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
                                    Pretraga po nazivu smeštajnog kapaciteta (po brendu).
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
                {!!$podaci[3]['sadrzaj']!!}
            </div>
        </div>
        <div class="gap gap-100"></div>
        {{--Kontakt END::--}}

        {{--footer START::--}}
        <div class="content" id="done" style="height: 200px;">
            <div class="container">
                <div style="height: 150px;" class="col-sm-2">
                    <a href="http://dusanperisic.com" class="btn btn-lg btn-primary"><i>dusanperisic.com</i></a>
                </div>
                <div style="height: 150px;" class="col-sm-2">
                            @if($podaci['app']['facebook']!= null)
                            <a href="{{$podaci['app']['facebook']}}" class="btn btn-social-icon btn-facebook">
                                <i class="fa fa-facebook"></i>
                            </a>@endif
                            @if($podaci['app']['twitter']!=null)
                            <a href="{{$podaci['app']['twitter']}}" class="btn btn-social-icon btn-twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                            @endif
                            @if($podaci['app']['google']!=null)
                            <a href="{{$podaci['app']['google']}}" class="btn btn-social-icon btn-google">
                                <i class="fa fa-google"></i>
                            </a>@endif
                            @if($podaci['app']['skype']!=null)
                            <a href="{{$podaci['app']['skype']}}" class="btn btn-social-icon btn-skype">
                                <i class="fa fa-skype"></i>
                            </a>@endif

                </div>
                <div class="col-sm-2">
                </div>
                <div style="height: 150px;"  class="col-sm-4">             
                    <h4>Prijavite se na našu mail-ing listu.</h4>
                    <i class='icon-spin4 animate-spin' style="color:rgba(0,0,0,0)"></i>
                    <div id="vrti" style="display:none;"><center><i class='icon-spin4 animate-spin' style="font-size: 150%"></i></center></div>
                 <div id="poruka" style="display:none"></div>
                 <div id="forma-news">
                    {!!Form::hidden('_token',csrf_token())!!}
                    {!!Form::hidden('nalog_id',$podaci['app']['id'])!!}
                        <div id="zabrani" class="input-group">
                          <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
                          {!!Form::text('email',null,['id'=>'email','class'=>'form-control','placeholder'=>'mail@email.com'])!!}
                        </div>
                        <br />
                        {!!Form::button('<span class="glyphicon glyphicon-mail"></span> Prijavite se!', ['id'=>'sakri','class'=>'btn btn-lg btn-primary','onclick'=>'Komunikacija.posalji("/aplikacija/news","forma-news","poruka","vrti","zabrani")' ])!!}
                        <script>
                            $('#sakri').click(function(){
                                $(this).hide(function(){
                                    setTimeout(function() { $('#sakri').show() }, 7000)});
                                });
                         
                        </script>
                    </div>
                </div>    


                <div style="height: 150px;"  class="col-sm-2">
                    <a href="{!!url('/administracija')!!}" class="btn btn-lg btn-default"><i class="glyphicon glyphicon-cog"></i> Administracija</a>
                </div>
            </div>
        </div>
        {{--footer END::--}}
    </div>
@endsection