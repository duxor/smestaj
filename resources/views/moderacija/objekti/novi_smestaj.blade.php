@extends('moderacija.master')

@section('content')
<div class="panel panel-primary clearfix">
	<div  class="panel-heading">Dodavanje novog smeštaja</div>
	    <div class="panel-body">
	      	<div id="sort" class="col-sm-8">
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
				    {!!Form::open(['url'=>'/moderacija/novi-smestaj','class'=>'form-horizontal','enctype' => 'multipart/form-data'])!!}
					   
					    <div class="form-group">
							{!! Form::label('nazivobjekta','Dodavanje smeštaja u objekat:',['class'=>'control-label col-sm-5']) !!}
							<div class="col-sm-7">
								{!!Form::select('nazivobjekta', $objekti, null, ['class'=>'form-control'])!!}
							</div>
						</div>
						<div class="form-group">
							{!! Form::label('kapacitet','Naziv Kapaciteta',['class'=>'control-label col-sm-5']) !!}
							<div class="col-sm-7">
								{!!Form::select('kapacitet',$kapacitet,null, ['class'=>'form-control'])!!}
							</div>
						</div>
						<div class="form-group">
							{!! Form::label('vrstasmestaja','Vrsta Smeštaja',['class'=>'control-label col-sm-5']) !!}
							<div class="col-sm-7">
								{!!Form::select('vrstasmestaja',$vrstasmestaja,null, ['class'=>'form-control'])!!}
							</div>
						</div>
						<div class="form-group">
					        {!!Form::label('cena','Cena',['class'=>'control-label col-sm-5'])!!}
					        <div class="col-sm-7">
					            {!!Form::text('cena',null,['class'=>'form-control','placeholder'=>'Unesite cenu u dinarima...'])!!}
					        </div>
					    </div>

					<div class="form-group">
				        <div class="col-sm-5"></div>
				        <div class="col-sm-7">
				            {!!Form::button('<span class="glyphicon glyphicon-floppy-disk"></span> Dodaj smeštaj', ['class'=>'btn btn-lg btn-primary','type'=>'submit'])!!}
				        </div>
				    </div>
					<input id="fileSlika" name="naslovna_foto" type="file" style="display: none">
				    {!!Form::close()!!}
				     @endif
			</div>
			<div class="col-sm-4">
				<img id="slika" class="thumbnail" data-toggle="tooltip" data-placement="bottom" title="Izmenite fotografiju" style="width: 100%;cursor: pointer" src="/galerije/default-galerije/osnovne/smestaj-default.jpg">
				<script>
					$(function (){
						$('#slika').tooltip();
						$("input:file").change(function (){
							$("#slika").attr('src','');
							$("#slika").attr('alt','Izabrali ste fotografiju: '+$(this).val());
						});
					})
					$('#slika').click(function(){
						$('#fileSlika').click();
					});
				</script>
			</div>
	    </div>
</div>
@endsection