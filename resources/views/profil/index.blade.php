@extends(\App\OsnovneMetode::osnovniNav().".master")

@section('body')
<div  class="container">
      <div class="row">
        <div  class="col-sm-7 col-md-offset-1 toppad">
          <div style="opacity: 0.8;" class="panel panel-info">
            <div class="panel-body">

              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" style="width:100px;" src="/galerije/{{Session::get('username')}}/osnovne/profilna.jpg" class="img-circle"> </div>

                <div class=" col-md-9 col-lg-9 "> 
                  <table style="border-left:5px solid #5AC4DC" class="table table-user-information">
                    <tbody>
                      <tr class="edit">
                        <td>Prezime:</td>
                        <td>{!!$korisnik['prezime']!!}</td>
                          <td>
                          <a href="javascript: void(0)" id="member1" data-contentwrapper=".mycontent"  rel="popover"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

                              <div style="display:none;" class="mycontent">
                              
                              <div id='vrti' style='display:none;'><center><i class='icon-spin4 animate-spin' style='font-size: 100%'></i></center></div>
                              <div id='forma'>
                              {!!Form::hidden('id_korisnika',$korisnik['id'])!!}
                              {!!Form::hidden('_token',csrf_token())!!}      
                               {!! Form::text('prezime',$korisnik['prezime'], ['class'=>'form-control', 'placeholder'=>'Prezime'])!!}<br>
                                {!! Form::button('<span class="glyphicon glyphicon-ok-circle">  </span>  Potvrdi',['class'=>'btn btn-sm btn-success','onclick'=>"Komunikacija.posalji('/moderacija/zabrani',\'forma\',\'poruka\',\'vrti\',\'zabrani\')"]) !!}  
                                {!!Form::button('<span class="glyphicon glyphicon-minus">  </span> Otkaži', ['class'=>'btn btn-şm btn-danger',' data-dismiss'=>'modal']) !!}
                              
                              </div>
                          </td>
                      </tr>
                      <tr class="edit">
                        <td>Ime:</td>
                        <td>{!!$korisnik['ime']!!}</td>
                        <td>
                          <button data-toggle="popover" data-html="true"   data-content="<div>{{ Form::text('ime',$korisnik['ime'], ['class'=>'form-control', 'placeholder'=>'Ime'])}}<br>
                              <button><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Sačuvaj</button> 
                              <button><span class='glyphicon glyphicon-minus' aria-hidden='true'></span> Otkaži</button></div>" data-placement="top"  type="button" id="show" style="display: none;" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
                            </button>
                        </td>
                      </tr>
                      <tr class="edit">
                        <td>Username:</td>
                        <td>{!!$korisnik['username']!!}</td>
                        <td>
                          <button data-toggle="popover" data-html="true"   data-content="<div>{{ Form::text('username',$korisnik['username'], ['class'=>'form-control', 'placeholder'=>'Username','id'=>'username'])}}<br>
                              <button><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Sačuvaj</button> 
                              <button><span class='glyphicon glyphicon-minus' aria-hidden='true'></span> Otkaži</button></div>" data-placement="top"  type="button" id="show" style="display: none;" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
                            </button>
                        </td>
                      </tr>
                      <tr class="edit">
                        <td>Email:</td>
                        <td><a href="{!!$korisnik['email']!!}">{!!$korisnik['email']!!}</a> </td>
                        <td>
                          <button data-toggle="popover" data-html="true"   data-content="<div>{{ Form::text('prezime',$korisnik['email'], ['class'=>'form-control', 'placeholder'=>'Prezime'])}}<br>
                              <button><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Sačuvaj</button> 
                              <button><span class='glyphicon glyphicon-minus' aria-hidden='true'></span> Otkaži</button></div>" data-placement="top"  type="button" id="show" style="display: none;" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
                            </button>
                        </td>
                      </tr>
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
        <div style="border:1px solid #E0F0F8" class="col-md-3">
        {!!HTML::script('js/CircularLoader.js')!!}
        <div style="opacity: 0.8;" id="divProgress"></div>
        <script>
          $("#divProgress").circularloader({
          backgroundColor: "#ffffff",//background colour of inner circle
          fontColor: "#000000",//font color of progress text
          fontSize: "40px",//font size of progress text
          radius: 70,//radius of circle
          progressBarBackground: "#7CC67C",//background colour of circular progress Bar
          progressBarColor: "#5AC4DC",//colour of circular progress bar
          progressBarWidth: 25,//progress bar width
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