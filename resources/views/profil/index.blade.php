@extends(\App\OsnovneMetode::osnovniNav().".master")

@section('body')
<div id="container_id"  class="container" style=" position:absolute;top:15px; margin-top:0px; padding-top:0px; width:100%;  height:70%; border-bottom:2px solid #b5b1b1; background: url(/galerije/korisnik/teme/paralax-1/pozadine-1/bg_user_2.jpg) no-repeat center center fixed;">
     <div class="row">
       <div id="bg_btn" style="visibility: hidden; margin-bottom:50px; margin-top:7%;" class="col-md-2 col-md-offset-5">
       {!!Form::open(['id'=>'forma','url'=>'','class'=>'form-horizontal','enctype' => 'multipart/form-data'])!!}

       {!!Form::button('<span class="glyphicon glyphicon-picture"></span> Izmeni pozadinu', ['class'=>'btn btn-lg btn-success','type'=>'submit'])!!}
       
       {!!Form::close()!!}
         <script>
         $(document).on('mouseenter','#container_id',function(){
             $(this).find('#bg_btn').css('visibility','visible').fadeIn('slow');
            }).on('mouseleave','#container_id',function(){
              $(this).find('#bg_btn').css('visibility','hiden').fadeOut('slow');
            });
         
         </script>
       </div>
     </div>
</div>
<div class="container" style=" position:absolute;top:35%; margin-top:0px; padding-top:0px;">
      <div  class="row">
        <div  class="col-sm-7 col-md-offset-1 toppad">
          <div style="opacity: 0.9; border:none; " class="panel panel-info">
            <div class="panel-body">

              <div class="row">
                <div class="col-md-4 col-lg-4 " align="center"> <img alt="User Pic" style="width:140px;" src="/galerije/{{Session::get('username')}}/osnovne/profilna.jpg" class="img-thumbnail"> </div>

                <div class=" col-md-8 col-lg-8 "> 
                  <table id="table_hover" style="border-left:5px solid #5AC4DC" class="table table-user-information">
                    <tbody>
                    <style type="text/css"> 
                    </style>
                    @foreach($korisnik as $key=>$val)
                      @if (in_array($key,array('prezime','ime','username','email'))) 
                      <tr class="edit">
                        <td>{{$key}} </td>
                        <td ><span class="span_bg" >{{$val}}</span></td>  
                        <td ><button id="member{{$key}}" style="display: none;" class="btn btn-success btn-xs "  data-contentwrapper=".mycontent{{$key}}"  rel="popover"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                          <div style="display:none;" class="mycontent{{$key}}">      
                              {!!Form::open(['url'=>'/korisnik/profil/edit-profil/','class'=>'form-horizontal'])!!}
                              {!!Form::hidden('kljuc',$key)!!}   
                              {!!Form::hidden('_token',csrf_token())!!}    
                              {!! Form::text('podatak',$val, ['class'=>'form-control', 'placeholder'=>'{{$val}}'])!!}<br>
                              {!! Form::button('<span class="glyphicon glyphicon-ok-circle">  </span>  Potvrdi',['class'=>'btn btn-sm btn-success','type'=>'submit']) !!}  
                              {!!Form::button('<span class="glyphicon glyphicon-minus">  </span> Otkaži', ['class'=>'btn btn-şm btn-danger',' data-dismiss'=>'modal']) !!}
                              {!!Form::close()!!}
                          </div>
                        </td>                        
                      </tr>
                      <script>
                      $(document).on('mouseenter', '.edit', function (){  
                            $(this).find("#member{{$key}}").fadeIn('slow').click(function(){
                            $(this).popover({
                                html:true,
                                placement:'left',
                                content:function()
                                {
                                    return $($('#member{{$key}}').data('contentwrapper')).html();
                                }
                            });
                            });
                            }).on('mouseleave', '.edit', function () {
                                $(this).popover('destroy');
                                $(this).find("#member{{$key}}").fadeOut('slow');
                        });
                        </script>
                      @endif
                    @endforeach
                      
                      <tr class="edit">
                      @if($korisnik['adresa'])
                        <tr class="edit">
                          <td>Adresa:</td>
                          <td>{!!$korisnik['adresa']!!}</td>
                          <td>
                            <button data-toggle="popover" data-html="true"   data-content="<div>{{ Form::text('prezime',$korisnik['adresa'], ['class'=>'form-control', 'placeholder'=>'Adresa'])}}<br>
                                <button><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Sačuvaj</button> 
                                <button><span class='glyphicon glyphicon-minus' aria-hidden='true'></span> Otkaži</button></div>" data-placement="top"  type="button" id="show" style="display: none;" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
                            </button>
                        </td>
                        </tr>
                      @endif
                      @if($korisnik['grad'])
                          <tr class="edit">
                            <td>Grad:</td>
                            <td>{!!$korisnik['grad']!!}</td>
                            <td>
                              <button data-toggle="popover" data-html="true"   data-content="<div>{{ Form::text('prezime',$korisnik['grad'], ['class'=>'form-control', 'placeholder'=>'Grad'])}}<br>
                                  <button><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Sačuvaj</button> 
                                  <button><span class='glyphicon glyphicon-minus' aria-hidden='true'></span> Otkaži</button></div>" data-placement="top"  type="button" id="show" style="display: none;" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
                              </button>
                        </td>
                          </tr>
                      @endif
                      @if($korisnik['telefon'])
                        <tr class="edit">
                          <td>Telefon:</td>
                          <td>{!!$korisnik['telefon']!!}</td>
                          <td>
                            <button data-toggle="popover" data-html="true"   data-content="<div>{{ Form::text('prezime',$korisnik['telefon'], ['class'=>'form-control', 'placeholder'=>'PTelefonrezime'])}}<br>
                                <button><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Sačuvaj</button> 
                                <button><span class='glyphicon glyphicon-minus' aria-hidden='true'></span> Otkaži</button></div>" data-placement="top"  type="button" id="show" style="display: none;" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
                            </button>
                        </td>
                        </tr>
                      @endif
                    </tbody>
                  </table>                  
                 <a href="/{{\App\OsnovneMetode::osnovniNav()}}/profil/edit-nalog/" class="btn btn-lg btn-primary"><i class="glyphicon glyphicon-pencil"></i> Uredi profil</a>
                </div>
              </div>
            </div>            
          </div>
        </div>
        <div style="border:none;" class="col-md-3">
        {!!HTML::script('js/CircularLoader.js')!!}
        <div style="opacity: 0.9;" id="divProgress"></div>
        <script>
          $("#divProgress").circularloader({
          backgroundColor: "#ffffff",//background colour of inner circle
          fontColor: "#000000",//font color of progress text
          fontSize: "40px",//font size of progress text
          radius: 70,//radius of circle
          progressBarBackground: "#FF3333",//background colour of circular progress Bar
          progressBarColor: "#5AC4DC",//colour of circular progress bar
          progressBarWidth: 4,//progress bar width
          progressPercent: "{!!$procenat_popunjenosti!!}%",//progress percentage out of 100
          progressValue:0,//diplay this value instead of percentage
          showText: true,//show progress text or not
          });
        </script>
              <div class="row">
                <div class="progress">
                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: {{$procenat_popunjenosti}}%;">
                  Popunjenost profila:   {{$procenat_popunjenosti}}%
                  </div>

                </div>

        </div>
      </div>
    </div>
</div>

@stop