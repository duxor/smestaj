@extends('moderacija.master')

@section('content')
<div class="panel panel-primary clearfix">
	<div  class="panel-heading">Unos novog objekta</div>
    <div class="panel-body">
      	<div id="sort" class="row">
      			@if (Session::get('message'))
				    <div class="alert alert-success alert-dismissable">
				        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				        {{ Session::get('message')}}
				    </div>
				@endif
			    {!!Form::open(['url'=>'/moderator/novi-objekat','class'=>'form-horizontal'])!!}
			    <div id="nazivobjekta" class="form-group has-feedback">
			        {!!Form::label('lnazivobjekta','Naziv objekta',['class'=>'control-label col-sm-2'])!!}
			        <div class="col-sm-10">
			            {!!Form::text('nazivobjekta','naziv objekta',['class'=>'form-control','placeholder'=>'Naziv objekta','id'=>'nazivobjekta'])!!}
			            <span id="snazivobjekta" class="glyphicon form-control-feedback"></span>
			        </div>
			    </div>
			    <div class="form-group">
					{!! Form::label('vrstaobjekta','Vrsta objekta',['class'=>'control-label col-sm-2']) !!}
					<div class="col-sm-10">
						{!!Form::select('vrstaobjekta',$vrstaobjekta,['class'=>'form-control'])!!}
					</div>
				</div>
			    <div id="opisobjekta" class="form-group has-feedback">
			        {!!Form::label('lopisobjekta','Opis objekta',['class'=>'control-label col-sm-2'])!!}
			        <div class="col-sm-10">
			            {!!Form::textarea('opisobjekta','opis objekta',['class'=>'form-control','placeholder'=>'Opis objekta','id'=>'opisobjekta'])!!}
			            <span id="sopisobjekta" class="glyphicon form-control-feedback"></span>
			        </div>
			    </div>
			    <div id="koordinate" class="form-group has-feedback">
			        {!!Form::label('koordinate','Koordinate',['class'=>'control-label col-sm-2'])!!}
			        <div class="col-sm-3">
			            {!!Form::text('x','x',['class'=>'form-control','placeholder'=>'x','id'=>'x'])!!}
			            <span id="sx" class="glyphicon form-control-feedback"></span>
			        </div>
			        <div class="col-sm-3">
			            {!!Form::text('y','y',['class'=>'form-control','placeholder'=>'y','id'=>'y'])!!}
			            <span id="sy" class="glyphicon form-control-feedback"></span>
			        </div>
			        <div class="col-sm-3">
			            {!!Form::text('z','z',['class'=>'form-control','placeholder'=>'z','id'=>'z'])!!}
			            <span id="sz" class="glyphicon form-control-feedback"></span>
			        </div>
			    </div>
			    <div id="adresa" class="form-group has-feedback">
			        {!!Form::label('lopisobjekta','Grad',['class'=>'control-label col-sm-2'])!!}
			        <div class="col-sm-3">
			            {!!Form::select('grad',$grad,['class'=>'form-control'])!!}
			        </div>
			   			{!!Form::label('ladresa','Adresa',['class'=>'control-label col-sm-2'])!!}
			        <div class="col-sm-3">
			            {!!Form::text('adresa','Unesite adresu',['class'=>'form-control','placeholder'=>'Adresa','id'=>'adesa'])!!}
			            <span id="sadesa" class="glyphicon form-control-feedback"></span>
			        </div>
			    </div>
			    <div class="form-group">
					{!! Form::label('nalog','Aplikacija',['class'=>'control-label col-sm-2']) !!}
					<div class="col-sm-10">
					@if ($nalog==null)<?php $nalog=['Nemate aktivnih aplikacija'] ?>  @endif
						{!!Form::select('nalog',$nalog,['class'=>'form-control'])!!}
					</div>
				</div>
		        <div class="form-group">
			        <div class="col-sm-2"></div>
			        <div class="col-sm-10">
			            {!!Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Sačuvaj', ['class'=>'btn btn-lg btn-primary','type'=>'submit'])!!}
			        </div>
			    </div>
			 {!!Form::close()!!}			
		</div>
    </div>
</div>
@endsection