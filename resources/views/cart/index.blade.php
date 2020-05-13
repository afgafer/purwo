@extends('layouts.app')
@section('content')
@if(isset($cart))
<div class="bg-limpid-light p-2">
    <div class="bg-light">
        <h1 class="title">form</h1>
        <div class="form-row p-2">
            <div class="form-group col-md-6">
                <label for="name">name</label>
                <input type="text" value="{{Session::get('name')}}" class="form-control" readonly>
            </div>
            <div class="form-group col-md-2">
                <label for="hotel">hotel</label>
                <input type="text" value="{{Session::get('hotel')}}" class="form-control" readonly>
            </div>
            <div class="form-group col-md-2">
                <label for="cin">cin : 08.00</label>
                <input type="date"  value="{{Session::get('cin')}}" class="form-control" readonly>
            </div>
            <div class="form-group col-md-2">
                <label for="cout">cout : 06.00</label>
                <input type="date" value="{{Session::get('cout')}}" class="form-control" readonly>
            </div>
        </div>
    </div>
    @if ($msg = Session::get('msg'))
    <div class="alert alert-info" role="alert">
        {{$msg}}
    </div>
    @endif
    <div class="scroll mt-2">
        <table class="table-sm table-striped w-100 bg-limpid-light">
            <tr class="bg-primary text-white">
                <th>No</th>
                <th>room</th>
                <th>price</th>
                <th>quantity</th>
                <th></th>
            </tr>

            @foreach($cart as $c)
            <tr>
                <td>{{$c['item']->id}}</td>
                <td>{{$c['item']->name}}</td>
                <td>{{$c['cost']}}</td>
                <td>
                    <div class="row" style="width:200px">
                        <div class="d-inline">
                            <form action="{{route('cart.take',$c['item']->id)}}" method="post">
                                @csrf
                                <button class="btn btn-secondary btn-sm">+</button>
                            </form>
                        </div>
                        <div class="d-inline" style="width:50px">
                            <input type="number" value="{{$c['qty']}}" max="{{$c['item']->quota}}" class="form-control p-0"
                                readonly>    
                        </div>
                        <div class="d-inline">
                            <form action="{{route('cart.remove',$c['item']->id)}}" method="post">
                                @csrf
                                <button class="btn btn-secondary btn-sm">-</button>
                            </form>    
                        </div>
                    </div>
                </td>
                <td>
                    <form action="{{route('cart.destroy',$c['item']->id)}}" method="post">
                        {{csrf_field()}}
                        {{method_field('POst')}}
                        <button class="btn btn-danger" type='submit'>delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            <tr>
                <th colspan="2" class=>Tarif</th>
                <th>{{$bill}}</th>
                <th>{{$count}}</th>
                <th></th>
            </tr>
        </table>
        @else
        tidak ada
        @endif
    </div>
    @if($count!=0)
    <form action="{{route('order.store')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <input type="hidden" name="name" value="{{Session::get('name')}}" class="form-control col-md-8">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="hidden" name="cin" value="{{Session::get('cin')}}" class="form-control" readonly>
            </div>
            <div class="form-group col-md-6">
                <input type="hidden" name="cout" value="{{Session::get('cout')}}" class="form-control col-md-6"
                    readonly>
            </div>
            <button class="btn btn-success" type="submit">order</button>
    </form>
    @endif
    <form action="{{route('order.choice',session()->get('hotel_id'))}}" method="get">
        {{csrf_field()}}
        <button class="btn btn-primary" type='submit'>choice</button>
    </form>
    <form action="{{route('cart.drop')}}" method="post">
        {{csrf_field()}}
        {{method_field('POST')}}
        <button class="btn btn-warning" type='submit'>cancel</button>
    </form>
</div>
@endsection