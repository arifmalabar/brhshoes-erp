@extends('layout/layout')

@section('status')
    active
@endsection

@section('judul')
    Edit Data
@endsection

@section('content')
    <section class="content">
        <div class="container">
            <!-- Form Input Kode, Vendor, dan Tanggal -->
            <div class="card card-default">
                <div class="card-header">
                    <h5 class="card-title">Edit Purchase Data</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('rfq.update', $rfq->id) }}" method="POST" id="rfq-form">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="kode">Kode</label>
                            <input type="text" name="kode" id="kode" class="form-control"
                                value="{{ $rfq->kode }}" placeholder="Kode RFQ" required>
                        </div>
                        <div class="form-group">
                            <label for="vendor_id">Vendor</label>
                            <input type="text" name="vendor_id" id="vendor" class="form-control"
                                value="{{ $rfq->vendor_id }}" placeholder="Nama Vendor" required>
                        </div>
                        <div class="form-group">
                            <label for="tgl_pesan">Tanggal Pesan</label>
                            <input type="date" name="tgl_pesan" id="tgl_pesan" class="form-control"
                                value="{{ $rfq->tgl_pesan }}" required>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Produk -->
            <div class="card card-default">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <div class="ms-auto">
                        <button class="btn btn-success btn-sm mb-2 mb-md-0" data-bs-toggle="modal"
                            data-bs-target="#modalProduk">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="produk-table" class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Deskripsi</th>
                                <th>Kuantitas</th>
                                <th>Harga Satuan</th>
                                <th>Subtotal</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rfq->details as $detail)
                                <tr>
                                    <td>{{ $detail->produk }}</td>
                                    <td>{{ $detail->deskripsi }}</td>
                                    <td>{{ $detail->kuantitas }}</td>
                                    <td>{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm btn-hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-center">Total</th>
                                <th id="totalHarga">{{ number_format($rfq->details->sum('subtotal'), 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="form-group mt-2 d-flex justify-content-end gap-2">
                        <a href="{{ route('rfq.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="button" class="btn btn-primary">Print RFQ</button>
                        <button type="button" class="btn btn-success" id="submitForm">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Produk -->
        <div class="modal fade" id="modalProduk" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="isiProduk">
                            <div class="form-group mb-3">
                                <label for="nama">Nama Produk</label>
                                <select id="nama" name="nama" class="form-select" required>
                                    <option value="" disabled selected>Pilih Produk</option>
                                    @foreach ($bahan as $item)
                                        <option value="{{ $item->nama }}" data-harga="{{ $item->harga_modal }}">
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="kuantitas">Kuantitas</label>
                                <input type="number" id="kuantitas" name="kuantitas" class="form-control"
                                    placeholder="Kuantitas" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="simpanProduk">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(function() {
            $('#produk-table').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
        $(document).ready(function() {
            $('#simpanProduk').on('click', function() {
                const nama = $('#nama').val();
                const kuantitas = parseInt($('#kuantitas').val());
                const harga_modal = parseInt($('#nama option:selected').data('harga'));
                const subtotal = kuantitas * harga_modal;

                if (!nama || !kuantitas) {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Lengkapi data terlebih dahulu!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }

                const newRow = `
                    <tr>
                        <td>${nama}</td>
                        <td>${nama}</td>
                        <td>${kuantitas}</td>
                        <td>${harga_modal.toLocaleString()}</td>
                        <td>${subtotal.toLocaleString()}</td>
                        <td>
                            <button class="btn btn-danger btn-sm btn-hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;

                $('#produk-table tbody').append(newRow);
                updateTotal();
                $('#modalProduk').modal('hide');
                $('#isiProduk')[0].reset();

                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Produk berhasil ditambahkan",
                    showConfirmButton: false,
                    timer: 1500
                });
            });

            $(document).on('click', '.btn-hapus', function() {
                const row = $(this).closest('tr');
                const subtotal = parseInt(row.find('td:eq(4)').text().replace(',', ''));

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    title: "Apakah yakin?",
                    text: "Ingin menghapus data bahan ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        row.remove();
                        updateTotal();
                        swalWithBootstrapButtons.fire({
                            title: "Dihapus!",
                            text: "Data Dihapus.",
                            icon: "success"
                        });
                    }
                });
            });

            function updateTotal() {
                let total = 0;
                $('#produk-table tbody tr').each(function() {
                    const subtotal = parseInt($(this).find('td:eq(4)').text().replace(',', ''));
                    if (!isNaN(subtotal)) {
                        total += subtotal;
                    }
                });
                $('#totalHarga').text(total.toLocaleString());
            }

            $('#submitForm').on('click', function() {
                const produkList = [];
                $('#produk-table tbody tr').each(function() {
                    const row = $(this);
                    const produk = {
                        components_id: row.find('td:eq(0)').text(),
                        kuantitas: row.find('td:eq(2)').text(),
                        subtotal: row.find('td:eq(4)').text().replace(',', '')
                    };
                    produkList.push(produk);
                });

                produkList.forEach(function(produk, index) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: `produk[${index}][components_id]`,
                        value: produk.components_id
                    }).appendTo('#rfq-form');
                    $('<input>').attr({
                        type: 'hidden',
                        name: `produk[${index}][kuantitas]`,
                        value: produk.kuantitas
                    }).appendTo('#rfq-form');
                    $('<input>').attr({
                        type: 'hidden',
                        name: `produk[${index}][subtotal]`,
                        value: produk.subtotal
                    }).appendTo('#rfq-form');
                });

                $('#rfq-form').submit();
            });
        });
    </script>
@endsection
