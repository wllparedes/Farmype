import { passwordStrength } from "../auth/passwordStrength.js";
import { Toast } from "../global/ToastSwal.js";
import { resetPasswordValues } from "./resetPasswordValues.js";
import { assignValues } from "./assignValues.js";

$(document).ready(() => {
    let inputPassword = document.getElementById("password");
    let alertPassword = document.getElementById("password-strength");
    let spanPassword = document.querySelector(".span-password");

    // ******* SelectDefault *******

    assignValues();

    // ******* Jquery-Validator *******

    $("#updatePasswordForm").validate({
        rules: {
            password_now: {
                required: true,
                remote: {
                    url: $("#updatePasswordForm").data("validate"),
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        password: function () {
                            return $("#password-now").val();
                        },
                    },
                },
            },
            password: {
                required: true,
                maxlength: 20,
                minlength: 6,
            },
            password_confirmation: {
                required: true,
                equalTo: "#password",
            },
        },
        messages: {
            password_now: {
                remote: "La contraseña actual es incorrecta",
            },
            password: {
                required: "Por favor, introduce tu nueva contraseña",
            },
            password_confirmation: {
                equalTo: "Por favor, haz que tus contraseñas coincidan",
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
                        // * Eliminar datos del input
                        resetPasswordValues();
                        Toast.fire({
                            icon: "success",
                            text: "Contraseña actualizada correctamente",
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

    // ? Mensaje de la fuerza de la contraseña

    inputPassword.addEventListener("keyup", () =>
        passwordStrength(inputPassword, alertPassword, spanPassword)
    );
});
