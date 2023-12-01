export const renderProductsOnList = () => {
    let element = $("#productData");
    let url = $("#productData").data("url");

    function getMoreProducts() {
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                element.html(data.html);
            },
            complete: function (data) {},
        });
    }

    getMoreProducts();
};
