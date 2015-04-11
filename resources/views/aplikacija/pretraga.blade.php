@extends('master-paralax-1')
@section('content')
    <h1>Pretraga</h1>
    {!!Form::open(['url'=>'/pretraga','class'=>'form-inline'])!!}

    <div class="form-group">
        <label>Broj mesta (Tačan  broj {!!Form::checkbox('tacan_broj',1,$podaci['tacan_broj'])!!})</label>
        {!!Form::select('broj_osoba',[1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12],2,['class'=>'form-control'])!!}

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
            </div>
            <div class="col-sm-8">
                <h3>{{$smestaj['naziv']}}</h3>
                <table class="moja-tabela">
                    <tr><td>Broj mesta:</td><td>{{$smestaj['broj_osoba']}}</td></tr>
                    <tr><td>Adresa:</td><td>{{$smestaj['adresa']}}</td></tr>
                </table>
                <a href="#" class="btn btn-lg btn-default"><i class="glyphicon glyphicon-zoom-in"></i> Pregled</a>
                <a href="#" class="btn btn-lg btn-info"><i class="glyphicon glyphicon-check"></i> Rezervacija</a>
            </div><br clear="all">
        @endforeach
    @else
        <p>Nema rezultata za date parametre. Proverite parametre i pokušajte ponovo.</p>
    @endif
@endsection