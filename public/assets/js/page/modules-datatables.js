"use strict";

$("#table-1").dataTable({
    columnDefs: [
        {
            sortable: false,
            targets: [3],
        },
    ],
});
