@extends('administracija.masterBackEnd')

@section('content')

    @if(isset($nalozi))
        @if($nalozi)
            <h1>Aplikacije</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th>Naziv (brend)</th>
                    <th>Slug</th>
                     <th>Aktivan</th>
                    <th>Korisnik</th>
                    <th>Tema</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($nalozi as $nalog)
                    <tr>
                        <td><a href="/administracija/nalog/sadrzaji/{!!$nalog['slug']!!}" class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                        <td>{{$nalog['naziv']}}</td>
                        <td>{{$nalog['slug']}}</td>
                        <td>
                        <a href="{!!url('/administracija/nalog/nalog-status/'.$nalog['id'])!!}">@if($nalog['aktivan']==1) <span class="glyphicon glyphicon-ok"></span> @else <span class="glyphicon glyphicon-remove"></span>@endif</a>
                        </td>
                        <td>{{$nalog['ime']}}</td>
                        <td>{{$nalog['tema']}}</td>
                        <td>
                            <a href="/administracija/nalog/nalog-edit/{{$nalog['slug']}}" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a href="/administracija/nalog/nalog-brisi/{{$nalog['id']}}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="{!!url('/administracija/nalog/nalog-novi')!!}" class="btn btn-lg btn-default"><i class="glyphicon glyphicon-plus"></i> Novi nalog</a>
        @else
            <p>Ne postoji ni jedan nalog u evidenciji.</p>
        @endif
    @endif

@endsection