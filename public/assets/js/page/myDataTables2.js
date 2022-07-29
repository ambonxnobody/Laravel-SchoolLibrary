"use strict";

$("#myTable-2").dataTable({
    columnDefs: [
        {
            sortable: false,
            targets: [6],
        },
    ],
});
