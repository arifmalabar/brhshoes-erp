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
                        <h4 class="card-title">Informasi Produk</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('bom.store') }}" method="POST">
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Produk
                                            </label>
                                            <select id="nama_produk" name="nama_produk" class="form-select" required>
                                                <option value="" disabled selected>Pilih Produk</option>
                                                @foreach ($produk as $item)
                                                    <option value="{{ $item->nama_produk }}">
                                                        {{ $item->nama_produk }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Kategori
                                            </label>
                                            <select id="nama_kategori" name="nama_kategori" class="form-select" required>
                                                <option value="" disabled selected>Pilih Kategori</option>
                                                @foreach ($kategori as $item)
                                                    <option value="{{ $item->nama_kategori}}">
                                                        {{ $item->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Kuantitas
                                            </label>
                                            <input type="number" id="quantity" name="quantity" class="form-control" 
                                                    placeholder="Masukkan Kuantitas" required>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Kuantitas
                                            </label>
                                            <input type="text" id="satuan" name="satuan" class="form-control" 
                                                    placeholder="Satuan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success btn-sm float-left" id="#simpanBOM">
                                            <i class="fa fa-plus"></i> Tambah Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                           </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">Bill Of Material Detail</h4>
                        <div class="card-tools">
                            <button class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#tambahKomposisi">
                                <i class="fa fa-plus"></i>&nbsp;Tambah Komposisi
                            </button>
                            <div class="modal fade" id="tambahKomposisi" tabindex="-1" role="dialog" aria-labelledby="tambahKomposisi"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahKomposisi">Tambah Komposisi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Bahan</label>
                                                        <select id="nama" name="nama" class="form-select" required>
                                                            <option value="" disabled selected>Pilih Bahan</option>
                                                            @foreach ($bahan as $item)
                                                                <option value="{{ $item->nama }}">
                                                                    {{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Kuantitas</label>
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <input type="number" id="quantity" name="quantity" class="form-control" 
                                                                placeholder="Masukkan Kuantitas" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" id="satuan" name="satuan" class="form-control" 
                                                                placeholder="Satuan" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary" id="#simpanBahan">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="bahan-table" class="table table-bordered table-hover" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bahan</th>
                                    <th>Kuantitas</th>
                                    <th>Harga</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
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
    <script src="{{ mix("js/tambah_bom.js") }}"></script>
    <script>
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
        $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
        });

        $(document).ready(function() {
            $('#simpanBOM'),on('click', funstion(){
                const nama_produk = $('#nama_produk').val();
                const kategori = $('#kategori').val();
                const quantity = parseInt($('#quantity').val());
                const satuan = $('#satuan').val();

                if (!nama_produk || !kategori ||!quantity || !satuan) {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Lengkapi data terlebih dahulu!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }
                
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Produk berhasil ditambahkan",
                    showConfirmButton: false,
                    timer: 1500
                });
            });

            $('#simpanBahan').on('click', funstion() {
                const bahan = $('#bahan').val();
                const quantity = parseInt($(#quantity).val());
                const satuan = $('#satuan').val();
                const price= quantity * harga_modal;

                const newRow = '
                    <tr>
                        <td>${bahan}</td>
                        <td>${quantity}</td>
                        <td>${satuan}</td>
                        <td>${price.toLocaleString()}</td>
                    </tr>
                ';

                $('#bahan-table tbody').append(newRow);
            });
        })
    </script>
@endsection