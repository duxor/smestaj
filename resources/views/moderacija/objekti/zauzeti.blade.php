@extends('moderacija.master')
@section('content')

@if($podaci)
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Pregled zauzetih kapaciteta</h3>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Objekat</th>
							<th>Smeštaj</th>
							<th>Naziv kapaciteta</th>
							<th>Slobodan do</th>

							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					@foreach($podaci as $pod)
						<tr>
							<td>{{$pod['od']}}</td>
							<td>{{$pod['do']}}</td>
							<td>{{$pod['naziv']}}</td>
							<td>{{$pod['naziv_kapaciteta']}}</td>
							<td>{{$pod['vrsta_smestaja_naziv']}}</td>
							<td>{{$rez['broj_osoba']}}</td>
							<td style="font-size:12px;">{{$rez['napomena']}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


@else <h1 class="col-sm-12">Nema slobodnih kapaciteta!</h1>
@endif
   
@endsection