@extends('masterBackEnd')

@section('content')
    <table class="table table-striped">
        <thead><tr><th>Prezime i Ime</th><th>Prava pristupa</th><th>Status</th><th></th><th></thead>
        @foreach($korisnici as $korisnik)
            <tr>
                <td>
                    @if($korisnik['pravaPristupa']!='Kreator')<a href="{!! url('/administracija/korisnik/profil/'.$korisnik['username'])!!}">@endif
                        {{$korisnik['prezime']}} {{$korisnik['ime']}}
                    @if($korisnik['pravaPristupa']!='Kreator')</a>@endif
                </td>
                <td>{{$korisnik['pravaPristupa']}}</td>
                <td>
                    <a href="{!!url('/administracija/korisnik/status/'.$korisnik['username'])!!}">@if($korisnik['aktivan']==1) <span class="glyphicon glyphicon-ok"></span> @else <span class="glyphicon glyphicon-remove"></span>@endif</a>
                </td>
                <td>
                    @if($korisnik['pravaPristupa']!='Kreator')
                        <a href="{!!url('/administracija/korisnik/profil/'.$korisnik['username'])!!}" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a href="{!!url('/administracija/korisnik/ukloni/'.$korisnik['username'])!!}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{!!url('/administracija/korisnik/novi')!!}" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-plus"></span> Dodaj novog korisnika</a>

@endsection
