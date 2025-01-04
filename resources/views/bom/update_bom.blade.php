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
                        <form action="/bill_material/{{ $bom->id }}" id="editBOM" method="POST">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Produk
                                        </label>
                                        <select id="products_id" name="products_id" class="form-select" required>
                                            <option value="" disabled selected>Pilih Produk</option>
                                            @foreach ($produk as $item)
                                                @if($item->id == $bom->products_id)
                                                    <option selected value="{{ $item->id }}">
                                                        {{ $item->nama_produk }}
                                                    </option>
                                                @else
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nama_produk }}
                                                </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Kategori
                                        </label>
                                        <select id="nama_kategori" name="categories_id" class="form-select" required>
                                            <option value="" disabled selected>Pilih Kategori</option>
                                            @foreach ($kategori as $item)
                                                @if ($item->id == $bom->categories_id)
                                                    <option selected value="{{ $item->id }}">
                                                        {{ $item->nama_kategori }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->id}}">
                                                        {{ $item->nama_kategori }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Kuantitas
                                        </label>
                                        <input type="number" id="quantity" value="{{ $bom->quantity }}" name="quantity" class="form-control" 
                                                placeholder="Masukkan Kuantitas" required>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Satuan
                                        </label>
                                        <input type="text" id="satuan" value="{{ $bom->satuan }}" name="satuan" class="form-control" 
                                                placeholder="Satuan" required>
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
                                    <form action="/bill_material/bahan/tambah" method="post">
                                        @csrf
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
                                                            <label>BOM</label>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <input type="text" readonly value="{{ $bom->id }}" id="kuantitas" name="billofmaterials_id" class="form-control" 
                                                                    placeholder="Masukkan Kuantitas" required>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Bahan</label>
                                                            <select id="components_id" name="components_id" class="form-select" required>
                                                                <option value="" disabled selected>Pilih Bahan</option>
                                                                @foreach ($bahan as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Kuantitas</label>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <input type="number" id="kuantitas" name="quantity" class="form-control" 
                                                                    placeholder="Masukkan Kuantitas" required>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Harga</label>
                                                            <input type="number" id="harga" name="price" class="form-control" 
                                                                            placeholder="Masukkan Kuantitas" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary" id="#simpanBahan">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover" style="text-align: center">
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
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($bom_detail as $key)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $key->nama }}</td>
                                    <td>{{ $key->quantity }}</td>
                                    <td>{{ $key->price }}</td>
                                    <td>
                                        <form action="/bill_material/bahan/hapus/{{ $key->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="col-md-12">
                            <button type="submit" form="editBOM" class="btn btn-warning btn-sm float-right" id="simpanBOM">
                                <i class="fa fa-edit"></i> Ubah Data
                            </button>
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
        

            $(document).ready(function() {
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