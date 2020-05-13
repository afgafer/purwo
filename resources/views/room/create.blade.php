@extends('layouts.app')
@section('content')
            <form action="{{route('room.store')}}" method='post' enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="name">name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="name room" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-5 mb-1">
                        <label for="file">image</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" >
                        @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="price">price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="price" required>
                        @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-1">
                        <label for="bed">bed</label>
                        <input type="number" class="form-control @error('bed') is-invalid @enderror" name="bed" placeholder="bed" required>
                        @error('bed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-4">
                        <label for="slot">slot</label>
                        <input type="number" class="form-control @error('slot') is-invalid @enderror" name="slot" placeholder="slot" required>
                        @error('slot')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <label for="description">description</label>
                        <textarea class="form-control @error('desc') is-invalid @enderror" required="" name="desc"></textarea>
                        @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
 @endsection