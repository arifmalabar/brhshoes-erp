@extends('layout/layout')
@section('judul')
Customer
@endsection
@section('content')
<section class="conten">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            Data Customer
                        </h3>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-outline-success" data-toggle="modal"
                                data-target="#modal-tambah">
                                <i class="fa fa-plus"></i>
                                Data Customer
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Notelp</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <!--modal-->
                        <div class="modal fade" id="modal-tambah">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">
                                            Tambah Data
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">NIK</label>
                                                    <input type="number" name="nik" id="" placeholder="Masukan NIK"
                                                        class="form-control">
                                                    <input type="hidden" id="csrf" value="{{ csrf_token() }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nama</label>
                                                    <input type="text" name="nama" id="" placeholder="Masukan Nama"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">No Telp</label>
                                                    <input type="number" name="notelp" placeholder="Masukan Notelp"
                                                        id="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" name="email" placeholder="roa@email.id" id=""
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Alamat</label>
                                                    <textarea name="alamat" id="alamat" class="form-control"
                                                        placeholder="Masukan Alamat" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button class="btn btn-default float-left" data-dismiss="modal">Clear</button>
                                        <button class="btn btn-success btn-proses" data-dismiss="modal">Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modal-update">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">
                                            Update Data
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">NIK</label>
                                                    <input type="number" name="update-nik" id="update-nik"
                                                        placeholder="Masukan NIK" class="form-control">
                                                    <input type="hidden" class="id_customer">
                                                    <input type="hidden" class="csrf" value="{{ csrf_token() }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nama</label>
                                                    <input type="text" name="update-nama" id=""
                                                        placeholder="Masukan Nama" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">No Telp</label>
                                                    <input type="number" name="update-notelp"
                                                        placeholder="Masukan Notelp" id="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" name="update-email" id="update-email"
                                                        placeholder="roa@email.id" id="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Alamat</label>
                                                    <textarea name="update-alamat" class="form-control update-alamat"
                                                        placeholder="Masukan Alamat" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button class="btn btn-default float-left" data-dismiss="modal">Clear</button>
                                        <button class="btn btn-warning btn-update" data-dismiss="modal">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script type="module" src="{{ asset('js/customer/index.js') }}"></script>
<script type="module" src="{{ asset('js/customer/tambah/index.js') }}"></script>
<script type="module" src="{{ asset('js/customer/update/index.js') }}"></script>
<script type="module" src="{{ asset('js/customer/delete/index.js') }}"></script>
<script>
    window.data = {
        token : "{{ csrf_token() }}"
    };
    $("#modal-update").on('show.bs.modal', function (e) {
        let button = $(e.relatedTarget);
        let id = button.data("id");
        let nik = button.data("nik");
        let nama = button.data("nama");
        let notelp = button.data("notelp");
        let email = button.data("email");
        let alamat = button.data("alamat");

        $(".id_customer").val(id);
        $("input[name='update-nik']").val(nik);
        $("input[name='update-nama']").val(nama);
        $("input[name='update-notelp']").val(notelp);
        $("input[name='update-email']").val(email);
        $(".update-alamat").val(alamat);
    });
    
</script>
@endsection