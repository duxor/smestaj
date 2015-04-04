@extends('masterBackEnd')

@section('content')
    @if(!isset($templejt))
        {{$templejt=null}}
        {{$temaSlug=null}}
    @endif
    {!! Form::open(['url'=>'/administracija/aplikacija/templejt-novi-submit','id'=>'forma','class'=>'form-horizontal']) !!}
    {!! Form::hidden('id', $templejt['id']) !!}
    {!!Form::hidden('tema_slug',$tema_slug)!!}
    {!!Form::hidden('tema_id',$temaID)!!}

    <div id="dslug" class="form-group has-feedback">
        {!! Form::label('lslug', 'Slug',['class'=>'control-label col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::text('slug', $templejt['slug'], ['class'=>'form-control', 'placeholder'=>'Slug','id'=>'slug'])!!}
            <span id="sslug" class="glyphicon form-control-feedback"></span>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('lvrsta_sadrzaja_id', 'Vrsta sadržaja',['class'=>'control-label col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::select('vrsta_sadrzaja_id', $vrstaSadrzaja, $templejt['vrsta_sadrzaja_id'], ['class'=>'form-control'])!!}
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