@extends('lay.app')
@section('content')
            <div class="card p-0 col-md-6">
            <?php
            $foto='storage/upload/img/'.$kamar->foto;
            ?>
                <img src="{{asset($foto)}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <table class="table table-sm bg-white mb-2">
                        <tbody>
                            <tr>
                                <td>Nama kamar</td>
                                <td>: {{$kamar->nama}}</td>
                            </tr>
                            <tr>
                                <td>harga</td>
                                <td>: {{$kamar->harga}}</td>
                            </tr>
                            <tr>
                                <td>bed</td>
                                <td>: {{$kamar->bed}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="card-title">deskripsi :</h5>
                    <p>{{$kamar->deskripsi}}</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted row">
                        <a class="btn btn-success" href="/pesan/create?id_kamar={{$kamar->id}}">Pesan</a>
                        <a class="btn btn-primary" href="/kamar/{{$kamar->id}}/edit">Ubah</a>
                        <form action="{{ route('kamar.destroy', $kamar->id) }}" method="post">
                            {{csrf_field()}}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" type="submit">Hapus</button>
                        </form>
                    </small>
                </div>
            </div>
    <!-- boodi -->
 @endsection
