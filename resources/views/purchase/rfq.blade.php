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
                    <table id="rfq-table" style="text-align: center" class="table table-bordered table-hover">
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
                            <tr>
                                <td>RFQ001</td>
                                <td>5/11/2024</td>
                                <td>PT. SADE</td>
                                <td>73000</td>
                                <td>RFQ</td>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-edit"></i>&nbsp;Ubah
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>&nbsp;Hapus
                                    </button>
                                </td>
                            </tr>
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
        });
    </script>
@endsection
