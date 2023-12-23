import { Expressions } from "./../../global/regularExpressions.js";
import { Toast } from "./../../global/ToastSwal.js";
import { resetInputsForm } from "./../../global/resetInputsForm.js";
import { uploadImage } from "./../../global/uploadImage.js";
import { selectProduct } from "./selectProducts.js";
import { promotionsTable } from "./promotions-datatable.js";


let datepicker = new Datepicker("#datepicker", {
    inline: true,
    ranged: true,
});

$(document).ready(() => {
    uploadImage("#input-product-image-store", "#registerPromotionForm");

    const inputPrice = document.getElementById("price");

    inputPrice.addEventListener("keypress", (event) => {
        if (
            event.key === "e" ||
            event.key === "E" ||
            event.key === "-" ||
            event.key === "+"
        ) {
            event.preventDefault();
        }
    });

    // ******* Jquery-Validator *******

    let registerPromotionForm = $("#registerPromotionForm").validate({
        rules: {
            numberPromotion: {
                required: true,
            },
            image: {
                required: true,
            },
            selectProduct: {
                required: true,
            },
            price: {
                required: true,
                doubleOrInteger: true,
            },
            datepicker: {
                required: true,
            },
        },
        messages: {
            image: {
                required: "SUBIR IMAGEN",
            },
            price: {
                required: "Por favor, introduzca un precio para este producto.",
                doubleOrInteger: "Por favor, introduzca un precio válido.",
            },
        },
        submitHandler: function (form, event) {
            event.preventDefault();

            let modal = $("#createPromotionModal");

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
                        registerPromotionForm.resetForm();
                        resetInputsForm();
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
                    selectProduct.reset();
                    promotionsTable.ajax.reload();
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
});
