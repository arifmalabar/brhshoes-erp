@extends('layout/layout')

@section('status')
    active
@endsection

@section('judul')
    Customer
@endsection

@section('content')
    <section class="content">
        <div class="container">
            <div class="card card-default">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h5 class="card-title">Data Customer</h5>
                    <div class="ms-auto">
                        <button type="button" class="btn btn-success btn-sm mb-2 mb-md-0" data-toggle="modal"
                            data-target="#tambahCustomerModal">
                            <i class="fas fa-plus"></i> Tambah Data
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="customer-table" class="table table-bordered table-hover" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>No Telp</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $d->kode }}</td>
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->no_tlp }}</td>
                                    <td>{{ $d->email }}</td>
                                    <td>{{ $d->alamat }}</td>
                                    <td>
                                        <center>
                                            <button class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                data-target="#editCustomerModal" data-id="{{ $d->id }}"
                                                data-nama="{{ $d->nama }}" data-no_tlp="{{ $d->no_tlp }}"
                                                data-email="{{ $d->email }}" data-alamat="{{ $d->alamat }}">
                                                <i class="fas fa-pencil-alt"></i>&nbsp;Ubah
                                            </button>
                                            <form action="{{ route('customer.delete', $d->id) }}" method="POST"
                                                id="delete-form-{{ $d->id }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    onclick="confirmDelete('{{ $d->id }}')">
                                                    <i class="fas fa-trash-alt"></i>&nbsp;Hapus
                                                </button>
                                            </form>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Data -->
        <div class="modal fade" id="tambahCustomerModal" tabindex="-1" role="dialog"
            aria-labelledby="tambahCustomerModal-title" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahCustomerModal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formTambahCustomer" action="{{ url('/customer/store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="kode">Kode</label>
                                    <input type="text" class="form-control" id="kode" name="kode"
                                        placeholder="Kode">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Nama">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="no-telp">No Telp</label>
                                    <input type="text" class="form-control" id="no_tlp" name="no_tlp"
                                        placeholder="No Telp">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" form="formTambahCustomer">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Data -->
        <div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog"
            aria-labelledby="editCustomerModal-title" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCustomerModal-title">Ubah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditCustomer" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="editKode">Kode</label>
                                    <input type="text" class="form-control" id="editKode" name="kode"
                                        placeholder="Kode" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="editNama">Nama</label>
                                    <input type="text" class="form-control" id="editNama" name="nama"
                                        placeholder="Nama">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="editNotlp">No Telp</label>
                                    <input type="text" class="form-control" id="editNotlp" name="no_tlp"
                                        placeholder="No Telp">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="editEmail">Email</label>
                                    <input type="email" class="form-control" id="editEmail" name="email"
                                        placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editAlamat">Alamat</label>
                                <textarea class="form-control" id="editAlamat" name="alamat" rows="3" placeholder="Alamat"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" form="formEditCustomer">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('js')
    <script>
        $(function() {
            $('#customer-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        $('#editCustomerModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nama = button.data('nama');
            var no_tlp = button.data('no_tlp');
            var email = button.data('email');
            var alamat = button.data('alamat');

            var modal = $(this);
            modal.find('.modal-body #editKode').val(id);
            modal.find('.modal-body #editNama').val(nama);
            modal.find('.modal-body #editNotlp').val(no_tlp);
            modal.find('.modal-body #editEmail').val(email);
            modal.find('.modal-body #editAlamat').val(alamat);

            var formAction = '{{ url('/customer') }}/' + id + '/update';
            modal.find('form').attr('action', formAction);
        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        function confirmDelete(id) {
            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Ingin menghapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#068c15",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                    Swal.fire({
                        title: "Dihapus!",
                        text: "Data dihapus",
                        icon: "success"
                    });
                }
            });
        }
    </script>
@endsection
