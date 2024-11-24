import { useEffect, useState } from "react";
import ReactDom from "react-dom";
import axios from "axios";

function TambahBom() {
    let [type, setType] = useState(0);
    let [preview, setPreview] = useState(null);
    let [bom, setBom] = useState({
        quantity: "",
        satuan: "",
        price: "",
    })
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
    const inputBomHandler = (index, value) => {
        setBom({...bom, [index]: value});
    };
    const inputProdukHandler = (index, value) => {
        setProduk({ ...produk, [index]: value});
    };
    const inputBahanHander = (index, value) => {
        setBahan({ ...bahan, [index]: value});
    };
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
                    <input
                                type="radio"
                                id="produk"
                                name="type"
                                value={"produk"}
                                onClick={(e) => {
                                    setType(0);
                                    setProduk({ ...produk});
                                }}
                            />{" "}
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
                            className="form-control select2bs4"
                            style={{ width: "100%" }}
                            onSelect={(e) => {
                                inputProdukHandler(
                                    "kategori",
                                    e.target.value
                                );
                            }}
                        >
                            <option >Piih  Kategori</option>
                            <option>---</option>
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
                            onChange={(e) => {
                                inputBahanHander(
                                    "kuantitas"
                                );
                            }}
                        />
                    </div>
                    <div className="col-sm-2">
                        <input
                            type="text"
                            className="form-control"
                            placeholder="Satuan"
                            onChange={(e) => {
                                inputBomHandler(
                                    "satuan"
                                );
                            }}
                        />
                    </div>
                </div>
            </div>
            <div className="col-md-2"></div>
            <div className="col-md-10">
                <button
                    className="btn btn-success btn-sm"
                    style={{ width: "100%" }}
                    onClick={(e) => {
                        postDataBom();
                    }}
                >
                    <i className="fa fa-plus"></i> Tambah Data
                </button>
            </div>
        </div>
    );
}
function Komposisi() {
    let data_komposisi = [
        {
            bahan: "tali",
            kuantitas: 1,
            harga: 45000,
        },
    ];
    let no = 1;
    return data_komposisi.map((e) => (
        <tr>
            <td>{no++}</td>
            <td>{e.bahan}</td>
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
    return (
        <div className="row">
            <div className="col-md-12">
                <div className="form-group">
                    <label>Bahan</label>
                    <select
                        className="form-control select2bs4"
                        style={{ width: "100%" }}
                        onChange={(e) => {
                            inputBahanHander(
                                "jenis_bahan",
                                e.target.value
                            );
                        }}
                    >
                        <option>Pilih Bahan</option>
                        <option>---</option>
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
                                onChange={(e) => {
                                    inputBahanHander(
                                        "kuantitas",
                                        e.target.value
                                    );
                                }}
                            />
                        </div>
                        <div className="col-md-2">
                            <input
                                className="form-control"
                                placeholder="Satuan"
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
ReactDom.render(<TambahBom />, document.getElementById("form-data"));
ReactDom.render(<Komposisi />, document.getElementById("form-data-komposisi"));
ReactDom.render(
    <TambahKomposisi />,
    document.getElementById("form-komponen-tambah")
);
