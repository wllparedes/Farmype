$(document).ready(() => {
    $("#loginUserForm").validate({
        rules: {
            email: {
                email: true,
                required: true,
            },
            password: {
                required: true,
            },
        },
    });

    jQuery.extend(jQuery.validator.messages, {
        required:
            '<i class="ni ni-fat-remove"></i> &nbsp; Este campo es obligatorio',
        email: "Ingrese un email válido",
        number: "Por favor, ingresa un número válido",
        url: "Por favor, ingresa una URL válida",
        max: jQuery.validator.format(
            "Por favor, ingrese un valor menor o igual a {0}"
        ),
        min: jQuery.validator.format(
            "Por favor, ingrese un valor mayor o igual a {0}"
        ),
        step: jQuery.validator.format("Ingrese un número múltiplo de {0}"),
        maxlength: jQuery.validator.format("Ingrese menos de {0} digitos."),
        minlength: jQuery.validator.format("Ingrese al menos de {0} digitos."),
    });
});
