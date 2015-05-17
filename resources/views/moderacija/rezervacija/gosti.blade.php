@extends('moderacija.master')
@section('content')
@if($korisnici)
    <div class="container">
    @foreach($korisnici as $kor)
        <div class="row">
        <div class="panel panel-default">
            <div class="col-sm-2">
                    <img src="/galerije/korisnik/osnovne/profilna.jpg" class="img img-circle" style="height:80px; width:80px;">
                  <br clear="all"><br clear="all">
                <p>
                    <a href="/moderacija/mailbox/kreiraj/{{$kor['username']}}" class="btn btn-lg btn-default"><i class="glyphicon glyphicon-envelope"></i> Pošalji poruku</a>
                </p>
            </div>
            <div class="col-sm-7">       
                <table style="border-left:5px solid #74ABFB;" class="table table-condensed">
                    <tr ><td>Prezime i ime:</td><td>{{$kor['pr']}} {{$kor['ime_korisnika']}}</td></tr>
                    <tr><td>Username:</td><td> {{$kor['username']}}</td></tr>
                    <tr><td>Ocena:</td><td>{{$kor['ocena']}} </td></tr>
                </table>
            </div>
             <div class="col-sm-3">
                <table class="table table-condensed">
                    <tr><td>Utisci:</td><td></td></tr>
                    <tr><td>{!!$kor['utisci']!!}</td></tr>
                </table>
            </div>
            <br clear="all">
        </div></div>
        @endforeach
    </div>

    
@else <h1 class="col-sm-12">Nema gostiju u evidenciji!</h1>
@endif
