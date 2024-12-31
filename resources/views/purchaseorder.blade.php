@extends('layout.layout')

@section('status', 'active')

@section('judul', 'Request for Quotation')

@section('content')
<section class="content">
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                <h4 class="card-title">Data Purchase Orders</h4>
                <div class="card-tools">
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-lg"
                        onclick="resetForm()">
                        <i class="fa fa-plus"></i>
                        Tambah Purchase Order
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover" style="text-align: center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Tanggal Pesan</th>
                            <th>Vendor</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $index => $purchase)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $purchase->kode }}</td>
                            <td>{{ $purchase->tanggal_pesan }}</td>
                            <td>{{ $purchase->vendor }}</td>
                            <td>{{ $purchase->total }}</td>
                            <td>
                                @switch((int) $purchase->status)
                                @case(0)
                                <small class="badge badge-danger">Belum Validiasi</small>
                                @break
                                @case(1)
                                <small class="badge badge-primary">Tervalidiasi</small>
                                @break
                                @case(2)
                                <small class="badge badge-warning">Terkonfirmasi</small>
                                @break
                                @case(3)
                                <small class="badge badge-success">Selesai</small>
                                @break
                                @default
                                <small class="badge badge-danger">Belum Validiasi</small>
                                @break

                                @endswitch
                            </td>
                            <td>
                                @if($purchase->status !== 'Tagihan Selesai')
                                <a href="{{ route('purchasevalidasi', ['kode' => $purchase->kode]) }}"
                                    class="btn btn-primary mb-3">Proses</a>
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Input Purchase Order</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('purchaseorder.store') }}" method="POST" id="purchaseForm">
                    @csrf
                    <div class="form-group">
                        <label for="inputKode">Kode</label>
                        <input type="text" class="form-control" id="inputKode" name="kode" placeholder="Masukkan Kode"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="inputTanggal">Tanggal Pesan</label>
                        <input type="date" class="form-control" id="inputTanggal" name="tanggal_pesan" required>
                    </div>
                    {{-- <div class="form-group">
                        <label for="inputVendor">Vendor</label>
                        <input type="text" class="form-control" id="inputVendor" name="vendor"
                            placeholder="Masukkan Vendor" required>
                    </div> --}}


                    @csrf
                    <div class="form-group">
                        <label for="inputVendor">Vendor</label>
                        <select class="form-control" id="inputVendor" name="vendor" required>
                            @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->name }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                    </div>




                    <div class="form-group">
                        <label for="inputTotal">Total</label>
                        <input type="number" class="form-control" id="inputTotal" name="total"
                            placeholder="Masukkan Total" required>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Status</label>
                        <input type="text" class="form-control" id="inputStatus" name="status" value="0" readonly
                            required>
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
        $('#purchaseForm')[0].reset();
        $('#purchaseForm').attr('action', '{{ route('purchaseorder.store') }}');
    }

    function editPurchase(kode, tanggal_pesan, vendor, total, status) {
        $('#method').val('PUT');
        $('#purchaseForm').attr('action', '/purchase/order/' + kode + '/update');
        $('#inputKode').val(kode);
        $('#inputTanggal').val(tanggal_pesan);
        $('#inputVendor').val(vendor);
        $('#inputTotal').val(total);
        $('#inputStatus').val(status);
     
    }

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