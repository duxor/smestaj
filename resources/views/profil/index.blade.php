@extends(\App\OsnovneMetode::osnovniNav().".master")

@section('body')
<div  class="container">
      <div class="row">
        <div id="edit" class="col-sm-7 col-md-offset-1 toppad">
          <div style="opacity: 0.8;" class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Profil korisnika</h3> 
            </div>
            <div class="panel-body">

              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" style="width:100px;" src="/galerije/{{Session::get('username')}}/osnovne/profilna.jpg" class="img-circle"> </div>

                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                    <script>
                    $(document).on('mouseenter', '#edit', function () {
                         $("#show").click(function(){
                        $("#thedialog").show(); });
                        $(this).find(":button").fadeIn('slow').click(function(){ $('#thedialog').dialog('open'); });
                    }).on('mouseleave', '#edit', function () {
                        $(this).find(":button").fadeOut('slow');
                    });
                  </script>
                      <tr>
                        <td>Prezime:</td>
                        <td>{!!$korisnik['prezime']!!}<button type="button" id="show" style="display: none;" class="btn btn-success btn-xs" data-toggle="modal" data-target="#thedialog"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button> </td>
                      </tr>

                      <div   class="modal fade" style="display: none;" id="thedialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                </div>
                                <div class="modal-body">
                                  ...
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                              </div>
                           </div>
                      </div>

                      <tr>
                        <td>Ime:</td>
                        <td>{!!$korisnik['ime']!!} <button type="button" class="btn btn-success btn-xs" style="display: none;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></td>
                      </tr>
                      <tr>
                        <td>Username:</td>
                        <td>{!!$korisnik['username']!!} <button type="button" class="btn btn-success btn-xs" style="display: none;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><a href="{!!$korisnik['email']!!}">{!!$korisnik['email']!!}</a> <button type="button" class="btn btn-success btn-xs" style="display: none;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></td>
                      </tr>
                      <tr>
                      @if($korisnik['adresa'])
                        <tr>
                          <td>Adresa:</td>
                          <td>{!!$korisnik['adresa']!!} <button type="button" class="btn btn-success btn-xs" style="display: none;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></td>
                        </tr>
                      @endif
                      @if($korisnik['grad'])
                          <tr>
                            <td>Grad:</td>
                            <td>{!!$korisnik['grad']!!} <button type="button" class="btn btn-success btn-xs" style="display: none;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></td>
                          </tr>
                      @endif
                      @if($korisnik['telefon'])
                        <tr>
                          <td>Telefon:</td>
                          <td>{!!$korisnik['telefon']!!} <button type="button" class="btn btn-success btn-xs" style="display: none;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></td>
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
        <div class="col-md-3">
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