@extends('masterBackEnd')

@section('content')

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