@extends('layouts.app')
@section('content')
<a href="{{route('order.form')}}" class="btn btn-primary">order</a>
<div class="scroll">
        <table class="table table-sm bg-limpid-light">
            <thead>
                <tr class='bg-primary text-white'>
                    <th>No</th>
                    <th>name</th>
                    <th>cin</th>
                    <th>bill</th>
                    <th>status</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
            @php
            @endphp

                @foreach($orders as $o)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a href="{{route('order.showA',$o->id)}}">{{$o->name}}</a></td>
                    <td>{{$o->cin}}</td>
                    <td>{{$o->bill}}</td>
                    <td>{{$o->getStatus($o->status)}}</td>
                    <td>
                    @if($o->status==3)
                        <button class="btn btn-success" disabled>upload</button>
                    @else
                        <a href="{{route('order.showA',$o->id)}}" class="btn btn-success">upload</a>
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection