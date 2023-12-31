import { Toast } from "./../../global/ToastSwal.js";
import { resetInputsForm } from "./../../global/resetInputsForm.js";
import { uploadImage } from "./../../global/uploadImage.js";

$(document).ready(() => {
    // ******* selectTwo *******

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
            image: {
                required: true,
            },
            parentCategoryId: {
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
                    if (data.success === true) {
                        registerProductForm.resetForm();
                        resetInputsForm();
                        Toast.fire({
                            icon: "success",
                            text: data.message,
                        });
                        uploadImage(
                            "input-user-image-store",
                            "registerProductForm"
                        );

                        document.querySelector("#select-parent-category").reset();

                    } else if (data.success === "incompleto") {
                        Toast.fire({
                            icon: "warning",
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
                },
                error: function (data) {
                    console.log(data);
                },
            });
        },
    });
});
