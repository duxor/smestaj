@extends('moderacija.master')

@section('content')
@if($objekti)
<div class="col-sm-4">
	{!! Form::open(['url'=>'/moderacija/pregled-smestaja', 'name' => "forma"]) !!}
		{!! Form::select('nalog', array('-1' => 'Izaberite Aplikaciju ...') + $nalog, null, ['name' => 'nalog', 'class'=>'form-control', "onchange" => "document.forma.submit();"] )!!}
	{!! Form::close() !!}
</div>
</br></br>
<div id="dev-table1" class="container">
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
						<div id="vrti" style="display:none;"><center><i class='icon-spin4 animate-spin' style="font-size: 200%"></i></center></div>
						<div id="poruka" style="display:none"></div>
					<table class="table table-hover" id="dev-table">
						<thead>
							<tr>
								<th>Naziv objekta</th>
								<th>Naziv smestaja</th>
								<th> Vrsta smeštaja</th>
								<th>Naziv kapaciteta</th>
								<th>Broj osoba</th>
								<th></th><th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($objekti as $obj)
							<tr>
								<td>{{$obj['naziv_objekta']}}</td>
								<td><a href="/{{$obj['app']}}/{{$obj['slug']}}">{{$obj['naziv']}}</a></td>
								<td>{{$obj['naziv_smestaja']}}</td>
								<td>{{$obj['naziv_kapaciteta']}}</td>
								<td>{{$obj['broj_osoba']}}</td>
								<td>
									<div id="forma-{{$obj['id']}}" >
										{!!Form::hidden('id_objekta',$obj['id'])!!}
										{!!Form::hidden('_token',csrf_token())!!}
										<div class="status-smestaja btn btn-xs btn-primary" data-placement="top" data-toggle="tooltip" @if($obj['aktivan']==0) data-aktivan="false" title="Postavi smeštaj u stanje aktivan" @else data-aktivan="true" title="Postavi smeštaj u stanje neaktivan" @endif href="#" onclick='Komunikacija.posalji("/moderacija/smestaj-status","forma-{{$obj['id']}}","poruka","vrti","zabrani")'>
										<span @if($obj['aktivan']==0) class="glyphicon glyphicon-remove" @else class="glyphicon glyphicon-ok" @endif></span>
										</div>
									</div>
									<script>
										$('.status-smestaja').css('cursor','pointer');
										$('.status-smestaja').click(function(){
											$(this).attr('title','Postavi smeštaj u stanje '+($(this).data('aktivan')?'aktivan':'neaktivan'));
											$(this).children('span').toggleClass('glyphicon glyphicon-remove').toggleClass('glyphicon glyphicon-ok');
											$(this).data('aktivan',$(this).data('aktivan')?'false':'true');
										});
									</script>
								</td><td>
									<p data-placement="top" data-toggle="tooltip" title="Ažuriraj"><a href="{!!url('/moderacija/izmeni-smestaj/'.$obj['id']) !!}" class="btn btn-xs btn-primary" ><span class="glyphicon glyphicon-pencil"></span></a></p>
								</td>
							</tr>
							@endforeach

						</tbody>
					</table>
					{{--<button onclick="myFunction()">PDf</button>
				
						<script>
							function myFunction() {
							    $('#dev-table').tableExport({htmlContent:'false',type:'pdf',escape:'false'});
							}
						</script>--}}

				</div>
			</div>
		</div>
	</div>
@else <h1 class="col-sm-12">Nije dodata ni jedna smeštajna jedinica!</h1>
@endif


@endsection