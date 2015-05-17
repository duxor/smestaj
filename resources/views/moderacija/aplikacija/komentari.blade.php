@extends('moderacija.master')
@section('content')
	@if($komentari)
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-info">
						<div class="panel-heading panel-body">
							Komentari
							<a href="/{{\App\OsnovneMetode::osnovniNav()}}/komentari/svi" class="btn btn-xs btn-default" style="position: absolute;top: 5px;right: 20px"><i class="glyphicon glyphicon-comment"></i></a>
							<br clear="all">
						</div>
						<div class="panel-body"><i class='icon-spin4 animate-spin' style="color: rgba(0,0,0,0)"></i>
							<div id="vrti" style="display:none;"><center><i class='icon-spin4 animate-spin' style="font-size: 350%"></i></center></div>
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
									<div id="poruka" style="display:none"></div>
									<tr>
										<th>Odobren</th>
										<th>Korisnik</th>
										<th>Smeštaj</th>
										<th>Komentar</th>
										<th>Smeštaj</th>
										<th>Status</th>
										<th></th>
										<th></th><th></th>
									</tr>
									</thead>
									<tbody>
									@foreach($komentari as $kom)
										<tr>
											<div id="forma-{{$kom['id']}}" class="form-horizontal">
												{!!Form::hidden('id_komentara',$kom['id'])!!}
												{!!Form::hidden('_token',csrf_token())!!}
												<td style="text-align: center"><i @if($kom['aktivan']==1) class="glyphicon glyphicon-ok" @else class="glyphicon glyphicon-remove" @endif ></i></td>
												<td>{{$kom['username']}}</td>
												<td>{{$kom['slug']}}</td>
												<td>{{$kom['komentar']}}</td>
												<td>Smeštaj</td>
												<td></td>
												<td><p data-placement="top" data-toggle="tooltip" title="Ukloni komentar">{!! Form::button('<span class="glyphicon glyphicon-remove"></span>',['class'=>'btn btn-xs btn-danger','onclick'=>'Komunikacija.posalji("/moderacija/zabrani",\'forma-'.$kom['id'].'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}</p></td>
												<td><p data-placement="top" data-toggle="tooltip" title="Odobri komentar">{!! Form::button('<span class="glyphicon glyphicon-ok"></span>',['class'=>'btn btn-xs btn-success','onclick'=>'Komunikacija.posalji("/moderacija/odobri",\'forma-'.$kom['id'].'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}</p></td>
												<td><a data-placement="top" data-toggle="tooltip" title="Odgovori na komentar" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-envelope"></span></a></td>
											</div>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@else
		<h2>Nije dodat ni jedan komentar.</h2>
	@endif

@endsection