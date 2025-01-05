@extends('layout.layout')

@section('status', 'active')

@section('judul', 'Request for Quotation')

@section('content')
<section class="content">
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                <h4 class="card-title">Data Purchase Orders Pembayaran</h4>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="filterKode">Kode</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span> <!-- Ikon Kunci -->
                            </div>
                            <select id="filterKode" class="form-control" disabled>
                                @foreach ($purchases as $purchase)
                                <option value="{{ $purchase->kode }}">{{ $purchase->kode }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-3">
                        <label for="filterVendor">Vendor</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-industry"></i></span> <!-- Ikon untuk Vendor -->
                            </div>
                            <select id="filterVendor" class="form-control" disabled>
                                @foreach ($purchases as $purchase)
                                <option value="{{ $purchase->vendor }}">{{ $purchase->vendor }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="filterTanggalPesan">Tanggal Pesan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span> <!-- Ikon untuk Tanggal Pesan -->
                            </div>
                            <select id="filterTanggalPesan" class="form-control" disabled>
                                @foreach ($purchases as $purchase)
                                <option value="{{ $purchase->tanggal_pesan }}">{{ $purchase->tanggal_pesan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="filterTanggalDiterima">Tanggal Diterima</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-check"></i></span> <!-- Ikon untuk Tanggal Diterima -->
                            </div>
                            <select id="filterTanggalDiterima" class="form-control">
                                @foreach ($purchases as $purchase)
                                    <option value="{{ $purchase->tanggal_diterima }}">{{ $purchase->tanggal_diterima }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    
                 
                </div>

                <table id="example2" class="table table-bordered table-hover" style="text-align: center">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Deksripsi</th>
                            <th>Kuantitas</th>
                            <th>Diterima</th>
                            <th>Ditagih</th>
                            <th>Harga Satuan</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purchase)
                        <tr>
                    <tbody>
                        @foreach ($purchases as $purchase)
                        <tr>
                            <td>Kanvas</td>
                            <td>Kanvas</td>
                            <td>1</td>
                            <td>1</td>
                            <td>0</td>
                            <td>30.000</td>
                            <td>30.000</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </tr>
                    @endforeach
                    </tbody>


                </table>


                <!-- Tombol Proses yang diletakkan di bawah kanan -->
                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('purchasekonfirmasi', ['kode' => $purchase->kode]) }}"
                        class="btn btn-primary mb-3">Konfirmasi</a>
                </div>
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