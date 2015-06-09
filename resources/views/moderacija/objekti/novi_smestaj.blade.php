@extends('moderacija.master')

@section('content')
@if(session()->has('greska'))
        <div class="alert alert-danger" role="alert">
            <p>Dogodila se greška: <br>
            <ol>
                @foreach(session('greska') as $greske)
                    @foreach($greske as $greska)
                        <li>{{$greska}}</li>
                    @endforeach
                @endforeach
            </ol>
            </p>
        </div>
    @endif
    @if(session()->has('potvrda'))
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         {{session('potvrda')}}
    </div>

    @endif
<div class="panel panel-primary clearfix">
	<div  class="panel-heading">Dodavanje novog smeštaja</div>
	    <div class="panel-body">
	      	<div id="sort" class="col-sm-5">
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
				    {!!Form::open(['id'=>'forma','url'=>'/moderacija/novi-smestaj','class'=>'form-horizontal','enctype' => 'multipart/form-data'])!!}
					   
					    <div class="form-group">
							{!! Form::label('nazivobjekta','Dodavanje smeštaja u objekat:',['class'=>'control-label col-sm-7']) !!}
							<div class="col-sm-5">
								{!!Form::select('nazivobjekta', $objekti, null, ['class'=>'form-control'])!!}
							</div>
						</div>
						<div class="form-group">
							{!! Form::label('kapacitet','Naziv Kapaciteta',['class'=>'control-label col-sm-7']) !!}
							<div class="col-sm-5">
								{!!Form::select('kapacitet',$kapacitet,null, ['class'=>'form-control'])!!}
							</div>
						</div>
						<div class="form-group">
							{!! Form::label('vrstasmestaja','Vrsta Smeštaja',['class'=>'control-label col-sm-7']) !!}
							<div class="col-sm-5">
								{!!Form::select('vrstasmestaja',$vrstasmestaja,null, ['class'=>'form-control'])!!}
							</div>
						</div>
						<div id="dsmestaj" class="form-group has-feedback">
							{!!Form::label('lsmestaj','Naziv smeštaja',['class'=>'control-label col-sm-7'])!!}
							<div class="col-sm-5">
								{!!Form::text('smestaj',null,['id'=>'smestaj','class'=>'form-control','placeholder'=>'Unesite naziv smeštaja...'])!!}
								<span id="ssmestaj" class="glyphicon form-control-feedback"></span>
							</div>
						</div>
						<div id="dslug" class="form-group has-feedback">
							{!!Form::label('lslug','Slug',['class'=>'control-label col-sm-7'])!!}
							<div class="col-sm-5">
								{!!Form::text('slug',null,['id'=>'slug','class'=>'form-control','placeholder'=>'Unesite slug...'])!!}
								<span id="sslug" class="glyphicon form-control-feedback"></span>
							</div>
						</div>
						<div class="form-group">
					        {!!Form::label('cena','Cena',['class'=>'control-label col-sm-7'])!!}
					        <div class="col-sm-5">
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
				    
			</div>
			<div class="col-sm-4">
				<div class="well" style="max-height: 300px;overflow: auto;">
					<h4>Izaberite dodatnu opremu:</h4>
					@foreach($dodatna_oprema as $dodatna)
					<div class="col-sm-12">
						<input type="checkbox"  name="oprema_filter" value="0" class="my-checkbox" data-size="normal" data-on-text="Da" data-off-text="Ne" data-label-text="{{$dodatna['naziv']}}">
		            </div>
		            @endforeach
		            <script>$(".my-checkbox").bootstrapSwitch();
		            $('input[name="oprema_filter"]').on('switchChange.bootstrapSwitch', function(event, state) {
					     $(this).val(state?1:0);
					});</script>
	        	</div>
	            
			</div>{!!Form::close()!!}
				     @endif			
			<div class="col-sm-3">
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