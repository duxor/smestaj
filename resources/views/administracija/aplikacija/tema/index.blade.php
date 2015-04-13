
@extends('administracija.masterBackEnd')

@section('content')

    @if(isset($teme))
        @if($teme)
            <h1>Teme</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th>Naziv</th>
                    <th>Slug</th>
                    <th>Opis</th>
                    <th></th>
                    <th>Aktivan</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teme as $tema)
                    <tr>
                        <td><a href="/administracija/aplikacija/tema-templejt/{{$tema['slug']}}" class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                        <td>{{$tema['naziv']}}</td>
                        <td>{{$tema['slug']}}</td>
                        <td>{{$tema['opis']}}</td>
                        <td>
                            <a href="/administracija/aplikacija/tema-edit/{{$tema['slug']}}" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a href="/administracija/aplikacija/tema-ukloni/{{$tema['slug']}}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                        <td><a href="{!!url('/administracija/aplikacija/tema-status/'.$tema['id'])!!}">@if($tema['aktivan']==1) <span class="glyphicon glyphicon-ok"></span> @else <span class="glyphicon glyphicon-remove"></span>@endif</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="{!!url('/administracija/aplikacija/tema-nova')!!}" class="btn btn-lg btn-default"><i class="glyphicon glyphicon-plus"></i> Nova tema</a>
        @else
            <p>Ne postoji ni jedna tema u evidenciji.</p>
        @endif
    @endif

@endsection