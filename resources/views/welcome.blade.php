@extends('layouts.app')
@section('header')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-3 p-0 border border-dark">
            @if(isset($images))
            <div id="carouselExampleIndicators" style="height:300px; width:100%" class="carousel slide" data-ride="carousel">
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
                        <img class="d-block" style="height:300px; width:100%" src="{{$src}}" alt="{{$i->name}}">
                        <div class="carousel-caption d-none d-md-block">
                            <p>{{$i->desc}}</p>
                        </div>
                    </div>
                    @else
                    <div class="carousel-item">
                        <img class="d-block" style="height:300px; width:100%" src="{{$src}}" alt="{{$i->name}}">
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
        <div class="col-lg-8 bg-dark text-white p-2">
            @if(isset($event))
            @php
            $content=substr($event->desc,0,50);
            @endphp
            <h1 >{{$event->name}}</h1>
            <small>{{$event->place}},{{$event->date}}</small>
            <p>{{$content}}</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel ea, nam, illum doloribus praesentium ex cum
                delectus totam deleniti non, laudantium maiores ad. Cupiditate eaque placeat sed quo ratione, quis minus
                quia voluptatem illum tempora iusto optio aut corporis inventore blanditiis exercitationem autem,
                distinctio, eveniet quae laudantium veniam quaerat esse necessitatibus. Dolorem aperiam nulla modi natus
                explicabo odio. Quia placeat odio quibusdam, explicabo laborum nemo praesentium animi libero tenetur amet
                ullam distinctio magnam aut laboriosam commodi, quo eaque eveniet obcaecati enim. Nulla ut temporibus
                explicabo dolorem suscipit quis perferendis debitis laboriosam blanditiis, similique iure laudantium tempore
                fugit at dignissimos hic.</p>
            @elseif(isset($dest))
            @php
            $content=substr($dest->desc,0,50);
            @endphp
            <h1 >{{$dest->name}}</h1>
            <p>{{$content}}</p>
            <p class="">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel ea, nam, illum doloribus praesentium ex cum
                delectus totam deleniti non, laudantium maiores ad. Cupiditate eaque placeat sed quo ratione, quis minus
                quia voluptatem illum tempora iusto optio aut corporis inventore blanditiis exercitationem autem,
                distinctio, eveniet quae laudantium veniam quaerat esse necessitatibus. Dolorem aperiam nulla modi natus
                </p>
                <div>
                <button class="btn btn-primary btn-outline-light">read more</button>
                </div>
            @else
            <h1>empty</h1>
            @endif
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="">
    <!-- articles -->
    <h1 class="title">article list</h1>
    <hr>
    @forelse($articles as $a)
    @php
    $dirF='upload/img/'.$a->file;
    $src=asset($dirF);
    $time=date_create($a->created_at);
    $date=date_format($time,'d/m/Y');
    $content=substr($a->content,0,300);
    $mod=$loop->iteration%2;
    @endphp
    @if($mod)
    <div class="card mb-3 p-1"> 
        <div class="row no-gutters">
            <div class="col-md-3 align-self-center">
                <img src="{{$src}}" class="card-img" alt="{{$a->file}}">
            </div>
            <div class="col-md-8 ">
                <div class="card-body">
                    <h4 class="card-title text-primary">{{$a->title}}</h4>
                    <p class="card-text">{{$content}}</p>
                    <p class="card-text"><span
                                class="badge badge-primary">{{$a->admin->name}}</span><span
                                class="badge badge-secondary">{{$date}}</span></p>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="card mb-3 p-1">
        <div class="row no-gutters">
             <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title text-primary">{{$a->title}}</h4>
                    <p class="card-text">{{$content}}</p>
                    <p class="card-text"><span
                                class="badge badge-primary">{{$a->admin->name}}</span><span
                                class="badge badge-secondary">{{$date}}</span></p>
                </div>
            </div>
            <div class="col-md-3 align-self-center ml-auto">
                <img src="{{$src}}" class="card-img" alt="{{$a->file}}">
            </div>
            
        </div>
    </div>
    @endif
    @empty
    <h5>empty</h5>
    @endforelse
    <!-- articles end-->
</div>
<div class="bg-white p-2">
    <!-- rooms -->
    <h1 class="title">room list</h1>
    <hr>
    @if(isset($rooms))
    <div class="row row-cols-1 row-cols-md-4">
        @foreach($rooms as $r)
        @php
        $dirF='upload/img/'.$r->file;
        $src=asset($dirF);
        $price=number_format($r->price,0,'','.');
        @endphp
        <div class="col mb-4">
            <div class="card h-100 border border-white">
                <img src="{{$src}}" class="card-img-top" alt="{{$r->file}}">
                <div class="card-body">
                    <h5 class="card-title text-white badge badge-primary">No {{$r->id}}</h5>
                    <h5 class="card-title border badge badge-light">Rp {{$price}}</h5>
                    <table class="table table-sm bg-white mb-2 ">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>: {{$r->name}}</td>
                            </tr>
                            <tr>
                                <td>hotel</td>
                                <td>: {{$r->hotel->name}}</td>
                            </tr>
                            <tr>
                                <td>bed</td>
                                <td>: {{$r->bed}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <h5>empty</h5>
    @endif
    <!-- rooms end-->
</div>
@endsection