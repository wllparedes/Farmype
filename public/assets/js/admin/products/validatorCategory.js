import { Expressions } from "./../../global/regularExpressions.js";
import { Toast } from "./../../global/ToastSwal.js";
import { resetInputsForm } from "./../../global/resetInputsForm.js";
import { renderProductsLoad } from "./../../global/renderProductsNext.js";

// *

import { execute } from "./handleParentSelect.js";
import { renderSelectParentCategory } from "./select/selectCategoryParent.js";
import { renderCategoriesChild } from "./select/selectCategoryChild.js";

$(document).ready(() => {
    let registerCategoryForm = $("#registerCategoryForm").validate({
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
                required: true,
            },
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            var form = $(form);
            var modal = $("#createCategoryModal");
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
                    form.trigger("reset");
                    modal.modal("hide");
                    Toast.fire({
                        icon: "success",
                        text: data.message,
                    });
                },
                complete: function (data) {
                    form.find(".btn-save").removeAttr("disabled");
                    modal.modal("toggle");

                    // * aqui deberia de volver a renderizar al select del form
                    let urlParent = document
                        .getElementById("group-parent-category")
                        .getAttribute("data-url-parent");
                    renderSelectParentCategory(
                        urlParent,
                        "group-parent-category",
                        "select-parent-category",
                        "parentCategoryId",
                        true
                    );
                    let url = document
                        .getElementById("group-parent-category")
                        .getAttribute("data-url-child");
                    execute(url);
                    // * aqui deberia de volver a renderizar al select del modal
                    renderSelectParentCategory(
                        urlParent,
                        "group-parent-category-c",
                        "select-parent-category-c",
                        "parent_category_id_c",
                        true
                    );
                    // * aqui renderizar el select de las subcategorias
                    renderCategoriesChild(url, "");
                    registerCategoryForm.resetForm();

                    // *  resetear los checkbox

                    let checkParent = document.querySelector(
                        'input[name="create_parent_category"]'
                    );
                    let checkChild = document.querySelector(
                        'input[name="create_child_category"]'
                    );
                    let parentCategory = document.getElementById(
                        "name-parent-category"
                    );
                    let childCategory = document.getElementById(
                        "name-child-category"
                    );

                    parentCategory.classList.remove("div-name-parent-category");
                    parentCategory.classList.add(
                        "div-name-parent-category-active"
                    );

                    childCategory.classList.add("div-name-child-category");
                    childCategory.classList.remove(
                        "div-name-child-category-active"
                    );

                    checkChild.checked = false;
                    checkParent.checked = true;
                },
                error: function (data) {
                    console.log(data);
                },
            });
        },
    });
});
