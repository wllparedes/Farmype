let numberPage = 1;

const renderProducts = () => {
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();

        let page = $(this).attr("href").split("page=")[1];
        numberPage = page;
        getMoreProducts(page);
    });

    let dataSend = $("#productData").data("url");

    function getMoreProducts(page) {
        $.ajax({
            type: "GET",
            url: dataSend + "?page=" + page,
            success: function (data) {
                $("#productData").html(data);
            },
        });
    }
};

renderProducts();

export const renderProductsLoad = () => {

    let dataSend = $("#productData").data("url");

    function getMoreProducts(numberPage) {
        $.ajax({
            type: "GET",
            url: dataSend + "?page=" + numberPage,
            success: function (data) {
                $("#productData").html(data);
            },
        });
    }

    getMoreProducts(numberPage);

};
