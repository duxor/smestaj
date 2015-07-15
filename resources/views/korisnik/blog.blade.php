@extends('korisnik.blog_master')
@section('content')

    <!-- Page Content -->
    <div style="margin-top:70px;" class="container">

        <div class="row">
            <div class="col-md-8">
                <h1 class="page-header">
                    Blog
                    <small>NajSmeštaj-blog</small>
                </h1>
            @foreach($podaci as $pod)
                <!-- Blog Post -->
                <h2>
                    <a href="/blog/blog-post/{{$pod['id']}}">{{$pod['naslov']}}</a>
                </h2>
                <p class="lead">
                    Objavio: <a href="index.php">{{$pod['username']}}</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Objavljeno: {{$pod['created_at']}}</p>
                <hr>
                <img class="img-responsive" src="{{$pod['slika']}}" alt="">
                <hr>
                <p>{{substr($pod['tekst'],0,350)}}...</p>
                <a class="btn btn-primary" href="/blog/blog-post/{{$pod['id']}}">Više <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
            @endforeach
                {!!$podaci->render()!!}
            </div>
            <div class="col-md-4">
                <div class="well">
                    <h4>Pretraži blog</h4>
                    {!!Form::open(['class'=>'form-inline'])!!}
                        <div class="form-group">
                            {!!Form::text('pretraga',null,['id'=>'pretraga','class'=>'form-control','placeholder'=>'pretraga...'])!!}
                       </div>
                        <div class="form-group">
                            {!!Form::button('<span class="glyphicon glyphicon-search"></span>', ['id'=>'btn_search', 'class'=>'btn btn-default'])!!}
                        </div>
                    {!!Form::close()!!}
                <div id="rez"></div>    
                <div id="rezultat"></div>
                </div>
                
                <script>
                $('#btn_search').click(function(){
                     $("#rezultat").empty();
                     $("#rez").empty();
                    $.post('/blog/pretraga', { 
                        _token:'{{csrf_token()}}',
                        pretraga: $('#pretraga').val()
                    }, function(data){
                        var obj = JSON.parse(data);
                        $("#rez").append('<h5>Rezultat:</h5>');
                        $("#rezultat").empty();
                        for(var i=0; i<obj.length; i++){
                            var post = obj[i];  
                            $("#rezultat").append('<a href="/blog/blog-post/'+post.id+'">'+post.naslov+'</a> <br/>');
                        }            
                    });
                });
                </script>
                <div class="well" style="max-height: 300px;overflow: auto;">
                    <h4>Poslednje dodato</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="list-unstyled">
                                @foreach($posts as $pod)
                                    <div style="border: 1px solid #E7E7E7; height:50px;  text-decoration:none; ">
                                        <a style=" text-decoration:none;"  href="/blog/blog-post/{{$pod['id']}}">
                                            <li ><i data-toggle="tooltip" data-placement="top" title="{{date ('d.M.Y',strtotime($pod['created_at']))}}" style="font-weight:800;  color:red;">{{date ('H:i',strtotime($pod['created_at']))}} </i> {{$pod['naslov']}} <span class="glyphicon glyphicon-menu-right" ></span></li>
                                        </a>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                        
                    </div>
                    <script>
                        $(function () {
                          $('[data-toggle="tooltip"]').tooltip();
                        });
                    </script>
                </div>
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>
            </div>
        </div>
    </div>
@endsection