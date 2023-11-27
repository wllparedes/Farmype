import { Toast } from "./../../global/ToastSwal.js";
import { renderProductsOnList } from "./../productsOnList/renderProductsOnList.js";

$(document).ready(() => {
    $("#productData").on("click", ".deleteProductOnShopping", function () {
        let url = $(this).data("delete-shopping");
        $.ajax({
            method: "DELETE",
            url: url,
            dataType: "JSON",
            success: function (data) {
                console.log(data)
                renderProductsOnList();
                Toast.fire({
                    icon: "success",
                    text: data.message,
                });
            },
        });
    });
});
