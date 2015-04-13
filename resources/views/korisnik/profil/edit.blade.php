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
             {!! Form::open(['url'=>'/profil/edit-nalog','id'=>'forma','class'=>'form-horizontal']) !!}
             {!! Form::hidden('id', $korisnik['id']) !!}
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>

                <div class=" col-md-9 col-lg-9 "> 
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
                        <td>Email:</td>
                        <td>{!! Form::text('email',$korisnik['email'], ['class'=>'form-control', 'placeholder'=>'Email','id'=>'email','type'=>'email'])!!}</td>
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