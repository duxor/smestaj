@extends('masterBackEnd')

@section('content')

    @if(isset($teme))
        @if($teme)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Slug</th>
                    <th>Opis</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($teme as $tema)
                    <tr>
                        <td>{{$tema['naziv']}}</td>
                        <td>{{$tema['slug']}}</td>
                        <td>{{$tema['opis']}}</td>
                        <td>
                            <a href="/administracija/aplikacija/tema-edit/{{$tema['slug']}}" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a href="/administracija/aplikacija/tema-ukloni/{{$tema['slug']}}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
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