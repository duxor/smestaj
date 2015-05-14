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
                            <td>{!!$podaci['smestaj']['cena_osoba']!!}</td>
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
        <div class='col-md-9'>
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
            <div class="row" style="margin-top:40px;">
                <div class="col-md-12">
                    <div class="well well-sm">
                        <div class="text-right">
                            <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Ostavite komentar</a>
                        </div>
                    
                        <div class="row" id="post-review-box" style="display:none;">
                            <div class="col-md-12">
                                <form accept-charset="UTF-8" action="" method="post">
                                    <input id="ratings-hidden" name="rating" type="hidden"> 
                                    <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Unesite komentar ovde ..." rows="5"></textarea>
                    
                                    <div class="text-right">
                                        <div class="stars starrr" data-rating="0"></div>
                                        <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                        <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                                        <button class="btn btn-success btn-lg" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>                 
                    </div>
                </div> <!--Komentari - KRAJ -->
            </div><!-- KRAJ row -->                          
        </div><!-- KRAJ md-9 -->
        <div class="col-md-3"><!-- pocetak mapa-->
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed/v1/place?q=tarska%203%2C%20beograd&key=AIzaSyANkR_6WBUEKhO58qGQo0thZmNpvSCqRZE"></iframe>
                </div>
        </div><!-- kraj mapa-->
    </div><!-- KRAJ row -->

<div class="row"><!--Komentari -->
    <div class="col-md-12">
     <!--Komentari - START -->
        <div class="container">

            <div class="row">
                <div class="panel panel-default widget">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-comment"></span>
                        <h3 class="panel-title">
                            Recent Comments</h3>
                        <span class="label label-info">
                            78</span>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-2 col-md-1">
                                        <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                                    <div class="col-xs-10 col-md-11">
                                        <div>
                                            <a href="http://www.jquery2dotnet.com/2013/10/google-style-login-page-desing-usign.html">
                                                Google Style Login Page Design Using Bootstrap</a>
                                            <div class="mic-info">
                                                By: <a href="#">Bhaumik Patel</a> on 2 Aug 2013
                                            </div>
                                        </div>
                                        <div class="comment-text">
                                            Awesome design
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
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-2 col-md-1">
                                        <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                                    <div class="col-xs-10 col-md-11">
                                        <div>
                                            <a href="http://bootsnipp.com/BhaumikPatel/snippets/Obgj">Admin Panel Quick Shortcuts</a>
                                            <div class="mic-info">
                                                By: <a href="#">Bhaumik Patel</a> on 11 Nov 2013
                                            </div>
                                        </div>
                                        <div class="comment-text">
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                            euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim
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
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-2 col-md-1">
                                        <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                                    <div class="col-xs-10 col-md-11">
                                        <div>
                                            <a href="http://bootsnipp.com/BhaumikPatel/snippets/4ldn">Cool Sign Up</a>
                                            <div class="mic-info">
                                                By: <a href="#">Bhaumik Patel</a> on 11 Nov 2013
                                            </div>
                                        </div>
                                        <div class="comment-text">
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                            euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim
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
                        <a href="#" class="btn btn-primary btn-sm btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> More</a>
                    </div>
                </div>
            </div>
        </div><!--Container - KRAJ -->
    </div>
</div>
</div>
            

@endsection
