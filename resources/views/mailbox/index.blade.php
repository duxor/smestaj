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

    </div>
    <script>
        function getInbox(){
            $.post('/{{$podaci['prava']}}/mailbox/ucitaj-inbox',{
                _token:'{{csrf_token()}}'
            },function(data){
                var inbox='<table class="table table-hover">';
                var podaci=JSON.parse(data);
                for(var i=0;i<podaci.length;i++)
                    inbox+='<tr><td>'+podaci[i].od_email+'</td><td>'+podaci[i].naslov+'</td><td>'+podaci[i].poruka+'</td><td>'+podaci[i].created_at+'</td></tr>';
                $('#work-area').html(inbox+'</table>');
            });
        }
    </script>
@endsection