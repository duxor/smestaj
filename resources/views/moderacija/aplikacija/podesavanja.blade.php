@extends('moderacija.master')

@section('content')
	@if($podaci['aplikacije'])
	@foreach($podaci['aplikacije'] as $app)
      	<div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Podešavanje aplikacije <b>{{$app['naziv']}}</b>  <a href="/{{$app['slug']}}"> <i class="glyphicon glyphicon-eye-open"></i></a> </h3>
            </div>
            <div id="id{{$app['id']}}" class="panel-body">

					{!! Form::open(['url'=>'/moderacija/podesavanja','id'=>'forma','class'=>'form-horizontal']) !!}
					{!!Form::hidden('nalog_id',$app['id'])!!}
			<div class="row">
				<div class="col-md-6">	
					<div class="form-group">
						{!! Form::label('lnaziv','Naziv',['class'=>'control-label col-sm-3']) !!}
						<div class="col-sm-9">
							{!!Form::text('naziv',$app['naziv'],['class'=>'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('tema','Tema',['class'=>'control-label col-sm-3']) !!}
						<div class="col-sm-9">
							{!!Form::select('tema',$podaci['teme'],$app['tema_id'],['class'=>'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('saradnja','Saradnja',['class'=>'control-label col-sm-3']) !!}
						<div class="col-sm-9">
							{!!Form::select('saradnja',['0'=>'Ne','1'=>'Da'],$app['saradnja'],['class'=>'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							{!! Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Sačuvaj', ['class'=>'btn btn-lg btn-primary','type'=>'submit']) !!}
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-sm-1">
							<a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>  
						</div>
						<div class="col-sm-8">
							{!!Form::text('facebook',$app['facebook'],['class'=>'form-control','placeholder'=>'Unesite facebook nalog'])!!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-1">
							<a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>     
						</div>
						<div class="col-sm-8">
							{!!Form::text('twitter',$app['twitter'],['class'=>'form-control','placeholder'=>'Unesite twitter nalog'])!!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-1">
							<a class="btn btn-social-icon btn-google"><i class="fa fa-google"></i></a> 
						</div>
						<div class="col-sm-8">
							{!!Form::text('google',$app['google'],['class'=>'form-control','placeholder'=>'Unesite google nalog'])!!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-1">
							<a class="btn btn-social-icon btn-skype"><i class="fa fa-skype"></i></a>   
						</div>
						<div class="col-sm-8">
							{!!Form::text('skype',$app['skype'],['class'=>'form-control','placeholder'=>'Unesite skype nalog'])!!}
						</div>
					</div>
				</div>
			</div>


					{!! Form::close() !!}
					<hr>
					<p>Uvoz tekstova</p>
					{!! Form::open(['url'=>'/moderator/prenos','id'=>'forma','class'=>'form-horizontal']) !!}
					{!!Form::hidden('nalog_id',$app['id'])!!}
					<div class="form-group">
						{!!Form::label('ltema','Iz:',['class'=>'control-label col-sm-3'])!!}
						<div class="col-sm-3">
							{!!Form::select('temaiz',$app['teme'],null,['class'=>'form-control','id'=>'izteme'])!!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('tema','U:',['class'=>'control-label col-sm-3'])!!}
						<div class="col-sm-3">
							{!!Form::select('temau',array_slice($app['teme'],1),null,['class'=>'form-control','id'=>'utemu'])!!}
						</div>
					</div>
					<script>
						$("#id{{$app['id']}} select#izteme").change(function(){
							$("#id{{$app['id']}} select#utemu").html($("#id{{$app['id']}} select#izteme > option").clone(true));
							$("#id{{$app['id']}} select#utemu option[value='"+$("#id{{$app['id']}} select#izteme option:selected").val()+"']").remove();
						});
					</script>
					<div class="form-group">
						<div class="col-sm-3"></div>
						<div class="col-sm-9">
							{!!Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Uvezi', ['class'=>'btn btn-lg btn-primary','type'=>'submit'])!!}
						</div>
					</div>
					{!!Form::close()!!}
		    </div>
		</div>
	@endforeach
	@else
		<p>Nemate ni jednu aktivnu aplikaciju.</p>
	@endif
@endsection