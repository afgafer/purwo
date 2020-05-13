@extends('layouts.app')
@section('content')

@if ($message = Session::get('message'))
 <div class="alert alert-success martop-sm">
 <p>{{ $message }}</p>
 </div>
@endif
<h1 class="title">hotels</h1>
<div class="card-columns">
            @forelse($hotels as $h)
            @php
            $dirF='upload/img/'.$h->file;
            $src=asset($dirF);
            @endphp
            <div class="card p-0 bg-transparent">
                <a class="text-white" href="{{route('hotel.showA',$h->id)}}">
                <img src="{{$src}}" class="card-img-top" alt="{{$h->file}}">
                <div class="card-body text-center bg-secondary">
                    <h5 >{{$h->name}}</h5>
                    <!-- <div>
                        <a href="{{route('dest.show',$h->id)}}" class="btn btn-primary btn-sm">read more</a>
                        <a href="{{route('dest.edit',$h->id)}}" class="btn btn-primary btn-sm">edit</a>
                        <form action="{{route('dest.destroy',$h->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">delete</button>
                        </form>
                    </div> -->
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