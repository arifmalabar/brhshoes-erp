@extends('layout/layout')
@section('status')
active
@endsection
@section('judul')
Tambah Manufacturing
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                <div class="row">
                    <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="">Produk <sup>*</sup></label>
                            <div class="col-sm-10">
                                <select name="" id="product-data" class="form-control select2bs4">
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
                                <select name="" id="bom-data" class="form-control select2bs4">
                                    <option value="SP001">[PSS] Sepatu Sekolah</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="">Jadwal Awal<sup>*</sup></label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="NIK"
                                    placeholder="Masukan Nama Produk" value="2024-10-24" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="">Estimasi Selesai <sup>*</sup></label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="NIK"
                                    placeholder="Masukan Nama Produk" value="2024-10-24" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label" for="">Kuantitas <sup>*</sup></label>
                            <div class="col-sm-11">
                                <input type="number" class="form-control" name="NIK"
                                    placeholder="Masukan Masukan Kuantias" value="100" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <table id="example2" style="text-align: center"
                            class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Komponen</th>
                                    <th>Disediakan</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <button class="btn btn-success btn-sm float-right">Tambah Manufacturing Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script src="{{ asset("js/manufacturingorder/index.js") }}"  type="module"></script>
<script>
    const dt = [
        {
            komponen : "kavas",
            membutuhkan : 5000,
            satuan : "cm"
        },
        {
            komponen : "sol karet",
            membutuhkan : 200,
            satuan : "pcs"
        },
        {
            komponen : "Insole",
            membutuhkan : 3000,
            satuan : "gr"
        },
        {
            komponen : "Benang Jahit",
            membutuhkan : 10000,
            satuan : "gr"
        },
        {
            komponen : "Lem Sepatu",
            membutuhkan : 20000,
            satuan : "ml"
        },
        {
            komponen : "Tali Sepatu",
            membutuhkan : 200,
            satuan : "pcs"
        },
        {
            komponen : "Prexson",
            membutuhkan : 3000,
            satuan : "cm"
        },
        {
            komponen : "eyelet",
            membutuhkan : 1200,
            satuan : "pcs"
        },
        {
            komponen : "Busa",
            membutuhkan : 5000,
            satuan : "cm"
        },
        {
            komponen : "furing",
            membutuhkan : 5000,
            satuan : "cm"
        },
    ]
    let no = 1;
    $(function() {
            
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "bDestroy": true,   
                
            });
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "bDestroy": true,   
                data : dt,
                columns: [
                    {
                        data : 'komponen',
                    },
                    {
                        data : null,
                        render: function (data, type, row) {
                            return `${row.membutuhkan} ${row.satuan}`
                        }
                    },
                    {
                        data : null,
                        render: function (data, type, row) {
                            return `${row.membutuhkan} ${row.satuan}`
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return `${row.membutuhkan} ${row.satuan}`
                        }
                    }
                ]
            });
        });
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
</script>
@endsection