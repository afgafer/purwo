@extends('layouts.app')
@section('content')
        <div class="col-md-8 bg-white p-2">
            <form action="{{route('room.update',$room->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{ method_field('PUT') }}
                <div class="form-group">
                    <div class="col-md-5 mb-1">
                        @php
                        $dirF='upload/img/'.$room->file;
                        $src=asset($dirF);
                        @endphp
                        <img src="{{$src}}" class="w-25" alt="{{$room->file}}">
                </div>
                <div class="form-group">
                    <div class="col-md-5 mb-1">
                        <input type="file" class="form-control" name="file" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 mb-4">
                        <label for="name">name</label>
                        <input type="text" class="form-control" name="name" value="{{$room->name}}" required>
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="price">price</label>
                        <input type="number" class="form-control" name="price" value="{{$room->price}}" required>
                    </div>
                    <div class="col-md-3 mb-1">
                        <label for="bed">bed</label>
                        <input type="number" class="form-control" name="bed" value="{{$room->bed}}" required>
                    </div>
                    <div class="col-md-3 mb-1">
                        <label for="quota">quota</label>
                        <input type="number" class="form-control" name="quota" value="{{$room->quota}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <label for="desc">description</label>
                        <textarea class="form-control" required="" name="desc">{{$room->desc}}</textarea>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
        </div>
 @endsection