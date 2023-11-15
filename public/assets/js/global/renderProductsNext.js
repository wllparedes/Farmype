let numberPage = 1;

const renderProducts = () => {
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();

        let page = $(this).attr("href").split("page=")[1];
        numberPage = page;
        getMoreProducts(page);
    });

    function getMoreProducts(page) {
        $.ajax({
            type: "GET",
            url: "?page=" + page,
            success: function (data) {
                $("#productData").html(data.html);
            },
        });
    }
};

renderProducts();

export const renderProductsLoad = () => {
    function getMoreProducts(numberPage) {
        $.ajax({
            type: "GET",
            url: "?page=" + numberPage,
            success: function (data) {
                $("#productData").html(data.html);
            },
        });
    }

    getMoreProducts(numberPage);
};
