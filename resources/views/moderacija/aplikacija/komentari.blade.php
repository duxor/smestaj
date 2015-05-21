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
										<tr id="forma-{{$kom['id']}}">
												<td style="text-align: center">{!!Form::hidden('id_komentara',$kom['id'])!!}{!!Form::hidden('_token',csrf_token())!!}<i @if($kom['aktivan']==1) class="glyphicon glyphicon-ok" @else class="glyphicon glyphicon-remove" @endif ></i></td>
												<td>{{$kom['username']}}</td>
												<td>{{$kom['slug']}}</td>
												<td>{{$kom['komentar']}}</td>
												<td>Smeštaj</td>
												<td></td>
												<td><p data-placement="top" data-toggle="tooltip" title="Ukloni komentar">{!! Form::button('<span class="glyphicon glyphicon-remove"></span>',['class'=>'btn btn-xs btn-danger zabrani','onclick'=>'Komunikacija.posalji("/moderacija/zabrani",\'forma-'.$kom['id'].'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}</p></td>
												<td><p data-placement="top" data-toggle="tooltip" title="Odobri komentar">{!! Form::button('<span class="glyphicon glyphicon-ok"></span>',['class'=>'btn btn-xs btn-success odobri','onclick'=>'Komunikacija.posalji("/moderacija/odobri",\'forma-'.$kom['id'].'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}</p></td>
												<td><p data-placement="top" data-toggle="tooltip" title="Odgovori na komentar"><button  class="btn btn-xs btn-info" data-toggle="modal" data-target="#odgovor{{$kom['id']}}"><span class="glyphicon glyphicon-envelope"></span></button></p></td>
										</tr>
										<div class="modal fade" id="odgovor{{$kom['id']}}" tabindex="-1" role="dialog">
									        <div class="modal-dialog">
									            <div class="modal-content">
									                <div class="modal-header">
									                    <button type="button" class="close" data-komentar="{{$kom['komentar']}}" data-dismiss="modal" aria-hidden="true">&times;</button>
									                    <h2>Odgovor na komentar</h2>
									                </div>
									                <div class="modal-body">
										                <div class="container-fluid">
										                    {!!Form::open(['url'=>'/moderacija/odgovor','class'=>'form-horizontal'])!!}
															{!!Form::hidden('id',$kom['id'])!!}
															{!!Form::hidden('smestaj_id',$kom['id_smestaja'])!!}

										                    {!! Form::label('utisci',$kom['komentar'],['class'=>'control-label col-sm-4']) !!}
										                    {!! Form::textarea('odgovor', null, ['class'=>'form-control', 'placeholder'=>'Odgovor...']) !!}      
										                </div>
									                </div>
									                <div class="modal-footer">
									                	{!! Form::button('<span class="glyphicon glyphicon-remove"></span> Otkaži', ['class'=>'btn btn-lg btn-primary',' data-dismiss'=>'modal']) !!}
									                    {!! Form::button('<span class="glyphicon glyphicon-ok"></span> Odgovori', ['class'=>'btn btn-lg btn-primary','type'=>'submit']) !!}
									                    {!! Form::close() !!}
									                </div>
									            </div>
									        </div>
									    </div>
									@endforeach
									<script>
										$('.odobri,.zabrani').click(function(){$('#'+$(this).closest('tr').attr('id')).fadeOut()});
									</script>
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