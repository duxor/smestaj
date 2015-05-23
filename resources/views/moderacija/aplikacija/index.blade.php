@extends('moderacija.master')
@section('content')
    <div class="col-sm-4">
        @if($podaci['aplikacije'])<h2>Aplikacije:</h2>@endif
        @foreach($podaci['aplikacije'] as $aplikacija)
            <p>{{$aplikacija['naziv']}} <a href="{!!url('/moderator/podesavanja/'.$aplikacija['slug'])!!}" target="_blank" class="btn btn-info glyphicon glyphicon-pencil"></a> <a href="/{{$aplikacija['slug']}}" target="_blank" class="btn btn-default glyphicon glyphicon-eye-open"></a></p>
        @endforeach
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3>Kapaciteti</h3>
            <div><div class="col-sm-8 nDn">Broj smestaja:</div><div class="col-sm-2">{{$podaci['kapaciteti']['smjestaj']}}</div><div class="col-sm-1"><a href="{!!url('/moderacija/novi-smestaj')!!}" class="btn btn-xs btn-primary" style="padding: 0"><i class="icon-hospital"></i></a></div></div>
            <div><div class="col-sm-8 nDn">Broj objekata:</div><div class="col-sm-2">{{$podaci['kapaciteti']['objekat']}}</div><div class="col-sm-1"><a href="{!!url('/moderacija/novi-objekat')!!}" class="btn btn-xs btn-primary" style="padding: 0"><i class="icon-hospital"></i></a></div></div>
            <br clear="all">
        </div>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3>Komentari</h3>
            <div><div class="col-sm-8 nDn">Broj komentara:</div><div class="col-sm-4">{{$podaci['komentari']}}</div></div>
            <h3>Newsletter</h3>
            <div><div class="col-sm-8 nDn">Broj korisnika:</div><div class="col-sm-4">{{$podaci['newsletter']}}</div></div>
            <br clear="all">
        </div>
    </div>

    <div class="col-sm-4">
        <h2>Rezervacije</h2>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3>Aktivne</h3>
            <div><div class="col-sm-8 nDn">Broj rezervacija:</div><div class="col-sm-4">@if($podaci['rezervacije']['aktivne']['brojRezervacija']){{$podaci['rezervacije']['aktivne']['brojRezervacija']}}@else 0 @endif</div></div>
            <div><div class="col-sm-8 nDn">Broj osoba:</div><div class="col-sm-4">@if($podaci['rezervacije']['aktivne']['ukupnoOsoba']){{$podaci['rezervacije']['aktivne']['ukupnoOsoba']}}@else 0 @endif</div></div>
            <div><div class="col-sm-8 nDn">Ukupan prihod:</div><div class="col-sm-4">@if($podaci['rezervacije']['aktivne']['uupanPrihod']){{$podaci['rezervacije']['aktivne']['uupanPrihod']}}@else 0 @endif</div></div>
            <br clear="all">
        </div>
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3>Zaključene</h3>
            <div><div class="col-sm-8 nDn">Broj rezervacija:</div><div class="col-sm-4">@if($podaci['rezervacije']['zakljucene']['brojRezervacija']){{$podaci['rezervacije']['zakljucene']['brojRezervacija']}}@else 0 @endif</div></div>
            <div><div class="col-sm-8 nDn">Broj osoba:</div><div class="col-sm-4">@if($podaci['rezervacije']['zakljucene']['ukupnoOsoba']){{$podaci['rezervacije']['zakljucene']['ukupnoOsoba']}}@else 0 @endif</div></div>
            <div><div class="col-sm-8 nDn">Ukupan prihod:</div><div class="col-sm-4">@if($podaci['rezervacije']['zakljucene']['uupanPrihod']){{$podaci['rezervacije']['zakljucene']['uupanPrihod']}}@else 0 @endif</div></div>
            <br clear="all">
        </div>
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3>Ukupno</h3>
            <div><div class="col-sm-8 nDn">Broj rezervacija:</div><div class="col-sm-4">@if($podaci['rezervacije']['ukupno']['brojRezervacija']){{$podaci['rezervacije']['ukupno']['brojRezervacija']}}@else 0 @endif</div></div>
            <div><div class="col-sm-8 nDn">Broj osoba:</div><div class="col-sm-4">@if($podaci['rezervacije']['ukupno']['ukupnoOsoba']){{$podaci['rezervacije']['ukupno']['ukupnoOsoba']}}@else 0 @endif</div></div>
            <div><div class="col-sm-8 nDn">Ukupan prihod:</div><div class="col-sm-4">@if($podaci['rezervacije']['ukupno']['uupanPrihod']){{$podaci['rezervacije']['ukupno']['uupanPrihod']}}@else 0 @endif</div></div>
            <br clear="all">
        </div>
    </div>

    <div class="col-sm-4">

    </div>
@endsection