$(document).ready(function () {
    let url = document
        .getElementById("group-parent-category")
        .getAttribute("data-url");

    $("select[name=parent_category_id]").change(function () {
        let valueParent = $(this).val();
        let selectChilds = $("#select-child-category");
        selectChilds.html("");

        $.ajax({
            method: "GET",
            url: url,
            dataType: "JSON",
            data: { valueParent },
            success: function (data) {
                let arrayChildCategories = data.childCategories;

                if (arrayChildCategories.length === 0) {
                    console.log("0");
                    selectChilds.prop("disabled", true);
                } else {
                    selectChilds.append("<option></option>");
                    $.each(arrayChildCategories, function (key, values) {
                        selectChilds.append(
                            '<option value="' +
                                values.id +
                                '">' +
                                values.name +
                                "</option>"
                        );
                    });

                    selectChilds.prop("disabled", false);
                }
            },
            complete: function () {},
        });
    });
});
