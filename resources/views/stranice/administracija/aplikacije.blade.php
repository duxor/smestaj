@extends('administracija.masterBackEnd')

@section('content')

    @if(isset($teme))
        @if($teme)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Naziv</th>
                        <th>Slug</th>
                        <th>Opis</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($teme as $tema)
                    <tr>
                        <td>{{$tema['naziv']}}</td>
                        <td>{{$tema['slug']}}</td>
                        <td>{{$tema['opis']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Ne postoji ni jedna tema u evidenciji.</p>
        @endif
    @endif



    @if(isset($korisnici))
        @if(!isset($aplikacija)){{$aplikacija=null}}@endif
        {!! Form::open(['url'=>'/administracija/aplikacije/nova','id'=>'forma','class'=>'form-horizontal']) !!}
            {!! Form::hidden('id', $aplikacija['id']) !!}

            <div id="dnaziv" class="form-group">
                {!! Form::label('lnaziv', 'Naziv',['class'=>'control-label col-sm-2']) !!}
                <div class="col-sm-10">
                    {!! Form::text('naziv', $aplikacija['naziv'], ['class'=>'form-control', 'placeholder'=>'Naziv','id'=>'naziv']) !!}
                </div>
            </div>

            <div id="dslug" class="form-group">
                {!! Form::label('lslug', 'Slug',['class'=>'control-label col-sm-2']) !!}
                <div class="col-sm-10">
                    {!! Form::text('slug', $aplikacija['slug'], ['class'=>'form-control', 'placeholder'=>'Slug','id'=>'slug']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('lpass', 'Password',['class'=>'control-label col-sm-2']) !!}
                <div class="col-sm-10">
                    {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('lkorisnik', 'Korisnik',['class'=>'control-label col-sm-2']) !!}
                <div class="col-sm-10">
                    {!! Form::select('korisnici_id', $korisnici, $aplikacija['korisnici_id'], ['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('lgrad', 'Grad',['class'=>'control-label col-sm-2']) !!}
                <div class="col-sm-10">
                    {!! Form::select('grad_id', $gradovi, $aplikacija['grad_id'], ['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    {!! Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Sačuvaj', ['class'=>'btn btn-lg btn-primary','onClick'=>'_submit("forma")']) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Resetuj izmene', ['class'=>'btn btn-lg btn-danger','type'=>'reset']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    @endif

    @if(isset($aplikacije))
        <table class="table table-striped">
            <thead><tr><th>Naziv</th><th>Slug</th><th>Vlasnik</th><th>Grad</th><th>Aktivna</th><th></th></tr></thead>
            @foreach($aplikacije as $aplikacija)
                <tr>
                    <td>
                        <a href="/administracija/aplikacije/aplikacija/{{$aplikacija['slug']}}">{{$aplikacija['naziv']}}</a>
                    </td>
                    <td>
                        {{$aplikacija['slug']}}
                    </td>
                    <td>
                        <a href="/administracija/korisnici/korisnik/{{$aplikacija['vlasnik']}}">{{$aplikacija['vlasnik']}}</a>
                    </td>
                    <td>
                        {{$aplikacija['grad']}}
                    </td>
                    <td>
                        <a href="{!! url('/administracija/aplikacije/status/'.$aplikacija['slug']) !!}">@if($aplikacija['aktivan']==1) <span class="glyphicon glyphicon-ok"></span> @else <span class="glyphicon glyphicon-remove"></span>@endif</a>
                    </td>
                    <td>
                        <a href="{!! url('/administracija/aplikacije/ukloni/'.$aplikacija['slug']) !!}" class="btn btn-danger">Ukloni</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="{!! url('/administracija/aplikacije/nova') !!}" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-plus"></span> Nova Aplikacija</a>
    @endif

@endsection