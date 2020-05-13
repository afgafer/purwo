@extends('layouts.app')
@section('content')

@if ($message = Session::get('message'))
 <div class="alert alert-success martop-sm">
 <p>{{ $message }}</p>
 </div>
@endif
<h1 class="text-center">dests</h1>
<a href="{{route('dest.create')}}" class="btn btn-primary btn-sm">create</a>
<div class="card-columns">
            @forelse($dests as $d)
            @php
            $dirF='upload/img/'.$d->file;
            $src=asset($dirF);
            @endphp
            <div class="card p-0">
                <a class="text-dark" href="{{route('dest.show',$d->id)}}">
                <img src="{{$src}}" class="card-img-top" alt="{{$d->file}}">
                <div class="card-body">
                    <h5 >{{$d->name}}</h5>
                    <div>
                        <a href="{{route('dest.show',$d->id)}}" class="btn btn-primary btn-sm">read more</a>
                        <a href="{{route('dest.edit',$d->id)}}" class="btn btn-primary btn-sm">edit</a>
                        <form action="{{route('dest.destroy',$d->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">delete</button>
                        </form>
                    </div>
                </div>
                </a>
            </div>
            @empty
            <h5>empty</h5>
            @endforelse
@endsection