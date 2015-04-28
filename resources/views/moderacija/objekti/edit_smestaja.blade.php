@extends('moderacija.master-moderator')

@section('content')
<div class="panel panel-primary clearfix">
	<div  class="panel-heading">Izmena smeštaja</div>
	    <div class="panel-body">
			      	<div id="sort" class="row">
					      	@if(!isset($objekti))
						        {{$objekti=null}}
						        <h1 class="col-sm-10">Greška</h1>
						    @else  
							@if (Session::get('message'))
							    <div class="alert alert-success alert-dismissable">
							        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							        {{ Session::get('message')}}
							    </div>
							@endif
						    {!!Form::open(['url'=>'/moderator/izmeni-smestaj','class'=>'form-horizontal'])!!}
						    {!!Form::hidden('id',$objekti['id'])!!}
						   
						    <div id="nazivobjekta" class="form-group has-feedback">
						        {!!Form::label('lnazivobjekta','Naziv objekta',['class'=>'control-label col-sm-2'])!!}
						        <div class="col-sm-10">
						            {!!Form::text('nazivobjekta',$objekti['naziv'],['class'=>'form-control','placeholder'=>'Naziv objekta','id'=>'nazivobjekta','disabled'=>'disabled'])!!}
						            <span id="snazivobjekta" class="glyphicon form-control-feedback"></span>
						        </div>
						    </div>
						     <div class="form-group">
								{!! Form::label('vrstasmestaja','Vrsta Smeštaja',['class'=>'control-label col-sm-2']) !!}
								<div class="col-sm-10">
									{!!Form::select('vrstasmestaja',$vrstasmestaja, $objekti['id_smestaja'], ['class'=>'form-control'])!!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('kapacitet','Naziv Kapaciteta',['class'=>'control-label col-sm-2']) !!}
								<div class="col-sm-3">
									{!!Form::select('kapacitet',$kapacitet, $objekti['id_kapaciteta'],['class'=>'form-control'])!!}
								</div>
							</div>
					        <div class="form-group">
						        <div class="col-sm-2"></div>
						        <div class="col-sm-10">
						            {!!Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Sačuvaj izmene', ['class'=>'btn btn-lg btn-primary','type'=>'submit'])!!}
						        </div>
						    </div>
						    {!!Form::close()!!}
						     @endif


									
 
					</div>

	    </div>
</div>
@endsection