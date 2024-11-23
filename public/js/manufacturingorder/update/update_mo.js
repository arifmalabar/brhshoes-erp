import { bom_detail } from "../../config/end_point.js";
import { getDetailData } from "../../fecth/fetch.js";
import { ProductData } from "../manufacturing_order.js";
import { init as moDefault } from "../manufacturing_order.js";

export function init() {
    showDetailData();
    ProductData();
    moDefault();
}
async function showDetailData() {
    const id = window.location.pathname.split("/")[3];
    const data = await getDetailData(bom_detail, id);
    console.log(data[0].quantity);
    $("#kuantitas").val(data[0].quantity);
}
