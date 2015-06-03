@extends('moderacija.master')

@section('content')
<div class="panel panel-primary clearfix">
	<div  class="panel-heading">Izmena objekta</div>
	    <div class="panel-body">
			<div id="sort" class="row">
				<div class="col-md-8">
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
				    {!!Form::open(['url'=>'/moderator/izmeni-objekat','class'=>'form-horizontal'])!!}
				    {!!Form::hidden('id',$objekti['id'])!!}
				   
				    <div id="nazivobjekta" class="form-group has-feedback">
				        {!!Form::label('lnazivobjekta','Naziv objekta',['class'=>'control-label col-sm-2'])!!}
				        <div class="col-sm-10">
				            {!!Form::text('nazivobjekta',$objekti['ime'],['class'=>'form-control','placeholder'=>'Naziv objekta','id'=>'nazivobjekta'])!!}
				            <span id="snazivobjekta" class="glyphicon form-control-feedback"></span>
				        </div>
				    </div>

				    <div class="form-group">
						{!! Form::label('vrstaobjekta','Vrsta objekta',['class'=>'control-label col-sm-2']) !!}
						<div class="col-sm-10">
							{!!Form::select('vrstaobjekta',$vrstaobjekta,$objekti['vrsta_objekta_id'], ['class'=>'form-control'])!!}
						</div>
					</div>

				    <div id="opisobjekta" class="form-group has-feedback">
				        {!!Form::label('lopisobjekta','Opis objekta',['class'=>'control-label col-sm-2'])!!}
				        <div class="col-sm-10">
				            {!!Form::textarea('opisobjekta',$objekti['opis_objekta'],['class'=>'form-control','placeholder'=>'Opis objekta','id'=>'opisobjekta'])!!}
				            <span id="sopisobjekta" class="glyphicon form-control-feedback"></span>
				        </div>
				    </div>
				    <div id="koordinate" class="form-group has-feedback">
				        {!!Form::label('koordinate','Koordinate',['class'=>'control-label col-sm-2'])!!}
				        <div class="col-sm-3">
				            {!!Form::text('x',$objekti['x'],['class'=>'form-control','placeholder'=>'x','id'=>'x'])!!}
				            <span id="sx" class="glyphicon form-control-feedback"></span>
				        </div>
				        <div class="col-sm-3">
				            {!!Form::text('y',$objekti['y'],['class'=>'form-control','placeholder'=>'y','id'=>'y'])!!}
				            <span id="sy" class="glyphicon form-control-feedback"></span>
				        </div>
				        <div class="col-sm-3">
				            {!!Form::text('z',$objekti['z'],['class'=>'form-control','placeholder'=>'z','id'=>'z'])!!}
				            <span id="sz" class="glyphicon form-control-feedback"></span>
				        </div>
				    </div>
				    <div id="adresa" class="form-group has-feedback">
				        {!!Form::label('lopisobjekta','Grad',['class'=>'control-label col-sm-2'])!!}
				        <div class="col-sm-3">
				            {!!Form::select('grad',$grad, $objekti['grad_id'],['class'=>'form-control'])!!}
				        </div>
				   			{!!Form::label('ladresa','Adresa',['class'=>'control-label col-sm-2'])!!}
				        <div class="col-sm-3">
				            {!!Form::text('adresa',$objekti['adresa'],['class'=>'form-control','placeholder'=>'Adresa','id'=>'adesa'])!!}
				            <span id="sadesa" class="glyphicon form-control-feedback"></span>
				        </div>
				    </div>
				    <div class="form-group">
						{!! Form::label('nalog','Aplikacija',['class'=>'control-label col-sm-2']) !!}
						<div class="col-sm-10">
							{!!Form::select('nalog',$nalog,$objekti['nalog_id'],['class'=>'form-control'])!!}
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
 				<div class="gllpLatlonPicker col-md-4" id="mapPick">
				<h4>Pomerite marker, ili kliknite na mapu.</h4>
				<div class="row">
					<div class="col-sm-8">
					{!!Form::text('adresa',null,['class'=>'form-control gllpSearchField','placeholder'=>'Unesite adresu, mesto'])!!}
					</div>
					<div class="col-sm-4">
					{!!Form::button('<span class="glyphicon glyphicon-zoom-in"></span> Pretraži', ['class'=>'btn btn-sm btn-success gllpSearchButton','value'=>'search','type'=>'submit'])!!}
					</div>
				</div><br/>
				<div class="gllpMap">Google Maps</div>
				<input id="lat"  type="hidden" class="gllpLatitude" value="43.83452678223684"/>
				<input id="lon" type="hidden" class="gllpLongitude" value="20.478515625"/>
				<input id="zoom" type="hidden" class="gllpZoom" value="7"/>
			</div>
			</div>

	    </div>
</div>
@endsection