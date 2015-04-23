@extends('moderacija.master-moderator')
@section('content')
    <div class="col-sm-4">
        <h2>Aplikacije:</h2>
        @foreach($aplikacije as $aplikacija)
            <p>{{$aplikacija['naziv']}} <a href="{!!url('/moderator/podesavanja/'.$aplikacija['slug'])!!}" class="btn btn-info glyphicon glyphicon-pencil"></a> <a href="/{{$aplikacija['slug']}}" class="btn btn-default glyphicon glyphicon-eye-open"></a></p>
        @endforeach
    </div>
@endsection