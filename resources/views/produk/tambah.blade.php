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
                    <div class="row">
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label
                                        for="inputEmail3"
                                        class="col-sm-2 col-form-label"
                                    >
                                        Nama
                                    </label>
                                    <div class="col-sm-10">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="inputEmail3"
                                            placeholder="Masukan Nama Produk/Bahan"
                                            
                                        />
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label
                                        for="inputEmail3"
                                        class="col-sm-2 col-form-label"
                                    >
                                        Harga Modal
                                    </label>
                                    <div class="col-sm-10">
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="inputEmail3"
                                            placeholder="Masukan Harga Modal"
                                            
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label
                                        for="inputEmail3"
                                        class="col-sm-2 col-form-label"
                                    >
                                        Kategori
                                    </label>
                                    <div class="col-sm-10">
                                        <select
                                            class="form-control"
                                            
                                        >
                                            <option>Pilih Kategori</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label
                                        for="inputEmail3"
                                        class="col-sm-2 col-form-label"
                                    >
                                        Harga Jual
                                    </label>
                                    <div class="col-sm-10">
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="inputEmail3"
                                            placeholder="Harga Jual"
                                            
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label
                                        for="inputEmail3"
                                        class="col-sm-2 col-form-label"
                                    >
                                        Internal Reference
                                    </label>
                                    <div class="col-sm-10">
                                        <input
                                            type="email"
                                            class="form-control"
                                            id="inputEmail3"
                                            placeholder="Email"
                                            
                                        />
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label
                                        for="inputEmail3"
                                        class="col-sm-2 col-form-label"
                                    ></label>
                                </div>
                            </div>
                        </div>
            
                        <div class="col-md-3">
                            <div class="col-md-12">
                                
                            </div>
                            <div class="col-md-12">
                                <input
                                    type="file"
                                    placeholder="Upload File Disini"
                                    class="form-control"
                                    
                                />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button
                                class="btn btn-success w-100"
                                
                            >
                                <i class="fa fa-plus"></i>
                                Tambah Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
    <script>
        window.csrf_token = "{{ csrf_token() }}"
    </script>
@endsection