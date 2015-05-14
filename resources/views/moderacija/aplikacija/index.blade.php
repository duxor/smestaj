@extends('moderacija.master')
@section('content')
    <div class="col-sm-4">
        @if($podaci['aplikacije'])<h2>Aplikacije:</h2>@endif
        @foreach($podaci['aplikacije'] as $aplikacija)
            <p>{{$aplikacija['naziv']}} <a href="{!!url('/moderator/podesavanja/'.$aplikacija['slug'])!!}" target="_blank" class="btn btn-info glyphicon glyphicon-pencil"></a> <a href="/{{$aplikacija['slug']}}" target="_blank" class="btn btn-default glyphicon glyphicon-eye-open"></a></p>
        @endforeach
    </div>
@endsection