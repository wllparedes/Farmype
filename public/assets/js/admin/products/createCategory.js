// * checkboxs

let checkParent = document.querySelector(
    'input[name="create_parent_category"]'
);
let checkChild = document.querySelector('input[name="create_child_category"]');

// * divs container

let parentCategory = document.getElementById("name-parent-category");
let childCategory = document.getElementById("name-child-category");

checkParent.addEventListener("click", function () {
    if (checkParent.checked) {
        // * Divs
        parentCategory.classList.remove("div-name-parent-category");
        parentCategory.classList.add("div-name-parent-category-active");

        childCategory.classList.remove("div-name-child-category-active");
        childCategory.classList.add("div-name-child-category");

        // * checkbox
        checkParent.checked = true;
        checkChild.checked = false;
    } else {
        checkParent.checked = false;
        checkChild.checked = true;

        parentCategory.classList.add("div-name-parent-category");
        parentCategory.classList.remove("div-name-parent-category-active");

        childCategory.classList.add("div-name-child-category-active");
        childCategory.classList.remove("div-name-child-category");

        let url = checkChild.getAttribute("data-url");
        let selectChilds = $("#select-parent-category-c");
        selectChilds.html("");
        selectChilds.append(
            "<option disabled selected >Seleccionar una categoria principal </option>"
        );

        $.ajax({
            method: "GET",
            url: url,
            dataType: "JSON",
            success: function (data) {
                let parentCategories = data;

                if (parentCategories.length === 0) {
                    console.log("0");
                    selectChilds.prop("disabled", true);
                } else {
                    $.each(parentCategories, function (key, values) {
                        selectChilds.append(
                            '<option value="' +
                                values.id +
                                '">' +
                                values.name +
                                "</option>"
                        );
                    });
                }
            },
            complete: function () {},
        });
    }
});

checkChild.addEventListener("click", function () {
    if (checkChild.checked) {
        parentCategory.classList.remove("div-name-parent-category-active");
        parentCategory.classList.add("div-name-parent-category");

        childCategory.classList.remove("div-name-child-category");
        childCategory.classList.add("div-name-child-category-active");

        checkChild.checked = true;
        checkParent.checked = false;
        let url = checkChild.getAttribute("data-url");
        let selectChilds = $("#select-parent-category-c");
        selectChilds.html("");

        $.ajax({
            method: "GET",
            url: url,
            dataType: "JSON",
            success: function (data) {
                let parentCategories = data;

                if (parentCategories.length === 0) {
                    console.log("0");
                    selectChilds.prop("disabled", true);
                } else {
                    selectChilds.append(
                        "<option disabled selected >Seleccionar una categoria principal </option>"
                    );
                    $.each(parentCategories, function (key, values) {
                        selectChilds.append(
                            '<option value="' +
                                values.id +
                                '">' +
                                values.name +
                                "</option>"
                        );
                    });
                }
            },
            complete: function () {},
        });
    } else {
        parentCategory.classList.remove("div-name-parent-category");
        parentCategory.classList.add("div-name-parent-category-active");

        childCategory.classList.add("div-name-child-category");
        childCategory.classList.remove("div-name-child-category-active");

        checkChild.checked = false;
        checkParent.checked = true;
    }
});
