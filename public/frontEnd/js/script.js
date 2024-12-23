jQuery(document).ready(function () {
    "use strict";

        // main slider 
        $(".main-slider").owlCarousel({
            items: 1,
            loop: true,
            dots: false,
            autoplay: true,
            nav: true,
            autoplayHoverPause: false,
            margin: 0,
            mouseDrag: true,
            smartSpeed: 1000,
            autoplayTimeout: 5000,

            navText: ["<i class='fa-solid fa-angle-double-left'></i>",
                "<i class='fa-solid fa-angle-double-right'></i>"
            ],

            responsive: {
                0: {
                    nav: false
                },
                600: {
                    nav: false
                },
                1000: {
                    nav: false
                }
            }
        });
        // brand slider
    $("#brandCarousel").owlCarousel({
        items: 5,
        loop: true,
        dots: false,
        autoplay: true,
        nav: true,
        autoplayHoverPause: false,
        margin: 0,
        mouseDrag: true,
        smartSpeed: 1000,
        autoplayTimeout: 5000,
        navText: ["<i class='fa-solid fa-angle-double-left'></i>",
            "<i class='fa-solid fa-angle-double-right'></i>"
        ],
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
    // brand slider
    $("#testimonialCarousel").owlCarousel({
        items: 3,
        loop: true,
        dots: false,
        autoplay: true,
        nav: true,
        autoplayHoverPause: false,
        margin: 20,
        mouseDrag: true,
        smartSpeed: 1000,
        autoplayTimeout: 5000,
        navText: ["<i class='fa-solid fa-angle-double-left'></i>",
            "<i class='fa-solid fa-angle-double-right'></i>"
        ],
        responsive: {
            0: {   
                items: 1
            },
            600: {  
                items: 2
            },
            1000: { 
                items: 4
            }
        }
    });
    $('.select2').select2();

})
