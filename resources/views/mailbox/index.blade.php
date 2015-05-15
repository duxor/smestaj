@extends("{$podaci['prava']}.master")
@section('content')
    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" @if($podaci['akcija']=='nova') class="active" @endif><a href="#"onclick="kreirajNovu()">Kreiraj poruku</a></li>
            <li role="presentation" @if($podaci['akcija']=='inbox') class="active" @endif><a href="#"onclick="getInbox()">Inbox</a></li>
            <li role="presentation" @if($podaci['akcija']=='poslate') class="active" @endif><a href="#">Poslate</a></li>
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
                case'nova':break;
                case'inbox':getInbox();break;
                case'poslate':break;
            }
        });
        function getInbox(){
            $('#show').hide();
            $('#wait').show();
            $.post('/{{$podaci['prava']}}/mailbox/ucitaj-inbox',{
                _token:'{{csrf_token()}}'
            },function(data){
                var podaci=JSON.parse(data);
                if(podaci.length){
                    var inbox='<table class="table table-hover">';
                    for(var i=0;i<podaci.length;i++)
                        inbox+='<tr onclick="getPoruka(\''+podaci[i].id+'\')" class="citajPoruku '+(podaci[i].procitano==0?'success':'')+'"><td>'+podaci[i].od_email+'</td><td>'+podaci[i].naslov+'</td><td>'+podaci[i].created_at+'</td></tr>';
                    $('#show').html(inbox+'</table>');
                }else $('#show').html('<p>Nemate poruka u prijemnom sandučetu.</p>');
                $('#wait').hide();
                $('#show').fadeIn();
            });
        }
        function getPoruka(id){
            $('#show').hide();
            $('#wait').show();
            $.post('/{{$podaci['prava']}}/mailbox/ucitaj-poruku',{
                _token:'{{csrf_token()}}',
                id:id
            },function(data){
                var podaci=JSON.parse(data);
                if(podaci){
                    var poruka='<div>' +
                                '<p><b>Od:</b> '+podaci.od_email+'</p>' +
                                '<p><b>Naslov:</b> <h2>'+podaci.naslov+'</h2></p>' +
                                '<p><b>Datum:</b> '+podaci.created_at+'</p>' +
                                '<p><b>Poruka:</b> <br>'+podaci.poruka+'</p>' +
                            '</div>';
                    $('#show').html(poruka);
                }else $('#show').html('<p>Došlo je do greške u čitanju poruke.</p>');
                $('#wait').hide();
                $('#show').fadeIn();
            });
        }
        function kreirajNovu(){
            $('#show').hide();
            $('#wait').show();
            $('#show').html(
            '<div id="zaSlanje" class="form-horizontal">'+
                '{!!Form::hidden('_token',csrf_token())!!}'+
                '<div class="form-group">'+
                    '<input name="za" class="form-control" placeholder="Email primaoca">'+
                '</div>'+
                '<div class="form-group">'+
                    '<input name="naslov" class="form-control" placeholder="Naslov">'+
                '</div>'+
                '<div class="form-group">'+
                    '<textarea name="poruka" class="form-control" placeholder="Poruka"></textarea>'+
                '</div>'+
                '<div class="form-group">'+
                    '<button class="btn btn-lg btn-primary" onclick="Komunikacija.posalji(\'/{{$podaci['prava']}}/mailbox/posalji-poruku\',\'zaSlanje\',\'poruka\',\'wait\',\'show\')"><i class="glyphicon glyphicon-envelope"></i> Pošalji</div>'+
                '</div>'+
            '</div>');
            $('#wait').hide();
            $('#show').fadeIn();
        }
    </script>
    <style>.citajPoruku{cursor: pointer}</style>
@endsection