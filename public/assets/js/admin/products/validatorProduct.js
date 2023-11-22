import { Toast } from "./../../global/ToastSwal.js";
import { resetInputsForm } from "./../../global/resetInputsForm.js";
import { uploadImage } from "./../../global/uploadImage.js";

$(document).ready(() => {
    // ******* selectTwo *******

    $("#select-child-category").select2({
        placeholder: "Selecciona una categoria principal",
        language: {
            noResults: function () {
                return "No se encontraron resultados";
            }
        },

        minimumResultsForSearch: Infinity,
        multiple: true,
    });

    $("#select-parent-category").select2({
        placeholder: "Selecciona una sub categoria",
        language: "es",
        minimumResultsForSearch: Infinity,
    });

    uploadImage("#input-product-image-store", "#registerProductForm");

    // ******* Jquery-Validator *******

    let registerProductForm = $("#registerProductForm").validate({
        rules: {
            name: {
                required: true,
            },
            child_category_id: {
                required: true,
            },
            detail: {},
            image: {
                required: true,
            },
            parent_category_id: {
                required: true,
            },
        },
        messages: {
            image: {
                required: "SUBIR IMAGEN",
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
                            title: "Producto registrado",
                            text: data.message,
                        });
                        $("#select-child-category").val(null).trigger("change");
                        $("#select-parent-category")
                            .val(null)
                            .trigger("change");
                        uploadImage(
                            "input-user-image-store",
                            "registerProductForm"
                        );
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: "Error",
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
});
