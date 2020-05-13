@extends('layouts.app')
@section('content')
            <div class="card p-0 col-md-6">
            <?php
            $src='/upload/img/'.$room->file;
            ?>
                <img src="{{$src}}" class="card-img-top" alt="{{$room->image}}">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <table class="table table-sm bg-white mb-2">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>: {{$room->name}}</td>
                            </tr>
                            <tr>
                                <td>price</td>
                                <td>: {{$room->price}}</td>
                            </tr>
                            <tr>
                                <td>bed</td>
                                <td>: {{$room->bed}}</td>
                                <td>quota</td>
                                <td>: {{$room->quota}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="card-title">description :</h5>
                    <p>{{$room->desc}}</p>
                </div>
                <div class="card-footer">
                </div>
            </div>
 @endsection
