@extends('aplikacija.teme.paralax-1.master')
@section('content')
    <div class="row pretraga">
        <div class="col-md-8 toppad">
            <div class="panel-body">
                <div class="media col-md-5">
                <figure class="pull-left">
                    <img class="media-object img-rounded img-responsive"  src="/{{\App\OsnovneMetode::randomFoto('galerije/'.$podaci['app']['username'].'/aplikacije/'.$podaci['app']['slug'].'/smestaji/'.$podaci['smestaj']['slug'])}}" alt="Naslovna fotografija" >
                </figure>   
                </div>
                <div class="col-md-6">
                    <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td><i class="glyphicon glyphicon-home"></i> Naziv objekta</td>
                                <td>{!!$podaci['smestaj']['naziv']!!}</td>
                            </tr>
                            <tr>
                                <td><i class="glyphicon glyphicon-dashboard"></i> Kapacitet</td>
                                <td>{!!$podaci['smestaj']['naziv_kapaciteta']!!}</td>
                            </tr>
                            <tr>
                                <td><i class="glyphicon glyphicon-user"></i> Broj osoba</td>
                                <td>{!!$podaci['smestaj']['broj_osoba']!!}</td>
                            </tr>
                            <tr>
                                <td><i class="glyphicon glyphicon-th-large"></i> Vrsta smeštaja</td>
                                <td>{!!$podaci['smestaj']['vrsta_smestaja']!!}</td>
                            </tr>
                            @if($podaci['smestaj']['adresa'])
                                <tr>
                                    <td><i class="glyphicon glyphicon-map-marker"></i> Adresa</td>
                                    <td>{!!$podaci['smestaj']['adresa']!!}</td>
                                </tr>
                            @endif
                            @if($podaci['smestaj']['grad'])
                                <tr>
                                    <td><i class="glyphicon glyphicon-map-marker"></i> Grad</td>
                                    <td>{!!$podaci['smestaj']['grad']!!}</td>
                                </tr>
                            @endif
                            <tr>
                                <td><i class="glyphicon glyphicon-euro"></i> Cena po osobi</td>
                                <td>{!!$podaci['smestaj']['cena_osoba']!!} din.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pannel-body">
            <hr>
                @if($podaci['smestaj']['opis'])
                <div class="row">
                    <div class="col-md-12">
                    Opis: {!!$podaci['smestaj']['opis']!!}
                    </div><br clear="all"><hr>
                </div>
                @endif
                @if($podaci['oprema'])
                    @foreach($podaci['oprema'] as $opr)
                        <div class="col-sm-4">
                           <i><span class="glyphicon glyphicon-ok"></span>{!! Form::label('oprema', $opr['dodatna_oprema'] ,['class'=>'control-label col-sm-8']) !!}</i>
                        </div>
                    @endforeach
                @endif
            </div>
        </div><!-- KRAJ md-9 -->
        <div class="col-md-4">
        <!-- Responsive calendar - START -->
            <div class="responsive-calendar">
                <div class="controls">
                    <a class="pull-left" data-go="prev"><div class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i></div></a>
                    <h4><span data-head-year></span> <span data-head-month></span></h4>
                    <a class="pull-right" data-go="next"><div class="btn btn-primary"><i class="glyphicon glyphicon-chevron-right"></i></div></a>
                </div><hr/>
                <div class="day-headers">
                  <div class="day header">Pon</div>
                  <div class="day header">Uto</div>
                  <div class="day header">Sre</div>
                  <div class="day header">Čet</div>
                  <div class="day header">Pet</div>
                  <div class="day header">Sub</div>
                  <div class="day header">Ned</div>
                </div>
                <div class="days" data-group="days">
                </div>
            </div>

            <script type="text/javascript">
              $(document).ready(function () {
                  var datum=new Date();
                $(".responsive-calendar").responsiveCalendar({
                  time: datum.getFullYear()+'-'+(datum.getMonth()+1),
                  events: {!!$podaci['kalendar']!!}
                })
              });
            </script><!-- Responsive calendar - END -->
            @if(\App\Security::autentifikacijaTest(2,'min'))
                <button class="btn btn-lg btn-info m" data-toggle="modal" data-target="#rezervacija"><span class="glyphicon glyphicon-check"></span> Rezervacija</button>
            @else
                <a href="/log/login" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-check"></span> Rezervacija</a>
            @endif
        <div class="modal fade" id="rezervacija" tabindex="-1" role="dialog" ><!-- POCETAK modal rezervacija-->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 style="text-align:center"><i class="glyphicon glyphicon-edit" style="font-size: 150%"></i> Rezerviši najbolji</h2>
                    </div>
                    <div class="modal-body">
                        <div id="container-fluid">
                            <div id="vrti" style="display:none"><center><i class='icon-spin6 animate-spin' style="font-size: 350%"></i></center></div>
                            <div id="forma" class="form-horizontal">
                                {!!Form::hidden('id_smestaja',$podaci['smestaj']['id'],['id'=>'id_smestaja'])!!}
                                {!!Form::hidden('id_korisnika',Session::get('id'))!!}
                                {!!Form::hidden('_token',csrf_token())!!}
                                {!!Form::hidden('cena',$podaci['smestaj']['cena_osoba'])!!}
                                {!!Form::hidden('ukupna_cena')!!}
                                <div class="form-group">
                                    <div class="col-sm-4"><img id="foto" style="width:100%" src="/{{\App\OsnovneMetode::randomFoto('galerije/'.$podaci['app']['username'].'/aplikacije/'.$podaci['app']['slug'].'/smestaji/'.$podaci['smestaj']['slug'])}}"></div>
                                    <div class="col-sm-8">
                                        <p id="app" style="text-align:center;text-decoration:underline;margin:0">{{$podaci['app']['nazivApp']}}</p>
                                        <p id="objekat" style="text-align:center;margin:0">{{$podaci['smestaj']['naziv']}}</p>
                                        <p id="vrobjekta" style="text-align:center;margin:0">{{$podaci['smestaj']['vrsta_smestaja']}}</p>
                                        <p id="adresa" style="text-align:center;margin:0">{{$podaci['smestaj']['adresa']}}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group" id="datarange" style="padding-left: 22px">
                                    <div class="input-daterange input-group col-sm-7 col-sm-offset-4" id="datepicker">
                                        {!! Form::text('datumOd', date("Y-m-d"),['class'=>'input-sm form-control datum','placeholder'=>'od...','id'=>'datumod','style'=>'padding:20px']) !!}
                                        <span class="input-group-addon">do</span>
                                        {!! Form::text('datumDo',null,['class'=>'input-sm form-control datum','placeholder'=>'do...','id'=>'datumdo','style'=>'padding:20px'])!!}
                                    </div>
                                </div>
                                <script>$('#datarange .input-daterange').datepicker({orientation:"top auto",weekStart:1,startDate:"current",todayBtn:"linked",toggleActive:true,format:"yyyy-mm-dd"});</script>
                                <div id="broj osoba" class="form-group has-feedback">
                                    {!!Form::label('brojosoba','Broj osoba',['class'=>'control-label col-sm-4'])!!}
                                    <div class="col-sm-4">
                                        {!!Form::select('broj_osoba',[],null,['class'=>'form-control','id'=>'broj_osoba'])!!}
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    {!! Form::label('napomena','Napomena',['class'=>'control-label col-sm-4']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::textarea('napomena',null,['class'=>'form-control','placeholder'=>'Upišite napomenu','id'=>'napomena']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('lcena','Cena',['class'=>'control-label col-sm-4']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::label('lcena',null,['class'=>'control-label','id'=>'cena']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="poruka" style="display:none"></div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::button('<span class="glyphicon glyphicon-remove"></span> Otkaži',['class'=>'btn btn-lg btn-warning','data-dismiss'=>'modal']) !!}
                        {!! Form::button('<span class="glyphicon glyphicon-ok"></span> Rezerviši',['class'=>'btn btn-lg btn-success','onclick'=>'Komunikacija.posalji("/rezervisi",\'forma\',\'poruka\',\'vrti\',\'forma\')' ]) !!}
                    </div>
                </div>
            </div>
        </div><i class='icon-spin6 animate-spin' style="color: rgba(0,0,0,0)"></i>
        <style>._tooltip:hover{color: red}</style>
        <script>
            $(document).ready(function(){$('button').tooltip();$('a').tooltip()});
            $('button.m').click(function(){
                $('input[name=ukupna_cena]').val($('input[name=cena]').val());
                racunajCenu();
                var option = '';
                for(i=1;i<={{$podaci['smestaj']['broj_osoba']}};i++){
                    option += '<option value="'+ i + '">' + i + '</option>';
                }
                $('#broj_osoba').html(option);
            });
            $('#broj_osoba').change(function(){racunajCenu()});
            $('input.datum').change(function(){racunajCenu()});
            function racunajCenu(){
                var cena=$('input[name=cena]').val()*$('#broj_osoba').val()*((new Date($('#datumdo').val())-new Date($('#datumod').val()))/86400000);
                $('#cena').html($.isNumeric(cena)?cena+' din':'Izaberite period.');
                $('input[name=ukupna_cena]').val(cena);
            }
        </script>
        </div><!-- KRAJ col-md-3-->
    </div><!-- KRAJ row -->
<br clear="all"><hr>
<div class='row'>
        <div class='col-md-8'>
            <div class="row">
                <div class="carousel slide media-carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="thumbnail">
                                        <img id="slika-1" class="slike-slajder" src="/galerije/default-galerije/osnovne/smestaj-default.jpg">
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a class="thumbnail slajder-p2">
                                        <img id="slika-2" class="slike-slajder" src="/galerije/default-galerije/osnovne/smestaj-default.jpg">
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a class="thumbnail slajder-p2">
                                        <img id="slika-3" class="slike-slajder" src="/galerije/default-galerije/osnovne/smestaj-default.jpg">
                                    </a>
                                </div>
                            </div>
                    </div>
                  </div>
                    <a data-strana="left" class="left carousel-control slajder-kontrola" style="cursor: pointer">‹</a>
                    <a data-strana="right" class="right carousel-control slajder-kontrola" style="cursor: pointer">›</a>
                </div>
            </div>
        </div>
    <style>
        .slike-slajder{cursor: pointer}
        @media(min-width: 990px){.slajder-p2{display: block}}
        @media(max-width: 991px){.slajder-p2{display: none}}
    </style>
    <script>
        $(document).ready(function(){slajder.podesavanja(JSON.parse('{!!$podaci['slajder']!!}'))});
        var slajder={
            slikaID1:'#slika-1',
            slikaID2:'#slika-2',
            slikaID3:'#slika-3',
            slikeClass:'.slike-slajder',
            slajderID:'#media',
            velikaSlikaID:'#shFoto',
            modalID:'#prikaziSliku',
            dugmeKontrol:'.slajder-kontrola',
            dugmeModalSlide:'.modalSlide',
            brojFoto:0,
            foto:{},
            pozicija:0,
            podesavanja:function(foto){
                this.foto=foto;
                this.brojFoto=foto.length;
                $(slajder.slikeClass).click(function(){slajder.prikaziModal($(this).attr('src'))});
                $(this.dugmeKontrol).click(function(){slajder.promjena($(this).data('strana'))});
                $(this.dugmeModalSlide).click(function(){slajder.setModalImg($(this).data('strana'))});
                this.podesiFoto()
            },
            podesiFoto:function(){
                if(this.brojFoto==0) $(this.slajderID).hide();
                else{
                    $(this.slikaID1).attr('src','/'+this.foto[this.pozicija]);
                    if(this.brojFoto>=1){
                        $(this.slikaID2).attr('src','/'+this.foto[this.sledecaPozicija(1,'left')]);
                        if(this.brojFoto>=2) {
                            $(this.slikaID3).attr('src','/'+this.foto[this.sledecaPozicija(2,'left')]);
                        }
                    }
                }
            },
            promjena:function(strana){
                this.pozicija=this.sledecaPozicija(1,strana);
                this.podesiFoto()
            },
            sledecaPozicija:function(koliko,strana){
                return strana=='right'?this.pozicija+koliko>=this.brojFoto?this.pozicija+koliko-this.brojFoto:this.pozicija+koliko:this.pozicija-koliko<0?this.brojFoto+this.pozicija-koliko:this.pozicija-koliko;
            },
            prikaziModal:function(foto){
                $(this.velikaSlikaID).attr('src',foto);
                $(this.modalID).modal('show')
            },
            setModalImg:function(strana){
                this.pozicija=this.sledecaPozicija(1,strana);
                $(this.velikaSlikaID).attr('src','/'+this.foto[this.pozicija]);
            }
        };
    </script>
        <div class="col-md-4"><!-- pocetak mapa-->
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyANkR_6WBUEKhO58qGQo0thZmNpvSCqRZE&q={!!$podaci['smestaj']['y']!!},{!!$podaci['smestaj']['x']!!}&zoom=15&center={!!$podaci['smestaj']['y']!!},{!!$podaci['smestaj']['x']!!}"></iframe>

                </div>
        </div><!-- kraj mapa-->
    </div><!-- KRAJ row -->

<br clear="all"><hr>

<div class="row"><!--Komentari -->
    <div class="col-md-12">
     <!--Komentari - START -->
        <div class="container">
            <div class="row">
                <div class="panel panel-default widget">
                    <div class="panel-heading" style="padding: 10px">
                        <div class="col-sm-6">
                            <span class="glyphicon glyphicon-comment"></span>
                            <h3 class="panel-title" style=" display:inline">Ocena smeštaja: </h3><span class="label label-info" >{!!round($prosecna_ocena,1)!!}</span>
                        </div>
                        <div class="panel-body"><a class="btn btn-success btn-green pull-right" @if(\App\Security::autentifikacijaTest(2,'min')) id="komentarisi" @else id="prijaviSe" @endif><span class="glyphicon glyphicon-bullhorn"> </span>  Ostavite komentar</a>
                            @if(!\App\Security::autentifikacijaTest(2,'min'))
                                <script>$('#prijaviSe').click(function(){document.location='/log/login';});</script>
                            @else
                                <div id="poruka_k" style="display: none;margin-top: 25px"></div>
                                <i class='icon-spin6 animate-spin' style="color: rgba(0,0,0,0)"></i>
                                <div id="wait" style="display:none"><center><i class='icon-spin6 animate-spin' style="font-size: 350%"></i></center></div>
                                <div id="hide" style="display:none">
                                    {!!Form::hidden('_token',csrf_token())!!}
                                    {!!Form::hidden('id_smestaja',$podaci['smestaj']['id'])!!}
                                    <input id="ratings-hidden" name="rating" value="3" type="hidden">
                                    <textarea class="form-control" id="new-review" name="komentar" placeholder="Unesite komentar..."></textarea>
                                    <div class="text-right">
                                        <div class="stars starrr" style="color:green;" data-rating="3"></div>
                                        <button id="otkazi" class="btn btn-danger btn-sm" style="margin-right: 10px;"><span class="glyphicon glyphicon-remove"></span>Otkaži</button>
                                        {!!Form::button('<i class="glyphicon glyphicon-check"></i> Pošalji komentar',['class'=>'btn btn-success btn-lg','onclick'=>'Komunikacija.posalji("/aplikacija/posalji-komentar","hide","poruka_k","wait","hide")'])!!}
                                    </div>
                                </div>
                                <script>
                                    $('#komentarisi').click(function(){$(this).fadeOut();$('#hide').slideDown();});
                                    $('#otkazi').click(function(){$('#hide').slideUp();$('#komentarisi').fadeIn();$('textarea[name=komentar]').val('')});
                                </script>
                            @endif
                        </div>
                    </div>
                    <div class="panel-body" style=" padding:0px;">
                @if($podaci['komentari']['komentari'])
                    @foreach($podaci['komentari']['komentari'] as $k => $kom)
                        <ul class="list-group"style=" margin-bottom: 0; ">
                            <li class="list-group-item" style="border-radius: 0;border: 0;border-top: 1px solid #ddd;">
                                <div class="row">
                                    <div class="col-xs-2 col-md-1">
                                        <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                                    <div class="col-xs-10 col-md-11">
                                        <div>
                                            <div class="mic-info" style=" color: #666666;font-size: 11px;">
                                                <strong>Ocenio:</strong> <a href="#">{{$kom['username']}}</a>,  {{$kom['created_at']}}, <strong>Ocena: </strong>{{$kom['ocena']}}
                                            </div>
                                        </div>
                                        <div class="comment-text">
                                        <h6 style=" color: #666666;font-size: 12px;"><strong>Komentar:</strong></h6>
                                            {{$kom['komentar']}}
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @foreach($podaci['komentari']['odgovori'][$k] as $odg)
                             <ul class="list-group"style=" margin-bottom: 0;margin-left: 10%;width:90%; ">
                                  <li class="list-group-item" style="border-radius: 0;border: 0;border-top: 1px solid #ddd;">
                                      <div class="row">
                                          <div class="col-xs-2 col-md-1">
                                              <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                                              <div class="col-xs-10 col-md-11">
                                              <div>
                                                 <div class="mic-info" style=" color: #666666;font-size: 11px;">
                                                     <strong>Odgovorio:</strong> <a href="#">{{$odg['username']}}</a>,  {{$odg['created_at']}}
                                                 </div>
                                              </div>
                                              <div class="comment-text">
                                                  <h6 style=" color: #666666;font-size: 12px;"><strong>Odgovor:</strong></h6>
                                                  {{$odg['odgovor']}}
                                              </div>
                                           </div>
                                      </div>
                                  </li>
                             </ul>
                                @endforeach
                    @endforeach
                    <div id="ostali-komenrari"></div>
                    <button class="btn btn-primary btn-sm btn-block vise" data-stranica="2" style="border-top-left-radius:0px;border-top-right-radius:0px;;"role="button"><span class="glyphicon glyphicon-refresh"></span> Više</button>
                    <script>
                        $('.vise').click(function(){
                            var button=$(this);
                            $.post('/{{$podaci['app']['slug']}}/{{$podaci['smestaj']['slug']}}/smestaj-komentari',{
                                _token:'{{csrf_token()}}',
                                id:'{{$podaci['smestaj']['id']}}',
                                stranica:$(button).data('stranica')
                            },function(data){
                                $(button).data('stranica',$(button).data('stranica')+1);
                                var komentari=JSON.parse(data);console.log(komentari);
                                if(komentari.komentari.length<1) $(button).html('<p>Nema više komentara u evidenciji.</p>');
                                for(var i=0;i<komentari.komentari.length;i++) {
                                    $('#ostali-komenrari').append('<ul class="list-group koment-'+komentari.komentari[i].id+'" style="margin-bottom:0;"><li class="list-group-item" style="border-radius:0;border:0; border-top:1px  \
                                    solid#ddd;"><div class="row"><div class="col-xs-2 col-md-1"><img src="http://placehold.it/80" class="img-circle img-responsive" alt=""/></div><div \
                                     class="col-xs-10 col-md-11"><div><div class="mic-info" style="color:#666666; font-size:11px;"><strong>Ocenio: </strong><a href="#">'
                                    + komentari.komentari[i].username + '</a>,' + komentari.komentari[i].created_at + ',<strong>Ocena: </strong>' + komentari.komentari[i].ocena + '</div></div><divclass="comment-text">' +
                                    '<h6 style="color:#666666;font-size:12px;"><strong>Komentar:</strong></h6>' + komentari.komentari[i].komentar + '</div></div></div></li></ul>');
                                    $('.koment-'+komentari.komentari[i].id).fadeIn();
                                    for(var j=0;j<komentari.odgovori[i].length;j++) {
                                        $('#ostali-komenrari').append('<ul class="list-group koment-'+komentari.odgovori[i][j].id+'" style="margin-bottom:0;margin-left:10%;width:90%;"><li class="list-group-item" style="border-radius:0;border:0; border-top:1px  \
                                    solid#ddd;"><div class="row"><div class="col-xs-2 col-md-1"><img src="http://placehold.it/80" class="img-circle img-responsive" alt=""/></div><div \
                                     class="col-xs-10 col-md-11"><div><div class="mic-info" style="color:#666666; font-size:11px;"><strong>Ocenio: </strong><a href="#">'
                                        + komentari.odgovori[i][j].username + '</a>,' + komentari.odgovori[i][j].created_at + ',<strong>Ocena: </strong>' + komentari.odgovori[i][j].ocena + '</div></div><divclass="comment-text">' +
                                        '<h6 style="color:#666666;font-size:12px;"><strong>Komentar:</strong></h6>' + komentari.odgovori[i][j].komentar + '</div></div></div></li></ul>');
                                        $('.koment-'+komentari.odgovori[i][j].id).fadeIn();
                                    }
                                }
                            });
                        });
                    </script>
                @else <h3 class="col-sm-12" >Nije ostavljen ni jedan komentar.</h3><br clear="all"><hr>
                @endif

                    </div>
                </div>
            </div>
        </div><!--Container - KRAJ -->
    </div>
</div>
@endsection

@section('body')
    <div class="modal fade" id="prikaziSliku">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <img style="width: 100%" id="shFoto">
                    <div style="text-align: right;margin-top:20px">
                        <button class="btn btn-default modalSlide" data-strana="left"><i class="glyphicon glyphicon-chevron-left"></i></button>
                        <button class="btn btn-default modalSlide" data-strana="right"><i class="glyphicon glyphicon-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection