@extends('layouts.app')
@section('content')

@if ($message = Session::get('message'))
 <div class="alert alert-success martop-sm">
 <p>{{ $message }}</p>
 </div>
@endif
<h1 class="title">dests</h1>
<hr>
<div class="card-columns">
            @forelse($dests as $d)
            @php
            $dirF='upload/img/'.$d->file;
            $src=asset($dirF);
            @endphp
            <div class="card p-0 bg-transparent">
                <a class="text-white" href="{{route('dest.showA',$d->id)}}">
                <img src="{{$src}}" class="card-img-top" alt="{{$d->file}}">
                <div class="card-body text-center bg-secondary">
                    <h5 >{{$d->name}}</h5>
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