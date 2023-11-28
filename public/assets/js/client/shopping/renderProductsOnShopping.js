export const renderProductsOnList = () => {
    let element = $("#productData");
    let url = $("#productData").data("url");

    function getMoreProducts() {
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                element.html(data.html);

                let key = data.key;
                let preferenceId = data.id;

                const mp = new MercadoPago(key, {
                    locale: "es-AR",
                });
                mp.checkout({
                    preference: {
                        id: preferenceId,
                    },
                    render: {
                        container: ".mercadopago-button",
                        label: "Pagar",
                    },
                });
            },
            complete: function (data) {},
        });
    }

    getMoreProducts();
};
