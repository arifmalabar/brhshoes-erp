<table id="example2" class="table table-bordered table-hover" style="text-align: center">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Deksripsi</th>
            <th>Kuantitas</th>
            <th>Diterima</th>
            <th>Harga Satuan</th>
            <th>Sub Total</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total = 0;
        @endphp
        @foreach ($detail as $key)
        <tr>
            <td>{{ $key->nama }}</td>
            <td>{{ $key->deskripsi }}</td>
            <td>{{ $key->kuantitas }}</td>
            <td>{{ $key->diterima }}</td>
            <td>{{ $key->harga_satuan }}</td>
            <td>{{ $key->subtotal }}</td>
            @php
            $total += $key->subtotal;
            @endphp
        </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th colspan="5">Total</th>
            <th>{{ $total }}</th>
        </tr>
    </tfoot>
</table>