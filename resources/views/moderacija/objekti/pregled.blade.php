@extends('moderacija.master-moderator')

@section('content')

{!! Form::open(['url'=>'/moderator/pregledobjekata', 'name' => "forma"]) !!}
	{!! Form::select('nalog', array('-1' => 'Izaberite nalog ...') + $nalog, null, array('name' => 'nalog', "onchange" => "document.forma.submit();") )!!}
{!! Form::close() !!}

@endsection