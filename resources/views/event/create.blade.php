@extends('layouts.app')
@section('header')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
            <form action="{{route('event.store')}}" method='post' enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-row">
                    <div class="col-md-6 ">
                        <label for="name">name</label>
                        <input type="text" class="form-control" name="name" placeholder="name" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 ">
                        <label for="file">image</label>
                        <input type="file" class="form-control" name="file" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3">
                        <label for="date">date</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>
                    <div class="col-md-3">
                        <label for="place">place</label>
                        <input type="text" class="form-control" name="place" placeholder="place" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="desc">desc</label>
                        <textarea class="form-control" id="editor" name="desc"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mt-2">
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