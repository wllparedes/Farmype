import { renderProductsOnList } from "./../../client/productsOnList/renderProductsOnList.js";
import { Toast } from "./../../global/ToastSwal.js";
import { SwalDelete } from "./../../global/SwalAlerts.js";

$(document).ready(() => {
    $("#productData").on("click", ".emptyShoppingCart", function () {
        let element = $(this);
        let url = $(this).data("empty");

        SwalDelete.fire().then(
            function (e) {
                if (e.value === true) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        dataType: "JSON",
                        success: function (data) {
                            if (data.success) {
                                // * volver a renderizar
                                renderProductsOnList();
                                Toast.fire({
                                    icon: "success",
                                    text: "¡Carrito vaciado!",
                                });
                            }
                        },
                        error: function (data) {
                            Toast.fire({
                                icon: "error",
                                title: "¡Ocurrió un error inesperado!",
                            });
                        },
                    });
                } else {
                    e.dismiss;
                }
            },
            function (dismiss) {
                return false;
            }
        );
    });
});
