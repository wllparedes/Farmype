import { Toast } from "./../../global/ToastSwal.js";
import { renderProductsLoad } from "./../../global/renderProductsNext.js";


$(".container-products").on("click", ".addProductOnList", function () {
    let url = $(this).data("url");

    $.ajax({
        method: "POST",
        url: url,
        dataType: 'JSON',
        success: function (data) {

            renderProductsLoad();
            Toast.fire({
                icon: "success",
                text: data.message
            })

        }
    });
});

$(".container-products").on("click", ".deleteProductOnList", function () {

    let url = $(this).data("url");

    $.ajax({
        method: "DELETE",
        url: url,
        dataType: 'JSON',
        success: function (data) {

            renderProductsLoad();
            Toast.fire({
                icon: "success",
                text: data.message
            })

        }
    });


});


