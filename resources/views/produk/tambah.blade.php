@extends('layout/layout')
@section('status')
    active
@endsection
@section('judul')
    Tambah Produk dan Bahan
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h4 class="card-title">Produk</h4>
            </div>
            <div class="card-body">
                <div id="form-produk">

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script src="{{ mix('js/tambahproduk.js') }}"></script>
    <script>
        window.csrf_token = "{{ csrf_token() }}"
    </script>
@endsection