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
    $(".testimonial-carousel").owlCarousel({
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
                items: 3
            }
        }
    });
    // $('.select2').select2();

    $(window).on("scroll", function () {
        $(".counter-section").each(function () {
            if (isInViewport($(this))) {
                startCountAnimation();
                $(window).off("scroll"); // Stop listening after animation starts
            }
        });
    });

    function isInViewport($element) {
        var elementTop = $element.offset().top;
        var elementBottom = elementTop + $element.outerHeight();

        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    }
    function startCountAnimation() {
        $(".count-number").each(function () {
            var $this = $(this);
            var duration = $this.data("duration") || 1000;
            var start = $this.data("start") || 0;
            var end = parseFloat($this.text().replace(/[^0-9.-]+/g, "")) || 0;

            $this.prop("Counter", start).animate(
                {
                    Counter: end,
                },
                {
                    duration: duration,
                    easing: "swing",
                    step: function (now) {
                        now = Number(Math.ceil(now)).toLocaleString('en');
                        $this.text(now);
                    },
                }
            );
        });
    }


    // Order form fields hide/show
    $('.resizeto-div').show();
    $(function () {
        if ($('#resize').is(':checked')) {
            $('.resizeto-div').show();
        } else {
            $('.resizeto-div').hide();
        }
    });

    $(document).on('click', '#resize', function () {
        $('.resizeto-div').show();
    });
    $(document).on('click', '#original', function () {
        $('.resizeto-div').hide();
    });



})
