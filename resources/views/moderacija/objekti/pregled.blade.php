@extends('moderacija.master-moderator')

@section('content')
@if($objekti)
<div class="panel panel-primary clearfix">
	<div  class="panel-heading">Pregled objekata</div>
	    <div class="panel-body">
	    @foreach($objekti as $obj)
	    		<div class=" well well-sm">
			      	<div id="sort" class="row">
						<div style="padding-top:0px;" class="col-xs-4">
                    		<img  src="http://images.prd.mris.com/image/V2/1/Yu59d899Ocpyr_RnF0-8qNJX1oYibjwp9TiLy-bZvU9vRJ2iC1zSQgFwW-fTCs6tVkKrj99s7FFm5Ygwl88xIA.jpg" alt="" class="img-rounded img-responsive" />
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
						<div  class="col-xs-4">
							<i class="icon-th-large-outline"></i> Opis: {{$obj['opis']}}
							<br/><br/>
							<a href="{!!url('/moderator/izmeni-objekat/'.$obj['id']) !!}" class="btn btn-lg btn-primary" >Ažuriranje</a>
						</div>  
					</div>
				</div>
			@endforeach

	    </div>
</div>

@else <h1 class="col-sm-12">Nema objekata u bazi podataka!</h1>
@endif


@endsection