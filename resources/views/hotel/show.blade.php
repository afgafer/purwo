@extends('layouts.app')
@section('content')
<div class="bg-white p-2">
<h1 class="title " id="name">{{$hotel->name}}</h1>
<hr>
            <div class="row p-2 justify-content-center">
            <div class="card p-0 col-md-6 m-2 border-white">
            @php
            $dirF='upload/img/'.$hotel->file;
            $src=asset($dirF);
            @endphp
                <img src="{{$src}}" class="card-img-top" alt="{{$hotel->file}}">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <table class="table table-sm bg-white mb-2">
                        <tbody>
                            <tr>
                                <td>name</td>
                                <td>: {{$hotel->name}}</td>
                            </tr>
                            <tr>
                                <td>contact</td>
                                <td>: {{$hotel->contact}}</td>
                            </tr>
                            <tr>
                                <td>address</td>
                                <td>: {{$hotel->address}} </td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="card-title">desc :</h5>
                    <p><?=$hotel->desc?></p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint ab provident ex minima voluptates enim doloremque omnis necessitatibus qui, quisquam id labore aliquid aliquam fuga neque quo quae nulla iusto quod tempore officiis tempora velit. Obcaecati minus fuga id eligendi. Cupiditate blanditiis, ex nemo nesciunt consequuntur earum dolorum consectetur eaque aut dignissimos quas, qui quis cumque aperiam obcaecati ea ratione ipsum recusandae libero quo molestiae? In, amet earum doloribus accusamus labore quisquam esse deserunt qui quos, iure voluptates ab perspiciatis culpa inventore minus sequi voluptatum debitis quis iusto unde magnam necessitatibus dolorem similique totam? Unde cupiditate ducimus vel tempora expedita ratione dolores delectus totam accusamus facere id fugit cumque neque officia quia vitae consectetur non mollitia eos, aliquam sapiente eligendi nam debitis soluta? Tempore, voluptate praesentium quasi possimus dignissimos quibusdam ullam. Totam quo ex quibusdam. Quaerat omnis adipisci voluptate id sunt facere nam aliquam molestiae rerum non. Nesciunt ducimus ratione assumenda vel accusamus est harum temporibus modi non, libero ut, labore, atque optio voluptatem repellendus voluptatibus quod minus error facilis corporis! Id quia ea ratione illo, eaque impedit nulla distinctio! Molestias aliquam quas officia totam quae quos! Laborum sunt ut dolor cupiditate necessitatibus dolorem sequi, beatae ad exercitationem? Amet consectetur provident ipsam dolores sequi, beatae repellat, quae aspernatur eaque ratione nesciunt, ipsum inventore pariatur quo est distinctio vel nulla odit earum praesentium eveniet qui libero. Iste, alias! Alias, rem laudantium adipisci saepe recusandae eum ipsa dolor et quas veniam blanditiis voluptates eos. Incidunt, dolorem sed. Quidem dolorem odit temporibus perferendis dolorum aliquam iste et, consequatur delectus vel? Sapiente rem inventore ipsam eum aliquam optio dignissimos nesciunt, repudiandae quasi numquam error repellendus praesentium expedita quibusdam quas officiis quos atque rerum magnam consectetur? Rem tempora temporibus sint deserunt dicta facere adipisci debitis quia ex laborum minima, illum perspiciatis assumenda laudantium? Corrupti velit consectetur vel accusamus repellendus est fugiat, officia itaque harum vitae. Quasi soluta natus, earum laboriosam quisquam quia officiis inventore distinctio veniam voluptates nam fugit molestias accusantium fugiat magni minus deleniti ex ab aliquid fuga hic impedit saepe consequatur. Dicta iste esse sed dolorum exercitationem provident? Tempora commodi recusandae ipsa excepturi facere obcaecati nobis impedit, eos, neque provident tempore modi eius animi fugiat delectus. Repellendus a cupiditate aut eligendi perspiciatis unde dolore, eaque minus? Neque mollitia, nemo commodi ab vel maiores deleniti, exercitationem unde voluptas fuga accusamus. Placeat dolorum ab ullam laudantium animi voluptates, natus laboriosam quasi nam ipsa quod, velit magni illum vitae. Molestias nemo nesciunt sequi aliquid, iste assumenda, praesentium labore et voluptate quibusdam autem vitae quasi quos aut voluptates consectetur modi deleniti quae magni beatae officia obcaecati ad? Quos cumque laudantium cum ab minus. Tenetur ratione necessitatibus quis! Animi saepe molestias quam soluta inventore suscipit culpa hic magnam nihil ducimus illum quisquam accusantium impedit ullam nisi praesentium ipsa possimus, exercitationem cumque? Laudantium unde, laborum exercitationem magnam ab odio molestias odit enim, cum dignissimos modi a sequi ex vero. Minima, natus quae, maxime nesciunt vitae autem placeat, mollitia ratione sunt labore corporis aliquam? Quos quam eius nostrum harum iste.</p>
                </div>
                <div class="card-footer">
                    <!-- <small class="text-muted"><a class="btn btn-primary" href="{{route('dest.edit',$hotel->id)}}">edit</a></small> -->
                </div>
            </div>
            <div class="card p-0 col-md-5 m-2  border-white">
            <div id="map" style="width:100%;height:300px;"></div>
                <div class="card-body">
                <h5 class="card-title">room list</h5>
                    <table class="table table-sm mb-2">
                        <tbody>
                            @forelse($hotel->room as $r)
                            <tr>
                                <td>-</td>
                                <td>{{$r->name}}</td>
                                <td>{{$r->slot}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td>empty</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
</div>
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
            zoom: 4    
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
                var glatval={{$hotel->lat}};
                var glngval={{$hotel->lng}};
                var gname='{{$hotel->name}}';
                //console.log(val.name);
                var GLatLng = new google.maps.LatLng(glatval, glngval);
                var gicn= 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
                createMarker(GLatLng,gicn,gname);
    }
    }); 
    </script>
@endsection