@extends('moderacija.master-moderator')

@section('content')
<div class="row">
    <div class="col-md-12">

	    {!! Form::open(['url'=>'/moderator/podesavanja','id'=>'forma','class'=>'form-horizontal']) !!}

	    <div  class="form-group has-feedback">
	        {!! Form::label('nalog', 'Izaberite nalog:',['class'=>'control-label col-sm-3']) !!}
	        <div class="col-sm-9">
	            {!!Form::select('nalog' ,$nalozi,  ['class'=>'form-control'])!!}
	        </div>
	    </div>


	    <div id="izbor_teme" class="form-group has-feedback">
	        {!! Form::label('tema', 'Izaberite temu:',['class'=>'control-label col-sm-3']) !!}
	        <div class="col-sm-9">
	            {!!Form::select('tema' ,$tema_id, ['class'=>'form-control'])!!}
	        </div>
	    </div>
	   	<div id="saradnja" class="form-group has-feedback">
	        {!! Form::label('saradnja', 'Spreman za saradnju:',['class'=>'control-label col-sm-3']) !!}
	        <div class="col-sm-9">
	            {!!Form::select('saradnja', ['0'=>'Ne','1'=>'Da'], ['class'=>'form-control'])!!}
	        </div>
	    </div>
	    
	    <div class="form-group">
		    <div class="col-sm-3"></div>
		    <div class="col-sm-9">
		        {!! Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Sačuvaj', ['class'=>'btn btn-lg btn-primary','type'=>'submit']) !!}
		        
		    </div>
		</div>
	    {!! Form::close() !!}

	</div>
</div>
<div class="row">

	    <h3>Uvoz tekstova</h3>

	    {!! Form::open(['url'=>'#','id'=>'forma','class'=>'form-horizontal']) !!}
			    <div id="izbor_teme" class="form-group has-feedback">
			        {!! Form::label('tema', 'Izaberite temu:',['class'=>'control-label col-sm-3']) !!}
			        <div class="col-sm-9">
			            {!!Form::select('tema' ,$tema_id, ['class'=>'form-control'])!!}
			        </div>
			    </div>
			    <div id="izbor_teme" class="form-group has-feedback">
			        {!! Form::label('tema', 'Izaberite temu:',['class'=>'control-label col-sm-3']) !!}
			        <div class="col-sm-9">
			            {!!Form::select('tema' ,$tema_id, ['class'=>'form-control'])!!}
			        </div>
			    </div>
			    <div class="col-sm-3">
			    <div class="form-group">
				    
				    <div class="col-sm-9">
				        {!! Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Sačuvaj', ['class'=>'btn btn-lg btn-primary','type'=>'submit']) !!}
				        
				    </div>
				    </div>
				</div>
	    {!! Form::close() !!}
</div>
@endsection