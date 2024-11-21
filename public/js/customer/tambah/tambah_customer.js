export class TambahCustomer {
    nik;
    nama;
    notelp;
    email;
    alamat;
    constructor(id = null) {
        let data = {
            NIK: $("input[name='nik']").val(),
            nama: $("input[name='nama']").val(),
            notelp: $("input[name='notelp']").val(),
            email: $("input[name='email']").val(),
            alamat: $("input[name='alamat']").val(),
        };
        $(".btn-proses").on("click", function () {
            console.log(data);
        });
    }
    async prosesData(id = null) {}
}
