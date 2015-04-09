@extends('masterBackEnd')

@section('body')

<div class="container">
      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
       <br>

      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Profil korisnika</h3> 
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>

                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Prezime:</td>
                        <td>{!! $korisnik['prezime'] !!}</td>
                      </tr>
                      <tr>
                        <td>Ime:</td>
                        <td>{!! $korisnik['ime'] !!}</td>
                      </tr>
                      <tr>
                        <td>Username:</td>
                        <td>{!! $korisnik['username'] !!}</td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><a href="{!! $korisnik['email']!!}">{!! $korisnik['email'] !!}</a></td>
                      </tr>                    
                    </tbody>
                  </table>
                  
                 <a href="{!!url('/profil/edit-nalog/')!!}" class="btn btn-lg btn-primary" >Edit Profile</a>
                </div>
              </div>
            </div>            
          </div>
        </div>
      </div>
    </div>
  
@stop