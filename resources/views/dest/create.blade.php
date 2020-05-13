@extends('layouts.app')
@section('head')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
<form action="{{route('dest.store')}}" method='post' enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-row">
                    <div class="col-md-4">
                        <label for="name">name</label>
                        <input type="text" class="form-control" name="name" placeholder="name" required>
                    </div>
                    <div class="col-md-3">
                        <label for="contact">contact</label>
                        <input type="number" class="form-control" name="contact" placeholder="contact" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-7">
                        <label for="file">image</label>
                        <input type="file" class="form-control" name="file" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                    <div class="col-md-12 p-0">
                        <label for="lat">lat</label>
                        <input type="number" class="form-control" name="lat" placeholder="lat">
                    </div>
                    <div class="col-md-12 p-0">
                        <label for="lng">lng</label>
                        <input type="number" class="form-control" name="lng" placeholder="lng">
                    </div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <label for="address">address</label>
                        <textarea class="form-control" name="address"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 p-0">
                        <label for="desc">desc</label>
                        <textarea class="form-control" id="editor" name="desc"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 ">
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