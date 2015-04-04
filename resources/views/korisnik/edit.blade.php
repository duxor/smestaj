@extends('masterBackEnd')

@section('content')

    @if(!isset($korisnik)){{$korisnik=null}}@endif

    {!!Form::open(['url'=>'/administracija/korisnik/novi','class'=>'form-horizontal','id'=>'forma'])!!}
    {!!Form::hidden('id',$korisnik['id'])!!}

    <div id="dprezime" class="form-group has-feedback">
        {!!Form::label('lprezime','Prezime',['class'=>'control-label col-sm-2'])!!}
        <div class="col-sm-10">
            {!!Form::text('prezime',$korisnik['prezime'],['class'=>'form-control','placeholder'=>'Prezime','id'=>'prezime'])!!}
            <span id="sprezime" class="glyphicon form-control-feedback"></span>
        </div>
    </div>

    <div id="dime" class="form-group has-feedback">
        {!!Form::label('lime','Ime',['class'=>'control-label col-sm-2'])!!}
        <div class="col-sm-10">
            {!!Form::text('ime',$korisnik['ime'],['class'=>'form-control','placeholder'=>'Ime','id'=>'ime'])!!}
            <span id="sime" class="glyphicon form-control-feedback"></span>
        </div>
    </div>

    <div id="dusername" class="form-group has-feedback">
        {!!Form::label('lusername','Username',['class'=>'control-label col-sm-2'])!!}
        <div class="col-sm-10">
            {!!Form::text('username',$korisnik['username'],['class'=>'form-control','placeholder'=>'Username','id'=>'username'])!!}
            <span id="susername" class="glyphicon form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group has-feedback">
        {!!Form::label('lpassword','Password',['class'=>'control-label col-sm-2'])!!}
        <div class="col-sm-10">
            {!!Form::password('password',['class'=>'form-control','placeholder'=>'Password'])!!}
        </div>
    </div>

    <div id="demail" class="form-group has-feedback">
        {!!Form::label('lemail','Email',['class'=>'control-label col-sm-2'])!!}
        <div class="col-sm-10">
            {!!Form::email('email',$korisnik['email'],['class'=>'form-control','placeholder'=>'Email','id'=>'email'])!!}
            <span id="semail" class="glyphicon form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group">
        {!!Form::label('lprava','Prava pristupa',['class'=>'control-label col-sm-2'])!!}
        <div class="col-sm-10">
            {!!Form::select('pravaPristupa_id',$prava,$korisnik['pravaPristupa_id'],['class'=>'form-control'])!!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            {!!Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Sačuvaj', ['class'=>'btn btn-lg btn-primary','onClick'=>'SubmitForm.submit("forma")'])!!}
            {!!Form::button('<span class="glyphicon glyphicon-trash"></span> Resetuj promene', ['class'=>'btn btn-lg btn-danger','type'=>'reset'])!!}
        </div>
    </div>
    {!!Form::close()!!}

@endsection
