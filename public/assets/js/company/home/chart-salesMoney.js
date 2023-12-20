$(document).ready(() => {


    let url = $("#chart-sales").data("url");


    // *ajax

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        success: function (response) {

            let labels = response.labels;
            let datasets = response.datasets;

            // * raw chart
            var SalesChart = (function () {
                // Variables

                var $chart = $("#chart-sales");

                // Methods

                function init($chart) {
                    var salesChart = new Chart($chart, {
                        type: "line",
                        options: {
                            scales: {
                                yAxes: [
                                    {
                                        gridLines: {
                                            lineWidth: 1,
                                            color: Charts.colors.gray[900],
                                            zeroLineColor:
                                                Charts.colors.gray[900],
                                        },
                                        ticks: {
                                            callback: function (value) {
                                                if (!(value % 10)) {
                                                    return "S/. " + value;
                                                }
                                            },
                                        },
                                    },
                                ],
                            },
                            tooltips: {
                                callbacks: {
                                    label: function (item, data) {
                                        var label =
                                            data.datasets[item.datasetIndex]
                                                .label || "";
                                        var yLabel = item.yLabel;
                                        var content = "";

                                        if (data.datasets.length > 1) {
                                            content +=
                                                '<span class="popover-body-label mr-auto">' +
                                                label +
                                                "</span>";
                                        }

                                        content +=
                                            '<span class="popover-body-value">S/. ' +
                                            yLabel +
                                            "</span>";
                                        return content;
                                    },
                                },
                            },
                        },
                        data: {
                            labels: labels,
                            datasets: datasets,
                        },
                    });

                    // Save to jQuery object

                    $chart.data("chart", salesChart);
                }

                // Events

                if ($chart.length) {
                    init($chart);
                }
            })();

        }
    })



});
