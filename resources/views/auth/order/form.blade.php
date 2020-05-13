@extends('layouts.app')
@section('content')
            <form action="{{route('order.select')}}" method='get'>
                <!-- @csrf -->
                <div class="form-row">
                    <div class="col-md-8 mb-3">
                        <label for="name">name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{session()->get('namePemesan')}}" required>
                    </div>
                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                </div>
                <div class="form-row">
                    <div class="col-9 mb-4">
                        <label for="cin">cin</label>
                        <input type="date" class="form-control @error('cin') is-invalid @enderror" name="cin"  value="{{session()->get('cin')}}">
                        <br>cin: 8.00 cout:6.00
                        @error('cin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-3 mb-1">
                        <label for="duration">duration</label>
                        <input type="number" class="form-control @error('duration') is-invalid @enderror" name="duration"  >
                        @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <!-- <div class="form-group">
                        <label for="cout">cout</label>
                        <input type="date" class="form-control" name="cout"  value="{{session()->get('cin')}}" readonly>
                </div> -->
                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
 @endsection