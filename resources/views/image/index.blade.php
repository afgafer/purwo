@extends('layouts.app')
@section('content')
        <a class="btn btn-primary" href="{{route('image.create')}}">create</a>
        <table class="table table-striped table-light table-sm">
            <thead>
                <tr class='bg-primary text-white'>
                    <th>No</th>
                    <th>name</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($images as $i)
                @php
                $dirF='upload/img/'.$i->file;
                $src=asset($dirF);
                @endphp
                <tr class=''>
                    <td>{{$loop->iteration}}</td>
                    <td><img src="{{$src}}" width='100px' clas="img-thumb" alt="{{$i->file}}"> {{$i->name}}</td>
                    <td>
                    <form action="{{route('image.pConfirm',$i->id)}}" method="post">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option disabled selected>--Confirm--</option>
                            <option value="1">accept</option>
                            <option value="2">abort</option>
                        </select>
                        </form>
                    </td>
                </tr>
                @empty
                <td colspan="4" class="text-center">empty</td>
                @endforelse
            </tbody>
        </table>
       
@endsection