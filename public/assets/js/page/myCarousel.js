"use strict";

$("#myCarousel").owlCarousel({
    items: 1,
    nav: true,
    navText: [
        '<i class="fas fa-chevron-left"></i>',
        '<i class="fas fa-chevron-right"></i>',
    ],
    loop: true,
    margin: 10,
    responsive: {
        600: {
            items: 1,
        },
        800: {
            items: 2,
        },
    },
});
$("#myCarousel-2").owlCarousel({
    items: 1,
    nav: true,
    navText: [
        '<i class="fas fa-chevron-left"></i>',
        '<i class="fas fa-chevron-right"></i>',
    ],
    loop: true,
    margin: 10,
    responsive: {
        600: {
            items: 1,
        },
        800: {
            items: 2,
        },
    },
});
