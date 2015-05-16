@extends('moderacija.master')
@section('content')

@if($rezervacije)
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info">
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
								<th></th>
								<th></th>
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
								<td style="font-size:12px;">{{$rez['napomena']}}</td>
								<th>
									
								</th>
								<th>
									<p data-placement="top" data-toggle="tooltip" title="Odjavi korisnika"><button  class="btn btn-xs btn-danger" data-toggle="modal" data-target="#odjavakorisnika{{$rez['id']}}"><span class="glyphicon glyphicon-remove"></span></button></p>
								</th>
							</tr>
								<div class="modal fade" id="odjavakorisnika{{$rez['id']}}" tabindex="-1" role="dialog">
							        <div class="modal-dialog">
							            <div class="modal-content">
							                <div class="modal-header">
							                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							                    <h2>Odjava korisnika</h2>
							                </div>
							                <div class="modal-body">
								                <div class="container-fluid">
								                    {!!Form::open(['url'=>'/rezervacija/odjavi-korisnika','class'=>'form-horizontal'])!!}
													{!!Form::hidden('id',$rez['id'])!!}
													<div class="form-group has-feedback">
														{!! Form::label('unesiteocenu','Unesite ocenu',['class'=>'control-label col-sm-4']) !!}
														<input id="ratings-hidden" name="rating" value="3" type="hidden">
														<div class="col-sm-8">
															<div class="stars starrr" style="color:green;" data-rating="3"></div>
														</div>
													</div>
								                    <div class="form-group has-feedback">
								                        {!! Form::label('utisci','Utisci o korisniku',['class'=>'control-label col-sm-4']) !!}
								                        <div class="col-sm-8">
								                            {!! Form::textarea('utisci', null, ['class'=>'form-control', 'placeholder'=>'Utisci']) !!}      
								                        </div>
								                    </div>
								                </div>
							                </div>
							                <div class="modal-footer">
							                	{!! Form::button('<span class="glyphicon glyphicon-remove"></span> Otkaži odjavu', ['class'=>'btn btn-lg btn-primary',' data-dismiss'=>'modal']) !!}
							                    {!! Form::button('<span class="glyphicon glyphicon-ok"></span> Odjavi', ['class'=>'btn btn-lg btn-primary','type'=>'submit']) !!}
							                    {!! Form::close() !!}
							                </div>
							            </div>
							        </div>
							    </div>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
@else <h1 class="col-sm-12">Nema aktuelnih rezervacija!</h1>
@endif
   
@endsection