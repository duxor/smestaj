@extends('aplikacija.teme-osnove.osnovna.master')
@section('content')
    <button class="btn btn-lg btn-info" onclick="funkcija()" style="margin-top:100px">Test</button>
    <script>
        function funkcija(){
            $.post('/android',
                   {url:'/log/test/', mobile_token:'najsmestaj.com:android'},
                   function(data){
                        alert(data);
                    }
            );
        }
    </script>
@endsection