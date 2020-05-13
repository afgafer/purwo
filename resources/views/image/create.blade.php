@extends('layouts.app')
@section('header')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
            <form action="{{route('image.store')}}" method='post' enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-group">
                    <div class="col-md-6 mb-3">
                        <label for="name">name</label>
                        <input type="text" class="form-control" name="name" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 mb-3">
                        <label for="file">image</label>
                        <input type="file" class="form-control" name="file" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 mb-3">
                        <label for="dest">dest</label>
                        <select name="dest_id" class="form-control">
                            <option disabled selected required>--choice--</option>
                            @forelse($dests as $d)
                            <option value="{{$d->id}}">{{$d->name}}</option>
                            @empty
                            <option disabled selected>empty</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <label for="desc">Deskripsi</label>
                        <textarea class="form-control" required="" name="desc"></textarea>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">save</button>
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