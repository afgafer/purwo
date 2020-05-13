@extends('layouts.app')
@section('content')
<div id="map" class="position-absolute" style="width:100%;height:500px;left:0;top:0;"></div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script crossorigin="anonymous" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6DzQ7KQPGFV7-F9mcF-Yy5SD4Dm1IiYI&libraries=places" type="text/javascript"></script>
    <script>
    var map;
    var myLatLng;
    $(document).ready(function() {
        geoLocationInit();

        function geoLocationInit() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, fail);
        } else {
            alert("Browser not supported");
        }
    }

    function success(position) {
        console.log(position);
        var latval = position.coords.latitude;
        var lngval = position.coords.longitude;
        myLatLng = new google.maps.LatLng(latval, lngval);
        createMap(myLatLng);
        search();
    }

    function fail() {
        alert("it fails");
    }

    function createMap(myLatLng) {
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 8    
        });
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map
        });
    }

    function createMarker(latlng, icn, name) {
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: icn,
            title: name
        });
    }
    function search(){
        $.get('http://localhost:8000/api/dest',function(match){
            $.each(match,function(i,val){
                var glatval=val.lat;
                var glngval=val.lng;
                var gname=val.name;
                console.log(val.name);
                var GLatLng = new google.maps.LatLng(glatval, glngval);
                var gicn= 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
                createMarker(GLatLng,gicn,gname);
            });
        });
    }
}); 
    </script>
@endsection