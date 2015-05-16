@extends('moderacija.master')
@section('content')
    @if($podaci['galerije'])
        <div class="form-group col-sm-8">
            {!!Form::label('lgalerija','Galerija',['class'=>'control-label col-sm-3'])!!}
            <div class="col-sm-5">{!!Form::select('galerija',[],null,['class'=>'form-control'])!!}</div>
        </div>
    @else
        <p>Ne postoji ni jedna galerija.</p>
    @endif
@endsection