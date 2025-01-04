@extends('layout/layout')
@section('status')
    active
@endsection
@section('judul')
    Bill Of Material
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">Bill Of Material Detail</h4>
                        <div class="card-tools">
                            <a href="{{ route('bom.create') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>&nbsp;Tambah Komposisi
                        </a>
                        </div>
                    </div>
                    <div class="card-body row" id="bom-data">
                        <div class="col-md-12">
                            <table
                                id="example2"
                                class="table table-bordered table-hover text-center">                            >
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Produk</th>
                                        <th>Reference</th>
                                        <th>Total Komponen</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key)
                                    <tr>
                                        <td>{{ $key->id }}</td>
                                        <td>{{ $key->nama_produk }}</td>
                                        <td>{{ $key->internal_reference }}</td>
                                        <td>{{ $key->total }}</td>
                                        <td>
                                            <a
                                                href="/bill_material/show/{{ $key->id }}"
                                                class="btn btn-sm btn-outline-info"
                                            >
                                                <i class="fa fa-edit"></i> Update
                                            </a>
                                            &nbsp;
                                            <a
                                                href="/bill_material/hapus/"
                                                class="btn btn-sm btn-outline-danger btn-hapus"
                                                
                                            >
                                                <i class="fa fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
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