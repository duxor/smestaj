@extends('moderacija.master-moderator')

@section('content')
<div class="col-sm-4">
	{!! Form::open(['url'=>'/moderator/pregled-smestaja', 'name' => "forma"]) !!}
		{!! Form::select('nalog', array('-1' => 'Izaberite nalog ...') + $nalog, null, ['name' => 'nalog', 'class'=>'form-control',"onchange" => "document.forma.submit();"] )!!}
	{!! Form::close() !!}
</div>
@endsection