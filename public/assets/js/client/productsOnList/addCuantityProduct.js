import { renderProductsOnList } from "./renderProductsOnList.js";

$(document).ready(() => {
    $("#productData").on("click", ".addCuantity", function () {
        let element = $(this);

        let url = $(this).data("add");

        $.ajax({
            method: "POST",
            url: url,
            datatype: "JSON",
            success: function (data) {
                renderProductsOnList();
            },
        });
        // }
    });
});
