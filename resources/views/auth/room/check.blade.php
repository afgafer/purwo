@extends('layouts.app')
@section('content')
@php
if(isset($_GET['date1']) and isset($_GET['date2'])){
    $date1=$_GET['date1'];
    $date2=$_GET['date2'];
}else{
    $date1=date('Y-m-d');
    $date2=date('Y-m-d', strtotime("+1 days", strtotime($date1)));
}
@endphp
<div class="bg-light">
    <h1 class="title">form</h1>
    <div class="form-row p-2">
        <div class="form-group col-md-2">
            <label for="cin">cin : 08.00</label>
            <input type="date"  value="{{$date1}}" id="date1" class="form-control">
        </div>
        <div class="form-group col-md-2">
            <label for="cout">cout : 06.00</label>
            <input type="date" value="{{$date2}}" id="date2" class="form-control">
        </div>
        <div class="form-group col-md-2">
            <button class="btn btn-primary" id="filter">filter</button>
        </div>
    </div>
    <div class="form-group col-md-4 ">
            <input type="text" placeholder="name room" id="search" class="form-control">
    </div>
</div>
<h1 class="title text-center mt-2">hotels</h1>
<div class="card-columns" id="result">
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
                url:"http://localhost:8000/room/search",
                method:'GET',
                data:{query:query,date1:date1,date2:date2},
                dataType:'json',
                success: function(data){
                    $('#result').html(data.card_data);
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