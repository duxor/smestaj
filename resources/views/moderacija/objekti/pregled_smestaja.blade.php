@extends('moderacija.master-moderator')

@section('content')
@if($objekti)
<div class="col-sm-4">
	{!! Form::open(['url'=>'/moderator/pregled-smestaja', 'name' => "forma"]) !!}
		{!! Form::select('nalog', array('-1' => 'Izaberite Aplikaciju ...') + $nalog, null, ['name' => 'nalog', 'class'=>'form-control', "onchange" => "document.forma.submit();"] )!!}
	{!! Form::close() !!}
</div>
</br></br>
<div class="container">
    	<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Pregled smeštaja</h3>
						<div class="pull-right">
							<span class="clickable filter" data-toggle="tooltip" title="Filter" data-container="body">
								<i class="glyphicon glyphicon-filter"></i>
							</span>
						</div>
					</div>
					<div class="panel-body" id="sdf">
						<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Unesite naziv, vrstu smestaja, kapacitet ili broj osoba!" />
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
						@foreach($objekti as $obj)
							<tr>
								<td>{{$obj['naziv_objekta']}}</td>
								<td>{{$obj['naziv_smestaja']}}</td>
								<td>{{$obj['naziv_kapaciteta']}}</td>
								<td>{{$obj['broj_osoba']}}</td>
								<td><p data-placement="top" data-toggle="tooltip" title="Ažuriraj"><a href="{!!url('/moderator/izmeni-smestaj/'.$obj['id']) !!}" class="btn btn-xs btn-primary" ><span class="glyphicon glyphicon-pencil"></span></a></p></td>
							</tr>
							@endforeach

						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
@else <h1 class="col-sm-12">Nema objekata u bazi podataka!</h1>
@endif


@endsection