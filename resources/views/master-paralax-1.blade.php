<!--
         _____ _ _ __\/_____ __ _   ___ ___ ___ _ __\/___ _/___
        |_    | | |  ___/   |  \ | |   | __|   | |  ___/ |  __/
         _| | | | |___  | ^ | |  | | ^_| __| ^_| |___  | | |__
        |_____|_,_|_____|_|_|_|__| |_| |___|_|\ _|_____|_|____|

        Hvala što se interesujete za kod :)

        Kontakt za developere: kontakt@dusanperisic.com

-->

<!DOCTYPE html>
<html lang="sr" class="no-skrollr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <title>najSmestaj</title>
    {!! HTML::style('teme/osnovna-paralax/css/templejt.css') !!}
    {!! HTML::style('css/bootstrap.min.css') !!}
    {!! HTML::style('teme/osnovna-paralax/css/parallax.css') !!}
    {!! HTML::style('css/datepicker.css') !!}

    @if(isset($podaci['x']))
        {!! HTML::script('http://maps.googleapis.com/maps/api/js') !!}
        <script>var mx="{{$podaci['x']}}", my="{{$podaci['y']}}";</script>
        {!! HTML::script('js/gmap1.js') !!}
    @endif
    {!! HTML::script('js/jquery-3.0.js') !!}
    {!! HTML::script('js/datepicker.js') !!}

    {!!HTML::script('js/map/modestmaps.js')!!}
    {!!HTML::script('js/map/modestmaps.markers.js')!!}
    {!!HTML::script('js/map/spotlight.js')!!}
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
                        new com.modestmaps.MouseHandler()
                    ]);
            markers = new MM.MarkerLayer();
            map.setCenterZoom(new com.modestmaps.Location(45.311149,15.7401466), 6);

            map.addLayer(markers);
            loadMarkers();
        }
        function loadMarkers() {
            var script = document.createElement("script");
            script.src = "/markeri";
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
                marker.setAttribute("title", [
                    type, "on", feature.properties.date_time
                ].join(" "));
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
            map.setCenterZoom(new com.modestmaps.Location(45.311149,15.7401466), 6);
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
</head>

<body onload="initMap()">
{{--navigacija START::--}}
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">
                <span class="glyphicon glyphicon-home"></span> najSmestaj
            </a>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @foreach($podaci as $k => $meni)
                    @if(isset($meni['vrsta_sadrzaja_id']))
                        @if($meni['vrsta_sadrzaja_id']==1)
                            <li><a href="/#{{$meni['slug']}}" class="scroll-link" data-id="{{$meni['slug']}}"><i class="{{$podaci['icon'][$k]}}"></i> {!! $meni['naziv'] !!}</a></li>
                        @endif
                    @endif
                @endforeach
                @if(\App\Security::autentifikacijaTest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Profil <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="glyphicon glyphicon-eye-open"></i> Pregled</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-pencil"></i> Uredi</a></li>
                            <li><a href="/administracija/logout"><i class="glyphicon glyphicon-off"></i> Odjava</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="/profil/login"><i class="glyphicon glyphicon-log-in"></i> Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
{{--navigacija END::--}}

<div class="container">
    @yield('content')
</div>

@yield('body')
{!! HTML::script('teme/osnovna-paralax/js/skrollr.min.js') !!}
<script type="text/javascript">
    skrollr.init({
        smoothScrolling: false,
        mobileDeceleration: 0.004
    });
</script>

@if(!isset($podaci['foother']))
    <div class="footer">
        <div class="container">
            <div class="col-sm-10">
                <p class="text-muted">Autor: Dušan Perišić</p>
                <a href="http://dusanperisic.com" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-hand-right"></span> <i>dusanperisic.com</i></a>
            </div>
            <div class="col-sm-2">
                <a href="{!! url('/administracija') !!}" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-cog"></span> Administracija</a>
            </div>
        </div>
    </div>
@endif

{!! HTML::script('js/bootstrap.min.js') !!}
{!! HTML::script('js/funkcije.js') !!}

</body>
</html>