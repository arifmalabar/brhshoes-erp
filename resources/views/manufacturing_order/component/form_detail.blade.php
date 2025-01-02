<input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
<div class="col-md-6">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="">Produk <sup>*</sup></label>
        <div class="col-sm-10">
            <select name="" id="product-data" disabled class="form-control select2bs4">
                @foreach($data["data_produk"] as $key)
                @if($modata->product_id == $key->product_id)
                <option selected value="{{ $key->id }}">{{ $key->nama_produk }}</option>
                @elseif($modata->product_id != $key->product_id)
                <option value="{{ $key->id }}">{{ $key->nama_produk }}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="">Bill Of Material
            <sup>*</sup></label>
        <div class="col-sm-10">
            <select name="" id="bom-data" disabled class="form-control select2bs4">
                @foreach($data["data_bom"] as $key)
                @if($modata->bom_id == $key->id)
                <option selected value="{{ $key->id }}">{{ $key->id }}</option>
                @elseif($modata->bom_id != $key->id)
                <option value="{{ $key->id }}">{{ $key->id }}</option>
                @endif
                @endforeach
            </select>
        </div>

    </div>
</div>
<div class="col-md-6">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="">Jml Produksi <sup>*</sup></label>
        <div class="col-sm-10">
            <input type="number" disabled class="form-control jml_produksi" name="NIK"
                id="kuantitas" placeholder="Masukan Masukan Kuantias"
                value="{{ $modata->quantity }}" required>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="">Estimasi <sup>*</sup></label>
        <div class="col-sm-5">
            <input type="date" class="form-control" disabled id="et-mulai"
                placeholder="Masukan Nama Produk" value="{{ $modata->schedule }}"
                required>
        </div>
        <div class="col-sm-5">
            <input type="date" class="form-control" disabled id="et-selesai" name="NIK"
                placeholder="Masukan Nama Produk" value="{{ $modata->late }}" required>
        </div>
    </div>
</div>