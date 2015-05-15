@extends('administracija.master')
{{--forma za izmenu naloga--}}
@section('content')
    <div class="col-sm-3"></div>
    @if(!isset($nalog))
        {{$nalog=null}}
        <h1 class="col-sm-9">Nova aplikacija</h1>
    @else
        <h1 class="col-sm-9">Uredi aplikaciju</h1>
    @endif

    {!! Form::open(['url'=>'/administracija/nalog/nalog-edit','id'=>'forma','class'=>'form-horizontal']) !!}
    {!! Form::hidden('id', $nalog['id']) !!}

    <div id="dnaziv" class="form-group has-feedback">
        {!! Form::label('lnaziv', 'Naziv',['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!!Form::text('naziv', $nalog['naziv'], ['class'=>'form-control', 'placeholder'=>'Naziv','id'=>'naziv'])!!}
            <span id="snaziv" class="glyphicon form-control-feedback"></span>
        </div>
    </div>

    <div id="dslug" class="form-group has-feedback">
        {!! Form::label('lslug', 'Slug',['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::text('slug', $nalog['slug'], ['class'=>'form-control', 'placeholder'=>'Slug','id'=>'slug'])!!}
            <span id="sslug" class="glyphicon form-control-feedback"></span>
        </div>
    </div>
    <div id="dtema" class="form-group has-feedback">
        {!! Form::label('ltema_id', 'Izaberi temu',['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!!Form::select('tema_id',$tema_id,$nalog['tema_id']?$nalog['tema_id']:2,['class'=>'form-control'])!!}
        </div>
    </div>
    <div id="dpridruzi" class="form-group has-feedback">
        {!! Form::label('lkorisnici_id', 'Pridruži korisnika',['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!!Form::select('korisnici_id',$korisnici,$nalog['korisnici_id'],['class'=>'form-control'])!!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3"></div>
        <div class="col-sm-9">
            {!! Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Sačuvaj', ['class'=>'btn btn-lg btn-primary','onClick'=>'subCheck(\'forma\')']) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Resetuj izmene', ['class'=>'btn btn-lg btn-danger','type'=>'reset']) !!}
            <script>
                function subCheck(formaID){
                    $.post('/administracija/nalog/slug-test',{_token:'{{csrf_token()}}',slug:$('#slug').val(),id:'{{$nalog['id']}}'},function(data){
                        if(data=='ok') SubmitForm.submit(formaID);
                        else{
                            $('#dslug').toggleClass('has-success');
                            $('#dslug').addClass('has-error');
                            $('#sslug').removeClass('glyphicon-ok');
                            $('#sslug').addClass('glyphicon-remove');
                            $('#slug').after('<p id="greska" class="alert alert-danger" style="margin-top:5px;display:none">'+data+'</p>');
                            $('#greska').show('slow');
                            window.setTimeout(function(){
                                $('#greska').hide('slow');
                            },4000);
                        }
                    });
                }
            </script>
        </div>
    </div>
    {!! Form::close() !!}

@endsection