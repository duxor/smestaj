@extends('moderacija.master-moderator')

@section('content')
<div class="container">
    <div class="row">
      	<div class="col-md-5  toppad  pull-right col-md-offset-3 ">
      	<br>
      	</div>
      	<div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Podešavanje naloga:</h3> 
            </div>
            <div class="panel-body">
			    {!! Form::open(['url'=>'/moderator/podesavanja','id'=>'forma','class'=>'form-horizontal']) !!}
			    <div  class="form-group has-feedback">
			        {!! Form::label('nalog', 'Izaberite nalog:',['class'=>'control-label col-sm-3']) !!}
			        <div class="col-sm-3">
			            {!!Form::select('nalog' ,$nalozi, 'nalog', ['class'=>'form-control'])!!}
			        </div>
			    </div>
			    <div id="izbor_teme" class="form-group has-feedback">
			        {!! Form::label('tema', 'Izaberite temu:',['class'=>'control-label col-sm-3']) !!}
			        <div class="col-sm-3">
			            {!!Form::select('tema' ,$tema_id,$tema_id, ['class'=>'form-control'])!!}
			        </div>
			    </div>
			   	<div id="saradnja" class="form-group has-feedback">
			        {!! Form::label('saradnja', 'Spreman za saradnju:',['class'=>'control-label col-sm-3']) !!}
			        <div class="col-sm-3">
			            {!!Form::select('saradnja', ['0'=>'Ne','1'=>'Da'],'1', ['class'=>'form-control'])!!}
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

	</div>
</div>

<div class="container">
    <div class="row">
      	<div class="col-md-5  toppad  pull-right col-md-offset-3 ">
      	<br>
      	</div>
      	<div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Uvoz tekstova</h3> 
            </div>
            <div class="panel-body">
			    {!! Form::open(['url'=>'/moderator/prenos','id'=>'forma','class'=>'form-horizontal']) !!}
					    <div id="izbor_teme" class="form-group has-feedback">
					        {!! Form::label('tema', 'Izvorišna tema:',['class'=>'control-label col-sm-3']) !!}
					        <div class="col-sm-3">
					            {!!Form::select('izvorisnatema' ,$tema_id, 'izvorisnatema',['class'=>'form-control'])!!}
					        </div>
					    </div>
					    <div id="izbor_teme" class="form-group has-feedback">
					        {!! Form::label('tema', 'Odredišna tema:',['class'=>'control-label col-sm-3']) !!}
					        <div class="col-sm-3">
					            {!!Form::select('odredisnatema' ,$tema_id,'odredisnatema', ['class'=>'form-control'])!!}
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
	</div>
</div>
@endsection