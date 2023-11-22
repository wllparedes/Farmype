import { Toast } from "./../../global/ToastSwal.js";
import { renderProductsLoad } from "./../../global/renderProductsNext.js";
import { SwalDelete } from "./../../global/SwalAlerts.js";

$(document).ready(() => {

    $("#productData").on("click", ".deleteProduct", function () {

        var url = $(this).data("url");

        SwalDelete.fire().then(
            function (e) {
                if (e.value === true) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        dataType: "JSON",
                        success: function (data) {

                            if (data.success === true) {
                                // * volver a renderizar
                                renderProductsLoad();
                                Toast.fire({
                                    icon: "success",
                                    text: "¡Registro eliminado!",
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
