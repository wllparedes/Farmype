import { Expressions } from "./../../global/regularExpressions.js";
import { Toast } from "./../../global/ToastSwal.js";
import { resetInputsForm } from "./../../global/resetInputsForm.js";
import { renderProductsLoad } from "./../../global/renderProductsNext.js";

$(document).ready(() => {
    // ******* selectTwo *******

    let requiredImage = false;


    // ******* Jquery-Validator *******

    $("#editProductForm").validate({
        rules: {
            name: {
                required: true,
            },
            detail: {
                //
            },
            image: {
                required: requiredImage,
            },
        },
        messages: {
            image: {
                required: "SUBIR IMAGEN",
            },
            discount: {
                isDiscount:
                    "Por favor, introduzca un descuento para este producto.",
            },
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            var form = $(form);
            // var loadSpinner = form.find(".loadSpinner");
            var modal = $("#updateProductModal");

            var formData = new FormData(form[0]);
            // loadSpinner.toggleClass("active");
            form.find(".btn-save").attr("disabled", "disabled");

            $.ajax({
                method: form.attr("method"),
                url: form.attr("action"),
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (data) {
                    if (data.success) {
                        // * Volver a cargar la lista de datos
                        renderProductsLoad();
                        form.trigger("reset");
                        modal.modal("hide");
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
                },
                complete: function (data) {
                    form.find(".btn-save").removeAttr("disabled");
                    modal.modal("toggle");
                },
                error: function (data) {
                    console.log(data);
                },
            });
        },
    });

    $.validator.addMethod(
        "doubleOrInteger",
        (value, element) => Expressions.isPrice.test(value),
        "Por favor, introduzca un precio para este producto."
    );

    $.validator.addMethod(
        "isDiscount",
        (value, element) => Expressions.isDiscount.test(value),
        "Por favor, introduzca un descuento para este producto."
    );
});
