@extends('korisnik.master')

@section('content')

      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
       <br>

      </div>
        <div class="col-sm-12 col-md-6 col-md-offset-3 toppad" >

          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Profil korisnika:</h3> 
            </div>
            <div class="panel-body">
            <div class="row">
                <div class="progress">
                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: {{$procenat_popunjenosti}}%;">
                  Popunjenost profila: {{$procenat_popunjenosti}}%
                  </div>
                </div>
              </div>
             {!! Form::open(['url'=>'/profil/edit-nalog','id'=>'forma','enctype'=>'multipart/form-data','class'=>'form-horizontal']) !!}
             {!! Form::hidden('id', $korisnik['id']) !!}
              <div class="row">
                <div class="col-md-4" align="center"> 
                  <div class="row">
                    <a href="#" data-toggle="modal" data-target="#dodajFoto">
                      <img id="foto" data-toggle="tooltip" data-placement="bottom" title="Izmeni fotografiju" style="width:200px;height: 200px" src="/galerije/{{Session::get('username')}}/osnovne/profilna.jpg" class="img-circle img-responsive">
                      <script>$(document).ready(function(){$('#foto').tooltip()})</script>
                    </a>
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
                        <td>{!! Form::password('password', ['class'=>'form-control'])!!}</td>
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
                  {!! Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Sačuvaj',['class'=>'btn btn-lg btn-primary','onClick'=>'SubmitForm.submit(\'forma\')'])!!}
                </div>
              </div>
              {!! Form::close() !!}
            </div>            
          </div>
        </div>
      </div>
@endsection
@section('body')
  <div class="modal fade" id="dodajFoto">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal">&times;</button>
          <h2>Dodaj novu fotografiju</h2>
        </div>
        <div class="modal-body">
          <input id="input-700" name="image" type="file" multiple=false class="file-loading">
        </div>
        <div class="modal-footer">
          <a href="/profil" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-ok"></span> Završeno dodavanje</a>
        </div>
      </div>
    </div>
  </div>
  {!! HTML::style('/dragdrop/css/fileinput.css') !!}
  {!! HTML::script('/dragdrop/js/fileinput.min.js') !!}
  <script>
    $("#input-700").fileinput({
      uploadExtraData: {username: '{{Session('username')}}', _token:'{{csrf_token()}}'},
      uploadUrl: '/profil/upload-profilna',
      uploadAsync: true,
      maxFileCount: 10,
      overwriteInitial: true
    });
  </script>
@endsection