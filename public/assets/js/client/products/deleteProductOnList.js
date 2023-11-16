import { Toast } from "./../../global/ToastSwal.js";
import { renderProductsLoad } from "./../../global/renderProductsNext.js";

$(document).ready(() => {
    $("#productData").on("click", ".deleteProductOnList", function () {
        let url = $(this).data("url");

        $.ajax({
            method: "DELETE",
            url: url,
            dataType: "JSON",
            success: function (data) {
                renderProductsLoad();
                Toast.fire({
                    icon: "success",
                    text: data.message,
                });
            },
        });
    });
});
