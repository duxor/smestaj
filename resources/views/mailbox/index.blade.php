@extends(\App\OsnovneMetode::osnovniNav().".master")
@section('content')
    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked">
            <li id="nova" role="presentation"><a href="#"onclick="kreirajNovu()">Kreiraj poruku</a></li>
            <li id="inbox" role="presentation"><a href="#"onclick="getInbox()">Inbox</a></li>
            <li id="poslate" role="presentation"><a href="#"onclick="getPoslate()">Poslate</a></li>
        </ul>
    </div>
    <div id="work-area" class="col-sm-9">
        <i class='icon-spin6 animate-spin' style="color: rgba(0,0,0,0)"></i>
        <div id="wait" style="display:none"><center><i class='icon-spin6 animate-spin' style="font-size: 350%"></i></center></div>
        <div id="show"></div>
        <div id="poruka" style="display: none"></div>
    </div>
    <script>
        $(document).ready(function(){
            switch('{{$podaci['akcija']}}'){
                case'nova':kreirajNovu();break;
                case'inbox':getInbox();break;
                case'poslate':getPoslate();setActive('poslate');break;
            }
        });
        function setActive(ID){
            $('.active').removeClass('active');
            $('#'+ID).addClass('active');
        }
        function getInbox(){
            setActive('inbox');
            $('#show').hide();
            $('#wait').show();
            $.post('/{{\App\OsnovneMetode::osnovniNav()}}/mailbox/ucitaj-inbox',{
                _token:'{{csrf_token()}}'
            },function(data){
                var podaci=JSON.parse(data);
                if(podaci.length){
                    var inbox='<table class="table table-striped table-hover"><thead><tr><td>Pošiljalac</td><td>Naslov</td><td>Vreme prijema</td></tr></thead><tbody>';
                    for(var i=0;i<podaci.length;i++)
                        inbox+='<tr onclick="getPoruka(\''+podaci[i].id+'\',\'inbox\')" class="citajPoruku '+(podaci[i].procitano==0?'success':'')+'"><td>'+(podaci[i].username?podaci[i].username:podaci[i].od_email)+'</td><td>'+podaci[i].naslov+'</td><td>'+podaci[i].created_at+'</td></tr>';
                    $('#show').html(inbox+'</thead></table>');
                }else $('#show').html('<p>Nemate poruka u prijemnom sandučetu.</p>');
                $('#wait').hide();
                $('#show').fadeIn();
            });
        }
        function getPoruka(id,akcija){
            setActive(akcija);
            var url,str;
            switch(akcija){
                case'inbox':url='poruku';str='Od';break;
                case'poslate':url='poslatu';str='Za';break;
            }
            $('#show').hide();
            $('#wait').show();
            $.post('/{{\App\OsnovneMetode::osnovniNav()}}/mailbox/ucitaj-'+url,{
                _token:'{{csrf_token()}}',
                id:id
            },function(data){
                var podaci=JSON.parse(data);
                if(podaci){
                    var poruka='<div>' +
                                '<p><b>'+str+':</b> '+(podaci.username?'<span id="username">'+podaci.username+'</span> <button onclick="odgovori()" class="btn btn-primary"><i class="glyphicon glyphicon-share-alt"></i></button>':podaci.od_email)+'</p>' +
                                '<p><b>Naslov: <span id="naslov">'+podaci.naslov+'</span></b></p>' +
                                '<p><b>Datum:</b> '+podaci.created_at+'</p>' +
                                '<p><b>Poruka:</b><hr> <br><span id="poruka">'+podaci.poruka+'</span></p>' +
                            '</div>';
                    $('#show').html(poruka);
                }else $('#show').html('<p>Došlo je do greške u čitanju poruke.</p>');
                $('#wait').hide();
                $('#show').fadeIn();
            });
        }
        function odgovori(){
            var username=$('#username').text(),
                    naslov=$('#naslov').text(),
                    poruka=$('#poruka').text();
            kreirajNovu();
            $('input[name=za]').val(username);
            $('input[name=naslov]').val('Odgovor: '+naslov);
            $(':input[name=poruka]').val('\n--------------\n'+poruka);
        }
        function kreirajNovu(){
            setActive('nova');
            $('#show').hide();
            $('#wait').show();
            $('#show').html(
            '<div id="zaSlanje" class="form-horizontal">'+
                '{!!Form::hidden('_token',csrf_token())!!}'+
                '<div class="form-group">'+
                    '<input name="za" class="form-control" placeholder="Username primaoca">'+
                '</div>'+
                '<div class="form-group">'+
                    '<input name="naslov" class="form-control" placeholder="Naslov">'+
                '</div>'+
                '<div class="form-group">'+
                    '<textarea name="poruka" class="form-control" placeholder="Poruka" rows="7"></textarea>'+
                '</div>'+
                '<div class="form-group">'+
                    '<button class="btn btn-lg btn-primary" onclick="Komunikacija.posalji(\'/{{\App\OsnovneMetode::osnovniNav()}}/mailbox/posalji-poruku\',\'zaSlanje\',\'poruka\',\'wait\',\'show\')"><i class="glyphicon glyphicon-envelope"></i> Pošalji</div>'+
                '</div>'+
            '</div>');
            $('#wait').hide();
            $('#show').fadeIn();
        }
        function getPoslate(){
            setActive('poslate');
            $('#show').hide();
            $('#wait').show();
            $.post('/{{\App\OsnovneMetode::osnovniNav()}}/mailbox/poslate',{
                _token:'{{csrf_token()}}'
            },function(data){
                var podaci=JSON.parse(data);
                if(podaci.length){
                    var inbox='<table class="table table-striped table-hover"><thead><tr><td>Primalac</td><td>Naslov</td><td>Vreme prijema</td></tr></thead><tbody>';
                    for(var i=0;i<podaci.length;i++)
                        inbox += '<tr onclick="getPoruka(\'' + podaci[i].id + '\',\'poslate\')" class="citajPoruku"><td>' + podaci[i].username + '</td><td>' + podaci[i].naslov + '</td><td>' + podaci[i].created_at + '</td></tr>';
                    $('#show').html(inbox+'</tbody></table>');
                }else $('#show').html('<p>Nemate poruka u prijemnom sandučetu.</p>');
                $('#wait').hide();
                $('#show').fadeIn();
            });
        }
    </script>
    <style>.citajPoruku{cursor: pointer}</style>
@endsection