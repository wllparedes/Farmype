import { Toast } from "./../../global/ToastSwal.js";
import { renderProductsLoad } from "./../../global/renderProductsNext.js";

$(document).ready(() => {
    $("#productData").on("click", ".addProductOnList", function () {
        let url = $(this).data("url");

        $.ajax({
            method: "POST",
            url: url,
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                renderProductsLoad();
                Toast.fire({
                    icon: "success",
                    text: data.message,
                });
            },
        });
    });
});
