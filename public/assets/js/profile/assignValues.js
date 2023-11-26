export const assignValues = () => {
    $.ajax({
        type: "GET",
        url: $("#updateFieldsForm").data("send"),
        dataType: "JSON",
        success: function (data) {
            const user = data["user"];
            const departament = data["departament"];
            const district = data["district"];
            const province = data["province"];

            let selectDocumentType = $("#select-document-type");
            let selectDepartament = $("#select-departament");
            let selectProvince = $("#select-province");
            let selectDistrict = $("#select-district");

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

            selectDocumentType.val(user.document_type).change();
            selectDepartament.val(user.departament).change();
            selectProvince.val(user.province).change();
            selectDistrict.val(user.district).change();
        },
    });
};
