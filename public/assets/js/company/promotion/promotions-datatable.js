import { es } from "./../../global/es.js";

let table = $("#promotions-table");

let getDataTable = table.data("url");

export let promotionsTable = table.DataTable({
    language: es,
    drawCallback: function (settings) {
        $("ul.pagination").addClass("pagination-sm");
        $(".dataTables_info").addClass("text-small");
    },
    responsive: true,
    autoWidth: false,
    serverSide: true,
    processing: true,
    ajax: getDataTable,
    columns: [
        { data: "id", name: "id" },
        { data: "number_promotion", name: "number_promotion" },
        { data: "price", name: "price" },
        { data: "stock", name: "stock" },
        { data: "date_start", name: "date_start" },
        { data: "date_end", name: "date_end" },
        { data: "products", name: "products" },
        { data: "image", name: "image", orderable: false, searchable: false },
        { data: "action", name: "action", orderable: false, searchable: false },
    ],
    order: [[0, "desc"]],
});
