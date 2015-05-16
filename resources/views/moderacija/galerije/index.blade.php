@extends('moderacija.master')
@section('body')
    @if($podaci['galerije'])
        <div class="list-group col-sm-4">
            <p style="text-align: right"><button class="btn btn-info editMod" style="margin-right: 5px"><i class="glyphicon glyphicon-pencil"></i></button><button class="btn btn-success"><i class="glyphicon glyphicon-cloud-upload"></i></button></p>
            @foreach($podaci['galerije'] as $galerija)
                <a href="#" class="list-group-item" data-slugapp="{{$galerija['slugApp']}}" data-link="galerije/{{Session::get('username')}}/aplikacije/{{$galerija['slugApp']}}/{{$galerija['slugTeme']}}/{{$galerija['sadrzaj']}}">
                    <h2 style="text-align: center">{{$galerija['naziv']}}</h2>
                    <p class="list-group-item-text">
                        <dl class="dl-horizontal">
                            <dt>Aplikacija</dt>
                            <dd>{{$galerija['nazivApp']}}</dd>
                            <dt>Tema</dt>
                            <dd>{{$galerija['nazivTeme']}}</dd>
                        </dl>
                    </p>
                </a>
            @endforeach
        </div>
        <div class="col-sm-8">
            <div id="poruka" style="display: none"></div>
            <div id="wait" style="display:none"><center><i class='icon-spin6 animate-spin' style="font-size: 350%"></i></center></div>
            <div id="foto"></div>
            <style>.clFoto{width:100%;cursor: pointer}.prikaz{width: 100%}</style>
            <i class='icon-spin6 animate-spin' style="color: rgba(0,0,0,0)"></i>
        </div>
        <script>
            var editMod=false, slugApp=false;
            $('.editMod').click(function(){editMod=!editMod});
            function slikaOption(){if(editMod)$('.prikaz').popover('toggle')}
            function prikazSlike(objekat){
                $('.prikaz').attr('src',objekat.src);
                $('.prikaz').fadeIn();
                $('.prikaz').data('toggle','popover');
                $('.prikaz').data('trigger','focus');
                $('.prikaz').data('placement','left');
                $('.prikaz').data('html','true');
                $('.prikaz').attr('title','Opcije');
                $('.prikaz').data('content','<button onclick="ukloniFoto(\''+objekat.src+'\',\''+objekat.id+'\',\''+$(objekat).data('slugapp')+''\)"class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>');
                if(editMod)$('.prikaz').popover('show');
            }
            function ukloniFoto(url,id,slugApp){
                $('.prikaz').popover('hide');
                $('#wait').fadeIn();
                $.post('/moderacija/'+slugApp+'/galerije/ukloni-foto',{
                    _token:'{{csrf_token()}}',
                    link:url
                },function(data){

                    $('#prikaz').fadeOut();
                    $("img[src='"+url+"']").fadeOut();
                    $('#'+id).fadeOut();
                });
            }
            $('a.list-group-item').click(function(){
                $('#foto').hide();
                $('#wait').fadeIn();
                $('a.list-group-item').removeClass('active');
                $(this).addClass('active');
                var slugApp=$(this).data('slugapp');
                $.post('/moderacija/'+slugApp+'/galerije/lista-fotografija',
                        {
                            _token:'{{csrf_token()}}',
                            folder:$(this).data('link')
                        },
                        function(data){
                            var podaci=JSON.parse(data);
                            var foto='<img class="prikaz thumbnail" onclick="slikaOption()" style="display: none">';
                            if(podaci.length){
                                for(var i=0;i<podaci.length;i++) {
                                    foto += '<div class="col-xs-6 col-md-3"><img id="slika-'+i+'" data-slugApp="'+slugApp+'" onclick="prikazSlike(this)" class="clFoto thumbnail" src="/' + podaci[i] + '"></div>';
                                }
                            }else foto='<p>Ni jedna fotografija nije dodata u evidenciju.</p>';
                            $('#foto').html(foto);
                            $('#wait').hide();
                            $('#foto').fadeIn();
                });
            });
        </script>
    @else
        <p>Ne postoji ni jedna galerija.</p>
    @endif
@endsection