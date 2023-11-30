
const ajax = (url, idSelect) => {
    $.ajax({
        method: "GET",
        url: url,
        dataType: "JSON",
        success: function (data) {
            let arrayParentCategories = data.parentCategories;

            VirtualSelect.init({
                ele: idSelect,
                options: arrayParentCategories,
                search: true,
                required: true,
                searchPlaceholderText: "Buscar...",
                noSearchResultsText: "No se encontraron resultados",
                noOptionsText: "No hay opciones para mostrar",
                allOptionsSelectedText: "Todo seleccionado",
                optionsSelectedText: "Opciones seleccionadas",
                placeholder: `Seleccionar una categoria`,
            });
        },
    });
};


export const renderSelectParentCategory = (url, contendor = "" , idSelect = "" , name = "" , render = false) => {

    if (render) {
        let contenedor = document.getElementById(contendor);
        contenedor.querySelector(`#${idSelect}`).remove();

        const select_parentCategory = document.createElement("div");
        select_parentCategory.id = idSelect;
        select_parentCategory.classList.add(
            "form-control",
            "js-example-basic-single",
            "input-form-class"
        );
        select_parentCategory.setAttribute("name", name);

        contenedor.append(select_parentCategory);

        // * execute ajax1
        ajax(url, `#${idSelect}`);
        // * execute ajax1

    } else {

        // * execute ajax2
        ajax(url, `#${idSelect}`);
        // * execute ajax2
    }
};
