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
                    <div class="card-body" id="bom-data">
                        <table id="example2" className="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Reference</th>
                                    <th>Total Komponen</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $bomitem)
                                    <tr>
                                        <td>{{ $index + 1}}</td>
                                        <td>{{ $bomitem->id }}</td>
                                        <td>{{ $bomitem->nama_produk}}</td>
                                        <td>{{ $bomitem->internal_reference}}</td>
                                        <td>
                                            <button href="{{ route('bom.update'), $bomitem->id}}" class="btn btn-warning btn-sm" >
                                            Edit
                                            </button>
                                            <form action="{{ route('bom.destroy', $bomitem->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
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
</section>
@endsection
@section('js')
    <script src="{{ mix("js/bom.js") }}"></script>
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