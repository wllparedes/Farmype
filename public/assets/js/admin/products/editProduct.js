import { uploadImage } from "./../../global/uploadImage.js";

$(document).ready(() => {
    $("#productData").on("click", ".editProduct", function () {
        var modal = $("#updateProductModal");
        var getDataUrl = $(this).data("send");
        var url = $(this).data("url");
        var form = modal.find("#editProductForm");
        var selectProductType = modal.find("#select-product-type");

        form.trigger("reset");
        form.attr("action", url);

        $("#editProductForm").reset;

        $.ajax({
            type: "GET",
            url: getDataUrl,
            dataType: "JSON",
            success: function (data) {
                // let discountValue = document.getElementById("discount-value");

                uploadImage("#input-product-image-store", "#editProductForm");
                let product = data["product"];

                selectProductType.val(product.product_type).change();

                modal.find("input[name=name]").val(product.name);
                modal.find("input[name=stock]").val(product.stock);
                modal.find("input[name=price]").val(product.price);
                modal.find("input[name=email]").val(product.detail);

                // let checked = modal.find("input[name=on_sale]");

                // if (product.on_sale) {
                //     checked.prop("checked", true);
                //     discountValue.classList.remove("discount-value");
                //     discountValue.classList.add("discount-value-active");
                //     modal.find("input[name=discount]").val(product.discount);
                // } else {
                //     discountValue.classList.add("discount-value");
                //     discountValue.classList.remove("discount-value-active");
                // }

                modal
                    .find(".img-holder")
                    .html(
                        '<img class="img-fluid product_img" id="image-product-edit" src="' +
                            data.url_img +
                            '"></img>'
                    );
                modal
                    .find("#input-product-image-store")
                    .attr(
                        "data-value",
                        '<img scr="' +
                            data.url_img +
                            '" class="img-fluid avatar_img"></img>'
                    );
                modal.find("#input-user-image-edit").val("");
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
