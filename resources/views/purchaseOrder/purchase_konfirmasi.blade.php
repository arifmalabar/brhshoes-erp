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
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="filterKode">Kode <i class="fas fa-key"></i></label> <!-- Ikon kunci -->
                            <select id="filterKode" class="form-control" disabled>
                                @foreach ($purchases as $purchase)
                                    <option value="{{ $purchase->kode }}">{{ $purchase->kode }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="filterVendor">Vendor <i class="fas fa-industry"></i></label> <!-- Ikon vendor -->
                            <select id="filterVendor" class="form-control" disabled>
                                @foreach ($purchases as $purchase)
                                    <option value="{{ $purchase->vendor }}">{{ $purchase->vendor }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="filterTanggalPesan">Tanggal Pesan <i class="fas fa-calendar-alt"></i></label>
                            <!-- Ikon kalender -->
                            <select id="filterTanggalPesan" class="form-control" disabled>
                                @foreach ($purchases as $purchase)
                                    <option value="{{ $purchase->tanggal_pesan }}">{{ $purchase->tanggal_pesan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="filterTanggalDiterima">Tanggal Diterima <i
                                    class="fas fa-calendar-check"></i></label> <!-- Ikon kalender cek -->
                            <select id="filterTanggalDiterima" class="form-control" disabled>
                                @foreach ($purchases as $purchase)
                                    <option value="{{ $purchase->tanggal_diterima }}">{{ $purchase->tanggal_diterima }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="filterpembayaran">Pilih Pembayaran <i class="fas fa-money-bill-wave"></i></label>
                            <!-- Ikon pembayaran -->
                            <select id="filterpembayaran" class="form-control">
                                <option value="" disabled selected>Pilih Pembayaran</option>
                                <option value="Cash">Cash</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </div>
                    </div>


                    <table id="example2" class="table table-bordered table-hover" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Deksripsi</th>
                                <th>Kuantitas</th>
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
                        <a href="{{ route('purchaseselesai', ['kode' => $purchase->kode]) }}"
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

        $(document).ready(function() {
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
            $('#filterKode, #filterVendor, #filterTanggalPesan, #filterTanggalDiterima').on('change', function() {
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
                function(settings, data, dataIndex) {
                    let tanggalPesan = $('#filterTanggalPesan').val();
                    let tanggalDiterima = $('#filterTanggalDiterima').val();
                    let tanggalData = data[2] || ""; // Tanggal di kolom ke-3

                    if ((tanggalPesan && tanggalData < tanggalPesan) || (tanggalDiterima && tanggalData >
                            tanggalDiterima)) {
                        return false;
                    }
                    return true;
                }
            );
        });
    </script>
@endsection
