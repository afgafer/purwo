@extends('layouts.app')

@section('content')
<div align="center">
@if(isset($images))
<div id="carouselExampleIndicators" style="width:300px; height:300px" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
  </ol>
  <div class="carousel-inner">
  @foreach($images as $i)
    @php
    $dirF='upload/img/'.$i->file;;
    $src=asset($dirF);
    @endphp
    @if($loop->iteration==1)
    <div class="carousel-item active">
      <img class="d-block" style="width:300px; height:300px" src="{{$src}}" alt="{{$i->name}}">
      <div class="carousel-caption d-none d-md-block">
        <p>{{$i->desc}}</p>
      </div>
    </div>    
    @else
    <div class="carousel-item">
      <img class="d-block" style="width:300px; height:300px" src="{{$src}}" alt="{{$i->name}}">
      <div class="carousel-caption d-none d-md-block">
            <p>{{$i->desc}}</p>
        </div>
    </div>
    @endif
  @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
@endif
</div>
@endsection
