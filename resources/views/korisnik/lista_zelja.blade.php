@extends('korisnik.master')
@section('content')
	@if($lista_zelja)
	<div class="container">
    	<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Llista želja</h3>
					</div>
					
					<table class="table table-hover" id="dev-table">
						<thead>
							<tr>
								<th>Naziv objekta</th>
								<th> Vrsta smeštaja</th>
								<th>Naziv kapaciteta</th>
								<th>Broj osoba</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($lista_zelja as $lista)
							<tr>
								<td>{{$lista['naziv_objekta']}}</td>
								<td>{{$lista['naziv_smestaja']}}</td>
								<td>{{$lista['naziv_kapaciteta']}}</td>
								<td>{{$lista['broj_osoba']}}</td>
								<td><p data-placement="top" data-toggle="tooltip" title="Ukloni iz liste"><a href="{!!url('/aplikacija/ukloni-lista-zelja/'.$lista['id']) !!}" class="btn btn-xs btn-primary" ><span class="glyphicon glyphicon-remove"></span></a></p></td>
							</tr>
							@endforeach

						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>

	@endif
@endsection