import { renderProductsOnList } from "./../productsOnList/renderProductsOnList.js";
import { Toast } from "./../../global/ToastSwal.js";

$(document).ready(() => {
    $("#productData").on("click", ".addOnShoppingCart", function () {
        let element = $(this);
        let url = $(this).data("add-cart-shopping");

        $.ajax({
            method: "POST",
            url: url,
            datatype: "JSON",
            success: function (data) {

                if (data.success === false) {
                    Toast.fire({
                        icon: "warning",
                        text: data.message,
                    });
                } else if (data.success === true) {
                    Toast.fire({
                        icon: "success",
                        text: data.message,
                    });
                } else {
                    Toast.fire({
                        icon: "error",
                        text: data.message,
                    });
                }

                renderProductsOnList();
            },
        });
    });
});
