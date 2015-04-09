@extends('masterBackEnd')

@section('content')

    @if(isset($templejt))
        @if($templejt)
            <h2>{{$templejt[0]['tema']}}</h2>
            <p>{{$templejt[0]['opis']}}</p>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Naslov</th>
                    <th>Slug</th>
                    <th>Redosled</th>
                    <th>Vrsta sadržaja</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($templejt as $podaci)
                    <tr>
                        <td>{{$podaci['naziv']}}</td>
                        <td>{{$podaci['slug']}}</td>
                        <td>
                            {!!Form::open(['url'=>'/administracija/aplikacija/tema-templejt/'.$podaci['templejt_id'],'class'=>'form-inline'])!!}
                            {!!Form::text('redoslijed',$podaci['redoslijed'],['class'=>'form-control'])!!}
                            {!!Form::button('<i class="glyphicon glyphicon-ok"></i>',['class'=>'btn btn-default','type'=>'submit'])!!}
                            {!!Form::close()!!}
                        </td>
                        <td>{{$podaci['vrsta_sadrzaja']}}</td>
                        <td>
                            {!!Form::open(['url'=>'/administracija/aplikacija/osnovna-edit/'.$podaci['slug'],'class'=>'col-sm-6'])!!}
                            {!!Form::hidden('templejt_id',$podaci['templejt_id'])!!}
                            {!!Form::button('<i class="glyphicon glyphicon-pencil"></i>',['class'=>'btn btn-info','type'=>'submit'])!!}
                            {!!Form::close()!!}

                            {!!Form::open(['url'=>'/administracija/aplikacija/templejt-ukloni/'.$podaci['templejt_id'],'class'=>'col-sm-6'])!!}
                            {!!Form::hidden('tema_slug',$templejt[0]['tema_slug'])!!}
                            {!!Form::button('<i class="glyphicon glyphicon-trash"></i>',['class'=>'btn btn-danger','type'=>'submit'])!!}
                            {!!Form::close()!!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!!Form::open(['url'=>'/administracija/aplikacija/templejt-novi','class'=>'col-sm-6'])!!}
                {!!Form::hidden('tema_slug',$templejt[0]['tema_slug'])!!}
                {!!Form::hidden('tema_id',$templejt[0]['tema_id'])!!}
                {!!Form::button('<i class="glyphicon glyphicon-plus"></i> Novi templejt',['class'=>'btn btn-lg btn-default','type'=>'submit'])!!}
            {!!Form::close()!!}
        @else
            <p>Ne postoji ni jedan templejt u evidenciji.</p>
        @endif
    @endif

@endsection