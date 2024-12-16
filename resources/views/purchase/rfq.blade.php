@extends('layout/layout')

@section('status')
    active
@endsection

@section('judul')
    Request for Quotation
@endsection

@section('content')
    <section class="content">
        <div class="container">
            <div class="card card-default">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h5 class="card-title">Purchase Data</h5>
                    <div class="ms-auto">
                        <button class="btn btn-secondary btn-sm mb-2 mb-md-0">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('rfq.create') }}" class="btn btn-success btn-sm mb-2 mb-md-0">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="rfq-table" class="table table-bordered table-hover" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Tgl Pesan</th>
                                <th>Vendor</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($RFQ as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($d->tgl_pesan)->format('d/m/Y') }}</td>
                                    <td>{{ $d->vendor_id }}</td>
                                    <td>{{ isset($d->total) ? number_format($d->total, 0, ',', '.') : '0' }}</td>
                                    <td>{{ $d->status }}</td>
                                    <td>
                                        <a href="{{ route('rfq.edit', $d->id) }}" class="btn btn-outline-info btn-sm">
                                            <i class="fas fa-edit"></i>&nbsp;Ubah
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm btn-delete"
                                            data-id="{{ $d->id }}">
                                            <i class="fas fa-trash-alt"></i>&nbsp;Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Tidak ada data RFQ</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(function() {
            $('#rfq-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $(document).on("click", ".btn-delete", function() {
                var id = $(this).data("id");

                Swal.fire({
                    title: "Apakah kamu yakin?",
                    text: "Ingin menghapus data RFQ ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#068c15",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/purchase/rfq/" + id,
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: "Dihapus!",
                                        text: response.message ||
                                            "Data berhasil dihapus.",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(() => {
                                        location.reload(); // Reload tabel
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Gagal!",
                                        text: response.message ||
                                            "Gagal menghapus data.",
                                        icon: "error"
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    title: "Gagal!",
                                    text: "Terjadi kesalahan saat menghapus data.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
