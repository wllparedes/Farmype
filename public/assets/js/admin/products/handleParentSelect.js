$(document).ready(function () {
    let url = document
        .getElementById("group-parent-category")
        .getAttribute("data-url-child");
    let urlParent = document
        .getElementById("group-parent-category")
        .getAttribute("data-url-parent");

    const childCategory = document.getElementById("select-child-category");

    const choicesChildCategory = new Choices(childCategory, {
        placeholder: true,
        placeholderValue: "Selecciona una sub-categoria",
        allowHTML: true,
        itemSelectText: "Presiona para seleccionar",
        noResultsText: "Resultados no encontrados",
        noChoicesText: "No hay opciones para seleccionar",
    });

    // **********************
    const parentCategory = document.getElementById("select-parent-category");

    const choicesParentCategory = new Choices(parentCategory, {
        placeholder: true,
        placeholderValue: "Selecciona una categoria",
        allowHTML: true,
        itemSelectText: "Presiona para seleccionar",
        noResultsText: "Resultados no encontrados",
        noChoicesText: "No hay opciones para seleccionar",
    });

    $.ajax({
        method: "GET",
        url: urlParent,
        dataType: "JSON",
        success: function (data) {
            let arrayParentCategories = data.parentCategories;

            if (arrayParentCategories.length === 0) {
                console.log("0");
                // selectChilds.prop("disabled", true);
            } else {
                // choicesChildCategory.setValue(arrayChildCategories);
                choicesParentCategory.setChoices(
                    arrayParentCategories,
                    "value",
                    "label",
                    true
                );
                // selectChilds.prop("disabled", false);
            }
        },
        complete: function () {},
    });

    // **********************

    $("select[name=parentCategoryId]").change(function () {

        console.log("dasdasdas");
        let valueParent = $(this).val();
        let selectChilds = $("#select-child-category");

        // eliminar options
        choicesChildCategory.removeActiveItems();
        choicesChildCategory.clearStore();
        // eliminar options

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
                    // choicesChildCategory.setValue(arrayChildCategories);
                    choicesChildCategory.setChoices(
                        arrayChildCategories,
                        "value",
                        "label",
                        true
                    );
                    selectChilds.prop("disabled", false);
                }
            },
            complete: function () {},
        });
    });
});
