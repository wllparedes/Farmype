import { Toast } from "./../../global/ToastSwal.js";

$(document).ready(() => {

    $("#update-location-company").validate({
        rules: {
            latitude: {
                required: true,
            },
            longitude: {
                required: true,
            },
        },
        submitHandler: function (form, event) {
            event.preventDefault();

            var form = $(form);
            var formData = new FormData(form[0]);
            form.find(".btn-update-location").attr("disabled", "disabled");

            $.ajax({
                method: form.attr("method"),
                url: form.attr("action"),
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (data) {
                    if (data.success) {
                        Toast.fire({
                            icon: "success",
                            text: "Ubicación actualizada correctamente.",
                        });
                    } else {
                        Toast.fire({
                            icon: "error",
                            text: data.message,
                        });
                    }
                },
                complete: function (data) {
                    form.find(".btn-update-location").removeAttr("disabled");
                },
                error: function (data) {
                    console.log(data);
                },
            });
        },
    });
});
