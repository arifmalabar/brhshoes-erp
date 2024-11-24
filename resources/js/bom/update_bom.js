import { useEffect, useState } from "react";
import ReactDom from "react-dom";
import axios from "axios";

function UpdateBom() {
    let [type, setType] = useState(0);
    let [bom, setBom] = useState({
        products_id: "",
        categories_id: "",
        quantity: "",
        satuan: "",
    });
    let [produk, setProduk] = useState({
        nama_produk: "",
        kategori: "",
        jumlah: "",
    });
    let [bahan, setBahan] =- useState({
        jenis_bahan: "",
        kuantitas: "",
        harga_modal: "",
    });
    let [kategori, setKategori] = useState([]);
    const inputBomHandler = (index, value) => {
        setBom({...bom, [index]: value});
    };
    const inputProdukHandler = (index, value) => {
        setProduk({ ...produk, [index]: value});
    };
    const inputBahanHander = (index, value) => {
        setBahan({ ...bahan, [index]: value});
    };
    const getKategori = async () => {
        try {
            let response = await axios.get("/get_kategori");
            if (response.status == 200) {
                const dt = await response.data;
                setKategori(dt);
            } else {
                const err = await response.data;
                throw new Error(`Error : ${err.message}`);
            }
        } catch (error) {
            console.log(error);
        }
    };
    useEffect(() => {
        getKategori();
        console.log(kategori);
    }, []);
    async function postDataBom(){
        try {
            const response = await axios.post(
                "bill_material/tambah_data", bom,
                {
                    Headers: {
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                }
            );
            console.log(response,data);
        } catch (error){
            console.log(error);
        }
    }
    return (
        <div className="row">
            <div className="col-md-12">
                <div className="form-group row">
                    <label
                        for="inputEmail3"
                        className="col-sm-2 col-form-label"
                    >
                        Produk
                    </label>
                    <div className="col-sm-10">
                    <select
                        className="form-control"
                        onChange={(e) => {
                            inputBomHandler(
                                "products_id",
                                e.target.value
                            );
                        }}
                        >
                            <option>Pilih Produk</option>
                            {produk.map((e) => (
                                <option value={e.products_id}>
                                    {e.nama_produk}
                                </option>
                            ))}
                    </select>
                    </div>
                </div>
            </div>
            <div className="col-md-12">
                <div className="form-group row">
                    <label
                        for="inputEmail3"
                        className="col-sm-2 col-form-label"
                    >
                        Kategori
                    </label>
                    <div className="col-sm-10">
                    <select
                        className="form-control"
                        onChange={(e) => {
                            inputBomHandler(
                                "categories_id",
                                e.target.value
                            );
                        }}
                        >
                            <option>Pilih Kategori</option>
                            {kategori.map((e) => (
                                <option value={e.categories_id}>
                                    {e.nama_kategori}
                                </option>
                            ))}
                    </select>
                    </div>
                </div>
            </div>
            <div className="col-md-12">
                <div className="form-group row">
                    <label
                        for="inputEmail3"
                        className="col-sm-2 col-form-label"
                    >
                        Kuantitas
                    </label>
                    <div className="col-sm-8">
                        <input
                            type="number"
                            className="form-control"
                            placeholder="Masukan Kuantitas"
                            value={bom.quantity}
                            onChange={(e) => {
                                inputBomHandler(
                                    "quantity",
                                    e.target.value
                                );
                            }}
                        />
                    </div>
                    <div className="col-sm-2">
                        <input
                            type="text"
                            className="form-control"
                            placeholder="Satuan"
                            value={bom.satuan}
                            onChange={(e) => {
                                inputBomHandler(
                                    "satuan",
                                    e.target.value
                                );
                            }}
                        />
                    </div>
                </div>
            </div>
            <div className="col-md-2"></div>
            <div className="col-md-10">
                <button
                    className="btn btn-warning btn-sm"
                    style={{ width: "100%" }}
                >
                    <i className="fa fa-edit"></i> Update Data
                </button>
            </div>
        </div>
    );
}
function Komposisi() {
    let data_komposisi = [
        {
            components_id: "",
            jenis_bahan: "tali",
            kuantitas: 1,
            harga: 45000,
        },
    ];
    let no = 1;
    return data_komposisi.map((e) => (
        <tr>
            <td>{no++}</td>
            <td>{e.jenis_bahan}</td>
            <td>{e.kuantitas}</td>
            <td>{e.harga}</td>
            <td>
                <center>
                    <button type="button" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>&nbsp;Hapus
                    </button>
                </center>
            </td>
        </tr>
    ));
}
function TambahKomposisi() {
    let [bomDetail, setBomDetail] = useState({
        components_id: "",
        quantity: "",
        price: "",
    });

    const inputBomDetailHander = (index, value) => {
        setBomDetail({...bomDetail, [index]: value});
    };

    async function postDataBomDetail(){
        try {
            const response = await axios.post(
                "bill_material/tambah_data", bom,
                {
                    Headers: {
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                }
            );
            console.log(response,data);
        } catch (error){
            console.log(error);
        }
    }
    return (
        <div className="row">
            <div className="col-md-12">
                <div className="form-group">
                    <label>Bahan</label>
                    <select
                        className="form-control select2bs4"
                        style={{ width: "100%" }}
                        onChange={(e) => {
                            inputBomDetailHander(
                                "components_id",
                                e.target.value
                            );
                        }}
                    >
                        <option>Pilih Bahan</option>
                        {bomDetail.map((e) => (
                            <option value={e.components_id}>
                                {e.jenis_bahan}
                            </option>
                        ))}
                    </select>
                </div>
            </div>
            <div className="col-md-12">
                <div className="form-group">
                    <label>Kuantitas</label>
                    <div className="row">
                        <div className="col-md-10">
                            <input
                                className="form-control"
                                placeholder="Masukan Kuantitas"
                                value={bomDetail.quantity}
                                onChange={(e) => {
                                    inputBahanHander(
                                        "quantity",
                                        e.target.value
                                    );
                                }}
                            />
                        </div>
                        <div className="col-md-2">
                            <input
                                className="form-control"
                                placeholder="Satuan"
                                value={bomDetail.satuan}
                                onChange={(e) => {
                                    inputBomHander(
                                        "satuan",
                                        e.target.value
                                    );
                                }}
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
ReactDom.render(<UpdateBom />, document.getElementById("form-data"));
ReactDom.render(<Komposisi />, document.getElementById("form-data-komposisi"));
ReactDom.render(
    <UpdateKomposisi />,
    document.getElementById("form-komponen-tambah")
);
