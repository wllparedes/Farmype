import { es } from "./../../global/es.js";

let usersTableEle = $("#sales-table");
let getDataTable = usersTableEle.data("url");
let usersTable = usersTableEle.DataTable({
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
        { data: "operation_number_sale", name: "operation_number_sale" },
        { data: "client", name: "client" },
        { data: "discount", name: "discount" },
        { data: "total", name: "total" },
        { data: "time", name: "time" },
        { data: "date", name: "date" },
        { data: "action", name: "action", orderable: false, searchable: false },
    ],
    order: [[0, "desc"]],
});
