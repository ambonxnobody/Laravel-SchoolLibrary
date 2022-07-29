"use strict";

$("#myTable-1").dataTable({
    columnDefs: [
        {
            sortable: false,
            targets: [7],
        },
    ],
});
