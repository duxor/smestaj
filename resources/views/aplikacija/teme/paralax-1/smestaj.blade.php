@extends('aplikacija.teme.paralax-1.master')
@section('content')
    <div class="row pretraga">
        <div class="col-md-8 toppad">
            <div class="panel-body">
                <div class="media col-md-5">
                <figure class="pull-left">
                    <img class="media-object img-rounded img-responsive"  src="{!!$podaci['smestaj']['naslovna_foto']!!}" alt="Naslovna fotografija" >
                </figure>   
                </div>
                <div class="col-md-6">
                    <table class="table table-user-information">
                        <tbody>
                          <tr>
                            <td><i class="glyphicon glyphicon-home">&nbsp;</i>Naziv objekta:</td>
                            <td>{!!$podaci['smestaj']['naziv']!!}</td>
                          </tr>
                          <tr>
                            <td><i class="glyphicon glyphicon-dashboard">&nbsp;</i>Kapacitet:</td>
                            <td>{!!$podaci['smestaj']['naziv_kapaciteta']!!}</td>
                          </tr>
                          <tr>
                            <td><i class="glyphicon glyphicon-user">&nbsp;</i>Broj osoba:</td>
                            <td>{!!$podaci['smestaj']['broj_osoba']!!}</td>
                          </tr>                                    
                          <tr>
                            <td><i class="glyphicon glyphicon-th-large">&nbsp;</i>Vrsta smeštaja:</td>
                            <td>{!!$podaci['smestaj']['vrsta_smestaja']!!}</td>
                          </tr>
                          <tr>
                            <td><i class="glyphicon glyphicon-euro">&nbsp;</i>Cena po osobi:</td>
                            <td>{!!$podaci['smestaj']['cena_osoba']!!} din.</td>
                          </tr>
                        </tbody>
                    </table>
                </div>
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
                  <div class="day header">Mon</div>
                  <div class="day header">Tue</div>
                  <div class="day header">Wed</div>
                  <div class="day header">Thu</div>
                  <div class="day header">Fri</div>
                  <div class="day header">Sat</div>
                  <div class="day header">Sun</div>
                </div>
                <div class="days" data-group="days">
                  
                </div>
            </div>
            
            <script type="text/javascript">
              $(document).ready(function () {
                $(".responsive-calendar").responsiveCalendar({
                  time: '2015-05',
                  events: {!!$podaci['kalendar']!!}
                })
              });
            </script><!-- Responsive calendar - END -->
            
        </div><!-- KRAJ col-md-3-->
    </div><!-- KRAJ row -->
    <br clear="all"><hr>
    <div class='row'>
        <div class='col-md-8'>
            <div class="row">
               <div class="carousel slide media-carousel" id="media">
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
            brojFoto:0,
            foto:{},
            pozicija:0,
            podesavanja:function(foto){
                this.foto=foto;
                this.brojFoto=foto.length;
                $(slajder.slikeClass).click(function(){slajder.prikaziModal($(this).attr('src'))});
                $(this.dugmeKontrol).click(function(){slajder.promjena($(this).data('strana'))});
                this.podesiFoto()
            },
            podesiFoto:function(){
                if(this.brojFoto==0) $(this.slajderID).hide();
                else{
                    $(this.slikaID1).attr('src','/'+this.foto[this.pozicija]);
                    if(this.brojFoto>=1){console.log(this.foto[this.sledecaPozicija(1,'left')]);
                        $(this.slikaID2).attr('src','/'+this.foto[this.sledecaPozicija(1,'left')]);
                        if(this.brojFoto>=2) {console.log(this.foto[this.sledecaPozicija(2,'left')]);
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
                                <div id="poruka" style="display: none;margin-top: 25px"></div>
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
                                        {!!Form::button('<i class="glyphicon glyphicon-check"></i> Pošalji komentar',['class'=>'btn btn-success btn-lg','onclick'=>'Komunikacija.posalji("/aplikacija/posalji-komentar","hide","poruka","wait","hide")'])!!}
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
                @if($komentari)
                    @foreach($komentari as $kom)
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
                                        <div class="action">
                                            <button type="button" class="btn btn-primary btn-xs" title="Edit">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </button>
                                            <button type="button" class="btn btn-success btn-xs" title="Approved">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs" title="Delete">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                    <a href="#" class="btn btn-primary btn-sm btn-block" style="border-top-left-radius:0px;border-top-right-radius:0px;;"role="button"><span class="glyphicon glyphicon-refresh"></span> More</a>
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
                </div>
            </div>
        </div>
    </div>
@endsection
