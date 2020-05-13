@extends('layouts.app')
@section('content')
<h1 class="text-center title">dests</h1>
<div class="card-columns">
            @forelse($images as $i)
            @php
            $dirF='upload/img/'.$i->file;
            $src=asset($dirF);
            @endphp
            <div class="box">
                <a class="text-white" href="{{route('image.show',$i->id)}}">
                <img src="{{$src}}" class="card-img-top" alt="{{$i->file}}">
                <div class="overlay">
                    <h5 >{{$i->name}}</h5>
                </div>
                </a>
            </div>
            @empty
            <div class="card p-0">
                <div class="card-body">
                    <h5>empty</h5>
                </div>
            </div>
            @endforelse
</div>
@endsection