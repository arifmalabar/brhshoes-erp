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
                            <a href="/bill_material/tambah" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>&nbsp;Tambah Komposisi
                        </a>
                        </div>
                    </div>
                    <div class="card-body" id="bom-data">
                        
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