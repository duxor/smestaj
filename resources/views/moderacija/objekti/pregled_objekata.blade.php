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
			<div  class="panel-heading">Pregled objekata</div><i class='icon-spin4 animate-spin' style="color: rgba(0,0,0,0)"></i>
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
										<div id="forma-{{$obj['id']}}" style="position: absolute;top: 10px;right:10px">
											{!!Form::hidden('id_objekta',$obj['id'])!!}
											{!!Form::hidden('_token',csrf_token())!!}
											<div class="status-objekta btn btn-xs btn-primary" data-placement="top" data-toggle="tooltip" @if($obj['aktivan']==0) data-aktivan="false" title="Postavi objekat u stanje aktivan" @else data-aktivan="true" title="Postavi objekat u stanje neaktivan" @endif href="#" onclick='Komunikacija.posalji("/moderacija/objekat-status","forma-{{$obj['id']}}","poruka","vrti","zabrani")'>
												<span @if($obj['aktivan']==0) class="glyphicon glyphicon-remove" @else class="glyphicon glyphicon-ok" @endif></span>
											</div>
											<script>
												$('.status-objekta').css('cursor','pointer');
												$('.status-objekta').click(function(){
													$(this).attr('title','Postavi objekat u stanje '+($(this).data('aktivan')?'aktivan':'neaktivan'));
													$(this).children('span').toggleClass('glyphicon glyphicon-remove').toggleClass('glyphicon glyphicon-ok');
													$(this).data('aktivan',$(this).data('aktivan')?'false':'true');
												});
											</script>
											<a href="{!!url('/moderacija/izmeni-objekat/'.$obj['id']) !!}" style="margin-left: 10px" class="btn btn-xs btn-primary" ><span class="glyphicon glyphicon-pencil"> </span></a>
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
