@extends('layouts.app')
@section('content')
                <div class="form-group">
                    <div class="col-md-5 mb-1">
                        @php
                        $dirF='upload/img/'.$user->file;
                        $src=asset($dirF);
                        @endphp
                        <img src="{{$src}}" class="img-thumbnail" alt="{{$user->file}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5 mb-1">
                        <input type="file" class="form-control" name="file" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 mb-4">
                        <label for="name">name</label>
                        <input type="text" class="form-control" name="name" value="{{$user->name}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 mb-4">
                        <label for="email">email</label>
                        <input type="email" class="form-control" name="email" value="{{$user->email}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact">contact</label>
                    <input type="number" class="form-control" name="contact" value="{{$user->contact}}" required>
                </div>
 @endsection