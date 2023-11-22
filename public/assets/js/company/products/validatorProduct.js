import { Expressions } from "./../../global/regularExpressions.js";
import { Toast } from "./../../global/ToastSwal.js";
import { resetInputsForm } from "./../../global/resetInputsForm.js";
import { uploadImage } from "./../../global/uploadImage.js";

$(document).ready(() => {
    // ******* selectTwo *******

    $("#select-product").select2({
        placeholder: "Selecciona el producto",
        language: "es",
        minimumResultsForSearch: Infinity,
    });

    uploadImage("#input-product-image-store", "#registerProductForm");

    const inputsValidateSymbols = [
        document.getElementById("input-stock"),
        document.getElementById("input-price"),
        document.getElementById("input-discount"),
    ];

    inputsValidateSymbols.forEach((input) => {
        input.addEventListener("keypress", (event) => {
            if (
                inputsValidateSymbols[0] == input ||
                inputsValidateSymbols[2] == input
            ) {
                if (
                    event.key === "e" ||
                    event.key === "E" ||
                    event.key === "." ||
                    event.key === "-"
                ) {
                    event.preventDefault();
                }
            } else {
                if (
                    event.key === "e" ||
                    event.key === "E" ||
                    event.key === "-"
                ) {
                    event.preventDefault();
                }
            }
        });
    });

    // ******* Jquery-Validator *******

    let registerProductForm = $("#registerProductForm").validate({
        rules: {
            product_id: {
                required: true,
            },
            stock: {
                required: true,
                number: true,
                min: 0,
            },
            price: {
                required: true,
                doubleOrInteger: true,
            },

            discount: {
                required: true,
                isDiscount: true,
            },
        },
        messages: {
            discount: {
                isDiscount:
                    "Por favor, introduzca un descuento para este producto.",
            },
        },
        submitHandler: function (form, event) {
            event.preventDefault();

            var form = $(form);

            var formData = new FormData(form[0]);

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
                        registerProductForm.resetForm();
                        resetInputsForm();
                        Toast.fire({
                            icon: "success",
                            text: data.message,
                        });
                        $("#select-product").val(null).trigger("change");
                        let discountValue = document.getElementById("discount-value");
                        discountValue.classList.add("discount-value");
                        discountValue.classList.remove("discount-value-active");
                    } else {
                        Toast.fire({
                            icon: "error",
                            text: data.message,
                        });
                    }
                },
                complete: function (data) {
                    form.find(".btn-save").removeAttr("disabled");
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
