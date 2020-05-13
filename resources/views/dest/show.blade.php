@extends('layouts.app')
@section('content')

<h1 class="title " id="name">{{$dest->name}}</h1>
<hr>
        <div class="row p-2 justify-content-center">
            <div class="card p-0 col-md-6 bg-transparent m-2">
            @php
            $dirF='upload/img/'.$dest->file;
            $src=asset($dirF);
            @endphp
                <img src="{{$src}}" class="card-img-top" alt="{{$dest->file}}">
                <div class="card-body">
                    <table class="table table-sm mb-2">
                        <tbody>
                            <tr>
                                <td>contact</td>
                                <td>: {{$dest->contact}}</td>
                            </tr>
                            <tr>
                                <td>lat :</td>
                                <td id="lat">{{$dest->lat}}</td>
                            </tr>
                            <tr>
                                <td>lng :</td>
                                <td id="lng">{{$dest->lng}}</td>
                            </tr>
                            <tr>
                                <td>address</td>
                                <td>: {{$dest->address}} </td>
                            </tr>
                            <tr>
                                <td>address</td>
                                <td>: {{$dest->address}} </td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="card-title">desc :</h5>
                    <p>{{$dest->desc}}</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur laudantium ab expedita quibusdam tempora ullam officia culpa eveniet. Adipisci officia quaerat tempora inventore numquam dicta natus. Exercitationem consequatur deleniti nulla fugiat totam sit odio ex quas voluptas eius deserunt reprehenderit officiis velit praesentium necessitatibus ut, iusto eaque aspernatur nemo quod minus? Quas dolorum omnis vitae! Atque ipsa, molestias, facilis quidem dicta reiciendis fugiat non hic molestiae repellendus, cum nemo pariatur architecto? Excepturi nam, facere molestias a dicta vero fugiat sint aspernatur, praesentium ad molestiae qui velit dignissimos. Officiis, aspernatur dolorum? Iusto facilis, voluptates ipsam, cum optio quaerat libero nobis dolor eos incidunt quos veniam placeat asperiores quisquam quo excepturi provident quam reiciendis omnis? Perspiciatis autem quas neque in molestias voluptatem quibusdam voluptates pariatur numquam deleniti illum necessitatibus placeat, sint provident distinctio earum illo et, error asperiores eaque at aliquid aliquam sunt? Porro ea, sit voluptate cupiditate accusamus pariatur in fugit eveniet dolor ratione. Repellat maxime voluptas dolor optio odio perspiciatis magnam doloremque officia? Explicabo sint quam numquam, asperiores tenetur accusantium at voluptatibus maxime praesentium itaque quasi delectus tempore? Exercitationem inventore quod animi earum minus? Exercitationem at reprehenderit sapiente quia corporis ad officia beatae quaerat voluptatum omnis earum eum optio assumenda provident doloremque consequuntur, nobis ipsam? Vel adipisci molestias qui magnam consequuntur odit expedita, tenetur nihil iure exercitationem quasi eligendi culpa nemo minus aperiam veniam iste accusantium? Esse pariatur officia ipsum voluptates voluptas error nihil cum architecto. Aperiam consectetur fugiat perferendis molestiae ad facilis architecto, veritatis corrupti, a magnam dolores ullam alias asperiores qui natus? Provident eum ex adipisci aperiam deserunt rem animi, autem blanditiis dolorem pariatur cupiditate quibusdam deleniti illum quasi. Porro, atque. Eaque perspiciatis inventore est repellat autem maxime eius excepturi esse velit nihil sequi consequuntur architecto enim aliquam, nesciunt quam dolore recusandae quas odio adipisci doloribus possimus consequatur. Dolor est soluta nostrum, provident, explicabo nihil ab rem nisi ratione ipsa vitae nesciunt fugiat omnis natus aliquid vel. Officia eligendi cum dolorum iure perspiciatis error delectus veniam ex aliquam, corrupti minus fuga in quia est, eos, ratione distinctio assumenda ipsum id cupiditate nesciunt earum consectetur laborum? Qui, possimus labore? Nam impedit deleniti vero maxime aliquid quo, ipsam ut aut nemo possimus magnam? Quos earum eveniet totam nihil, dolore excepturi repellat reiciendis aliquid. Minima ipsa possimus commodi quia assumenda, veniam corrupti vitae ratione veritatis facere vel, in harum quisquam impedit consequuntur eius maiores, nihil ab! Fugiat, ipsum! Assumenda provident nesciunt, voluptatem deserunt possimus beatae perferendis accusamus odio sequi numquam necessitatibus dolor laborum consequuntur magnam ut eveniet quos corrupti voluptas! Ullam nesciunt accusamus corrupti explicabo laudantium minus, vel delectus distinctio temporibus at illo fuga minima debitis repudiandae sequi ex amet cum hic optio quaerat ut et perspiciatis. Perferendis maiores molestiae voluptatem, rem eligendi ab corrupti officiis pariatur aperiam perspiciatis facere consequatur expedita corporis, unde amet nemo impedit, iure commodi eos neque architecto sint exercitationem libero minus. Magnam quam, exercitationem doloribus et ipsa eligendi natus molestiae beatae quod quos rerum mollitia deleniti, placeat hic architecto, possimus asperiores facere autem! Ducimus, maiores totam!</p>
                </div>
                <div class="card-footer">
                    <!-- <small class="text-muted"><a class="btn btn-primary" href="{{route('dest.edit',$dest->id)}}">edit</a></small> -->
                </div>
            </div>
            <div class="card p-0 col-md-5 bg-transparent m-2">
            <div id="map" style="width:100%;height:300px;"></div>
                <div class="card-body">
                <h5 class="card-title">hotel list</h5>
                    <table class="table table-sm mb-2">
                        <tbody>
                            @forelse($hotels as $h)
                            <tr>
                                <td>-</td>
                                <td>{{$h->name}}</td>
                                <td>{{$h->contact}}</td>
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
                var glatval={{$dest->lat}};
                var glngval={{$dest->lng}};
                var gname='{{$dest->name}}';
                //console.log(val.name);
                var GLatLng = new google.maps.LatLng(glatval, glngval);
                var gicn= 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
                createMarker(GLatLng,gicn,gname);
    }
    }); 
    </script>
@endsection