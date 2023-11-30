import { renderSelectParentCategory } from "./select/selectCategoryParent.js";
import { renderCategoriesChild } from "./select/selectCategoryChild.js";

export const execute = (url) => {
    $("#select-parent-category").change(function () {
        let valueParent = $(this).val();
        renderCategoriesChild(url, valueParent);
    });
};

$(document).ready(function () {
    let url = document
        .getElementById("group-parent-category")
        .getAttribute("data-url-child");
    let urlParent = document
        .getElementById("group-parent-category")
        .getAttribute("data-url-parent");

    // * Formulario
    renderSelectParentCategory(urlParent, "group-parent-category", "select-parent-category", false);
    // * Model
    renderSelectParentCategory(urlParent, "group-parent-category-c", "select-parent-category-c", false);


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


    execute(url);
});
