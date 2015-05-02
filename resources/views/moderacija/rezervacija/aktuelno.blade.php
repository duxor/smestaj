@extends('moderacija.master-moderator')
@section('content')

@if($rezervacije)
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Pregled aktuelnih rezervacija</h3>
					</div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Početak rezervacije</th>
								<th>Kraj rezervacije</th>
								<th>Naziv smeštaja</th>
								<th>Naziv kapaciteta</th>
								<th>Vrsta smeštaja</th>
								<th>Broj osoba</th>
								<th>Napomena</th>
								<th>Rezervisao korisnik</th>
							</tr>
						</thead>
						<tbody>
						@foreach($rezervacije as $rez)
							<tr>
								<td>{{$rez['od']}}</td>
								<td>{{$rez['do']}}</td>
								<td>{{$rez['naziv']}}</td>
								<td>{{$rez['naziv_kapaciteta']}}</td>
								<td>{{$rez['vrsta_smestaja_naziv']}}</td>
								<td>{{$rez['broj_osoba']}}</td>
								<td>{{$rez['napomena']}}</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@else <h1 class="col-sm-12">Nemaaktuelnih rezervacija!</h1>
@endif
	
@endsection