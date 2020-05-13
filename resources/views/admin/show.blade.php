@extends('layouts.app')
@section('content')
            <div class="row p-2">
            <div class="card p-0 col-md-6">
            @php
            $dirF='upload/img/'.$user->file;
            $src=asset($dirF);
            @endphp
                <img src="{{$src}}" class="card-img-top" alt="{{$user->file}}">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <table class="table table-sm bg-white mb-2">
                        <tbody>
                            <tr>
                                <td>name</td>
                                <td>: {{$user->name}}</td>
                            </tr>
                            <tr>
                                <td>contact</td>
                                <td>: {{$user->contact}}</td>
                            </tr>
                            <tr>
                                <td>address</td>
                                <td>: {{$user->address}} </td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="card-title">desc :</h5>
                    <p><?=$user->desc?></p>
                </div>
                <div class="card-footer">
                    <!-- <small class="text-muted"><a class="btn btn-primary" href="{{route('dest.edit',$user->id)}}">edit</a></small> -->
                </div>
            </div>
            <!-- <div class="card p-0 col-md-6">
            <div id="map" style="width:100%;height:300px;"></div>
                <div class="card-body">
                    <table class="table table-sm bg-light mb-2">
                        <tbody>
                            <tr class="bg-primary text-white">
                                <th>id</th>
                                <th>room</th>
                                <th>slot</th>
                            </tr>
                            @foreach($user->room as $r)
                            <tr>
                                <td>{{$r->id}}</td>
                                <td>: {{$r->name}}</td>
                                <td>: {{$r->slot}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> -->
            </div>
 @endsection
 @section('script')
    <!-- <script crossorigin="anonymous" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6DzQ7KQPGFV7-F9mcF-Yy5SD4Dm1IiYI&libraries=places" type="text/javascript"></script>
    <script src="{{asset('index.js')}}"></script> -->
@endsection