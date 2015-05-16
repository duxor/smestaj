@extends('moderacija.master')

@section('content')
<div class="col-sm-4">
	{!! Form::open(['url'=>'/moderacija/pregledobjekata', 'name'=>"forma",'method'=>'post']) !!}
		{!! Form::select('nalog', array('-1' => 'Izaberite Aplikaciju ...') + $nalog, null, array('name' => 'nalog', 'class'=>'form-control',"onchange" => "document.forma.submit();") )!!}
	{!! Form::close() !!}
</div>

@endsection