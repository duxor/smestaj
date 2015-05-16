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
                    <a href="/moderacija/mailbox/kreiraj" class="btn btn-lg btn-default"><i class="glyphicon glyphicon-envelope"></i> Pošalji poruku</a>
                </p>
            </div>
            <div class="col-sm-10">
                <h3></h3>
                <table class="table">
                    <tr><td>Prezime:</td><td>{{$kor['pr']}}</td></tr>
                    <tr><td>Ime:</td><td> {{$kor['ime_korisnika']}}</td></tr>
                    <tr><td>Rezervisao smeštaj:</td><td> {{$kor['naziv_smestaja']}}</td></tr>
                    <tr><td>U periodu:</td><td>{{$kor['od']}} - {{$kor['do']}}</td></tr>
                    <tr><td>Utisci:</td><td>{{$kor['utisci']}} </td></tr>
                    <tr><td>Ocena:</td><td>{{$kor['ocena']}} </td></tr>
                </table>
            </div><br clear="all">
		</div></div>
		@endforeach
	</div>
	
@else <h1 class="col-sm-12">Arhiva je prazna!</h1>
@endif
   
@endsection