
export let selectProduct = document.getElementById("selectProduct");
let url = selectProduct.getAttribute("data-get");

$(document).ready(() => {

    VirtualSelect.init({
        ele: selectProduct,
        options: [],
        search: true,
        required: true,
        multiple: true,
        maxValues: 4,
        searchPlaceholderText: "Buscar...",
        noSearchResultsText: "No se encontraron resultados",
        noOptionsText: "No hay opciones para mostrar",
        allOptionsSelectedText: "Todo seleccionado",
        optionsSelectedText: "Opciones seleccionadas",
        optionSelectedText: "Opción seleccionada",
        placeholder: `Seleccionar producto`,
    });

    $.ajax({
        method: "GET",
        url: url,
        dataType: "JSON",
        success: function (data) {
            let products = data.products;
            selectProduct.setOptions(products);
        },
    });

});
