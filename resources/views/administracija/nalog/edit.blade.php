@extends('masterBackEnd')
<!-- forma za izmenu  naloga-->
@section('content')
    @if(isset($nalog))
    {!! Form::open(['url'=>'/administracija/nalog/nalog-novi','id'=>'forma','class'=>'form-horizontal']) !!}
    {!! Form::hidden('id', $nalog['id']) !!}

    <div id="dnaziv" class="form-group has-feedback">
        {!! Form::label('lnaziv', 'Naziv',['class'=>'control-label col-sm-2']) !!}
        <div class="col-sm-10">
            {!!Form::text('naziv', $nalog['naziv'], ['class'=>'form-control', 'placeholder'=>'Naziv','id'=>'naziv'])!!}
            <span id="snaziv" class="glyphicon form-control-feedback"></span>
        </div>
    </div>

    <div id="dslug" class="form-group has-feedback">
        {!! Form::label('lslug', 'Slug',['class'=>'control-label col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::text('slug', $nalog['slug'], ['class'=>'form-control', 'placeholder'=>'Slug','id'=>'slug'])!!}
            <span id="sslug" class="glyphicon form-control-feedback"></span>
        </div>
    </div>
    <div id="dtema" class="form-group has-feedback">
        {!! Form::label('ltema', 'Izaberi temu',['class'=>'control-label col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::select('tema', $tema, null, ['class'=>'form-control', 'placeholder'=>'Izaberi temu']) !!}
            <span id="stema" class="glyphicon form-control-feedback"></span>
        </div>
    </div>

    <div id="dpridruzi" class="form-group has-feedback">
        {!! Form::label('lpridruzi', 'Pridruži korisnika',['class'=>'control-label col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::select('pridruzi', $lista ,null, ['class'=>'form-control', 'placeholder'=>'Pridruži kontakt']) !!}
           
            <span id="spridruzi" class="glyphicon form-control-feedback"></span>

        </div>
    </div>
 

    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            {!! Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Sačuvaj', ['class'=>'btn btn-lg btn-primary','onClick'=>'SubmitForm.submit(\'forma\')']) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Resetuj izmene', ['class'=>'btn btn-lg btn-danger','type'=>'reset']) !!}
        </div>
    </div>
    {!! Form::close() !!}

@endif
<!-- kraj forme za izmenu naloga-->

<!-- forma za dodavanje novog naloga-->
    @if(isset($kor))
        {!! Form::open(['url'=>'/administracija/nalog/nalog-novi','id'=>'forma','class'=>'form-horizontal']) !!}


    <div id="dnaziv" class="form-group has-feedback">
        {!! Form::label('lnaziv', 'Naziv',['class'=>'control-label col-sm-2']) !!}
        <div class="col-sm-10">
            {!!Form::text('naziv', 'naziv', ['class'=>'form-control', 'placeholder'=>'Naziv','id'=>'naziv'])!!}
            <span id="snaziv" class="glyphicon form-control-feedback"></span>
        </div>
    </div>

    <div id="dslug" class="form-group has-feedback">
        {!! Form::label('lslug', 'Slug',['class'=>'control-label col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::text('slug','slug', ['class'=>'form-control', 'placeholder'=>'Slug','id'=>'slug'])!!}
            <span id="sslug" class="glyphicon form-control-feedback"></span>
        </div>
    </div>
    <div id="dtema" class="form-group has-feedback">
        {!! Form::label('ltema', 'Izaberi temu',['class'=>'control-label col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::select('tema', $tema, null, ['class'=>'form-control', 'placeholder'=>'Izaberi temu']) !!}
            <span id="stema" class="glyphicon form-control-feedback"></span>
        </div>
    </div>
    <div id="dpridruzi" class="form-group has-feedback">
        {!! Form::label('lpridruzi', 'Pridruži korisnika',['class'=>'control-label col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::select('pridruzi', $kor, null, ['class'=>'form-control', 'placeholder'=>'Pridruži kontakt']) !!}
            <span id="spridruzi" class="glyphicon form-control-feedback"></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            {!! Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Sačuvaj', ['class'=>'btn btn-lg btn-primary','onClick'=>'SubmitForm.submit(\'forma\')']) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Resetuj izmene', ['class'=>'btn btn-lg btn-danger','type'=>'reset']) !!}
        </div>
    </div>
    {!! Form::close() !!}
    @endif
<!--kraj  forme za dodavanje novog naloga-->
@endsection