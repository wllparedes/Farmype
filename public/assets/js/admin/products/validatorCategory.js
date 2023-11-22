import { Expressions } from "./../../global/regularExpressions.js";
import { Toast } from "./../../global/ToastSwal.js";
import { resetInputsForm } from "./../../global/resetInputsForm.js";
import { renderProductsLoad } from "./../../global/renderProductsNext.js";

$(document).ready(() => {
    // ******* selectTwo *******

    // $("#select-parent-category-c").select2({
    //     placeholder: "Selecciona una categoria principal",
    //     language: "es",
    //     minimumResultsForSearch: Infinity,
    // });

    // ******* Jquery-Validator *******

    $("#registerCategoryForm").validate({
        rules: {
            name_parent: {
                required: true,
            },
            parent_category_id_c: {
                required: true,
            },
            name_child: {
                required: true,
            },
            child_category_id: {
                required: true
            }
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            var form = $(form);
            // var loadSpinner = form.find(".loadSpinner");
            var modal = $("#createCategoryModal");

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
                    form.trigger("reset");
                    modal.modal("hide");
                    Toast.fire({
                        icon: "success",
                        text: data.message,
                    });
                    // else {
                    //     Toast.fire({
                    //         icon: "error",
                    //         text: data.message,
                    //     });
                    // }
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
});
