@extends('layouts.app')
@section('header')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
<form action="{{route('article.store')}}" method='post' enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-row">
                    <div class="col-md-6 mb-4">
                        <label for="title">title</label>
                        <input type="text" class="form-control" name="title" placeholder="title" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-4">
                        <label for="file">image</label>
                        <input type="file" class="form-control" name="file" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 p-0">
                        <label for="content">content</label>
                        <textarea class="form-control" id="editor" name="content"></textarea>
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