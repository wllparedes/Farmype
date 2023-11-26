import { passwordStrength } from "../auth/passwordStrength.js";
import { Expressions } from "../global/regularExpressions.js";
import { Toast } from "../global/ToastSwal.js";
import { resetPasswordValues } from "./resetPasswordValues.js";
import { assignValues } from "./assignValues.js";

// import { TokenCsrf } from "./../global/csrfToken.js";
// import { MessageValidator } from "./../global/validatorMessages.js";

$(document).ready(() => {
    let inputPassword = document.getElementById("password");
    let alertPassword = document.getElementById("password-strength");
    let spanPassword = document.querySelector(".span-password");

    // ******* SelectDefault *******

    assignValues();

    // ******* SelectTwo *******

    $("#select-document-type").select2({
        placeholder: "Selecciona un tipo de doc.",
        language: "es",
        minimumResultsForSearch: Infinity,
    });

    $("#select-departament").select2({
        placeholder: "Selecciona un departamento",
        language: "es",
        minimumResultsForSearch: Infinity,
    });

    $("#select-province").select2({
        placeholder: "Selecciona una provincia",
        language: "es",
        minimumResultsForSearch: Infinity,
    });

    $("#select-district").select2({
        placeholder: "Selecciona un distrito",
        language: "es",
        minimumResultsForSearch: Infinity,
    });

    // ******* Jquery-Validator *******

    $("#updateFieldsForm").validate({
        rules: {
            document_type: {
                required: true,
            },
            document_number: {
                required: true,
                documentType: "#select-document-type",
            },
            names_surnames: {
                required: true,
            },
            departament: {
                required: true,
            },
            province: {
                required: true,
            },
            district: {
                required: true,
            },
            address: {
                required: true,
            },
            phone: {
                required: true,
                number: true,
                maxlength: 11,
                minlength: 6,
            },
            email: {
                required: true,
                email: true,
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
                        // form.trigger("reset");

                        // * atualizar datos del user en la pagina
                        assignValues();
                        // * Eliminar datos del input
                        resetPasswordValues();

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
                },
                error: function (data) {
                    console.log(data);
                },
            });
        },
    });

    // ? Funcionalidad del número de documento de identidad

    $.validator.addMethod(
        "documentType",
        // ? valors
        function (value, element, param) {
            let selectElement = $(param);
            let selectedDocumentType = selectElement.val();

            const isNumeric = Expressions.isNumeric.test(value);
            const isAlphaNumeric = Expressions.isAlphaNumeric.test(value);

            switch (selectedDocumentType) {
                case "dni":
                    return isNumeric && value.length === 8;
                case "foreigner_id_Card":
                    return isAlphaNumeric && value.length <= 12;
                case "ruc":
                    return isNumeric && value.length === 11;
                case "passport":
                    return isAlphaNumeric && value.length <= 12;
            }

            return false;
        },
        // ? messages
        function (params, element) {
            let selectedDocumentType = $(params).val();

            switch (selectedDocumentType) {
                case "dni":
                    return "Por favor, ingrese un dni válido";
                case "foreigner_id_Card":
                    return "Por favor, ingrese un C.E válido";
                case "ruc":
                    return "Por favor, ingrese un ruc válido";
                case "passport":
                    return "Por favor, ingrese un pasaporte válido";
            }
        }
    );

    // // ? Mensaje de la fuerza de la contraseña

    // inputPassword.addEventListener("keyup", () =>
    //     passwordStrength(inputPassword, alertPassword, spanPassword)
    // );


});
