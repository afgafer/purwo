@extends('layouts.app')
@section('header')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
            <form action="{{route('hotel.store')}}" method='post' enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="name">name</label>
                        <input type="text" class="form-control" name="name" placeholder="name" required>
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="file">image</label>
                        <input type="file" class="form-control" name="file" >
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="contact">contact</label>
                        <input type="number" class="form-control" name="contact" placeholder="contact" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <label for="address">address</label>
                        <textarea class="form-control" name="address"></textarea>
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="lat">lat</label>
                        <input type="number" class="form-control" name="lat" placeholder="lat">
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="lng">lng</label>
                        <input type="number" class="form-control" name="lng" placeholder="lng">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <label for="desc">desc</label>
                        <textarea class="form-control" id="editor" name="desc"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <button class="btn btn-primary" type="submit">save</button>
                        </div>
                </div>
            </form>
@endsection
@section('script')
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection