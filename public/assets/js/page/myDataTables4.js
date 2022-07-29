"use strict";

$("#myTable-4").dataTable({
    columnDefs: [
        {
            sortable: false,
            targets: [0, 3],
        },
    ],
});
