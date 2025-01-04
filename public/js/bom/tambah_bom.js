let bom_item = [];

export function initData() {
    showItemBom();
    $("#simpanBahan").on("click", function () {
        pushItem();
        showItemBom();
    });
    $("body").on("click", ".btn-del-item", function () {
        let id = $(this).data("id");
        destroyItem(id);
    });
    $("#simpanBOM").on("click", function () {
        tambahData();
    });
}
function pushItem() {
    let component = $("#components_id").val();
    let kuantitas = $("#kuantitas").val();
    let harga = $("#harga").val();
    bom_item.push({
        components_id: parseInt(component),
        quantity: kuantitas,
        price: harga,
        component_name: $("#components_id option:selected").html(),
    });
}
function showItemBom() {
    let number = 1;
    $("#example2").DataTable({
        paging: true,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        bDestroy: true,
        data: bom_item,
        columns: [
            {
                data: null,
                render: function (p1, p2, p3) {
                    return number++;
                },
            },
            {
                data: "component_name",
            },
            {
                data: "quantity",
            },
            {
                data: "price",
            },
            {
                data: null,
                render: function (p1, p2, p3) {
                    return `<button data-id="${p3.components_id}" class="btn btn-sm btn-danger btn-del-item"><i class="fa fa-trash"></i> Delete</button>`;
                },
            },
        ],
    });
}
function destroyItem(id) {
    bom_item = bom_item.filter((item) => item.components_id !== id);
    showItemBom();
}
async function tambahData() {
    let produk = $("#product_id").val();
    let kategori = $("#nama_kategori").val();
    let kuantitas = $("#quantity").val();
    let satuan = $("#satuan").val();
    let token = $("#token").val();
    let bom_data = {
        bom: {
            products_id: produk,
            categories_id: kategori,
            quantity: kuantitas,
            satuan: satuan,
        },
        detail: bom_item,
    };
    let options = {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
        },
        body: JSON.stringify(bom_data),
    };
    try {
        const url = window.location.host;
        const response = await fetch(`/bill_material/tambah_data`, options);
        if (response.ok) {
            const data = await response.json();
            //console.log(data);
            window.location.href = "/bill_material";
        } else {
            alert(await response.json());
            //throw new Error(response.json());
        }
    } catch (error) {
        console.log(error);
    }
}
