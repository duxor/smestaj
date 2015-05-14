@extends('aplikacija.teme.paralax-1.master')
@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-8  toppad" >
            <div class="panel-body">
                <div class="media col-md-5">
                <figure class="pull-left">
                    <img class="media-object img-rounded img-responsive"  src="{!!$podaci['smestaj']['naslovna_foto']!!}" alt="placehold.it/350x250" >
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
                    <a class="pull-left" data-go="prev"><div class="btn btn-primary">Prev</div></a>
                    <h4><span data-head-year></span> <span data-head-month></span></h4>
                    <a class="pull-right" data-go="next"><div class="btn btn-primary">Next</div></a>
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
                  events: {
                    "2015-05-30": {"number": 5, "url": "http://w3widgets.com/responsive-slider"},
                    "2015-05-26": {"number": 1, "url": "http://w3widgets.com"}, 
                    "2015-05-03":{"number": 1}, 
                    "2015-05-12": {}}
                });
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
                  <div class="item  active">
                    <div class="row">
                      <div class="col-md-4">
                        <a class="thumbnail fancybox" rel="ligthbox" href="#"><img alt="" src="http://placehold.it/150x150"></a>
                      </div>          
                      <div class="col-md-4">
                        <a class="thumbnail fancybox"  rel="ligthbox" href="#"><img alt="" src="http://placehold.it/150x150"></a>
                      </div>
                      <div class="col-md-4">
                        <a class="thumbnail fancybox"  rel="ligthbox"href="#"><img alt="" src="http://placehold.it/150x150"></a>
                      </div>        
                    </div>
                  </div>
                  <div class="item">
                    <div class="row">
                      <div class="col-md-4">
                        <a class="thumbnail fancybox" href="#"><img alt="" src="http://placehold.it/150x150"></a>
                      </div>          
                      <div class="col-md-4">
                        <a class="thumbnail fancybox" href="#"><img alt="" src="http://placehold.it/150x150"></a>
                      </div>
                      <div class="col-md-4">
                        <a class="thumbnail fancybox" href="#"><img alt="" src="http://placehold.it/150x150"></a>
                      </div>        
                    </div>
                  </div>
                  <div class="item">
                    <div class="row">
                      <div class="col-md-4">
                        <a class="thumbnail" href="#"><img alt="" src="http://placehold.it/150x150"></a>
                      </div>          
                      <div class="col-md-4">
                        <a class="thumbnail" href="#"><img alt="" src="http://placehold.it/150x150"></a>
                      </div>
                      <div class="col-md-4">
                        <a class="thumbnail" href="#"><img alt="" src="http://placehold.it/150x150"></a>
                      </div>      
                    </div>
                  </div>
                </div>
                <a data-slide="prev" href="#media" class="left carousel-control">‹</a>
                <a data-slide="next" href="#media" class="right carousel-control">›</a>
              </div>
            </div><!-- KRAJ row --> 
                          
        </div><!-- KRAJ md-9 -->
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
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-comment"></span>
                        <h3 class="panel-title" style=" display:inline">
                             Ocena smeštaja:  </h3>
                        <span class="label label-info" >
                            {!! round($prosecna_ocena,1)!!} </span>
                              {!!Form::open(['url'=>'/aplikacija/posalji-komentar','class'=>'form-horizontal'])!!}
                                 {!!Form::hidden('id_smestaja',$podaci['smestaj']['id'])!!}
                           <span><div class="row"> <a class="btn btn-success btn-green pull-right" href="#reviews-anchor" id="open-review-box"><span class="glyphicon glyphicon-bullhorn"> </span>  Ostavite komentar</a></div></span>
                            <div class="row" id="post-review-box" style="display:none; margin-top:15px;">
                            <div class="col-md-12">
                                <form accept-charset="UTF-8" action="" method="post">
                                    <input id="ratings-hidden" name="rating" type="hidden"> 
                                    <textarea class="form-control animated" cols="50" id="new-review" name="komentar" placeholder="Unesite komentar..." rows="5"></textarea>
                    
                                    <div class="text-right">
                                        <div class="stars starrr" style="color:green;" data-rating="3"></div>
                                        <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                        <span class="glyphicon glyphicon-remove"></span>Otkaži</a>
                                        <button class="btn btn-success btn-lg" type="submit">Pošalji komentar</button>
                                    </div>
                                </form>
                            </div>
                        </div> 
                         {!!Form::close()!!}
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
                @else <h3 class="col-sm-12" >Nema komentara u bazi!</h3><br clear="all"><hr>
                @endif
                        
                    </div>
                </div>
            </div>
        </div><!--Container - KRAJ -->
    </div>
</div>
</div>
            

@endsection
