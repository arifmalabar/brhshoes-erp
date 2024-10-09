@extends('layout/layout')
@section('status')
    active
@endsection
@section('judul')
    Produk
@endsection
@section('content')
<section class="content">
        
    <div class="container-fluid">
        
        <div class="card card-default">
            <div class="card-header">
                <h4 class="card-title">Informasi Produk</h4>
                <div class="card-tools">
                    <button class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#tambahGedungModal">
                            <i class="fa fa-plus"></i>&nbsp;Tambah Produk
                        </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        
                        <table id="example2" class="table table-bordered table-hover" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody id="product-data">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah Gedung -->
<div class="modal fade" id="tambahGedungModal" tabindex="-1" role="dialog" aria-labelledby="tambahGedungModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahGedungModalLabel">Tambah Gedung</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahGedung" action="{{ url('/setting_gedung/store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Gedung<sup>*</sup>:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nama_gedung"
                                placeholder="Masukan Nama Gedung" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat Gedung<sup>*</sup>:</label>
                        <div class="input-group mb-3">
                            <textarea name="alamat_gedung" placeholder="Masukan Alamat Gedung" id="" cols="30" rows="5"
                                class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="formTambahGedung">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Gedung -->
<div class="modal fade" id="editGedungModal" tabindex="-1" role="dialog" aria-labelledby="editGedungModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGedungModalLabel">Edit Gedung</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditGedung" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Kode Gedung<sup>*</sup>:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control" id="editKodeGedung" name="kode_gedung"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Gedung<sup>*</sup>:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="editNamaGedung" name="nama_gedung"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat Gedung<sup>*</sup>:</label>
                        <div class="input-group mb-3">
                            <textarea id="editAlamatGedung" name="alamat_gedung" id="" cols="30" rows="5"
                                class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="formEditGedung">Edit</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ mix('js/produk.js') }}"></script>
    <script>
        $(function() {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>  
@endsection