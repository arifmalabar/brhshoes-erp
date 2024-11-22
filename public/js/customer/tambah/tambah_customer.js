import { tambah_customer } from "../../config/end_point.js";
import { fecthCustomer } from "../customer.js";

export function init() {
    $(".btn-proses").on("click", function () {
        prosesData();
    });
}
async function prosesData() {
    let data = {
        NIK: $("input[name='nik']").val(),
        name: $("input[name='nama']").val(),
        notelp: $("input[name='notelp']").val(),
        email: $("input[name='email']").val(),
        alamat: $("#alamat").val(),
    };
    try {
        const response = await fetch(tambah_customer, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $("#csrf").val(),
            },
            body: JSON.stringify(data),
            method: "POST",
        });
        if (response.status == 201 || response.status == 200) {
            const data = await response.json();
            //window.location.href = "/customer";
            Swal.fire({
                title: "Berhasil",
                text: "Berhasil menambah data",
                icon: "success",
            });
            fecthCustomer();
        } else if (response.status == 400) {
            const error = await response.json();
            console.log(error);
        } else {
            throw new Error(response.status);
        }
    } catch (error) {
        alert(error);
    }
}
