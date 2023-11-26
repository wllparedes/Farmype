import { Toast } from "./../../global/ToastSwal.js";
import { renderProductsOnList } from "./../productsOnList/renderProductsOnList.js";

$(document).ready(() => {
    $("#productData").on("click", ".addCuantity", function () {
        let element = $(this);

        let url = $(this).data("add");

        $.ajax({
            method: "POST",
            url: url,
            datatype: "JSON",
            success: function (data) {
                if (data.success == false) {
                    Toast.fire({
                        icon: "warning",
                        text: "Producto sin stock suficiente",
                    });
                }
                renderProductsOnList();
            },
        });
        // }
    });
});
