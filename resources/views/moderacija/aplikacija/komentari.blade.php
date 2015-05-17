@extends('moderacija.master')
@section('content')	
@if($komentari)
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Lista komentara aktivnih i zabranjenih!</h3>
				</div>
				<div class="panel-body">
				<div id="vrti" style="display:none;"><center><i class='icon-spin4 animate-spin' style="font-size: 350%; left:50%;"></i></center></div>
					<div class="table-responsive">
						<table id="zabrani" class="table table-hover">
							<thead>
							<div id="poruka" style="display:none"></div>
								<tr>
									<th>Korisnik</th>
									<th>Smeštaj</th>
									<th>Komentar</th>
									<th>Status</th>
									<th></th>
									<th></th><th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($komentari as $kom)
								<tr>
									<div id="forma" class="form-horizontal">
									{!!Form::hidden('id_komentara',$kom['id'])!!}
									{!!Form::hidden('_token',csrf_token())!!}
										<th>{{$kom['username']}}</th>
										<th>{{$kom['slug']}}</th>
										<th>{{ $kom['komentar'] }}</th>
										<th>@if($kom['aktivan']==0) Zabranjen @else Odobren @endif</th>
										<th></th>
										<th><p data-placement="top" data-toggle="tooltip" title="Zabrani komentar">{!! Form::button('<span class="glyphicon glyphicon-remove"></span>',['class'=>'btn btn-xs btn-danger','onclick'=>'Komunikacija.posalji("/moderacija/zabrani/",\'forma\',\'poruka\',\'vrti\',\'zabrani\')']) !!}</p></th>
										<th><p data-placement="top" data-toggle="tooltip" title="Odobri komentar">{!! Form::button('<span class="glyphicon glyphicon-ok"></span>',['class'=>'btn btn-xs btn-success','onclick'=>'Komunikacija.posalji("/moderacija/odobri",\'forma\',\'poruka\',\'vrti\',\'zabrani\')']) !!}</p></th>
										<th><p data-placement="top" data-toggle="tooltip" title="Odgovori na poruku">{!! Form::button('<span class="glyphicon glyphicon-envelope"></span>',['class'=>'btn btn-xs btn-info','onclick'=>'Komunikacija.posalji("/moderacija/zabrani",\'forma\',\'poruka\',\'vrti\',\'zabrani\')']) !!}</p></th>
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
@endif


   
@endsection