@extends('layout/layout')
@section('status')
active
@endsection
@section('judul')
Manufacturing Order Detail
@php
$modata = $data["mo_data"];
@endphp
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body p-0">
                <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                        <!-- your steps here -->
                        <div class="step" data-target="#logins-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="logins-part"
                                id="logins-part-trigger">
                                <span class="bs-stepper-circle"><i class="fa fa-user"></i></span>
                                <span class="bs-stepper-label">Konfirmasi</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#information-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part"
                                id="information-part-trigger">
                                <span class="bs-stepper-circle"><i class="fas fa-solid fa-building"></i></span>
                                <span class="bs-stepper-label">Produksi</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#selesai-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="selesai-part"
                                id="selesai-part-trigger">
                                <span class="bs-stepper-circle"><i class="fas fa-solid fa-building"></i></span>
                                <span class="bs-stepper-label">Selesai</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <!-- your steps content here -->
                        <input type="hidden" value="{{ csrf_token() }}" class="token">
                        <input type="hidden" value="{{ $modata->status }}" class="status">
                        <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                            <div class="row">
                                <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="">Produk <sup>*</sup></label>
                                        <div class="col-sm-10">
                                            <select name="" id="product-data" class="form-control select2bs4">
                                                @foreach($data["data_produk"] as $key)
                                                @if($modata->product_id == $key->product_id)
                                                <option selected value="{{ $key->id }}">{{ $key->nama_produk }}</option>
                                                @elseif($modata->product_id != $key->product_id)
                                                <option value="{{ $key->id }}">{{ $key->nama_produk }}</option>
                                                @endif
                                                @endforeach
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
                                                @foreach($data["data_bom"] as $key)
                                                @if($modata->bom_id == $key->id)
                                                <option selected value="{{ $key->id }}">{{ $key->id }}</option>
                                                @elseif($modata->bom_id != $key->id)
                                                <option value="{{ $key->id }}">{{ $key->id }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="">Kuantitas <sup>*</sup></label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="NIK" id="kuantitas"
                                                placeholder="Masukan Masukan Kuantias" value="{{ $modata->quantity }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="">Estimasi <sup>*</sup></label>
                                        <div class="col-sm-5">
                                            <input type="date" class="form-control" id="et-mulai"
                                                placeholder="Masukan Nama Produk" value="{{ $modata->schedule }}"
                                                required>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="date" class="form-control" id="et-selesai" name="NIK"
                                                placeholder="Masukan Nama Produk" value="{{ $modata->late }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table id="example2" style="text-align: center"
                                        class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Komponen</th>
                                                <th>Membutuhkan</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                </div>
                                <div class="col-md-6 btn-update-place">
                                    <br>
                                    @if($modata->status == 0)
                                    <button class="btn btn-warning text-white next-btn float-left"
                                        onclick="stepper.next()" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-four-profile" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false"><i
                                            class="fa fa-solid fa-edit"></i>&nbsp;Update</button>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <a class="btn btn-info text-white next-btn float-right btn-konfirm"
                                        href="/manufacturing_order/step/{{ $modata->id }}"><i
                                            class="fa fa-solid fa-check"></i>&nbsp;Konfirmasi</a>
                                    <!-- <button class="btn btn-info text-white next-btn float-right"
                                        onclick="stepper.next()" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-four-profile" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false"><i
                                            class="fa fa-solid fa-check"></i>&nbsp;Konfirmasi</button>-->
                                </div>
                            </div>
                        </div>
                        <div id="information-part" class="content" role="tabpanel"
                            aria-labelledby="information-part-trigger">
                            <div class="row">
                                <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="">Produk <sup>*</sup></label>
                                        <div class="col-sm-10">
                                            <select name="" id="product-data" disabled class="form-control select2bs4">
                                                @foreach($data["data_produk"] as $key)
                                                @if($modata->product_id == $key->product_id)
                                                <option selected value="{{ $key->id }}">{{ $key->nama_produk }}</option>
                                                @elseif($modata->product_id != $key->product_id)
                                                <option value="{{ $key->id }}">{{ $key->nama_produk }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="">Bill Of Material
                                            <sup>*</sup></label>
                                        <div class="col-sm-10">
                                            <select name="" id="bom-data" disabled class="form-control select2bs4">
                                                @foreach($data["data_bom"] as $key)
                                                @if($modata->bom_id == $key->id)
                                                <option selected value="{{ $key->id }}">{{ $key->id }}</option>
                                                @elseif($modata->bom_id != $key->id)
                                                <option value="{{ $key->id }}">{{ $key->id }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="">Kuantitas <sup>*</sup></label>
                                        <div class="col-sm-10">
                                            <input type="number" disabled class="form-control" name="NIK" id="kuantitas"
                                                placeholder="Masukan Masukan Kuantias" value="{{ $modata->quantity }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="">Estimasi <sup>*</sup></label>
                                        <div class="col-sm-5">
                                            <input type="date" class="form-control" disabled id="et-mulai"
                                                placeholder="Masukan Nama Produk" value="{{ $modata->schedule }}"
                                                required>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="date" class="form-control" disabled id="et-selesai" name="NIK"
                                                placeholder="Masukan Nama Produk" value="{{ $modata->late }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table id="example3" style="text-align: center"
                                        class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Komponen</th>
                                                <th>Membutuhkan</th>
                                                <th>Digunakan</th>
                                                <th>Diproduksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <a class="btn btn-info text-white next-btn float-right btn-konfirm"
                                        href="/manufacturing_order/step/{{ $modata->id }}"><i
                                            class="fa fa-solid fa-check"></i>&nbsp;Produksi</a>
                                </div>
                            </div>
                        </div>
                        <div id="selesai-part" class="content" role="tabpanel" aria-labelledby="selesai-part-trigger">
                            <div class="row">
                                <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="">Poduk <sup>*</sup></label>
                                        <div class="col-sm-10">
                                            <select name="" id="product-data" disabled class="form-control select2bs4">
                                                <option value="SP001">Sepau Sekolah</option>
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
                                        <label class="col-sm-2 col-form-label" for="">Kuantitas <sup>*</sup></label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="Kuantitias"
                                                placeholder="Masukan Masukan Kuantias" value="10" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="">Jadwal <sup>*</sup></label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" name="NIK"
                                                placeholder="Masukan Nama Produk" value="2024-10-24" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table id="example1" style="text-align: center"
                                        class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Komponen</th>
                                                <th>Membutuhkan</th>
                                                <th>Disediakan</th>
                                                <th>Diproduksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <a class="btn btn-primary text-white next-btn float-right"
                                        href="/manufacturing_order" aria-selected="false">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script src="{{ asset('js/manufacturingorder/update/index.js') }}" type="module"></script>
<script>
    $(".btn-konfirm").on("click", function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Ingin konfirmasi produk",
            showDenyButton: true,
            confirmButtonText: "Konfirmasi, produk",
            denyButtonText: `Batalkan`,
            icon: "question",
            text: "Produk yang dikonfirmasi tidak dapat diubah datanya"
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href =$(this).attr("href");
                } else if (result.isDenied) {
                    Swal.fire("Konfirmasi dibatalkan", "", "info");
                }
            });
    });

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
                data : dt,
                columns: [
                    {
                        data : 'komponen',
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return `${row.membutuhkan} ${row.satuan}`
                        }
                    }
                ]
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
            try {
                let status = parseInt($(".status").val()) + 1;
                window.stepper.to(status);
            } catch (error) {
                window.stepper.to(1);
            }
        })
</script>
@endsection