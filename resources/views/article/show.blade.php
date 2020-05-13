@extends('layouts.app')
@section('header')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection

@php
$dirF='upload/img/'.$article->file;
$src=asset($dirF);
@endphp

@section('content')
<div class="bg-white p-2">
<h1 class="title">{{$article->title}}</h1>
<hr>
                <div class="form-row mx-2 ">
                    <div class="col-md-6 mb-4">
                        <img src="{{$src}}" alt="{{$article->file}}" class="img-thumbnail w-100 h-100">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <label for="content">content</label>
                        <textarea class="form-control" id="editor" name="content">{{$article->content}}</textarea>
                    </div>
                </div>
</div>
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