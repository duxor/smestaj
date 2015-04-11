@extends('master-paralax-1')
@section('content')
    <h1>Pretraga</h1>
    {!!Form::open(['url'=>'/pretraga','class'=>'form-inline'])!!}

    <div class="form-group">
        {!!Form::select('grad_id',$podaci['gradovi'],$podaci['grad_id'],['class'=>'form-control'])!!}

        {!!Form::button('<i class="glyphicon glyphicon-search"></i> Pronađi',['class'=>'btn btn-primary','type'=>'submit'])!!}
    </div>

    {!!Form::close()!!}

    @if($podaci['rezultat'])
        @foreach($podaci['rezultat'] as $smestaj)
            <hr>
            <div class="col-sm-4">
                <a href="#">
                    <img style="height: 150px;" src="/teme/osnovna-paralax/slike/15.jpg" alt="...">
                </a>
            </div><style >.tabela-bezbojna, .tabela-bezbojna td{
                    border-color: #fff;
                }</style>
            <div class="col-sm-8">
                <h4>{{$smestaj['naziv']}}</h4>
                <table class="table" style="border-color: #fff">
                    <tr>
                        <td>Broj mesta:</td>
                        <td>{{$smestaj['broj_osoba']}}</td>
                    </tr>
                    <tr>
                        <td>Broj mesta:</td>
                        <td>{{$smestaj['broj_osoba']}}</td>
                    </tr>
                    <tr>
                        <td>Broj mesta:</td>
                        <td>{{$smestaj['broj_osoba']}}</td>
                    </tr>
                </table>
                <p>Broj mesta: {{$smestaj['broj_osoba']}}</p>
                <p>Adresa: {{$smestaj['adresa']}}</p>
                <a href="#" class="btn btn-lg btn-default"><i class="glyphicon glyphicon-zoom-in"></i> Pregled</a>
                <a href="#" class="btn btn-lg btn-info"><i class="glyphicon glyphicon-check"></i> Rezervacija</a>
            </div><br clear="all">
        @endforeach
    @else
        <p>Nema rezultata za date parametre. Proverite parametre i pokušajte ponovo.</p>
    @endif
@endsection