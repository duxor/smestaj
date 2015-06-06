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
        <div  class="col-sm-9 col-md-offset-1 toppad">
          <div style="opacity: 0.9; border:none; " class="panel panel-info">
            <div class="panel-body">

              <div class="row editing">
                <div class="col-md-4 col-lg-4 " align="center"> <img alt="User Pic" style="width:140px;" src="/galerije/{{Session::get('username')}}/osnovne/profilna.jpg" class="img-thumbnail"> 
                  <div class="row">
                  @foreach($korisnik as $key=>$val)
                    @if (in_array($key,$popunjene_kolone))
                      @if($key == 'facebook')  
                            <td><a id="social{{$key}}" data-contentwrapper=".mycontent{{$key}}"  rel="popover" class=" btn btn-social-icon btn-facebook">
                                <i class="fa fa-facebook"></i>
                            </a></td> 
                          @elseif($key == 'twitter')   
                            <td><a id="social{{$key}}" data-contentwrapper=".mycontent{{$key}}"  rel="popover"  class="btn btn-social-icon btn-twitter">
                                <i class="fa fa-twitter"></i>
                            </a></td>
                          
                          @elseif($key == 'google')   
                            <td><a id="social{{$key}}" data-contentwrapper=".mycontent{{$key}}"  rel="popover"  class="btn btn-social-icon btn-google">
                                <i class="fa fa-google"></i>
                            </a></td>
                          @elseif($key == 'skype')   
                            <td><a id="social{{$key}}" data-contentwrapper=".mycontent{{$key}}"  rel="popover"  class="btn btn-social-icon btn-skype">
                                <i class="fa fa-skype"></i>
                            </a></td>
                      @endif
                      <div style="display:none;" class="mycontent{{$key}}">      
                            {!!Form::open(['url'=>'/korisnik/profil/edit-profil/','class'=>'form-horizontal'])!!}
                            {!!Form::hidden('kljuc',$key)!!}   
                            {!!Form::hidden('_token',csrf_token())!!}    
                            {!! Form::text('podatak',$val, ['class'=>'form-control'])!!}<br>
                            {!! Form::button('<span class="glyphicon glyphicon-ok-circle">  </span>  Potvrdi',['class'=>'btn btn-sm btn-success','type'=>'submit']) !!}  
                            {!!Form::close()!!}
                      </div>
                      <script>
                      $(document).ready(function(){
                          $('.editing').mouseenter(function(){
                            $(this).find("#social{{$key}}").fadeIn('fast').on('mouseenter', function(){
                            $(this).popover({
                                html:true,
                                placement:'bottom',
                                content:function()
                                {
                                    return $($('#social{{$key}}').data('contentwrapper')).html();
                                }
                            });
                          });
                      });});
                      $(document).on('mouseleave', '.popover', function () {
                                $('.popover').remove();


                        });
                      
                     
                      </script>
                    @endif
                    
                  @endforeach
                  </div>
                </div>

                <div class=" col-md-8 col-lg-8 "> 
                  <table id="table_hover1" style="border-left:5px solid #5AC4DC" class="table table-user-information">
                    <tbody>

                    @foreach($korisnik as $key=>$val)
                     <tr class="edit">
                        
                          @if (in_array($key,$popunjene_kolone) and $key !== 'facebook' and $key !== 'google' and $key !== 'twitter' and $key !== 'skype')
                            <td>{{ucfirst($key)}}</td>
                            <td ><span class="span_bg" >{{$val}}</span></td>
                            <td ><button id="member{{$key}}" style="display: none;" class="btn btn-success btn-xs "  data-contentwrapper=".mycontent{{$key}}"  rel="popover"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                            <div style="display:none;" class="mycontent{{$key}}">      
                                {!!Form::open(['url'=>'/korisnik/profil/edit-profil/','class'=>'form-horizontal'])!!}
                                {!!Form::hidden('kljuc',$key)!!}   
                                {!!Form::hidden('_token',csrf_token())!!}    
                                {!! Form::text('podatak',$val, ['class'=>'form-control'])!!}<br>
                                {!! Form::button('<span class="glyphicon glyphicon-ok-circle">  </span>  Potvrdi',['class'=>'btn btn-sm btn-success','type'=>'submit']) !!}  
                                {!!Form::close()!!}
                            </div>
                          </td>

                          @endif
                        
                          
                        
                      </tr>                        
                      
                      <script>
                      $(document).on('mouseenter', '.edit', function (){  
                            $(this).find("#member{{$key}}").fadeIn('fast').on('mouseenter', function(){
                            $(this).popover({
                                html:true,
                                placement:'left',
                                content:function()
                                {
                                    return $($('#member{{$key}}').data('contentwrapper')).html();
                                }
                            });
                            });
                            });
                      $(document).on('mouseleave', '.edit', function () {
                                $('.popover').remove();
                                $(this).find("#member{{$key}}").fadeOut('fast');

                        });
                        </script>

                      
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
                                  {!! Form::button('<span class="sacuvaj glyphicon glyphicon-ok"></span>',['class'=>'btn btn-sm btn-success','onclick'=>'Komunikacija.posalji("/korisnik/profil/popuni-profil",\'forma-'.$key.'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}
                                </td>
                                @elseif($key == 'twitter')   
                                <td><a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a></td>
                                <td >{!!Form::text('val',null,['class'=>'form-control','placeholder'=>'Unesite'])!!}</td>
                                <td>
                                  {!! Form::button('<span class="sacuvaj glyphicon glyphicon-ok"></span>',['class'=>'btn btn-sm btn-success','onclick'=>'Komunikacija.posalji("/korisnik/profil/popuni-profil",\'forma-'.$key.'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}
                                </td>
                              @elseif($key == 'google')   
                                <td><a class="btn btn-social-icon btn-google"><i class="fa fa-google"></i></a></td>
                                <td >{!!Form::text('val',null,['class'=>'form-control','placeholder'=>'Unesite'])!!}</td>
                                <td >
                                  {!! Form::button('<span class="sacuvaj glyphicon glyphicon-ok"></span>',['class'=>'btn btn-sm btn-success','onclick'=>'Komunikacija.posalji("/korisnik/profil/popuni-profil",\'forma-'.$key.'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}
                                </td>
                                 @elseif($key == 'skype')   
                                <td><a class="btn btn-social-icon btn-skype"><i class="fa fa-skype"></i></a></td>
                                <td >{!!Form::text('val',null,['class'=>'form-control','placeholder'=>'Unesite'])!!}</td>
                                <td >
                                  {!! Form::button('<span class="sacuvaj glyphicon glyphicon-ok"></span>',['class'=>'btn btn-sm btn-success','onclick'=>'Komunikacija.posalji("/korisnik/profil/popuni-profil",\'forma-'.$key.'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}
                                </td>
                              @else
                                <td>{{ucfirst($key)}}</td>
                                <td >{!!Form::text('val',null,['class'=>'form-control','placeholder'=>'Unesite'])!!}</td>  
                                <td >
                                  {!! Form::button('<span class="sacuvaj glyphicon glyphicon-ok"></span>',['class'=>'btn btn-sm btn-success','onclick'=>'Komunikacija.posalji("/korisnik/profil/popuni-profil",\'forma-'.$key.'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}
                                </td>
                              @endif 
                              <script>
                                $('.sacuvaj').click(function(){$('#'+$(this).closest('tr').attr('id')).fadeOut('slow')});
                              </script>                       
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
        <div style="border:none;" class="col-md-2">
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
          showText: true//show progress text or not
          });
        </script>
      </div>
    </div>
</div>

@stop
