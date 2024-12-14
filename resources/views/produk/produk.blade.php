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
                    <a href="#" data-toggle="modal" data-target="#tambahProdukModal" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>&nbsp;Tambah Produk
                    </a>
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
                                    <th>Harga Modal</th>
                                    <th>Harga Jual</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody id="product-data">
                                @foreach($data as $key)
                                <tr>
                                    <td>1</td>
                                    <td>{{ $key->nama_produk }}</td>
                                    <td>Rp {{ number_format($key->harga_modal, 2, ",", ".") }}</td>
                                    <td>Rp {{ number_format($key->harga_jual, 2, ",", ".") }}</td>
                                    <td>
                                        @if($key->on_hand >= 0)
                                            <small class="badge badge-success">Tersedia</small>
                                        @else
                                            <small class="badge badge-danger">Tidak Tersedia</small>
                                        @endif
                                    </td>
                                    <td>
                                        <center>
                                            <button
                                                class="btn btn-outline-info btn-sm"
                                                data-toggle="modal"
                                                data-target="#editProdukModal"
                                                data-kode="{{ $key->id }}"
                                                data-nama="{{ $key->nama_produk }}"
                                                data-hj="{{ $key->harga_jual }}"
                                                data-hm="{{ $key->harga_modal }}"
                                                data-internal_reference="{{ $key->internal_reference }}"
                                            >
                                                <i class="fas fa-pencil-alt"></i>&nbsp;Ubah
                                            </button>
                                            &nbsp;
                                            <button
                                                type="button"
                                                class="btn btn-outline-danger btn-sm"
                                                
                                            >
                                                <i class="fas fa-trash-alt"></i>&nbsp;Hapus
                                            </button>
                                        </center>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah Gedung -->
<div class="modal fade" id="tambahProdukModal" tabindex="-1" role="dialog" aria-labelledby="tambahProdukModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="/produk/tambah_data" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahProdukModalLabel">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Produk</label>
                                <input type="text" placeholder="Masukan Nama Produk" name="nama_produk" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Harga Jual</label>
                                <input type="number" placeholder="Masukan Harga Jual" name="harga_jual" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Harga Modal</label>
                                <input type="number" placeholder="Masukan Harga Modal" name="harga_modal" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Internal Reference</label>
                                <input type="text" placeholder="Masukan Internal Reference" name="internal_reference" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Gedung -->
<div class="modal fade" id="editProdukModal" tabindex="-1" role="dialog" aria-labelledby="editProdukModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" id="form-update" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProdukModalLabel">Edit Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @method('put')
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Produk</label>
                            <input type="text" placeholder="Masukan Nama Produk" name="nama_produk" id="nama_produk" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Harga Jual</label>
                            <input type="number" placeholder="Masukan Harga Jual" name="harga_jual" id="harga_jual" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Harga Modal</label>
                            <input type="number" placeholder="Masukan Harga Modal" name="harga_modal" id="harga_modal" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Internal Reference</label>
                            <input type="text" placeholder="Masukan Internal Reference" name="internal_reference" id="internal_reference" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
@section('js')
<script>
    window.csrf_token = "{{ csrf_token() }}"
    $("#editProdukModal").on("show.bs.modal", function (e) {
        let button = $(e.relatedTarget);
        $("#nama_produk").val(button.data("nama"));
        $("#harga_jual").val(button.data("hj"));
        $("#harga_modal").val(button.data("hm"));
        $("#internal_reference").val(button.data("internal_reference"));
        $("#form-update").attr("action", `/produk/update/${button.data("kode")}`);
    });
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