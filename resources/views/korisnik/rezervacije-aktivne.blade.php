@extends('korisnik.master')
@section('content')

@if($rezervacije)
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Pregled aktivnih rezervacija</h3>
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
								<th></th><th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($rezervacije as $rez)
							<tr>
								<td>
									<div class="form-group" id="datarange">
	                                        <div class="input-daterange input-group col-sm-12" id="datepicker">
	                                            {!! Form::text('datumOd',$rez['od'], null, ['class'=>'input-sm form-control','placeholder'=>'od...']) !!}
	                                        </div>
	                                </div>
								</td>
								<td>
									<div class="form-group" id="datarange">
                                        <div class="input-daterange input-group col-sm-12" id="datepicker">
                                            {!! Form::text('datumDo',$rez['do'], null, ['class'=>'input-sm form-control','placeholder'=>'do...']) !!}
                                        </div>
                                	</div>
								</td>
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
								<td>{{$rez['naziv']}}
									
								</td>
								<td>
									<div class="form-group">
										<div class="col-sm-12">
											{!!Form::select('kapacitet',$nk, $rez['idkap'], ['class'=>'form-control'])!!}
										</div>
									</div>
								</td>
								<td>{{$rez['vrsta_smestaja_naziv']}}</td>
								<td>{{$rez['broj_osoba']}}</td>
								<td>{{$rez['napomena']}}</td>
								<td><p data-placement="top" data-toggle="tooltip" title="Ažuriraj"><a href="{!!url('/rezervacije/izmeni-rezervaciju/'.$rez['id']) !!}" class="btn btn-xs btn-primary" ><span class="glyphicon glyphicon-pencil"></span></a></p>
								</td>
								<td>
									{!!Form::open(['url'=>'/rezervacije/otkazi-rezervaciju','class'=>'form-horizontal'])!!}
				    					{!!Form::hidden('rezervacija',$rez['id'])!!}
										<p data-placement="top" data-toggle="tooltip" title="Otkaži rezervaciju"><button  class="btn btn-xs btn-primary" type="submit" ><span class="glyphicon glyphicon-remove"></span></button></p>
									{!!Form::close()!!}
								</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@else <h1 class="col-sm-12">Nema aktivnih rezervacija!</h1>
@endif

@endsection