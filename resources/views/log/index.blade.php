@extends('administracija.masterBackEnd')

@section('content')
    @if(session()->has('greska'))
        <div class="alert alert-danger" role="alert">
            <p>Dogodila se greška: <br>
            <ol>
                @foreach(session('greska') as $greske)
                    @foreach($greske as $greska)
                        <li>{{$greska}}</li>
                    @endforeach
                @endforeach
            </ol>
            </p>
        </div>
    @endif
    @if(session()->has('potvrda'))
        <div class="alert alert-success" role="alert">
            <p>
                {{session('potvrda')}}
            </p>
        </div>
    @endif
    <script>
        var forma='forma1';
        function sub(_forma){
            forma=_forma;
        }
        $(document).keypress(function(e) {
            if(e.which == 13) {
                SubmitForm.submit(forma);
            }
        });
    </script>
    <div class="col-sm-7">
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#tab1default" data-toggle="tab">Prijava korisnika</a></li>
                    <li><a href="#tab2default" data-toggle="tab">Registracija korisnika</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1default" onclick="sub('forma1')">
                        <h1>Prijava</h1>
                        <hr/>
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
                        {!! Form::open(['url'=>'/log/login','class'=>'form-horizontal','id'=>'forma1']) !!}
                        @if(isset($return_to_url)){!!Form::hidden('return_to_url',$return_to_url)!!}@endif
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
                    <div class="tab-pane fade" id="tab2default" onclick="sub('forma2')">
                        <h1>Registracija korisnika</h1>
                        <hr/>
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
                        {!! Form::open(['url'=>'/log/registracija','class'=>'form-horizontal','id'=>'forma2']) !!}
                        @if(isset($return_to_url)){!!Form::hidden('return_to_url',$return_to_url)!!}@endif
                        <div class="form-group has-feedback">
                            {!! Form::label('lreg_prezime','Prezime',['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('reg_prezime',Input::old('reg_prezime'),['placeholder'=>'Prezime','class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('lreg_ime','Ime',['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('reg_ime',Input::old('reg_ime'),['placeholder'=>'Ime','class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div id="dreg_username" class="form-group has-feedback">
                            {!! Form::label('lreg_username','Username',['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('reg_username',Input::old('reg_username'),['placeholder'=>'Korisničko ime','class'=>'form-control','id'=>'reg_username']) !!}
                                <span id="sreg_username" class="glyphicon form-control-feedback"></span>
                            </div>
                        </div>

                        <div id="dreg_password" class="form-group has-feedback">
                            {!! Form::label('lreg_password','Password',['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::password('reg_password', ['placeholder'=>'Pristupna šifra','class'=>'form-control','id'=>'reg_password']) !!}
                                <span id="sreg_password" class="glyphicon form-control-feedback"></span>
                            </div>
                        </div>
                        <div id="dreg_password_potvrda" class="form-group has-feedback">
                            {!! Form::label('lreg_password_potvrda','Password',['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::password('reg_password_potvrda', ['placeholder'=>'Ponovite šifru','class'=>'form-control','id'=>'reg_password_potvrda']) !!}
                                <span id="sreg_password_potvrda" class="glyphicon form-control-feedback"></span>
                            </div>
                        </div>
                        <div id="dreg_email" class="form-group has-feedback">
                            {!! Form::label('lreg_email','Email',['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::email('reg_email',Input::old('reg_email'),['placeholder'=>'Email','class'=>'form-control','id'=>'reg_email']) !!}
                                <span id="sreg_email" class="glyphicon form-control-feedback"></span>
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