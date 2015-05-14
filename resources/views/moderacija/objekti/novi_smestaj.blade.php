@extends('moderacija.master')

@section('content')
<div class="panel panel-primary clearfix">
	<div  class="panel-heading">Dodavanje novog smeštaja</div>
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
				    {!!Form::open(['url'=>'/moderator/novi-smestaj','class'=>'form-horizontal'])!!}
					   
					    <div class="form-group">
							{!! Form::label('nazivobjekta','Dodavanje smeštaja u objekat:',['class'=>'control-label col-sm-4']) !!}
							<div class="col-sm-4">
								{!!Form::select('nazivobjekta', $objekti, null, ['class'=>'form-control'])!!}
							</div>
						</div>
						<div class="form-group">
							{!! Form::label('kapacitet','Naziv Kapaciteta',['class'=>'control-label col-sm-4']) !!}
							<div class="col-sm-4">
								{!!Form::select('kapacitet',$kapacitet,null, ['class'=>'form-control'])!!}
							</div>
						</div>
						<div class="form-group">
							{!! Form::label('vrstasmestaja','Vrsta Smeštaja',['class'=>'control-label col-sm-4']) !!}
							<div class="col-sm-4">
								{!!Form::select('vrstasmestaja',$vrstasmestaja,null, ['class'=>'form-control'])!!}
							</div>
						</div>
						<div class="form-group">
					        {!!Form::label('cena','Cena',['class'=>'control-label col-sm-4'])!!}
					        <div class="col-sm-4">
					            {!!Form::text('cena',null,['class'=>'form-control','placeholder'=>'Unesite cenu...'])!!}
					        </div>
					    </div>

					<div class="form-group">
				        <div class="col-sm-2"></div>
				        <div class="col-sm-10">
				            {!!Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Dodaj smeštaj', ['class'=>'btn btn-lg btn-primary','type'=>'submit'])!!}
				        </div>
				    </div>

				    {!!Form::close()!!}
				     @endif
			</div>
	    </div>
</div>
@endsection