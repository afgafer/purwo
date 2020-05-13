@extends('layouts.app')
@section('header')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection
@php
$dirF='upload/img/'.$article->file;
$src=asset($dirF);
@endphp
@section('content')
            <form action="{{route('article.update',$article->id)}}" method='post' enctype="multipart/form-data">
            {{csrf_field()}}
            @method('PUT')
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="title">title</label>
                        <input type="text" class="form-control" name="title" value="{{$article->title}}">
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <img src="{{$src}}" alt="{{$article->file}}" class="img-thumbnail">
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <input type="file" class="form-control" name="file">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <label for="content">content</label>
                        <textarea class="form-control" id="editor" name="content">{{$article->content}}</textarea>
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