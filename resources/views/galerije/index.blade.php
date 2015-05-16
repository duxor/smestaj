@extends('moderacija.master')
@section('body')
    @if($podaci['galerije'])
        <div class="list-group col-sm-4">
            <p style="text-align: right">
                <button class="btn btn-default sakrijListu"><i class="glyphicon glyphicon-circle-arrow-left strelica"></i></button>
                <button class="btn btn-info editMod" style="margin:0 5px"><i class="glyphicon glyphicon-pencil"></i></button>
            </p>
            @foreach($podaci['galerije'] as $galerija)
                <a style="cursor: pointer" class="list-group-item" data-slugapp="{{$galerija['slugApp']}}" data-link="galerije/{{Session::get('username')}}/aplikacije/{{$galerija['slugApp']}}/{{$galerija['slugTeme']}}/{{$galerija['sadrzaj']}}">
                    <button class="btn btn-success _upload" data-toggle="modal" data-target="#dodajFoto" style="position: absolute;right: 5px;top: 5px"><i class="glyphicon glyphicon-cloud-upload"></i></button>
                    <h2 style="text-align: center">{{$galerija['naziv']}}</h2>
                    <p class="list-group-item-text">
                    <table>
                        <tr><td>Aplikacija </td><td><b>{{$galerija['nazivApp']}}</b></td></tr>
                        <tr><td>Tema </td><td><b>{{$galerija['nazivApp']}}</b></td></tr>
                    </table>
                    </p>
                </a>
            @endforeach
        </div>
        <div class="col-sm-8 work-area">
            <div id="poruka" style="display: none"></div>
            <div id="wait" style="display:none"><center><i class='icon-spin6 animate-spin' style="font-size: 350%"></i></center></div>
            <div id="foto"></div>
            <style>.clFoto{width:100%;cursor: pointer}.prikaz{width: 100%}</style>
            <i class='icon-spin6 animate-spin' style="color: rgba(0,0,0,0)"></i>
        </div>
        <script>
            var sirina='50px';
            $('.sakrijListu').click(function(){$('.work-area').hide();
                $('.list-group').animate({width:sirina},350);
                $('.editMod').toggle();
                $('.list-group-item').toggle();
                $('.strelica').toggleClass('glyphicon-circle-arrow-left');
                $('.strelica').toggleClass('glyphicon-circle-arrow-right');
                $(this).show();
                $('.work-area').animate({width:sirina=='50px'?'100%':'70%'},350);
                $('.work-area').fadeIn();
                sirina=sirina=='50px'?'30%':'50px';
            });
            var editMod=false, slugApp=false, serverUrl='{{url('/')}}}';
            $('.editMod').click(function(){editMod=!editMod;$('.prikaz').popover('hide')});
            function slikaOption(){if(editMod)$('.prikaz').popover('toggle')}
            function prikazSlike(objekat){
                $('.prikaz').popover('destroy');
                $('.prikaz').attr('src',objekat.src);
                $('.prikaz').data('toggle','popover');
                $('.prikaz').data('trigger','focus');
                $('.prikaz').data('placement','left');
                $('.prikaz').data('html','true');
                $('.prikaz').attr('title','Opcije');
                $('.prikaz').data('content','<button onclick="ukloniFoto(\''+objekat.src+'\',\''+objekat.id+'\')"class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>');
                $('.prikaz').fadeIn();
                if(editMod)$('.prikaz').popover('show');
            }
            function ukloniFoto(url,id){
                $('.prikaz').popover('hide');
                $('#wait').fadeIn();
                $.post('/{{\App\OsnovneMetode::osnovniNav()}}/galerije/ukloni-foto',{
                    _token:'{{csrf_token()}}',
                    link:url.substr(serverUrl.length)
                },function(data){
                    if(JSON.parse(data).msg=='OK'){
                        $('.prikaz').fadeOut();
                        $('#'+id).fadeOut();
                        $('#wait').hide();
                    }
                });
            }
            $('a.list-group-item').click(function(){
                $('#foto').hide();
                $('#wait').fadeIn();
                $('a.list-group-item').removeClass('active');
                $(this).addClass('active');
                var slugApp=$(this).data('slugapp');
                $.post('/{{\App\OsnovneMetode::osnovniNav()}}/galerije/lista-fotografija',
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
    <div class="modal fade" id="dodajFoto">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h2>Dodaj nove fotografije</h2>
                </div>
                <div class="modal-body">
                    <input id="input-700" name="images[]" type="file" multiple=true class="file-loading" >
                    {!!Form::hidden('folder',null,['id'=>'folder'])!!}
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-lg btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Završeno dodavanje</a>
                </div>
            </div>
        </div>
    </div>

    {!! HTML::style('/dragdrop/css/fileinput.css') !!}
    {!! HTML::script('/dragdrop/js/fileinput.min.js') !!}
    <script>
        $('._upload').click(function(){
            $('#folder').val($(this).closest('a').data('link')+'/');
            $("#input-700").fileinput({
                uploadExtraData: {folder: $('#folder').val(), _token:'{{csrf_token()}}'},
                uploadUrl: '/{{\App\OsnovneMetode::osnovniNav()}}/galerije/upload',
                uploadAsync: true,
                maxFileCount: 10
            });
        });
    </script>
@endsection