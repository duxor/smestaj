@extends('moderacija.master-moderator')

@section('content')
@if($objekti)
<div class="panel panel-primary clearfix">
	<div  class="panel-heading">Pregled smestaja</div>
	    <div class="panel-body">
	    @foreach($objekti as $obj)
	    		<div class=" well well-sm">
			      	<div id="sort" class="row">
						<div style="padding-top:0px;" class="col-xs-4">
                    		<img  src="http://images.prd.mris.com/image/V2/1/Yu59d899Ocpyr_RnF0-8qNJX1oYibjwp9TiLy-bZvU9vRJ2iC1zSQgFwW-fTCs6tVkKrj99s7FFm5Ygwl88xIA.jpg" alt="" class="img-rounded img-responsive" />
			    		</div>
									
						<div  class="col-xs-4">
							<h5  style="margin-top:0px; margin-bottom:5px;" ><a href="" >{{$obj['naziv_objekta']}}</a></h5>
							<i class="glyphicon glyphicon-map-marker"> </i>{{$obj['naziv_smestaja']}}
							<br/>
							<i class="glyphicon glyphicon-map-marker"></i>{{$obj['naziv_kapaciteta']}}
							<br/>
						 	<i class="glyphicon glyphicon glyphicon-phone"></i> {{$obj['broj_osoba']}}
							<br/>
							
						</div>
						<div  class="col-xs-4">
							
						</div>  
					</div>
				</div>
			@endforeach

	    </div>
</div>

@else <h1 class="col-sm-12">Nema objekata u bazi podataka!</h1>
@endif


@endsection