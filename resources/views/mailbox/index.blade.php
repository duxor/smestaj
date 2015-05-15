@extends("{$podaci['prava']}.master")
@section('content')
    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" @if($podaci['akcija']=='nova') class="active" @endif><a href="#">Kreiraj poruku</a></li>
            <li role="presentation" @if($podaci['akcija']=='inbox') class="active" @endif><a href="#"onclick="getInbox()">Inbox</a></li>
            <li role="presentation" @if($podaci['akcija']=='poslate') class="active" @endif><a href="#">Poslate</a></li>
        </ul>
    </div>
    <div id="work-area" class="col-sm-9">
        <i class='icon-spin6 animate-spin' style="color: rgba(0,0,0,0)"></i>
        <div id="wait" style="display:none"><center><i class='icon-spin6 animate-spin' style="font-size: 350%"></i></center></div>
        <div id="show"></div>
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
            },function(data){alert(data);
                var podaci=JSON.parse(data);
                if(podaci.length){
                    var inbox='<table class="table table-hover">';
                    for(var i=0;i<podaci.length;i++)
                        inbox+='<tr><td>'+podaci[i].od_email+'</td><td>'+podaci[i].naslov+'</td><td>'+podaci[i].poruka+'</td><td>'+podaci[i].created_at+'</td></tr>';
                    $('#work-area').html(inbox+'</table>');
                }else $('#work-area').html('<p>Nemate poruka u prijemnom sandučetu.</p>');
                $('#wait').hide();
                $('#show').fadeIn();
            });
        }
    </script>
@endsection