/**
 *
 * @param {*} urlGetChildCategories
 * @param {*} valueParentCategory
 */
export const renderCategoriesChild = (urlGetChildCategories, valueParentCategory) => {

    valueParentCategory = valueParentCategory == "" ? false : valueParentCategory;

    let contenedor = document.getElementById("group-child-category");
    contenedor.querySelector("#select-child-category").remove();

    const select_childCategories = document.createElement("div");
    select_childCategories.id = "select-child-category";
    select_childCategories.classList.add(
        "form-control",
        "js-example-basic-single",
        "input-form-class"
    );
    select_childCategories.setAttribute("name", "child_category_id");
    contenedor.append(select_childCategories);

    if (!valueParentCategory) {
        VirtualSelect.init({
            ele: "#select-child-category",
            search: true,
            multiple: true,
            required: true,
            searchPlaceholderText: "Buscar...",
            noSearchResultsText: "No se encontraron resultados",
            noOptionsText: "No hay opciones para mostrar",
            allOptionsSelectedText: "Todo seleccionado",
            optionsSelectedText: "Opciones seleccionadas",
            placeholder: `Seleccionar las sub-categorias`,
        });
    } else {
        $.ajax({
            method: "GET",
            url: urlGetChildCategories,
            dataType: "JSON",
            data: { valueParentCategory },
            success: function (data) {
                let arrayChildCategories = data.childCategories;
                VirtualSelect.init({
                    ele: "#select-child-category",
                    options: arrayChildCategories,
                    search: true,
                    multiple: true,
                    required: true,
                    searchPlaceholderText: "Buscar...",
                    noSearchResultsText: "No se encontraron resultados",
                    noOptionsText: "No hay opciones para mostrar",
                    allOptionsSelectedText: "Todo seleccionado",
                    optionsSelectedText: "Opciones seleccionadas",
                    placeholder: `Seleccionar las sub-categorias`,
                });
            },
        });
    }
};
