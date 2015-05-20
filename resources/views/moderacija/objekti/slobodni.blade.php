@extends('moderacija.master')
@section('content')

@if($podaci)
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Pregled slobodnih kapaciteta</h3>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Objekat</th>
							<th>Slug</th>
							<th>Naziv kapaciteta</th>
							<th>Smeštaj</th>
							<th>Cena po osobi</th>
							<th>Slobodan od</th>

						</tr>
					</thead>
					<tbody>
					@foreach($podaci as $pod)
						<tr>
							<td>{{$pod['naziv']}}</td>
							<td><a href="/{{$pod['app']}}/{{$pod['slug']}}">{{$pod['slug']}}</a></td>
							<td>{{$pod['kapacitet']}}</td>
							<td>{{$pod['vrsta_smestaja']}}</td>
							<td>{{$pod['cena_osoba']}}</td>
							<td>{{$pod['od']}}</td>
							
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