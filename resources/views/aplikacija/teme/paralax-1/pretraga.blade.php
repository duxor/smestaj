@extends('aplikacija.teme.paralax-1.master')
@section('head')
    <script type="text/javascript">
        var map, markers, spotlight, locationsByType = {};
        function initMap() {
            var template = 'http://{S}tile.openstreetmap.org/{Z}/{X}/{Y}.png'//'http://{S}tile.openstreetmap.org/{Z}/{X}/{Y}.png';//'http://c.tiles.mapbox.com/v3/examples.map-szwdot65/{Z}/{X}/{Y}.png';//'http://ecn.t{S}.tiles.virtualearth.net/tiles/r{Q}?g=689&mkt=en-us&lbl=l0&stl=m';//'http://ecn.t{S}.tiles.virtualearth.net/tiles/r{Q}?g=689&mkt=en-us&lbl=l0&stl=m';//
            var subdomains = [ '', 'a.', 'b.', 'c.' ];//[0,1,2,3,4,5,6,7];//
            var provider = new com.modestmaps.TemplatedLayer(template, subdomains);
            map = new com.modestmaps.Map('map',
                    provider,
                    null, [
                        new com.modestmaps.TouchHandler(),
                        new com.modestmaps.MouseHandler()
                    ]);
            spotlight = new SpotlightLayer();
            map.addLayer(spotlight);
            markers = new MM.MarkerLayer();
            map.addLayer(markers);
            loadMarkers();
        }
        function loadMarkers() {
            var script = document.createElement("script");
            script.src = "/pretraga/markeri-izbor?broj_osoba={{$podaci['broj_osoba']}}&grad_id={{$podaci['grad_id']}}&tacan_broj={{$podaci['tacan_broj']}}";
            document.getElementsByTagName("head")[0].appendChild(script);
        }
        function onLoadMarkers(collection) {
            var features = collection.features,
                    len = features.length,
                    locations = [];
            for (var i = 0; i < len; i++) {
                var feature = features[i],
                        type = feature.properties.naslov,
                        marker = document.createElement("a");
                marker.feature = feature;
                marker.type = type;
                // give it a title
                marker.setAttribute("title", [type]);
                marker.setAttribute("class", "report");
                // set the href to link to crimespotting's crime page
                marker.setAttribute("href", feature.link);
                // create an image icon
                var img = marker.appendChild(document.createElement("a"));
                img.setAttribute("class","glyphicon glyphicon-screenshot");//glyphicon glyphicon-pushpin");//("src", "../geojson/icons/" + type.replace(/ /g, "_") + ".png");
                img.setAttribute("style","color:red");
                markers.addMarker(marker, feature);
                locations.push(marker.location);
                if (type in locationsByType) {
                    locationsByType[type].push(marker.location);
                } else {
                    locationsByType[type] = [marker.location];
                }
                // listen for mouseover & mouseout events
                MM.addEvent(marker, "mouseover", onMarkerOver);
                MM.addEvent(marker, "mouseout", onMarkerOut);
            }
            // tell the map to fit all of the locations in the available space
            map.setExtent(locations);
            //map.setCenterZoom(locations[0],6);
            //map.setCenterZoom(new com.modestmaps.Location('{{$podaci['grad_koo']['y']}}','{{$podaci['grad_koo']['x']}}'),'{{$podaci['grad_koo']['z']}}');
        }
        function getMarker(target) {
            var marker = target;
            while (marker && marker.className != "report") {
                marker = marker.parentNode;
            }
            return marker;
        }
        function onMarkerOver(e) {
            var marker = getMarker(e.target);
            if (marker) {
                var type = marker.type;
                console.log("over:", type);
                if (type in locationsByType) {
                    spotlight.addLocations(locationsByType[type] || []);
                    spotlight.parent.className = "active";
                } else {
                    spotlight.parent.className = "inactive";
                }
            }
        }
        function onMarkerOut(e) {
            var marker = getMarker(e.target);
            if (marker) {
                var type = marker.type;
                console.log("out:", type);
                spotlight.removeAllLocations();
                spotlight.parent.className = "inactive";
            }
        }
    </script>
    <style>
        .report {
            margin-left: -13px;
            margin-top: -13px;
            width: 26px;
            height: 26px;
        }
        .report img {
            border: none !important;
        }
        .report:hover {
            z-index: 1000;
        }
        #map canvas {
            transition-property: opacity;
            -webkit-transition-property: opacity;
            -moz-transition-property: opacity;
            -ms-transition-property: opacity;
            -o-transition-property: opacity;
            transition-duration: .6s;
            -webkit-transition-duration: .6s;
            -moz-transition-duration: .6s;
            -ms-transition-duration: .6s;
            -o-transition-duration: .6s;
            transition-delay: .1s;
            -webkit-transition-delay: .1s;
            -moz-transition-delay: .1s;
            -ms-transition-delay: .1s;
            -o-transition-delay: .1s;
            opacity: 0;
        }
        #map canvas.active {
            opacity: 1;
        }
    </style>

    <script>
        $(document).ready(function(){ initMap(); })
    </script>
@endsection
@section('content')
    <h1>Pretraga</h1>
    {!!Form::open(['url'=>$podaci['app']['slug'].'/pretraga','class'=>'form-inline col-sm-11'])!!}
    {!!Form::hidden('aplikacija',$podaci['app']['id'])!!}
    <div class="form-group">
        <label>Broj mesta (Tačan  broj {!!Form::checkbox('tacan_broj',1,$podaci['tacan_broj'])!!})</label>
        {!!Form::select('broj_osoba',[1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12],$podaci['broj_osoba'],['class'=>'form-control'])!!}
        {!!Form::select('grad_id',$podaci['gradovi'],$podaci['grad_id'],['class'=>'form-control'])!!}
        <div class="form-group" id="datarange">
            <div class="input-daterange input-group col-sm-12" id="datepicker">
                {!! Form::text('datumOd', null, ['class'=>'input-sm form-control','placeholder'=>'od...']) !!}
                <span class="input-group-addon">do</span>
                {!! Form::text('datumDo', null, ['class'=>'input-sm form-control','placeholder'=>'do...']) !!}
            </div>
        </div>
        <script>
            $('#datarange .input-daterange').datepicker({orientation: "top auto",weekStart: 1,startDate: "current",todayBtn: "linked",toggleActive: true,format: "yyyy-mm-dd"});
            var d = new Date();
            $('input[name=datumOd]').datepicker('setDate',d);
            d.setDate(d.getDate()+1);
            $('input[name=datumDo]').datepicker('setDate', d);
        </script>
        {!!Form::button('<i class="glyphicon glyphicon-search"></i> Pronađi',['class'=>'btn btn-primary','type'=>'submit'])!!}
    </div>
    {!!Form::close()!!}

    @if($podaci['rezultat'])
        <div class="col-sm-1">
            <a href="#" class="btn btn-success scroll-link" data-id="rezultati"><i class="glyphicon glyphicon-download"></i> Rezultati</a>
        </div><br clear="all">
        <hr>
        <div id="map" style="width: 100%;height: 400px"></div>
        <p id="rezultati"></p>
        @foreach($podaci['rezultat'] as $smestaj)
            <hr>
            <div class="col-sm-4">
                <a href="#">
                    <img style="height: 150px;" @if($smestaj['naslovna_foto'])src="{{$smestaj['naslovna_foto']}}" @else src="/teme/osnovna-paralax/slike/15.jpg" @endif>
                </a>
                <p>
                    <a href="/{{$smestaj['slugApp']}}/{{$smestaj['slugSmestaj']}}" class="btn btn-lg btn-default"><i class="glyphicon glyphicon-zoom-in"></i> Pregled</a>
                    @if(\App\Security::autentifikacijaTest())
                        <button class="btn btn-lg btn-info m" data-toggle="modal" data-target="#rezervacija" data-cena="{{$smestaj['cena_osoba']}}" data-id="{{$smestaj['id']}}" data-app="{{$smestaj['nazivApp']}}" data-naziv="{{$smestaj['naziv']}}" data-vrobjekta="{{$smestaj['vrsta_smestaja']}}" data-maxosoba="{{$smestaj['broj_osoba']}}" data-adresa="{{$smestaj['adresa']}}" data-img="/teme/osnovna-paralax/slike/15.jpg"><span class="glyphicon glyphicon-check"></span> Rezervacija</button>
                        <button id="zelja" class="btn btn-lg btn-default _tooltip" @if($smestaj['zelja']) data-zelja="{{$smestaj['zelja']}}" style="color:red" title="Izbaci iz liste zelja" @else data-zelja="false" title="Dodaj u listu želja" @endif data-id="{{$smestaj['id']}}" data-toggle="tooltip" data-placement="bottom"><i class="glyphicon glyphicon-heart"></i></button>
                    @else
                        <a href="/log/login" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-check"></span> Rezervacija</a>
                        <a href="/log/login" class="btn btn-lg btn-default _tooltip"  title="Dodaj u listu želja" data-toggle="tooltip" data-placement="bottom"><i class="glyphicon glyphicon-heart"></i></a>
                    @endif
                </p>
            </div>
            <div class="col-sm-8">
                <h3>{{$smestaj['nazivApp']}}</h3>
                <table class="moja-tabela">
                    <tr><td>Naziv objekta:</td><td>{{$smestaj['naziv']}}</td></tr>
                    <tr><td>Vrsta objekta:</td><td>{{$smestaj['vrsta_smestaja']}}</td></tr>
                    <tr><td>Broj mesta:</td><td>{{$smestaj['broj_osoba']}}</td></tr>
                    <tr><td>Adresa:</td><td>{{$smestaj['adresa']}}</td></tr>
                    <tr><td>Cena (po osobi):</td><td>{{$smestaj['cena_osoba']}} din</td></tr>
                </table>
            </div><br clear="all">
        @endforeach
        <div class="modal fade" id="rezervacija" tabindex="-1" role="dialog" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 style="text-align:center"><i class="glyphicon glyphicon-edit" style="font-size: 150%"></i> Rezerviši najbolji</h2>
                    </div>
                    <div class="modal-body">
                        <div id="container-fluid">
                            <div id="vrti" style="display:none"><center><i class='icon-spin6 animate-spin' style="font-size: 350%"></i></center></div>
                            <div id="forma" class="form-horizontal">
                                {!!Form::hidden('id_smestaja',null,['id'=>'id_smestaja'])!!}
                                {!!Form::hidden('id_korisnika',Session::get('id'))!!}
                                {!!Form::hidden('_token',csrf_token())!!}
                                {!!Form::hidden('cena')!!}
                                {!!Form::hidden('ukupna_cena')!!}
                                <div class="form-group">
                                    <div class="col-sm-4"><img id="foto" style="width:100%"></div>
                                    <div class="col-sm-8">
                                        <p id="app" style="text-align:center;text-decoration:underline;margin:0"></p>
                                        <p id="objekat" style="text-align:center;margin:0"></p>
                                        <p id="vrobjekta" style="text-align:center;margin:0"></p>
                                        <p id="adresa" style="text-align:center;margin:0"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group" id="datarange" style="padding-left: 22px">
                                    <div class="input-daterange input-group col-sm-7 col-sm-offset-4" id="datepicker">
                                        {!! Form::text('datumOd', date("Y-m-d"),['class'=>'input-sm form-control','placeholder'=>'od...','id'=>'datumod','style'=>'padding:20px']) !!}
                                        <span class="input-group-addon">do</span>
                                        {!! Form::text('datumDo',null,['class'=>'input-sm form-control','placeholder'=>'do...','id'=>'datumdo','style'=>'padding:20px'])!!}
                                    </div>
                                </div>
                                <script>$('#datarange .input-daterange').datepicker({orientation:"top auto",weekStart:1,startDate:"current",todayBtn:"linked",toggleActive:true,format:"yyyy-mm-dd"});</script>
                                <div id="broj osoba" class="form-group has-feedback">
                                    {!!Form::label('brojosoba','Broj osoba',['class'=>'control-label col-sm-4'])!!}
                                    <div class="col-sm-4">
                                        {!!Form::select('broj_osoba',[],null,['class'=>'form-control','id'=>'broj_osoba'])!!}
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    {!! Form::label('napomena','Napomena',['class'=>'control-label col-sm-4']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::textarea('napomena',null,['class'=>'form-control','placeholder'=>'Upišite napomenu','id'=>'napomena']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('lcena','Cena',['class'=>'control-label col-sm-4']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::label('lcena','Cena',['class'=>'control-label','id'=>'cena']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="poruka" style="display:none"></div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::button('<span class="glyphicon glyphicon-remove"></span> Otkaži',['class'=>'btn btn-lg btn-warning','data-dismiss'=>'modal']) !!}
                        {!! Form::button('<span class="glyphicon glyphicon-ok"></span> Rezerviši',['class'=>'btn btn-lg btn-success','onclick'=>'Komunikacija.posalji("/rezervisi",\'forma\',\'poruka\',\'vrti\',\'forma\')' ]) !!}
                    </div>
                </div>
            </div>
        </div><i class='icon-spin6 animate-spin' style="color: rgba(0,0,0,0)"></i>
        <style>._tooltip:hover{color: red}</style>
        <script>
            $(document).ready(function(){$('button').tooltip();$('a').tooltip()});
            $('button.m').click(function(){
                $('#app').html($(this).data('app'));
                $('#objekat').html($(this).data('naziv'));
                $('#vrobjekta').html($(this).data('vrobjekta'));
                $('#adresa').html($(this).data('adresa'));
                $('#id_smestaja').val($(this).data('id'));
                $('#foto').attr('src',$(this).data('img'));
                $('#cena').html($(this).data('cena')+' din');
                $('input[name=ukupna_cena]').val($(this).data('cena'));
                $('input[name=cena]').val($(this).data('cena'));
                var option = '';
                for (i=1;i<=$(this).data('maxosoba');i++){
                    option += '<option value="'+ i + '">' + i + '</option>';
                }
                $('#broj_osoba').html(option);
            });
            $('#broj_osoba').change(function(){
                $('#cena').html($('input[name=cena]').val()*$(this).val()+' din');
                $('input[name=ukupna_cena]').val($('input[name=cena]').val()*$(this).val());
            });
            $("button#zelja").click(function(){
                $(this).css("color","black");
                $(this).html("<i class='icon-spin6 animate-spin'></i> U procesu...");
                var id=$(this).data("id");
                $.post('/aplikacija/lista-zelja-dodaj',
                        {
                            _token: $('input[name="_token"]').val(),
                            smestaj: $(this).data("id"),
                            korisnik: "{{Session::get("id")}}",
                            zelja: $(this).data("zelja")
                        },
                        function(data){
                            $('button[data-id="'+id+'"]').html("<i class='glyphicon glyphicon-heart'></i>");
                            if($('button[data-id="'+id+'"]').data('zelja')!=false){
                                $('button[data-id="'+id+'"]').data('zelja',false);
                                $('button[data-id="'+id+'"]').css("color","black");
                            } else{
                                $('button[data-id="'+id+'"]').data('zelja',data);
                                $('button[data-id="'+id+'"]').css("color","red");
                            }
                        }
                );
            });
        </script>
    @else
        <br clear="all"><p>Nema rezultata za date parametre. Proverite parametre i pokušajte ponovo.</p>
    @endif
@endsection