export const assignValues = () => {
    const documentType = document.getElementById("select-document-type");
    const departament = document.getElementById("select-departament");
    const province = document.getElementById("select-province");
    const district = document.getElementById("select-district");

    const choicesDocumentType = new Choices(documentType, {
        placeholder: true,
        placeholderValue: "Selecciona un tipo de doc.",
        allowHTML: true,
        itemSelectText: "Presiona para seleccionar",
        noResultsText: "Resultados no encontrados",
    });

    const choicesDepartament = new Choices(departament, {
        placeholder: true,
        placeholderValue: "Selecciona un departamento",
        allowHTML: true,
        itemSelectText: "Presiona para seleccionar",
        noResultsText: "Resultados no encontrados",
    });

    const choicesProvince = new Choices(province, {
        placeholder: true,
        placeholderValue: "Selecciona una provincia",
        allowHTML: true,
        itemSelectText: "Presiona para seleccionar",
        noResultsText: "Resultados no encontrados",
    });

    const choicesDistrict = new Choices(district, {
        placeholder: true,
        placeholderValue: "Selecciona un distrito",
        allowHTML: true,
        itemSelectText: "Presiona para seleccionar",
        noResultsText: "Resultados no encontrados",
    });

    $.ajax({
        type: "GET",
        url: $("#updateFieldsForm").data("send"),
        dataType: "JSON",
        success: function (data) {
            const user = data["user"];
            const departament = data["departament"];
            const district = data["district"];
            const province = data["province"];

            $("#names_surnames").text(user.names_surnames);
            $("#document_number").text(user.document_number);
            $("#departament").text(departament);
            $("#district").text(district);
            $("#province").text(province);
            $("#address").text(user.address);
            $("#names_surnames-s").text(user.names_surnames);

            // * Inputs and selects

            $("input[name=names_surnames]").val(user.names_surnames);
            $("input[name=document_number]").val(user.document_number);
            $("input[name=address]").val(user.address);
            $("input[name=phone]").val(user.phone);
            $("input[name=email]").val(user.email);

            choicesDocumentType.setChoiceByValue(user.document_type);
            choicesDepartament.setChoiceByValue(user.departament);
            choicesProvince.setChoiceByValue(user.province);
            choicesDistrict.setChoiceByValue(user.district);
        },
    });
};
