import { renderProductsOnList } from "./renderProductsOnShopping.js";
import { Toast } from "./../../global/ToastSwal.js";

$(document).ready(() => {
    $("#productData").on("click", ".deleteDiscountCoupion", function () {
        let element = $(this);
        let url = $(this).data("url");

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
