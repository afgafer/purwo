@extends('layouts.app')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<a href="{{route('order.export')}}" class="btn btn-primary">export</a>
@php
if(isset($_GET['date1']) and isset($_GET['date2'])){
    $date1=$_GET['date1'];
    $date2=$_GET['date2'];
}else{
    $date1=date('Y-m-01');
    $date2=date('Y-m-d');
}
@endphp
<div class="form-row">
        <div class="col-md-3">
            <label for="date1">date1</label>
            <input type="date" id="date1" value='{{$date1}}' class="form-control">
        </div>
        <div class="col-md-3">
            <label for="date2">date2</label>
            <input type="date" id="date2" value='{{$date2}}' class="form-control">
        </div>
        <div class="col-1">
            <button id="filter" class="btn btn-primary">filter</button>
        </div>
</div>
<div class="form-row mb-3">
        <div class="col-md-3">
            <input type="text" id="search" class="form-control bg-transparent" style="border-bottom: 1px solid dodgerblue" placeholder="name customer/room">
        </div>
</div>
<div class="table-responsive">
        <table class="table table-sm bg-limpid-light">
            <thead>
                <tr class='bg-primary text-white'>
                    <th>No</th>
                    <th>name</th>
                    <th>cin</th>
                    <th>count</th>
                    <th>bill</th>
                    <th>status</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody id="tBody">
            </tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    
    $(document).ready(function() {
        fetch();
            $(document).on('click','#filter',function(){
                fetch();
            });
        function fetch(query='') {
            query=$('#search').val();
            date1=$('#date1').val();
            date2=$('#date2').val();
            $.ajax({
                url:"http://localhost:8000/admin/order/search",
                method:'GET',
                data:{query:query,date1:date1,date2:date2},
                dataType:'json',
                success: function(data){
                    $('#tBody').html(data.table_data);
                }
            });
        }
        $(document).on('keyup','#search',function(){
           var query=$(this).val();
           fetch(query);
        });
       
    });
    </script>
@endsection