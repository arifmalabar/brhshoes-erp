<div class="col-md-6">
    <br>
    <button type="button" data-toggle="modal" data-target="#modal-lg" class="btn btn-success float-left">Tambah Pesanan
    </button>
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="/purchase/tambah_pesanan" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Bahan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @csrf
                            <div class="col-md-6 form-group">
                                <label for="">Kode PO</label>
                                <input type="text" name="purchase_order_id" readonly value="{{ $purchases->kode }}"
                                    id="" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Bahan</label>
                                <select name="component_id" id="" class="form-control">
                                    @foreach($bahan as $key)
                                    <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Kuantitas</label>
                                <input class="form-control" placeholder="masukan jml kuantitas" type="number"
                                    name="kuantitas" id="">
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="deskripsi" placeholder="masukan deksripsi" id="" cols="30" rows="10"
                                    class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Tambah Pesanan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>