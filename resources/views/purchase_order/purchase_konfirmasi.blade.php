@extends('layout.layout')

@section('status', 'active')

@section('judul', 'Request for Quotation')

@section('content')
<section class="content">
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                <h4 class="card-title">Data Purchase Orders Konfirmasi</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    <form action="/update-tanggal-diterima" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="filterKode">Kode <i class="fas fa-key"></i></label> <!-- Ikon kunci -->
                                <input type="text" readonly name="kode" readonly value="{{ $purchases->kode }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="filterVendor">Vendor <i class="fas fa-industry"></i></label>
                                <!-- Ikon vendor -->
                                <input type="text" name="vendor" readonly value="{{ $purchases->vendor }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="filterTanggalPesan">Tanggal Pesan <i
                                        class="fas fa-calendar-alt"></i></label>
                                <!-- Ikon kalender -->
                                <input type="text" name="tanggal_pesan" readonly value="{{ $purchases->tanggal_pesan }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="filterTanggalDiterima">Tanggal Diterima <i
                                        class="fas fa-calendar-check"></i></label> <!-- Ikon kalender cek -->
                                <input type="date" id="filterTanggalDiterima" value="{{ date('Y-m-d') }}"
                                    class="form-control" readonly name="tanggal_diterima">
                            </div>
                            <div class="col-md-12">
                                <label for="filterpembayaran">Pilih Pembayaran <i
                                        class="fas fa-money-bill-wave"></i></label>
                                <!-- Ikon pembayaran -->
                                <select id="filterpembayaran" name="metode_pembayaran" class="form-control">
                                    <option value="" disabled selected>Pilih Pembayaran</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <button type="submit" class="btn btn-primary float-right">Bayar</button>
                            </div>
                        </div>
                    </form>

                </div>
                @include('purchase_order/component/tabel_bahan')
                <!-- Tombol Proses yang diletakkan di bawah kanan -->
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    function resetForm() {
        $('#purchaseForm')[0].reset();
        $('#purchaseForm').attr('action', '{{ route('purchaseorder.store') }}');
    }

    $(document).ready(function () {
        const table = $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        // Filter functionality
        $('#filterKode, #filterVendor, #filterTanggalPesan, #filterTanggalDiterima').on('change', function () {
            let kode = $('#filterKode').val();
            let vendor = $('#filterVendor').val();
            let tanggalPesan = $('#filterTanggalPesan').val();
            let tanggalDiterima = $('#filterTanggalDiterima').val();

            table.columns(1).search(kode).draw();
            table.columns(3).search(vendor).draw();
            // Custom filter for dates
            table.draw();
        });

        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                let tanggalPesan = $('#filterTanggalPesan').val();
                let tanggalDiterima = $('#filterTanggalDiterima').val();
                let tanggalData = data[2] || ""; // Tanggal di kolom ke-3

                if ((tanggalPesan && tanggalData < tanggalPesan) || (tanggalDiterima && tanggalData > tanggalDiterima)) {
                    return false;
                }
                return true;
            }
        );
    });
</script>
@endsection