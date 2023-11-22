import { Toast } from "./../../global/ToastSwal.js";
import { renderProductsOnList } from "./renderProductsOnList.js";


$(document).ready(() => {
    $("#productData").on("click", ".deleteProductOnList", function () {
        let url = $(this).data("delete-list");
        $.ajax({
            method: "DELETE",
            url: url,
            dataType: "JSON",
            success: function (data) {
                renderProductsOnList();
                Toast.fire({
                    icon: "success",
                    text: data.message,
                });
            },
        });
    });
});
