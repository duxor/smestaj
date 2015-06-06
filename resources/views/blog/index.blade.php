@extends(\App\OsnovneMetode::osnovniNav().".master")
@section('content')
    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked">
            <li id="novi" role="presentation"><a href="#" onclick="kreirajNovi()">Nova objava</a></li>
            <li id="pregled" role="presentation"><a href="#" onclick="getPregled()">Pregled svih</a></li>
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
                case'novi':kreirajNovi();break;
                case'pregled':getPregled();break;
            }
        });
        function setActive(ID){
            $('.active').removeClass('active');
            $('#'+ID).addClass('active');
        }
        function kreirajNovi(){
            setActive('novi');
            $('#show').hide();
            $('#wait').show();
            $('#show').html(
                    '<div id="zaSlanje" class="form-horizontal">'+
                    '{!!Form::hidden('_token',csrf_token())!!}'+
            '<div class="form-group">'+
            '{!!Form::select('app',$podaci['app'],null,['class'=>'form-control'])!!}'+
            '</div>'+
            '<div class="form-group">'+
            '<input name="naslov" class="form-control" placeholder="Naslov">'+
            '</div>'+
            '<div class="form-group">'+
            '<textarea name="tekst" class="form-control" placeholder="Objava..." rows="7"></textarea>'+
            '</div>'+
            '<div class="form-group">'+
            '<button class="btn btn-lg btn-primary" onclick="Komunikacija.posalji(\'/{{\App\OsnovneMetode::osnovniNav()}}/blog/dodaj-objavu\',\'zaSlanje\',\'poruka\',\'wait\',\'show\')"><i class="glyphicon glyphicon-envelope"></i> Pošalji</div>'+
            '</div>'+
            '</div>');
            $('#wait').hide();
            $('#show').fadeIn();
        }
        function getPregled(){
            setActive('pregled');
            $('#show').hide();
            $('#wait').show();
            $.post('/{{\App\OsnovneMetode::osnovniNav()}}/blog/pregled/{{Session::get('username')}}',{
                _token:'{{csrf_token()}}'
            },function(data){
                if(data) {
                    var podaci = JSON.parse(data);
                    if (podaci.length) {
                        var objave = '';
                        for (var i = 0; i < podaci.length; i++)
                            objave += '<div onclick="getPoruka(\'' + podaci[i].naslov + '\',\'poslate\')" class="citajPoruku">'+
                                        '<div class="nDn col-sm-3">Naslov</div><div class="col-sm-9">' + podaci[i].naslov +
                                        '</div><div class="nDn col-sm-3">Objava</div><div class="col-sm-9">' + podaci[i].tekst +
                                        '</div><div class="nDn col-sm-3">Aktivan</div><div class="col-sm-9">' + podaci[i].aktivan + '</div></div>';
                        $('#show').html(objave);
                    } else $('#show').html('<p>Nemate ni jednu objavu.</p>');
                } else $('#show').html('<p>Greška u autentifikaciji. Kontaktirajte administratora.</p>');
                $('#wait').hide();
                $('#show').fadeIn();
            });
        }
    </script>
@endsection