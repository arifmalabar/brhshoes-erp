@extends('layout.layout')

@section('status')
active
@endsection

@section('judul')
Vendor Individual
@endsection

@section('content')
<section class="content">
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                <h4 class="card-title">Data Vendor</h4>
                <div class="card-tools">
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-lg" onclick="resetForm()">
                        <i class="fa fa-plus"></i>
                        Tambah Vendor
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover" style="text-align: center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Vendor</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendors as $index => $vendor)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $vendor->kode }}</td>
                            <td>{{ $vendor->name }}</td>
                            <td>{{ $vendor->email }}</td>
                            <td>{{ $vendor->no_telp }}</td>
                            <td>{{ $vendor->alamat }}</td>
                            <td>
                                <!-- Edit button (with modal to update) -->
                                <button data-toggle="modal" data-target="#modal-lg" class="btn btn-warning btn-sm" 
                                        onclick="editVendor('{{ $vendor->kode }}', '{{ $vendor->name }}', '{{ $vendor->email }}', '{{ $vendor->no_telp }}', '{{ $vendor->alamat }}')">
                                    Edit
                                </button>
                                
                                <!-- Delete button -->
                                <form action="{{ route('vendor.destroy', $vendor->kode) }}" method="POST" style="display:inline;">
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
</section>

<!-- Modal for Adding and Editing Vendor -->
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Input Data Vendor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('vendor.store') }}" method="POST" id="vendorForm">
                    @csrf
                    <input type="hidden" name="_method" id="method" value="POST">
                    <input type="hidden" name="vendor_id" id="vendor_id">

                    <div class="form-group">
                        <label for="inputKode">Kode</label>
                        <input type="text" class="form-control" id="inputKode" name="kode" placeholder="Masukkan Kode" required>
                    </div>

                    <div class="form-group">
                        <label for="inputName">Nama</label>
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="Masukkan Nama" required>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Masukkan Email" required>
                    </div>

                    <div class="form-group">
                        <label for="inputtelp">Telepon</label>
                        <input type="text" class="form-control" id="inputtelp" name="no_telp" placeholder="Masukkan Nomer Telp" required>
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">Alamat</label>
                        <textarea class="form-control" id="inputAddress" name="alamat" rows="3" placeholder="Masukkan Alamat" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    function resetForm() {
        $('#method').val('POST');
        $('#vendorForm').attr('action', '{{ route('vendor.store') }}');
        $('#vendor_id').val('');
        $('#inputKode').val('');
        $('#inputName').val('');
        $('#inputEmail').val('');
        $('#inputtelp').val('');
        $('#inputAddress').val('');
    }

    function editVendor(kode, name, email, no_telp, alamat) {
        // Set form action for update
        $('#method').val('PUT');
        $('#vendorForm').attr('action', '/vendor/perorangan/' + kode + '/update');
        $('#vendor_id').val(kode);
        $('#inputKode').val(kode);
        $('#inputName').val(name);
        $('#inputEmail').val(email);
        $('#inputtelp').val(no_telp);
        $('#inputAddress').val(alamat);
    }

    $(function() {
        // Initialize DataTables
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
