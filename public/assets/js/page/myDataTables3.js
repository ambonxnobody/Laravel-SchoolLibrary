"use strict";

$("#myTable-3").dataTable({
    columnDefs: [
        {
            sortable: false,
            targets: [0, 4],
        },
    ],
});
