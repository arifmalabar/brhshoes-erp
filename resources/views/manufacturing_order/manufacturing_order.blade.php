@extends('layout/layout')
@section('status')
active
@endsection
@section('judul')
Manufacturing Order
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h4 class="card-title">Manufacturing Order Data</h4>
                <div class="card-tools">
                    <button href="#" class="btn btn-outline-warning btn-sm"><i
                            class="fa fa-sort"></i>&nbsp;Sorting</button>

                    <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-xl"><i
                            class="fa fa-plus"></i>&nbsp;Manufacturing
                        Order</a>
                </div>
            </div>
            <div class="card-body">
                <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Reference</th>
                            <th>Jadwal</th>
                            <th>Produk</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($data["mo_data"] as $key)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $key->id }}</td>
                            <td>{{ $key->schedule }} - {{ $key->late }}</td>
                            <td>{{ $key->nama_produk }}</td>
                            <td><a href="/manufacturing_order/mo_detail/{{ $key->id }}" class="btn btn-primary btn-sm">Draf</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="modal fade" id="modal-xl">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Extra Large Modal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="">Produk
                                                <sup>*</sup></label>
                                            <div class="col-sm-10">
                                                <select name="" id="data-spt" class="form-control">
                                                    <option value="SP001">Sepatu Sekolah</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="">Bill Of Material
                                                <sup>*</sup></label>
                                            <div class="col-sm-10">
                                                <select name="" id="bom-data" class="form-control">
                                                    <option value="SP001">[PSS] Sepatu Sekolah</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="">Kuantitas
                                                <sup>*</sup></label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="NIK"
                                                    placeholder="Masukan Masukan Kuantias" value="100" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="">Jadwal
                                                <sup>*</sup></label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="NIK"
                                                    placeholder="Masukan Nama Produk" value="2024-10-24"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default"
                                    data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!-- /.modal -->
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')

<script>
    $('.select2').select2();

//Initialize Select2 Elements
$('.select2bs4').select2({
theme: 'bootstrap4'
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
    //get product data
</script>
@endsection