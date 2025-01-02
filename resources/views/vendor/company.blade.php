@extends('layout.layout')

@section('status')
active
@endsection

@section('judul')
Vendor Company
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
                            <th>Website</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendors as $index => $vendorcompany)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $vendorcompany->kode }}</td>
                            <td>{{ $vendorcompany->name }}</td>
                            <td>{{ $vendorcompany->email }}</td>
                            <td>{{ $vendorcompany->no_telp }}</td>
                            <td>{{ $vendorcompany->alamat }}</td>
                            <td>{{ $vendorcompany->website }}</td>
                            <td>
                                <!-- Edit button (with modal to update) -->
                                <button data-toggle="modal" data-target="#modal-lg" class="btn btn-warning btn-sm" 
                                        onclick="editVendor('{{ $vendorcompany->kode }}', '{{ $vendorcompany->name }}', '{{ $vendorcompany->email }}', '{{ $vendorcompany->no_telp }}', '{{ $vendorcompany->alamat }}', '{{ $vendorcompany->website }}')">
                                    Edit
                                </button>
                                
                                <!-- Delete button -->
                                <form action="{{ route('vendorcompany.destroy', $vendorcompany->kode) }}" method="POST" style="display:inline;">
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
                <form action="{{ route('vendorcompany.store') }}" method="POST" id="vendorForm">
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

                    <div class="form-group">
                        <label for="inputwebsite">Website</label>
                        <input type="text" class="form-control" id="inputwebsite" name="website" placeholder="Masukkan Website" required>
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
        $('#vendorForm').attr('action', '{{ route('vendorcompany.store') }}');
        $('#vendor_id').val('');
        $('#inputKode').val('');
        $('#inputName').val('');
        $('#inputEmail').val('');
        $('#inputtelp').val('');
        $('#inputAddress').val('');
        $('#inputwebsite').val('');
    }

    function editVendor(kode, name, email, no_telp, alamat) {
        // Set form action for update
        $('#method').val('PUT');
        $('#vendorForm').attr('action', '/vendor/company/' + kode + '/update');
        $('#vendor_id').val(kode);
        $('#inputKode').val(kode);
        $('#inputName').val(name);
        $('#inputEmail').val(email);
        $('#inputtelp').val(no_telp);
        $('#inputAddress').val(alamat);
        $('#inputwebsite').val(website);
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
