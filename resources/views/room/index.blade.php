@extends('layouts.app')
@section('content')
@if (Session::get('message'))
@php
$message = Session::get('message');
@endphp
 <div class="alert alert-success martop-sm">
 <p>{{ $message }}</p>
 </div>
@endif
<h1 class="title">rooms</h1>
<hr>
<a href="{{route('room.create')}}" class="btn btn-primary btn-sm">create</a>
<div class="card-columns">
            @forelse($rooms as $r)
            @php
            $dirF='upload/img/'.$r->file;
            $src=asset($dirF);
            $price=number_format($r->price,0,',','.');
            @endphp
            <div class="card p-0">
                <a class="text-dark" href="{{route('room.show',$r->id)}}">
                <img src="{{$src}}" class="card-img-top" alt="{{$r->file}}">
                <div class="card-body">
                    <h5 class="card-title text-white badge badge-primary">No {{$r->id}}</h5>
                    <h5 class="card-title border badge badge-light">Rp {{$r->price}}</h5>
                    <table class="table table-sm bg-white mb-2 ">
                        <tbody>
                            <tr>
                                <td >Name</td>
                                <td>: {{$r->name}}</td>
                            </tr>
                            <tr>
                                <td>hotel</td>
                                <td>: {{$r->hotel->name}}</td>
                            </tr>
                            <tr>
                                <td>bed</td>
                                <td>: {{$r->bed}}</td>
                            </tr>
                            <tr>
                                <td>quota</td>
                                <td>: {{$r->quota}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </a>
            </div>
            @empty
            <div class="card p-0">
                <div class="card-body">
                    <h5>empty</h5>
                </div>
            </div>
            <h5>empty</h5>
            @endforelse
</div>
@endsection