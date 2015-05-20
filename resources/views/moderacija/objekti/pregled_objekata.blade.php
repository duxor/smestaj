@extends('moderacija.master')

@section('content')
@if($objekti)
<div class="col-sm-4">
	{!! Form::open(['url'=>'/moderacija/pregledobjekata', 'name' => "forma"]) !!}
		{!! Form::select('nalog', array('-1' => 'Izaberite Aplikaciju ...') + $nalog, null, array('name' => 'nalog','class'=>'form-control', "onchange" => "document.forma.submit();") )!!}
	{!! Form::close() !!}
</div>
	</br>	</br>
		<div id="forma" class="panel panel-primary clearfix">
			<div  class="panel-heading">Pregled objekata</div>
			<div id="vrti" style="display:none;"><center><i class='icon-spin4 animate-spin' style="font-size: 350%"></i></center></div>
			<div id="poruka" style="display:none"></div>
			    <div class="panel-body">
			    @foreach($objekti as $obj)
			    		<div class=" well well-sm">
					      	<div id="sort" class="row">
								<div style="padding-top:0px;" class="col-md-4">
		                    		<img  style="height: 150px;" src="/teme/osnovna-paralax/slike/15.jpg" alt="" class="img-rounded img-responsive" />
					    		</div>										
								<div  class="col-md-4">
									<h3  style="margin-top:0px; margin-bottom:5px;" >{{$obj['naziv']}}</h3>
									<i class="glyphicon glyphicon-map-marker"></i>  {{$obj['grad']}}
									<br/>
									<i class="glyphicon glyphicon-map-marker"></i>  {{$obj['adresa']}}
									<br/>
								 	<i class="glyphicon glyphicon-bed"></i>  {{$obj['vrsta']}}
									<br/>
									<i class="glyphicon glyphicon-user"></i> {{$obj['nalog']}}
								</div>
								
								<div  class="col-md-4">
									
										@if($obj['opis'])
											<i class="icon-th-large-outline"></i> Opis: {{$obj['opis']}}
											<br/><br/>
										@endif
										<div class="row">
											<div class="col-md-8">
												<a href="{!!url('/moderacija/izmeni-objekat/'.$obj['id']) !!}" class="btn btn-lg btn-primary" ><span class="glyphicon glyphicon-pencil"> </span>  Ažuriranje</a>
											</div>
											<div class="col-md-3">
												<div id="forma-{{$obj['id']}}" class="form-horizontal">
													{!!Form::hidden('id_objekta',$obj['id'])!!}
													{!!Form::hidden('_token',csrf_token())!!}	
													@if($obj['aktivan']==0)<div data-placement="top" data-toggle="tooltip" title="Postavi objekat u stanje aktivan">{!! Form::button('<span class="glyphicon glyphicon-ok"></span>',['class'=>'btn btn-xs btn-danger','onclick'=>'Komunikacija.posalji("/moderacija/objekat-aktivan",\'forma-'.$obj['id'].'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}</div>
													@else <div data-placement="top" data-toggle="tooltip" title="Postavi objekat u stanje neaktivan">{!! Form::button('<span class="glyphicon glyphicon-remove"></span>',['class'=>'btn btn-xs btn-success','onclick'=>'Komunikacija.posalji("/moderacija/objekat-neaktivan",\'forma-'.$obj['id'].'\',\'poruka\',\'vrti\',\'zabrani\')']) !!}</div>
													@endif
												</div>
											</div>
										</div>
								</div>
							</div>
						</div>
					@endforeach
			    </div>
		</div>
@else <h1 class="col-md-12">Nema objekata u bazi podataka!</h1>
@endif

@endsection
