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
                <div class="col-md-4 col-lg-4 " align="center"> <img alt="User Pic" style="width:140px;" src="/galerije/{{Session::get('username')}}/osnovne/profilna.jpg" class="img-thumbnail"> 
                 {{-- <div class="row">
                    <div class="col-md-3">@if(in_array('facebook',$popunjene_kolone)) <a href="#"> <i class="glyphicon glyphicon-map-marker"></i></a>  @endif</div>
                    <div class="col-md-3">@if(in_array('google',$popunjene_kolone)) <a href="#"><i class="glyphicon glyphicon-map-marker"></i> </a>  @endif</div>
                    <div class="col-md-3">@if(in_array('skype',$popunjene_kolone)) <a href="#"><i class="glyphicon glyphicon-map-marker"></i></a>  @endif</div>
                    <div class="col-md-3">@if(in_array('twitter',$popunjene_kolone)) <a href="#"><i class="glyphicon glyphicon-map-marker"></i></a>  @endif</div>
                  </div>--}}
                </div>

                <div class=" col-md-8 col-lg-8 "> 
                  <table id="table_hover" style="border-left:5px solid #5AC4DC" class="table table-user-information">
                    <tbody>

                    @foreach($korisnik as $key=>$val)
                      @if (in_array($key,$popunjene_kolone)) 
                      <tr class="edit">
                        <td>
                          @if($key == 'facebook')   
                            <a class="btn btn-social-icon btn-facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                            @elseif($key == 'twitter')   
                            <a class="btn btn-social-icon btn-twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                          
                          @elseif($key == 'google')   
                            <a class="btn btn-social-icon btn-google">
                                <i class="fa fa-google"></i>
                            </a>
                             @elseif($key == 'skype')   
                            <a class="btn btn-social-icon btn-skype">
                                <i class="fa fa-skype"></i>
                            </a>
                          
                          @else {{$key}}
                          @endif
                        </td>
                        <td ><span class="span_bg" >{{$val}}</span></td>  
                        <td ><button id="member{{$key}}" style="display: none;" class="btn btn-success btn-xs "  data-contentwrapper=".mycontent{{$key}}"  rel="popover"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                          <div style="display:none;" class="mycontent{{$key}}">      
                              {!!Form::open(['url'=>'/korisnik/profil/edit-profil/','class'=>'form-horizontal'])!!}
                              {!!Form::hidden('kljuc',$key)!!}   
                              {!!Form::hidden('_token',csrf_token())!!}    
                              {!! Form::text('podatak',$val, ['class'=>'form-control'])!!}<br>
                              {!! Form::button('<span class="glyphicon glyphicon-ok-circle">  </span>  Potvrdi',['class'=>'btn btn-sm btn-success','type'=>'submit']) !!}  
                              {!!Form::button('<span class="glyphicon glyphicon-minus">  </span> Otkaži', ['class'=>'btn btn-şm btn-danger',' data-dismiss'=>'modal']) !!}
                              {!!Form::close()!!}
                          </div>
                        </td>                        
                      </tr>
                      <script>
                      $(document).on('mouseenter', '.edit', function (){  
                            $(this).find("#member{{$key}}").fadeIn('fast').click(function(){
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
                                $(this).find("#member{{$key}}").fadeOut('fast');
                        });
                        </script>
                      @endif
                    @endforeach
                    </tbody>
                  </table>     

                 <!--<a href="/{{\App\OsnovneMetode::osnovniNav()}}/profil/edit-nalog/" class="btn btn-lg btn-primary"><i class="glyphicon glyphicon-pencil"></i> Uredi profil</a>-->
                 <button style="margin-bottom:10px;" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  Popuni profil
                </button>
                  <div class="collapse" id="collapseExample">
                  <div id="vrti" style="display:none;"><center><i class='icon-spin4 animate-spin' style="font-size: 350%"></i></center></div>
                 <div id="poruka" style="display:none"></div>
                    <table id="table_hover" style="border-left:5px solid #5AC4DC" class="table table-user-information">
                      <tbody>
                    @foreach($korisnik as $key=>$val)
                      @if (in_array($val,array('null','',)))
                          <tr id="forma-{{$key}}" class="edit">
                          {!!Form::hidden('kljuc',$key)!!}
                          {!!Form::hidden('_token',csrf_token())!!}
                            @if($key == 'facebook')   
                                
                                <td><a class="btn btn-social-icon btn-facebook">
                                    <i class="fa fa-facebook"></i>
                                </a></td>
                                <td >{!!Form::text('val',null,['class'=>'form-control','placeholder'=>'Unesite'])!!}</td>  
                                <td>
                                  {!! Form::button('<span class="glyphicon glyphicon-ok"></span>',['class'=>'btn btn-sm btn-success','onclick'=>'Komunikacija.posalji("/korisnik/profil/popuni-profil",\'forma-'.$key.'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}
                                </td>
                                @elseif($key == 'twitter')   
                                <td><a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a></td>
                                <td >{!!Form::text('val',null,['class'=>'form-control','placeholder'=>'Unesite'])!!}</td>
                                <td>
                                  {!! Form::button('<span class="glyphicon glyphicon-ok"></span>',['class'=>'btn btn-sm btn-success','onclick'=>'Komunikacija.posalji("/korisnik/profil/popuni-profil",\'forma-'.$key.'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}
                                </td>
                              @elseif($key == 'google')   
                                <td><a class="btn btn-social-icon btn-google"><i class="fa fa-google"></i></a></td>
                                <td >{!!Form::text('val',null,['class'=>'form-control','placeholder'=>'Unesite'])!!}</td>
                                <td >
                                  {!! Form::button('<span class="glyphicon glyphicon-ok"></span>',['class'=>'btn btn-sm btn-success','onclick'=>'Komunikacija.posalji("/korisnik/profil/popuni-profil",\'forma-'.$key.'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}
                                </td>
                                 @elseif($key == 'skype')   
                                <td><a class="btn btn-social-icon btn-skype"><i class="fa fa-skype"></i></a></td>
                                <td >{!!Form::text('val',null,['class'=>'form-control','placeholder'=>'Unesite'])!!}</td>
                                <td >
                                  {!! Form::button('<span class="glyphicon glyphicon-ok"></span>',['class'=>'btn btn-sm btn-success','onclick'=>'Komunikacija.posalji("/korisnik/profil/popuni-profil",\'forma-'.$key.'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}
                                </td>
                              @else
                                <td>{{$key}}</td>
                                <td >{!!Form::text('val',null,['class'=>'form-control','placeholder'=>'Unesite'])!!}</td>  
                                <td >
                                  {!! Form::button('<span class="glyphicon glyphicon-ok"></span>',['class'=>'btn btn-sm btn-success','onclick'=>'Komunikacija.posalji("/korisnik/profil/popuni-profil",\'forma-'.$key.'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}
                                </td>
                              @endif                        
                          </tr>
                      
                      @endif
                    @endforeach
                    </tbody>
                  </table>  
                      
            
                  </div>

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