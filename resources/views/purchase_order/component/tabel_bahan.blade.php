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
        @foreach ($detail as $key)
        <tr>
            <td>Kanvas</td>
            <td>Kanvas</td>
            <td>1</td>
            <td>0</td>
            <td>30.000</td>
            <td>30.000</td>
        </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th colspan="5">Total</th>
            <th>3000</th>
        </tr>
    </tfoot>
</table>