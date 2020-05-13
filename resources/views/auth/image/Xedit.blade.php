@extends('layouts.app')
@section('content')
            <form action="{{route('image.update',$image->id)}}" method='post' enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('put')}}
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <label for="name">name</label>
                        <input type="text" class="form-control" name="name" value="{{$image->name}}" >
                    </div>
                </div>
                @php
            $dirF='upload/img/'.$image->file;
            $src=asset($dirF);
            @endphp
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <img src="{{$src}}" class="img-thumbnail" width="100px" heigth="100px" alt="{{$image->file}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <input type="file" class="form-control" name="file" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 mb-3">
                        <label for="dest">dest</label>
                        <select name="dest" class="form-control">
                            <option disabled selected>--Pilih--</option>
                            @php
                            $dests=\App\models\Dest::orderBy('name','ASC')->get();
                            @endphp
                            @forelse($dests as $d)
                            @if($d->id==$image->dest_id)
                            <option value="{{$d->id}}" selected>{{$d->name}}</option>
                            @else
                            <option value="{{$d->id}}">{{$d->name}}</option>
                            @endif
                            @empty
                            <option disabled selected>empty</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <label for="desc">Deskripsi</label>
                        <textarea class="form-control" required="" name="desc">{{$image->desc}}</textarea>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
 @endsection