@extends('layout.layout')

@section('status', 'active')
@section('judul', 'Tambah Bahan')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h4 class="card-title">Tambah Bahan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('bahan.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="inputNama">Nama Bahan</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Bahan" required>
                    </div>
                    <div class="form-group">
                        <label for="inputKuantitas">Kuantitas</label>
                        <input type="number" class="form-control" name="kuantitas" placeholder="Masukkan Kuantitas" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="inputHargaModal">Harga Modal</label>
                        <input type="number" class="form-control" name="harga_modal" placeholder="Masukkan Harga Modal" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="inputJenisBahan">Jenis Bahan</label>
                        <input type="text" class="form-control" name="jenis_bahan" placeholder="Masukkan Jenis Bahan" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
