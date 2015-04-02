var myCenter=new google.maps.LatLng(mx, my);
var marker;

function initialize()
{
    var mapProp = {
        scrollwheel: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
        draggable: false,

        center:myCenter,
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };

    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

    var marker=new google.maps.Marker({
        position:myCenter
        //,animation:google.maps.Animation.BOUNCE
    });

    marker.setMap(map);

    var infowindow = new google.maps.InfoWindow({
        content:"<b><center>Hostel Jedro<center></b>" +
                "<span><i>ul. Tošin Bunar 148 Novi Beograd</i></span>"
    });

    infowindow.open(map,marker);
}
google.maps.event.addDomListener(window, 'load', initialize);