import { renderProductsOnList } from "./renderProductsOnShopping.js";
$(document).ready(() => {
    $("#discount").on("click", ".validateCupon", function (e) {
        var modal = $("#discount");
        var url = $("#verifyCupon").data("url");
        var form = modal.find("#verifyCupon");
        var formData = new FormData(form[0]);

        e.preventDefault();

        $.ajax({
            type: "POST",
            data: formData,
            url: url,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (data) {
                let cupon = data.data;
                let cuponNotFound = document.getElementById("cuponNotFound");
                let cuponFound = document.getElementById("cuponFound");

                if (data.success === false) {
                    cuponNotFound.classList.remove("d-none");
                    cuponNotFound.classList.add("d-block");
                    cuponFound.classList.add("d-none");
                    cuponFound.classList.remove("d-block");
                } else {
                    cuponNotFound.classList.add("d-none");
                    cuponNotFound.classList.remove("d-block");

                    cuponFound.classList.remove("d-none");
                    cuponFound.classList.add("d-block");
                    renderProductsOnList();
                }
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
});
