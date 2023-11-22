import { uploadImage } from "./../../global/uploadImage.js";

$(document).ready(() => {
    $("#productData").on("click", ".editProduct", function () {
        var modal = $("#updateProductModal");
        var getDataUrl = $(this).data("send");
        var url = $(this).data("url");
        var form = modal.find("#editProductForm");

        form.trigger("reset");
        form.attr("action", url);

        $("#editProductForm").reset;

        $.ajax({
            type: "GET",
            url: getDataUrl,
            dataType: "JSON",
            success: function (data) {
                let inventory = data.inventory;
                let parentCategory = data.parentCategory;
                let url_image = data.url_image;

                modal.find("input[name=name]").val(inventory.product.name);
                modal.find("input[name=name]").prop("disabled", true);

                modal.find("input[name=stock]").val(inventory.stock);
                modal.find("input[name=price]").val(inventory.price);

                let checked = modal.find("input[name=on_sale]");
                if (inventory.on_sale) {
                    checked.prop("checked", true);
                    discountValue.classList.remove("discount-value");
                    discountValue.classList.add("discount-value-active");
                    modal.find("input[name=discount]").val(inventory.discount);
                } else {
                    discountValue.classList.add("discount-value");
                    discountValue.classList.remove("discount-value-active");
                }
                modal
                    .find(".img-picture")
                    .html(
                        '<img class="img-fluid product_img" id="image-product-edit" src="' +
                            url_image +
                            '"></img>'
                    );
                modal
                    .find("textarea[name=detail]")
                    .val(
                        inventory.product.detail
                            ? inventory.product.detail
                            : "Sin detalle."
                    );
                modal.find("textarea[name=detail]").prop("disabled", true);

                let colors = [
                    "default",
                    "info",
                    "success",
                    "danger",
                    "warning",
                ];
                let i = 0;
                modal.find("#containerChildCategories").html("");
                inventory.product.child_categories.forEach((childCategory) => {
                    let newSpan = $(
                        `<span class='badge badge-pill badge-md badge-${colors[i]}'> ${childCategory.name} </span>`
                    );
                    modal.find("#containerChildCategories").append(newSpan);
                    i === 4 ? (i = 0) : i++;
                });
                modal.find("#parentCategory").text(parentCategory.name);
            },
            complete: function (data) {
                modal.modal("toggle");
                let inputs = document.querySelectorAll(".input-reset");
                inputs.forEach((input) => {
                    input.classList.remove("valid");
                });
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
});
