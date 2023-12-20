import { passwordStrength } from "./passwordStrength.js";
import { Expressions } from "./../global/regularExpressions.js";

$(document).ready(() => {

    let inputPassword = document.getElementById("password");
    let alertPassword = document.getElementById("password-strength");
    let spanPassword = document.querySelector(".span-password");


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

    $("#select-role").select2({
        placeholder: "Selecciona tu tipo de usuario",
        language: "es",
        minimumResultsForSearch: Infinity,
    });

    // ******* Jquery-Validator *******

    $("#registerUserForm").validate({
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
            role: {
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
            password: {
                required: "Por favor, introduce tu contraseña",
            },
            password_confirmation: {
                equalTo: "Por favor, haz que tus contraseñas coincidan",
            },
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

    // ? Mensaje de la fuerza de la contraseña

    inputPassword.addEventListener("keyup", () =>
        passwordStrength(inputPassword, alertPassword, spanPassword)
    );
});
