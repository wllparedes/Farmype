import { renderProductsOnList } from "./renderProductsOnShopping.js";

$(document).ready(() => {
    $("#productData").on("click", ".subtractCuantity", function () {
        let element = $(this);
        let url = $(this).data("subtract");

        $.ajax({
            method: "POST",
            url: url,
            datatype: "JSON",
            success: function (data) {
                renderProductsOnList();
            },
        });
    });
});
