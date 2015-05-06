@extends('administracija.masterBackEnd')

@section('body')

<div class="container">
      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
       <br>

      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Profil korisnika:</h3> 
            </div>
            <div class="panel-body">
            <div class="row">
                <div class="progress">
                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: {{$procenat_popunjenosti}}%;">
                  Popunjenost profila:   {{$procenat_popunjenosti}}%
                  </div>
                </div>
              </div>
             {!! Form::open(['url'=>'/profil/edit-nalog','id'=>'forma','enctype'=>'multipart/form-data','class'=>'form-horizontal']) !!}
             {!! Form::hidden('id', $korisnik['id']) !!}
              <div class="row">
                <div class="col-md-4" align="center"> 
                  <div class="row">
                    <img alt="User Pic" style="width:100px;" src="{{$korisnik['fotografija']}}" class="img-circle img-responsive">
                  </div>
                  <div class="row">
                    {!! Form::file('image',['class'=>'form-control']) !!}
                  </div>
                </div>
             

                <div class=" col-md-8"> 
                  <table class="table table-user-information">
                    <tbody>
                      @if ( $errors->any())
                      <div class="alert alert-danger" role="alert">
                        <p>Ispravite sledeće greške:</p>

                        <ul>
                          @foreach( $errors->all() as $message )
                            <li>{{ $message }}</li>
                          @endforeach
                        </ul>
                        </div>
                      @endif
                      <tr>
                        <td>Prezime:</td>
                        <td>{!! Form::text('prezime',$korisnik['prezime'], ['class'=>'form-control', 'placeholder'=>'Prezime'])!!}</td>
                      </tr>
                      <tr>
                        <td>Ime:</td>
                        <td>{!! Form::text('ime',$korisnik['ime'], ['class'=>'form-control', 'placeholder'=>'Ime'])!!}</td>
                      </tr>
                      <tr>
                        <td>Username:</td>
                        <td>{!! Form::text('username',$korisnik['username'], ['class'=>'form-control', 'placeholder'=>'Username','id'=>'username'])!!}</td>
                      </tr>
                      <tr>
                        <td>Password:</td>
                        <td>{!! Form::password('password', ['class'=>'form-control','id'=>'password'])!!}</td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td>{!! Form::text('email',$korisnik['email'], ['class'=>'form-control', 'placeholder'=>'Email','id'=>'email','type'=>'email'])!!}</td>
                      </tr> 
                      <tr>
                        <td>Adresa:</td>
                        <td>{!! Form::text('adresa',$korisnik['adresa'], ['class'=>'form-control', 'placeholder'=>'Adresa'])!!}</td>
                      </tr>
                      <tr>
                        <td>Grad:</td>
                        <td>{!! Form::text('grad',$korisnik['grad'], ['class'=>'form-control', 'placeholder'=>'Grad'])!!}</td>
                      </tr>
                      <tr>
                        <td>Telefon:</td>
                        <td>{!! Form::text('telefon',$korisnik['telefon'], ['class'=>'form-control', 'placeholder'=>'Telefon'])!!}</td>
                      </tr>                  
                    </tbody>
                  </table>
                  {!! Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Sačuvaj', ['class'=>'btn btn-lg btn-primary','onClick'=>'SubmitForm.submit(\'forma\')']) !!}
                </div>
              </div>
              {!! Form::close() !!}
            </div>            
          </div>
        </div>
      </div>
    </div>
  
@stop