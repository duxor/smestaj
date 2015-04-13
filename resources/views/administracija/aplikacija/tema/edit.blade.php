@extends('administracija.masterBackEnd')

@section('content')
    <h1>
    @if(!isset($tema))Nova tema{{$tema=null}}@else Naziv teme: {{$tema['naziv']}}@endif
    </h1>
    {!! Form::open(['url'=>'/administracija/aplikacija/tema-nova','id'=>'forma','class'=>'form-horizontal']) !!}
    {!! Form::hidden('id', $tema['id']) !!}

    <div id="dnaziv" class="form-group has-feedback">
        {!! Form::label('lnaziv', 'Naziv',['class'=>'control-label col-sm-2']) !!}
        <div class="col-sm-10">
            {!!Form::text('naziv', $tema['naziv'], ['class'=>'form-control', 'placeholder'=>'Naziv','id'=>'naziv'])!!}
            <span id="snaziv" class="glyphicon form-control-feedback"></span>
        </div>
    </div>
    <div id="dslug" class="form-group has-feedback">
        {!! Form::label('lslug', 'Slug',['class'=>'control-label col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::text('slug', $tema['slug'], ['class'=>'form-control', 'placeholder'=>'Slug','id'=>'slug'])!!}
            <span id="sslug" class="glyphicon form-control-feedback"></span>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('lopis', 'Opis',['class'=>'control-label col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('opis', $tema['slug'], ['class'=>'form-control', 'placeholder'=>'Opis'])!!}
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

@endsection