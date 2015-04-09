@extends('masterBackEnd')

@section('content')
    <div class="col-sm-7">
        <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Prijava korisnika</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Registracija korisnika</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
                                                        <h1>Prijava</h1>
                            <hr/>
                            {!! Form::open(['url'=>'/profil/login','class'=>'form-horizontal','id'=>'forma1']) !!}
                            <div id="dusername" class="form-group has-feedback">
                                {!! Form::label('lusername','Username',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('username',Input::old('username'),['placeholder'=>'Korisničko ime','class'=>'form-control','id'=>'username']) !!}
                                    <span id="susername" class="glyphicon form-control-feedback"></span>
                                </div>
                            </div>

                            <div id="dpassword" class="form-group has-feedback">
                                {!! Form::label('lpassword','Password',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::password('password', ['placeholder'=>'Pristupna šifra','class'=>'form-control','id'=>'password']) !!}
                                    <span id="spassword" class="glyphicon form-control-feedback"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    {!! Form::button('<span class="glyphicon glyphicon-play-circle"></span> Prijava', ['class' => 'btn btn-lg btn-primary','onClick'=>'SubmitForm.submit(\'forma1\')']) !!}
                                    {!! Form::button('<span class="glyphicon glyphicon-refresh"></span> Resetuj šifru', ['class' => 'btn btn-lg btn-warning']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="tab-pane fade" id="tab2default">
                        <h1>Registracija korisnika</h1>
                            <hr/>
                            {!! Form::open(['url'=>'/profil/registracija','class'=>'form-horizontal','id'=>'forma2']) !!}
                            <div id="dusername2" class="form-group has-feedback">
                                {!! Form::label('lusername2','Username',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('username2',Input::old('username2'),['placeholder'=>'Korisničko ime','class'=>'form-control','id'=>'username2']) !!}
                                    <span id="susername2" class="glyphicon form-control-feedback"></span>
                                </div>
                            </div>

                            <div id="dpassword2" class="form-group has-feedback">
                                {!! Form::label('lpassword2','Password',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::password('password2', ['placeholder'=>'Pristupna šifra','class'=>'form-control','id'=>'password2']) !!}
                                    <span id="spassword2" class="glyphicon form-control-feedback"></span>
                                </div>
                            </div>
                            <div id="demail2" class="form-group has-feedback">
                                {!! Form::label('lemail2','Email',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::email('email2',Input::old('email2'),['placeholder'=>'email','class'=>'form-control','id'=>'email2']) !!}
                                    <span id="email2" class="glyphicon form-control-feedback"></span>
                                </div>
                            </div>
                            <div id="dprezime" class="form-group has-feedback">
                                {!! Form::label('lprezime2','Prezime',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('prezime2',Input::old('prezime2'),['placeholder'=>'prezime','class'=>'form-control','id'=>'prezime2']) !!}
                                    <span id="prezime2" class="glyphicon form-control-feedback"></span>
                                </div>
                            </div>
                             <div id="dime2" class="form-group has-feedback">
                                {!! Form::label('lime2','Ime',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('ime2',Input::old('ime2'),['placeholder'=>'ime','class'=>'form-control','id'=>'ime2']) !!}
                                    <span id="ime2" class="glyphicon form-control-feedback"></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    {!! Form::button('<span class="glyphicon glyphicon-play-circle"></span> Registracija', ['class' => 'btn btn-lg btn-primary','onClick'=>'SubmitForm.submit(\'forma2\')']) !!}
                                   
                                </div>
                            </div>
                            {!! Form::close() !!}


                                                                
                        </div>
                    </div>
                </div>
            </div>








    </div>
@stop