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
              <h3 class="panel-title">Profil korisnika</h3> 
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="progress">
                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: {{$procenat_popunjenosti}}%;">
                  Popunjenost profila:   {{$procenat_popunjenosti}}%
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" style="width:100px;" src="{!!$korisnik['fotografija']!!}" class="img-circle"> </div>

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