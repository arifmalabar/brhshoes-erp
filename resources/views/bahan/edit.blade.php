@extends('layout.layout')

@section('status', 'active')
@section('judul', 'Edit Bahan')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h4 class="card-title">Edit Bahan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('bahan.update', $bahan->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Metode PUT untuk pembaruan -->

                    <div class="form-group">
                        <label for="inputNama">Nama Bahan</label>
                        <input type="text" class="form-control" name="nama" value="{{ old('nama', $bahan->nama) }}" placeholder="Masukkan Nama Bahan" required>
                    </div>

                    <div class="form-group">
                        <label for="inputKuantitas">Kuantitas</label>
                        <input type="number" class="form-control" name="kuantitas" value="{{ old('kuantitas', $bahan->kuantitas) }}" placeholder="Masukkan Kuantitas" required>
                    </div>

                    <div class="form-group">
                        <label for="inputHargaModal">Harga Modal</label>
                        <input type="number" class="form-control" name="harga_modal" value="{{ old('harga_modal', $bahan->harga_modal) }}" placeholder="Masukkan Harga Modal" required>
                    </div>

                    <div class="form-group">
                        <label for="inputJenisBahan">Jenis Bahan</label>
                        <input type="text" class="form-control" name="jenis_bahan" value="{{ old('jenis_bahan', $bahan->jenis_bahan) }}" placeholder="Masukkan Jenis Bahan" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Update Data</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
