@extends('korisnik.master')
@section('content')

@if($rezervacije)
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Lista aktivnih rezervacija!</h3>
				</div>
				<div class="panel-body">
					@if (Session::get('message'))
							    <div class="alert alert-success alert-dismissable">
							        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							        @foreach(Session::get('message') as $mess)
							        	{{$mess}}</br>
							        @endforeach
							    </div>
					@endif
					<div class="table-responsive">
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
								<th></th><th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($rezervacije as $rez)
								<tr>
									{!!Form::open(['url'=>'/rezervacije/izmeni-rezervaciju','class'=>'form-horizontal'])!!}
									{!!Form::hidden('smestaj_id',$rez['smestaj_id'])!!}
									<td>
										<div class="form-group" id="datarange">
		                                        <div class="input-daterange input-group" id="datepicker">
		                                            {!! Form::text('datumOd',$rez['od'], null, ['class'=>'input-sm form-control','placeholder'=>'od...']) !!}
		                                        </div>
		                                </div>
									</td>
									<td>
										<div class="form-group" id="datarange">
	                                        <div class="input-daterange input-group" id="datepicker">
	                                            {!! Form::text('datumDo',$rez['do'], null, ['class'=>'input-sm form-control','placeholder'=>'do...']) !!}
	                                        </div>
	                                	</div>
									</td>
										
									<td>{{$rez['naziv']}}</td>
									<td>{{$rez['naziv_kapaciteta']}}</td>
									<td>{{$rez['vrsta_smestaja_naziv']}}</td>
									<td>
										
									            {!!Form::text('broj_osoba',$rez['broj_osoba'],null,['class'=>'form-control'])!!}
									        
									    
									</td>
									<td style="font-size:12px;">{{$rez['napomena']}}</td>
									<td>
									<div class="form-group">
					    				{!!Form::hidden('rezervacija',$rez['id'])!!}
										<p data-placement="top" data-toggle="tooltip" title="Sačuvaj izmene"><button  class="btn btn-xs btn-success" type="submit" ><span class="glyphicon glyphicon-floppy-disk"></span></button></p>
										{!!Form::close()!!}
									</div>
									</td>
									<td>
									<div class="form-group">
										{!!Form::open(['url'=>'/rezervacije/otkazi-rezervaciju','class'=>'form-horizontal'])!!}
					    					{!!Form::hidden('rezervacija',$rez['id'])!!}
											<p data-placement="top" data-toggle="tooltip" title="Otkaži rezervaciju"><button  class="btn btn-xs btn-danger" type="submit"><span class="glyphicon glyphicon-remove"></span></button></p>
										{!!Form::close()!!}
									</div>
									</td>
								</tr>
							@endforeach

						</tbody>
						</table>
						<script>
	                        $('#datarange .input-daterange').datepicker({
	                            orientation: "top auto",
	                            weekStart: 1,
	                            startDate: "current",
	                            todayBtn: "linked",
	                            toggleActive: true,
	                            format: "yyyy-mm-dd"
	                        });
	                    </script>
	                </div>
				</div>
			</div>
		</div>
	</div>
</div>
@else <h1 class="col-sm-12">Nema aktivnih rezervacija!</h1>
@endif

@endsection