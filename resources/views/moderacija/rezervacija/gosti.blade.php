@extends('moderacija.master')
@section('content')

@if($korisnici)
    @if($korisnici[0]['id'])
    <div class="container">
    @foreach($korisnici as $kor)
        <div class="row">
        <div style="border:1px solid #E6E6E6; padding-top:20px;" >
            <div class="col-sm-2">
                    <img src="/galerije/korisnik/osnovne/profilna.jpg" class="img img-circle" style="height:60px; width:60px;">
                  <br clear="all">
                <p>
                    <a href="/moderacija/mailbox/kreiraj/{{$kor['username']}}" class="btn btn-lg btn-default"><i class="glyphicon glyphicon-envelope"></i> Pošalji poruku</a>
                </p>
            </div>
            <div class="col-sm-7">       
                <table  style="border-left:5px solid #74ABFB; "class="moja-tabela">
                    <tr ><td class="nDn"> Prezime i ime:</td><td>{{$kor['pr']}} {{$kor['ime_korisnika']}}</td></tr>
                    <tr><td class="nDn">Username:</td><td> {{$kor['username']}}</td></tr>
                    <tr><td class="nDn">Ocena:</td><td>{{$kor['ocena']}} </td></tr>
                </table>
            </div>
             <div class="col-sm-3">
                <table class="moja-tabela">
                    <tr><td>Utisci:</td><td></td></tr>
                    <tr><td>{!!isset($kor['utisci'])?$kor['utisci']:'Nema utisaka o korisniku.'!!}</td></tr>
                </table>
            </div>
            <br clear="all">
        </div></div>
        @endforeach
    </div>

    
@else <h1>Nema gostiju u evidenciji!</h1>
    @endif
        @else <h1>Nema gostiju u evidenciji!</h1>
@endif
@endsection