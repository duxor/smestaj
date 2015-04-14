@extends('aplikacija.master-paralax-1')
@section('head')
    <script type="text/javascript">
        var map;var markers, spotlight, locationsByType = {};
        function initMap() {
            var template = 'http://ecn.t{S}.tiles.virtualearth.net/tiles/r{Q}?g=689&mkt=en-us&lbl=l0&stl=m';//'http://ecn.t{S}.tiles.virtualearth.net/tiles/r{Q}?g=689&mkt=en-us&lbl=l0&stl=m';//'http://c.tiles.mapbox.com/v3/examples.map-szwdot65/{Z}/{X}/{Y}.png';//'http://{S}tile.openstreetmap.org/{Z}/{X}/{Y}.png';
            var subdomains =[0,1,2,3,4,5,6,7];// [ '', 'a.', 'b.', 'c.' ];
            var provider = new com.modestmaps.TemplatedLayer(template, subdomains);
            map = new com.modestmaps.Map('map',
                    provider,
                    null, [
                        new com.modestmaps.TouchHandler(),
                        //new com.modestmaps.MouseHandler()
                    ]);
            markers = new MM.MarkerLayer();
            //map.setCenterZoom(new com.modestmaps.Location(45.311149,15.7401466), 6);

            map.addLayer(markers);
            loadMarkers();
        }
        function loadMarkers() {
            var script = document.createElement("script");
            script.src = "/markeri-gradovi";
            document.getElementsByTagName("head")[0].appendChild(script);
        }
        function onLoadMarkers(collection) {
            var features = collection.features,
                    len = features.length,
                    locations = [];
            for (var i = 0; i < len; i++) {
                var feature = features[i],
                        type = feature.properties.crime_type,
                        marker = document.createElement("a");

                marker.feature = feature;
                marker.type = type;

                // give it a title
                /*marker.setAttribute("title", [
                    type, "on", feature.properties.date_time
                ].join(" "));
                */
                marker.setAttribute("class", "report");
                // set the href to link to crimespotting's crime page
                marker.setAttribute("href", "#");// + [
                /*    feature.properties.date_time.substr(0, 10),
                 type.replace(/ /g, "_"),
                 feature.id
                 ].join("/"));
                 */
                // create an image icon
                var img = marker.appendChild(document.createElement("a"));
                img.setAttribute("class","glyphicon glyphicon-flag");//glyphicon glyphicon-pushpin");//("src", "../geojson/icons/" + type.replace(/ /g, "_") + ".png");
                img.setAttribute("style","color:#5104ff;font-size:26px");
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
            map.setCenterZoom(new com.modestmaps.Location(44.311149,17.7401466), 7);//45.311149,15.7401466), 6);
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

@section('body')
    {{--pocetna START::--}}
    <div
            class="parallax-image-wrapper parallax-image-wrapper-100"
            data-anchor-target="#{{$podaci[0]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 150%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-100"
                style="background-image:url('{{$podaci['pozadine'][0]}}')"
                data-anchor-target="#{{$podaci[0]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -80%, 0px);"
                data-top-bottom="transform: translate3d(0px, 80%, 0px);"
                ></div>
    </div>
    {{--pocetna END::--}}

    {{--Smestaj START::--}}
    <div
            class="parallax-image-wrapper parallax-image-wrapper-100"
            data-anchor-target="#{{$podaci[1]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 200%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-100"
                style="background-image:url('{{$podaci['pozadine'][1]}}')"
                data-anchor-target="#{{$podaci[1]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -80%, 0px);"
                data-top-bottom="transform: translate3d(0px, 80%, 0px);"
                ></div>
    </div>
    {{--Smestaj END::--}}

    {{--Rezervacije START::--}}
    <div
            class="parallax-image-wrapper parallax-image-wrapper-50"
            data-anchor-target="#{{$podaci[2]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 320%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-50"
                style="background-image:url('{{$podaci['pozadine'][2]}}')"
                data-anchor-target="#{{$podaci[2]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -60%, 0px);"
                data-top-bottom="transform: translate3d(0px, 60%, 0px);"
                ></div>
    </div>
    {{--Rezervacije END::--}}

    {{--Kontakt START::--}}
    <div
            class="parallax-image-wrapper parallax-image-wrapper-100"
            data-anchor-target="#{{$podaci[3]['slug']}} + .gap"
            data-bottom-top="transform:translate3d(0px, 300%, 0px)"
            data-top-bottom="transform:translate3d(0px, 0%, 0px)">

        <div
                class="parallax-image parallax-image-50"
                style="background-image:url('{{$podaci['pozadine'][3]}}')"
                data-anchor-target="#{{$podaci[3]['slug']}} + .gap"
                data-bottom-top="transform: translate3d(0px, -60%, 0px);"
                data-top-bottom="transform: translate3d(0px, 60%, 0px);"
                ></div>
    </div>
    {{--Kontakt END::--}}

    <div id="skrollr-body">
        {{--pocetna START::--}}
        <div class="content content-full" id="{{$podaci[0]['slug']}}"><div id="map" style="height:650px;margin-top:-80px;width:104%;margin-left: -3%;overflow:hidden"></div>
            <div class="container" style="margin-top: -500px">
                <div class="col-sm-5">
                    <div style="
                        padding: 10px 30px;
                        background-color: #262626;
                        color:#fff;
                        -webkit-border-radius: 10px;
                        -moz-border-radius: 10px;
                        border-radius: 10px;
                    ">
                        <p><i class="glyphicon glyphicon-search"></i> Pronađite savršen smeštaj</p>
                        <div role="tabpanel">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab-rezervacije" aria-controls="tab-rezervacije" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i> Rezervacije</a></li>
                                <li role="presentation"><a href="#tab-objekti" aria-controls="tab-objekti" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-home"></i> Objekti</a></li>
                            </ul>
                            <div class="tab-content" style="padding:0 10px">
                                <div role="tabpanel" class="tab-pane fade in active" id="tab-rezervacije">

                                    {!!Form::open(['url'=>'/pretraga','class'=>'form-horizontal'])!!}
                                    {!!Form::hidden('tacan_broj',1)!!}
                                    <div class="form-group">
                                        {!!Form::label('lgrad','Grad',['class'=>'control-label'])!!}
                                        {!!Form::select('grad_id',$podaci['grad'],1,['class'=>'form-control'])!!}
                                    </div>
                                    <div class="form-group" id="datarange">
                                        {!!Form::label('lperiod','Izaberite period',['class'=>'control-label'])!!}
                                        <div class="input-daterange input-group col-sm-12" id="datepicker">
                                            {!! Form::text('datumOd', null, ['class'=>'input-sm form-control','placeholder'=>'od...']) !!}
                                            <span class="input-group-addon">do</span>
                                            {!! Form::text('datumDo', null, ['class'=>'input-sm form-control','placeholder'=>'do...']) !!}
                                        </div>
                                    </div>
                                    <script>
                                        $('#datarange .input-daterange').datepicker({
                                            orientation: "top auto",
                                            weekStart: 1,
                                            startDate: "current",
                                            todayBtn: "linked",
                                            toggleActive: true,
                                            format: "yyyy-mm-dd"
                                        });
                                    </script>
                                    <div class="form-group">
                                        {!!Form::label('lgrad','Broj osoba',['class'=>'control-label'])!!}
                                        {!!Form::select('broj_osoba',[1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12],2,['class'=>'form-control'])!!}
                                    </div>
                                    <div class="form-group" style="text-align: right">
                                        {!!Form::button('<i class="glyphicon glyphicon-search"></i> Pretraga',['class'=>'btn btn-lg btn-primary','type'=>'submit'])!!}
                                    </div>
                                    {!!Form::close()!!}
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab-objekti">
                                    Pretraga po nazivu smeštajnog kapaciteta (po brendu).
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-sm-7">
                    <div style="width: 100%; height: 500px"></div>
                </div>
            </div>
        </div>
        <div class="gap gap-100"></div>
        {{--pocetna END::--}}

        {{--Smestaj START::--}}
        <div class="content-full container" id="{{$podaci[1]['slug']}}">
                <h1>{!!$podaci[1]['naziv']!!}</h1>
                {!!$podaci[1]['sadrzaj']!!}
        </div>
        <div class="gap gap-100"></div>
        {{--Smestaj END::--}}

        {{--Rezervacije START::--}}
        <div class="content content-full" id="{{$podaci[2]['slug']}}">
            <div class="container">
                <h1>{!!$podaci[2]['naziv']!!}</h1>
                {!!$podaci[2]['sadrzaj']!!}
            </div>
        </div>
        <div class="gap gap-50"></div>
        {{--Rezervacije END::--}}

        {{--Kontakt START::--}}
        <div class="content" id="{{$podaci[3]['slug']}}">
            <div class="container">
                <h1>{!!$podaci[3]['naziv']!!}</h1>
                {!!$podaci[3]['sadrzaj']!!}
            </div>
        </div>
        <div class="gap gap-100"></div>
        {{--Kontakt END::--}}

        {{--footer START::--}}
        <div class="content" id="done" style="height: 200px;">
            <div class="container">
                <div class="col-sm-10">
                    <p>Autor: Dušan Perišić</p>
                    <a href="http://dusanperisic.com" class="btn btn-lg btn-primary"><i>dusanperisic.com</i></a>
                </div>
                <div class="col-sm-2">
                    <a href="{!!url('/administracija')!!}" class="btn btn-lg btn-default"><i class="glyphicon glyphicon-cog"></i> Administracija</a>
                </div>
            </div>
        </div>
        {{--footer END::--}}

    </div>

    {{--MODAL:: posalji mail START::--}}
    <div class="modal fade" id="posaljiMail">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2>Kontaktirajte nas putem email-a</h2>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url'=>'/posalji-email','class'=>'form-horizontal','id'=>'kontaktForma']) !!}
                    <div id="dk_ime" class="form-group has-feedback">
                        {!! Form::label('lime','Ime',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('k_ime', null, ['class'=>'form-control', 'placeholder'=>'Ime i Prezime', 'id'=>'k_ime']) !!}
                            <span id="sk_ime" class="glyphicon form-control-feedback"></span>
                        </div>
                    </div>

                    <div id="dk_email" class="form-group has-feedback">
                        {!! Form::label('lemail','Email',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::email('k_email', null, ['class'=>'form-control', 'placeholder'=>'Email','id'=>'k_email']) !!}
                            <span id="sk_email" class="glyphicon form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('ltelefon','Telefon',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('telefon', null, ['class'=>'form-control', 'placeholder'=>'Telefon']) !!}
                        </div>
                    </div>

                    <div id="dk_poruka" class="form-group has-feedback">
                        {!! Form::label('lporuka','Poruka',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea('k_poruka', null, ['class'=>'form-control', 'placeholder'=>'Poruka','id'=>'k_poruka']) !!}
                            <span id="sk_poruka" class="glyphicon form-control-feedback"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::button('<span class="glyphicon glyphicon-envelope"></span> Pošalji', ['class'=>'btn btn-lg btn-primary', 'onClick'=>'SubmitForma.submit("kontaktForma")']) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Obriši sve', ['class'=>'btn btn-lg btn-danger', 'type'=>'reset']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    {{--MODAL:: posalji mail END::--}}
@stop