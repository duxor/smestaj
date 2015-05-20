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
			    <div class="panel-body">
			    @foreach($objekti as $obj)
			    		<div class=" well well-sm">
					      	<div id="sort" class="row">
								<div style="padding-top:0px;" class="col-xs-4">
		                    		<img  style="height: 150px;" src="/teme/osnovna-paralax/slike/15.jpg" alt="" class="img-rounded img-responsive" />
					    		</div>										
								<div  class="col-xs-4">
									<h5  style="margin-top:0px; margin-bottom:5px;" ><a href="" >{{$obj['naziv']}}</a></h5>
									<i class="glyphicon glyphicon-map-marker"></i>  {{$obj['grad']}}
									<br/>
									<i class="glyphicon glyphicon-map-marker"></i>  {{$obj['adresa']}}
									<br/>
								 	<i class="icon-building"></i> {{$obj['vrsta']}}
									<br/>
									<i class="glyphicon glyphicon-user"></i> {{$obj['nalog']}}
								</div>
								@if($obj['opis'])
								<div  class="col-xs-4">
									<i class="icon-th-large-outline"></i> Opis: {{$obj['opis']}}
									<br/><br/>
									<a href="{!!url('/moderacija/izmeni-objekat/'.$obj['id']) !!}" class="btn btn-lg btn-primary" ><span class="glyphicon glyphicon-pencil"> </span>  Ažuriranje</a>
								</div>
								@endif
							</div>
						</div>
					@endforeach
			    </div>
		</div>
@else <h1 class="col-sm-12">Nema objekata u bazi podataka!</h1>
@endif

@endsection