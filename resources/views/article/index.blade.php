@extends('layouts.app')
@section('content')

@if ($message = Session::get('message'))
 <div class="alert alert-success martop-sm">
 <p>{{ $message }}</p>
 </div>
@endif
<h1 class="title">articles</h1>
<a href="{{route('article.create')}}" class="btn btn-primary btn-sm">create</a>
<div class="card-columns">
            @forelse($articles as $a)
            @php
            $dirF='upload/img/'.$a->file;
            $src=asset($dirF);
            $time=date_create($a->created_at);
            $date=date_format($time,'d-m-Y');
            $content=substr($a->content,0,500);
            @endphp
            <div class="card p-0">
                <a class="text-dark" href="{{route('article.show',$a->id)}}">
                <img src="{{$src}}" class="card-img-top" alt="{{$a->file}}">
                <div class="card-body">
                    <table class="table table-sm bg-white mb-2 ">
                        <tbody>
                            <tr>
                                <td >title</td>
                                <td>: {{$a->title}}</td>
                            </tr>
                            <tr>
                                <td>writer</td>
                                <td>: {{$a->admin->name}}</td>
                            </tr>
                            <tr>
                                <td>date</td>
                                <td>: {{$date}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <?=$content?>
                    <div class="btn-group">
                        <a href="{{route('article.show',$a->id)}}" class="btn btn-info btn-sm mr-1">read more</a>
                        <a href="{{route('article.edit',$a->id)}}" class="btn btn-primary btn-sm mr-1">edit</a>
                        <form action="{{route('article.destroy',$a->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                            <button class="btn btn-danger btn-sm mr-1" type="submit">delete</button>
                        </form>
                    </div>
                </div>
                </a>
            </div>
            @empty
            <div class="card p-0">
                <div class="card-body">
                    <h5>empty</h5>
                </div>
            </div>
            @endforelse
            </div>
@endsection