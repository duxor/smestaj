@extends('aplikacija.teme-osnove.osnovna.master')
@section('head')
    <script type="text/javascript" xmlns="http://www.w3.org/1999/html">
        var map, markers, spotlight, locationsByType = {};
        function initMap() {
            var template = 'http://{S}tile.openstreetmap.org/{Z}/{X}/{Y}.png';
            var subdomains = [ '', 'a.', 'b.', 'c.' ];
            var provider = new com.modestmaps.TemplatedLayer(template, subdomains);
            map = new com.modestmaps.Map('map',
                    provider,
                    null, [
                        //new com.modestmaps.TouchHandler(),
                        //new com.modestmaps.MouseHandler()
                        new MM.DragHandler(map),
                        new MM.DoubleClickHandler(map)
                    ]);
            spotlight = new SpotlightLayer();
            map.addLayer(spotlight);
            markers = new MM.MarkerLayer();
            map.addLayer(markers);
            loadMarkers();
        }
        function loadMarkers() {
            var script = document.createElement("script");
            @if(isset($podaci['pretragaApp']))
                script.src = "/pretraga/markeri-izbor?like={{$podaci['pretragaApp']?$podaci['pretragaApp']:'null'}}";
            @else
                script.src = "/pretraga/markeri-izbor?broj_osoba={{$podaci['broj_osoba']}}&grad_id={{$podaci['grad_id']}}&tacan_broj={{$podaci['tacan_broj']}}&datumOd{{$podaci['datumOd']}}&datumDo{{$podaci['datumDo']}}";
            @endif
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
                marker.setAttribute("title", [type]);
                marker.setAttribute("class", "report");
                marker.setAttribute("href", feature.link);
                var img = marker.appendChild(document.createElement("a"));
                img.setAttribute("class","glyphicon glyphicon-screenshot");
                img.setAttribute("style","color:red");
                markers.addMarker(marker, feature);
                locations.push(marker.location);
                if (type in locationsByType)locationsByType[type].push(marker.location);else locationsByType[type] = [marker.location];
                MM.addEvent(marker, "mouseover", onMarkerOver);
                MM.addEvent(marker, "mouseout", onMarkerOut);
            }
            map.setExtent(locations);
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
        $(document).ready(function(){ initMap(); })
    </script>
    <style>
        .report {margin-left: -13px;margin-top: -13px;width: 26px;height: 26px;}
        .report img {border: none !important;}
        .report:hover {z-index: 1000}
        #map canvas {transition-property: opacity;-webkit-transition-property: opacity;-moz-transition-property: opacity;-ms-transition-property: opacity;-o-transition-property: opacity;transition-duration: .6s;-webkit-transition-duration: .6s;-moz-transition-duration: .6s;-ms-transition-duration: .6s;-o-transition-duration: .6s;transition-delay: .1s;-webkit-transition-delay: .1s;-moz-transition-delay: .1s;-ms-transition-delay: .1s;-o-transition-delay: .1s;opacity: 0;}
        #map canvas.active {opacity: 1}
    </style>
@endsection
@section('content')
    <h1 style="margin-top: 70px">Pretraga</h1>
    @if(isset($podaci['pretragaApp']))
        {!!Form::open(['url'=>'/pretraga/smestaji','class'=>'form-inline col-sm-11'])!!}
        <div class="form-group col-sm-12">
            {!!Form::label('lnaziv','Naziv',['class'=>'col-sm-3'])!!}
            {!!Form::text('naziv',$podaci['pretragaApp'],['class'=>'form-control'])!!}
            {!!Form::button('<i class="glyphicon glyphicon-search"></i> Pronađi',['class'=>'btn btn-primary pronadji_btn','type'=>'submit'])!!}
        </div>
        {!!Form::close()!!}
    @else
        {!!Form::open(['url'=>'/pretraga','class'=>'form-inline col-sm-11'])!!}
        <div class="form-group">
            <label>Broj mesta (Tačan broj {!!Form::checkbox('tacan_broj',1,$podaci['tacan_broj'])!!})</label>
            {!!Form::select('broj_osoba',[1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12],$podaci['broj_osoba'],['class'=>'form-control'])!!}
            {!!Form::select('grad_id',$podaci['gradovi'],$podaci['grad_id'],['class'=>'form-control'])!!}
            <div class="form-group" id="datarange">
                <div class="input-daterange input-group col-sm-12" id="datepicker">
                    {!! Form::text('datumOd',isset($podaci['datumOd'])?$podaci['datumOd']:null,['class'=>'input-sm form-control','placeholder'=>'od...']) !!}
                    <span class="input-group-addon">do</span>
                    {!! Form::text('datumDo',isset($podaci['datumDo'])?$podaci['datumDo']:null,['class'=>'input-sm form-control','placeholder'=>'do...']) !!}
                </div>
            </div>
        </div>
        <br/><br/>
        <div class="form-group">
                <div class="col-md-4">
                    {!! Form::label('cenaod','Cena od:',['class'=>'control-label']) !!}
                    {!!Form::select('min', array_combine(range(500,10000,200),range(500,10000,200)),$min, ['class'=>'form-control'])!!}
                </div>


                <div class="col-md-4">
                    {!! Form::label('cenaod','Cena do:',['class'=>'control-label']) !!}
                    {!!Form::select('max', array_combine(range(500,10000,200),range(500,10000,200)),$max, ['class'=>'form-control'])!!}
                </div>

        </div><br/><br/>
        <div class="col-md-4">
            {!!Form::button('<i class="glyphicon glyphicon-search"></i> Pronađi',['class'=>'btn btn-primary pronadji_btn','type'=>'submit'])!!}
        </div>



        <script>
                $('#datarange .input-daterange').datepicker({orientation: "top auto",weekStart: 1,startDate: "current",todayBtn: "linked",toggleActive: true,format: "yyyy-mm-dd"});
                @if(!isset($podaci['datumOd'])) var d = new Date(); $('input[name=datumOd]').datepicker('setDate',d); @endif
                @if(!isset($podaci['datumDo'])) var d = new Date(); d.setDate(d.getDate()+1); $('input[name=datumDo]').datepicker('setDate', d); @endif
            </script>
    <br/>

        {!!Form::close()!!}
    @endif
    @if(isset($podaci['rezultat']))
        @if($podaci['rezultat'])
            <div class="col-sm-1">
                <a href="#" class="btn btn-success scroll-link" data-target="#rezultati" data-id="rezultati"><i class="glyphicon glyphicon-download"></i> Rezultati</a>
            </div><br clear="all">
            <hr>
            <div id="map" style="width: 100%;height: 400px">
                <button class="btn btn-xs btn-primary" onclick="zoomMap('+')" style="z-index:20;position: absolute;margin:10px 0 0 10px"><i class="glyphicon glyphicon-plus"></i></button>
                <button class="btn btn-xs btn-danger" onclick="zoomMap('-')" style="z-index:20;position: absolute;margin:50px 0 0 10px"><i class="glyphicon glyphicon-minus"></i></button>
            </div><script>function zoomMap(kako){map.zoomBy(kako=='+'?1:-1)}</script>
            @if(!isset($podaci['pretragaApp']))
                {!!Form::button('<i class="glyphicon glyphicon-chevron-down"></i> Filter',['class'=>'btn btn-info','id'=>'btn_filter'])!!}
                <div class="container">
                    <div class="filter">
                        <hr>
                        <div class="col-md-5">
                            @foreach($podaci['dodatna_oprema'] as $k=>$oprema)
                                <input name="oprema_filter" type="checkbox" value="0" class="oprema_filter" data-opremaid="{{$oprema['id']}}" data-size="normal" data-on-text="Da" data-off-text="Ne" data-label-text="{{$oprema['naziv']}}">
                            @endforeach
                        </div>
                        <script>
                            $(".oprema_filter").bootstrapSwitch();
                            $('.filter').hide();
                            $('#btn_filter').css('margin-top','20px');
                            $('#btn_filter').click(function(){
                                $(this).children('i').toggleClass('glyphicon-chevron-down');
                                $(this).children('i').toggleClass('glyphicon-chevron-up');
                                if($('div.filter').is(':visible'))$('div.filter').slideUp();
                                if($('div.filter').is(':hidden'))$('div.filter').slideDown();
                            });
                            $('input[name="oprema_filter"]').on('switchChange.bootstrapSwitch', function(event, state) {
                                $(this).val(state?1:0);console.log(1);
                                filter.akcijaFiltriraj($(this).data('opremaid'),state?'dodaj':'ukloni');
                            });
                            var filter={
                                oprema:JSON.parse('{!!$podaci['filter']!!}'),
                            filter:[],
                                    dodajFilter:function(oprema){this.filter.push(oprema)},
                            ukloniFilter:function(oprema){
                                for(var i=0;i<this.filter.length;i++)
                                    if(this.filter[i]==oprema){
                                        this.filter.splice(i,1);
                                        return;
                                    }
                            },
                            prikaziSakrijSve:function(akcija){
                                if(akcija=='sakrij') $('.smestaj').fadeOut()
                                else $('.smestaj').fadeIn()
                            },
                            prikaziSakrij:function(index,akcija){
                                if(akcija=='sakrij') $('.smestaj-'+index).fadeOut();
                                else $('.smestaj-'+index).fadeIn();
                            },
                            filtriraj:function(){
                                if(this.filter.length>0) this.prikaziSakrijSve('sakrij');
                                else { this.prikaziSakrijSve('prikazi'); return; }
                                var p,p1;
                                for(var s in this.oprema){
                                    p=1;
                                    for(var f=0;f<this.filter.length;f++){
                                        p1=0;
                                        for(var o=0;o<this.oprema[s].length;o++)
                                            if(this.filter[f]==this.oprema[s][o]){ p1=1; break; }
                                        if(!p1){ p=0; break; }
                                    }
                                    if(p) this.prikaziSakrij(s,'prikazi');
                                }
                            },
                            akcijaFiltriraj:function(oprema,akcija){
                                if(akcija=='dodaj') this.dodajFilter(oprema);
                                else this.ukloniFilter(oprema);
                                this.filtriraj();
                            }
                            }

                        </script>


                    </div>
                </div>
            @endif
            <p id="rezultati"></p>
            <div  class="container ">
                <div class="row">
                    <div class="span12">
                        <p class="lead">Izaberite prikaz:</p>
                        <div id="tab" class="btn-group" data-toggle="buttons-radio">
                            <a href="#listing" class="btn btn-large btn-info active" data-toggle="tab"><span class="glyphicon glyphicon-th-list"> </span> Lista</a>
                            <a href="#slike" class="btn btn-large btn-info" data-toggle="tab"><span class="glyphicon glyphicon-th"> </span> Box</a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="listing">
                                <br>
                                @foreach($podaci['rezultat'] as $smestaj)
                                    <div data-cene="{{$smestaj['cena_osoba']}}"  class="smestaj smestaj-{{isset($smestaj['id'])?$smestaj['id']:'app'}}">
                                        <hr>
                                        <div class="col-sm-4">
                                            <a @if(!isset($podaci['pretragaApp'])) href="/{{$smestaj['slugApp']}}/{{$smestaj['slugSmestaj']}}" @else href="/{{$smestaj['slug']}}" @endif >
                                                <img style="height: 150px;" alt="fotografija smeštajnog kapaciteta" @if(isset($podaci['pretragaApp'])) src="/{{\App\OsnovneMetode::randomFotoZaNalog($smestaj['slug'])}}" @elseif($smestaj['naslovna_foto'])src="/{{$smestaj['naslovna_foto']}}" @else src="/{{\App\OsnovneMetode::randomFoto('galerije/'.$smestaj['username'].'/aplikacije/'.$smestaj['slugApp'].'/smestaji/'.$smestaj['slugSmestaj'])}}" @endif>
                                            </a>
                                            <p>
                                                <a @if(!isset($podaci['pretragaApp'])) href="/{{$smestaj['slugApp']}}/{{$smestaj['slugSmestaj']}}" @@else href="/{{$smestaj['slug']}}" @endif  class="btn btn-lg btn-default"><i class="glyphicon glyphicon-zoom-in"></i> Pregled</a>
                                                @if(!isset($podaci['pretragaApp']))
                                                    @if(\App\Security::autentifikacijaTest(2,'min'))
                                                        <button class="btn btn-lg btn-info m" data-toggle="modal" data-target="#rezervacija" data-cena="{{$smestaj['cena_osoba']}}" data-id="{{$smestaj['id']}}" data-app="{{$smestaj['nazivApp']}}" data-naziv="{{$smestaj['naziv']}}" data-vrobjekta="{{$smestaj['vrsta_smestaja']}}" data-maxosoba="{{$smestaj['broj_osoba']}}" data-adresa="{{$smestaj['adresa']}}" data-img="/teme/osnovna-paralax/slike/15.jpg"><span class="glyphicon glyphicon-check"></span> Rezervacija</button>
                                                        <button class="btn btn-lg btn-default _tooltip zelja" @if($smestaj['zelja']) data-zelja="{{$smestaj['zelja']}}" style="color:red" title="Izbaci iz liste zelja" @else data-zelja="false" title="Dodaj u listu želja" @endif data-zid="{{$smestaj['id']}}" data-toggle="tooltip" data-placement="bottom"><i class="glyphicon glyphicon-heart"></i></button>
                                                    @else
                                                        <a href="/log/login" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-check"></span> Rezervacija</a>
                                                        <a href="/log/login" class="btn btn-lg btn-default _tooltip"  title="Dodaj u listu želja" data-toggle="tooltip" data-placement="bottom"><i class="glyphicon glyphicon-heart"></i></a>
                                                    @endif
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <h3 class="smestajNaslov">{{!isset($podaci['pretragaApp'])?$smestaj['nazivApp']:$smestaj['naziv']}}</h3>
                                            <table class="moja-tabela">
                                                @if(!isset($podaci['pretragaApp']))
                                                    <tr><td class="nDn">Naziv objekta:</td><td>{{$smestaj['naziv']}}</td></tr>
                                                    <tr><td class="nDn">Vrsta objekta:</td><td>{{$smestaj['vrsta_smestaja']}}</td></tr>
                                                    <tr><td class="nDn">Broj mesta:</td><td>{{$smestaj['broj_osoba']}}</td></tr>
                                                    <tr><td class="nDn">Adresa:</td><td>{{$smestaj['adresa']}}</td></tr>
                                                    <tr><td class="nDn">Cena (po osobi):</td><td>{{$smestaj['cena_osoba']}} din</td></tr>
                                                @else
                                                    <tr><td class="nDn">Opis:</td><td>{{$smestaj['opis']?$smestaj['opis']:'Opis nije dodat za ovaj brend.'}}</td></tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div><br clear="all">
                                @endforeach
                            </div>
                            <div class="tab-pane" id="slike">
                                <br>
                                @foreach($podaci['rezultat'] as $smestaj)
                                    <div data-cene="{{$smestaj['cena_osoba']}}"  class="smestaj smestaj-{{isset($smestaj['id'])?$smestaj['id']:'app'}}">
                                        <div class="col-sm-4">
                                            <div id="box{{$smestaj['id']}}" style="border:1px solid gray; height: 450px; background-color:#f1f3f4; margin: 25px;">
                                                <div style="position: relative;">
                                                    <a @if(!isset($podaci['pretragaApp'])) href="/{{$smestaj['slugApp']}}/{{$smestaj['slugSmestaj']}}" @else href="/{{$smestaj['slug']}}" @endif >
                                                        <img class="img-responsive" style="max-height: 200px;" alt="fotografija smeštajnog kapaciteta" @if(isset($podaci['pretragaApp'])) src="/{{\App\OsnovneMetode::randomFotoZaNalog($smestaj['slug'])}}" @elseif($smestaj['naslovna_foto'])src="/{{$smestaj['naslovna_foto']}}" @else src="/{{\App\OsnovneMetode::randomFoto('galerije/'.$smestaj['username'].'/aplikacije/'.$smestaj['slugApp'].'/smestaji/'.$smestaj['slugSmestaj'])}}" @endif>
                                                    </a>
                                                    <span style="color:#C2B7A3; position: absolute; top: 0%; left: 0%; opacity: 0.7" class="glyphicon glyphicon-picture">7</span>
                                                    @if(!isset($podaci['pretragaApp']))
                                                        @if(\App\Security::autentifikacijaTest(2,'min'))
                                                            <button style="position: absolute; bottom: 0%; left: 0%;  opacity: 0.7;" class="btn btn-lg btn-default _tooltip zelja" @if($smestaj['zelja']) data-zelja="{{$smestaj['zelja']}}" style="color:red" title="Izbaci iz liste zelja" @else data-zelja="false" title="Dodaj u listu želja" @endif data-zid="{{$smestaj['id']}}" data-toggle="tooltip" data-placement="bottom"><i class="glyphicon glyphicon-heart"></i></button>
                                                        @else
                                                            <a style="position: absolute; z=1000; bottom: 0%; left: 0%;  opacity: 0.7;" href="/log/login" class="btn btn-lg btn-default _tooltip"  title="Dodaj u listu želja" data-toggle="tooltip" data-placement="bottom"><i class="glyphicon glyphicon-heart"></i></a>

                                                        @endif
                                                    @endif
                                                </div>
                                                <p>
                                                    <div class="col-sm-5">
                                                    <a @if(!isset($podaci['pretragaApp'])) href="/{{$smestaj['slugApp']}}/{{$smestaj['slugSmestaj']}}" @@else href="/{{$smestaj['slug']}}" @endif  class="btn btn-lg btn-default"><i class="glyphicon glyphicon-zoom-in"></i> Pregled</a>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        @if(!isset($podaci['pretragaApp']))
                                                            @if(\App\Security::autentifikacijaTest(2,'min'))
                                                                <button class="btn btn-lg btn-info m" data-toggle="modal" data-target="#rezervacija" data-cena="{{$smestaj['cena_osoba']}}" data-id="{{$smestaj['id']}}" data-app="{{$smestaj['nazivApp']}}" data-naziv="{{$smestaj['naziv']}}" data-vrobjekta="{{$smestaj['vrsta_smestaja']}}" data-maxosoba="{{$smestaj['broj_osoba']}}" data-adresa="{{$smestaj['adresa']}}" data-img="/teme/osnovna-paralax/slike/15.jpg"><span class="glyphicon glyphicon-check"></span> Rezervacija</button>
                                                                @else
                                                                <a href="/log/login" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-check"></span> Rezervacija</a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </p>

                                                <h3 style=" padding-left: 5px; font-size: large;" class="smestajNaslov">{{!isset($podaci['pretragaApp'])?$smestaj['nazivApp']:$smestaj['naziv']}}</h3>
                                                <table class="moja-tabela">
                                                    @if(!isset($podaci['pretragaApp']))
                                                        <div style="margin-bottom: 5px; padding-left: 5px;" class="row"><div class="col-md-6">Naziv objekta:</div><div class="col-md-6 ">{{$smestaj['naziv']}}</div></div>
                                                        {{-- <tr><td class="nDn"></td><td></td></tr>--}}
                                                        <div style="margin-bottom: 5px; padding-left: 5px;" class="row"><div class="col-md-6">Vrsta objekta:</div><div class="col-md-6">{{$smestaj['vrsta_smestaja']}}</div></div>

                                                        <div style="margin-bottom: 5px; padding-left: 5px;" class="row"><div class="col-md-6">Broj mesta:</div><div class="col-md-6">{{$smestaj['broj_osoba']}}</div></div>

                                                        <div style="margin-bottom: 5px; padding-left: 5px;" class="row"><div class="col-md-6">Adresa:</div><div class="col-md-6">{{$smestaj['adresa']}}</div></div>

                                                        <div style="margin-bottom: 5px; padding-left: 5px;" class="row"><div class="col-md-6">Cena (po osobi):</div><div class="col-md-6">{{$smestaj['cena_osoba']}}</div></div>
                                                    @else
                                                        <tr><td class="nDn">Opis:</td><td>{{$smestaj['opis']?$smestaj['opis']:'Opis nije dodat za ovaj brend.'}}</td></tr>
                                                    @endif
                                                </table>
                                                </br>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                            $("#box{{$smestaj['id']}}").mouseenter(function(){$(this).css('box-shadow','0 0 15px 4px #888');
                                            $("#box{{$smestaj['id']}}").mouseleave(function(){
                                                        $(this).css('box-shadow','none');
                                                      });});
                                        </script>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                            {!! Form::text('datumOd', date("Y-m-d"), ['class'=>'input-sm form-control datum','placeholder'=>'od...','id'=>'datumod','style'=>'padding:20px']) !!}
                                            <span class="input-group-addon">do</span>
                                            {!! Form::text('datumDo', null, ['class'=>'input-sm form-control datum','placeholder'=>'do...','id'=>'datumdo','style'=>'padding:20px']) !!}
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
                $('#broj_osoba').change(function(){racunajCenu()});
                $('input.datum').change(function(){racunajCenu()});
                function racunajCenu(){
                    var cena=$('input[name=cena]').val()*$('#broj_osoba').val()*((new Date($('#datumdo').val())-new Date($('#datumod').val()))/86400000);
                    $('#cena').html($.isNumeric(cena)?cena+' din':'Izaberite period.');
                    $('input[name=ukupna_cena]').val(cena);
                }
                $("button.zelja").click(function(){
                    $(this).css("color","black");
                    $(this).html("<i class='icon-spin6 animate-spin'></i>");
                    var id=$(this).data("zid");
                    $.post('/aplikacija/lista-zelja-dodaj',
                            {
                                _token: $('input[name="_token"]').val(),
                                smestaj: $(this).data("zid"),
                                korisnik: "{{Session::get("id")}}",
                                zelja: $(this).data("zelja")
                            },
                            function(data){
                                $('button[data-zid="'+id+'"]').html("<i class='glyphicon glyphicon-heart'></i>");
                                if($('button[data-zid="'+id+'"]').data('zelja')!=false){
                                    $('button[data-zid="'+id+'"]').data('zelja',false);
                                    $('button[data-zid="'+id+'"]').css("color","black");
                                } else{
                                    $('button[data-zid="'+id+'"]').data('zelja',data);
                                    $('button[data-zid="'+id+'"]').css("color","red");
                                }
                            }
                    );
                });
            </script>
        @else
            <br clear="all"><p>Nema rezultata za date parametre. Proverite parametre i pokušajte ponovo.</p>
        @endif
    @else
        <br clear="all"><p>Nema rezultata za date parametre. Proverite parametre i pokušajte ponovo.</p>
    @endif
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
@endsection

   