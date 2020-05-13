@extends('layouts.app')
@section('content')
<h1 class="title">events</h1>
<div class="scroll">
    <table class="table table-sm bg-limpid-light mb-2">
        <tbody>
            <tr class="bg-primary text-white">
                <th>no</th>
                <th>name</th>
                <th>date</th>
                <th>place</th>
                <th></th>
            </tr>
            @php
            //dd($events);
            @endphp
            @forelse($events as $e)
            @php
            $dirF='upload/img/'.$e->file;
            $src=asset($dirF);
            $time=date_create($e->date);
            $date=date_format($time,'d/ m/ Y');
            $content=substr($e->content,0,500);
            @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="{{route('event.showA',$e->id)}}">{{$e->name}}</a></td>
                <td>{{$date}}</td>
                <td>{{$e->place}}</td>
                <td>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">empty</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection