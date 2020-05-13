@extends('lay.app')
@section('content')
<form action="{{route('pesan.store')}}" method='post'>
            {{csrf_field()}}
                <div class="form-group">
                    <div class="col-md-6 mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{$pesan->nama}}" readonly>
                    </div>
                </div>
                <div class="form-group">
                        @php
                        //$foto='storage/upload/img/'.$kamar[0]->foto;
                        @endphp
                    <!-- <img src="" clas="w-25 border-rounded"> -->
                    <div class="col-md-6 mb-3">
                        <label for="id_kamar">kamar</label>
                        <!-- <input type="hidden"  name="id_kamar" class="form-control" value="{{$pesan->id_kamar}}"> -->
                        <input type="text" class="form-control" value="{{$pesan->id_kamar}}" readonly>
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-6 mb-4">
                        <label for="masuk">masuk</label>
                        <input type="date" class="form-control" name="masuk" value="{{$pesan->masuk}}" readonly>
                    </div>
                    <div class="col-3 mb-1">
                        <label for="lama">lama</label>
                        <input type="number" class="form-control" name="lama" value="{{$pesan->lama}}" readonly>
                    </div>
                </div>
                        @php
                        $foto='storage/upload/img/'.$pesan->foto;
                        @endphp
                    <img src="{{asset($foto)}}" class="w-25 border-rounded">
                <div class="form-row mx-2">
                    <div class="col-md-3 mb-1">
                        <label for="biaya">biaya</label>
                        <input type="number" class="form-control" name="biaya" value="{{$pesan->biaya}}" readonly>
                    </div>
                    <!-- <div class="col-md-8 mb-1">

                        <label for="bukti">bukti</label>
                        <input type="file" class="form-control" name="foto">
                    </div> -->
                </div>
                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
 @endsection