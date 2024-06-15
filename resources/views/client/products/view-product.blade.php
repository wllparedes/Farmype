@extends('client.layouts.main')

@section('title', 'Producto relacionado')

@section('optional_links')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/virtual-select/virtual-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.css') }}">
@endsection

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-12">
                        <h1 class="text-white text-center">Productos a elegir</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- * -->

    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow" id="productData">
                    @include('client.products.render.render-products')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('optional_scripts')

    {{-- * Plugins --}}
    <script src="{{ asset('assets/js/plugins/@fortawesome/fontawesome-free/js/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/global/csrfToken.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetAlert/sweetAlert.min.js') }}"></script>
    {{--  --}}
    <script src="{{ asset('assets/js/plugins/virtual-select/virtual-select.min.js') }}"></script>
    {{-- * Necesarios --}}
    <script src="{{ asset('assets/js/global/renderProductsNext.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/client/products/addProductOnList.js') }}" type="module"></script>
    <script src="{{ asset('assets/js/client/products/deleteProductOnList.js') }}" type="module"></script>


    <script>
        let companiesNearby = document.getElementById("select-for-nearby-company");
        let url = companiesNearby.getAttribute("data-get");

        VirtualSelect.init({
            ele: companiesNearby,
            options: [],
            search: true,
            required: true,
            searchPlaceholderText: "Buscar...",
            noSearchResultsText: "No se encontraron resultados",
            noOptionsText: "No hay farmacias para mostrar",
            allOptionsSelectedText: "Todo seleccionado",
            optionsSelectedText: "Opciones seleccionadas",
            optionSelectedText: "Opción seleccionada",
            placeholder: `Seleccionar farmacia`,
        });

        $.ajax({
            method: "GET",
            url: url,
            dataType: "JSON",
            success: function(data) {
                let companies = data;
                companiesNearby.setOptions(companies);

            },
        });
    </script>


    <script>
        $(document).ready(() => {

            let containerProducts = document.getElementById("column-product-list");
            let url = containerProducts.getAttribute("data-url");

            let selectCompanyNearby = $("#select-for-nearby-company");

            selectCompanyNearby.on("change", function() {
                let companyId = selectCompanyNearby.val();

                $.ajax({
                    method: "GET",
                    url: url,
                    data: {
                        companyId: companyId,
                    },
                    dataType: "JSON",
                    success: function(data) {
                        let html = data.html;
                        containerProducts.innerHTML = html;
                    },
                });


            });

        });
    </script>

@endsection
