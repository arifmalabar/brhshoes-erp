@extends('layout/layout')
@section('status')
active
@endsection
@section('judul')
Manufacturing Order
@endsection
@section('content')
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">Manufacturing Order Data</h4>
                        <div class="card-tools">
                            <button href="#" class="btn btn-outline-warning btn-sm"><i
                                    class="fa fa-sort"></i>&nbsp;Sorting</button>
                            <a href="#" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp;Manufacturing
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
                                    <th>Bahan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>MO_01</td>
                                    <td>31-10-2024</td>
                                    <td>[PSS] Sepatu Sekolah</td>
                                    <td><span class="badge badge-success">Tersedia</span></td>
                                    <td><a href="/manufacturing_order/mo_detail" class="btn btn-primary btn-sm">Draf</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script>
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
</script>
@endsection