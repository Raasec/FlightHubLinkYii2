(function ($) {
    "use strict";

    $(document).ready(function () {

        // Dropdown on mouse hover
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);


        // Back to top button
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.back-to-top').fadeIn('slow');
            } else {
                $('.back-to-top').fadeOut('slow');
            }
        });
        $('.back-to-top').click(function () {
            $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
            return false;
        });


        // date e time picker
        if ($.fn.datetimepicker) {
            $('.date').datetimepicker({
                format: 'L'
            });
            $('.time').datetimepicker({
                format: 'LT'
            });
        }


        // carousel
        if ($.fn.owlCarousel) {
            $(".testimonial-carousel").owlCarousel({
                autoplay: true,
                smartSpeed: 1500,
                margin: 30,
                dots: true,
                loop: true,
                center: true,
                responsive: {
                    0: { items: 1 },
                    576: { items: 1 },
                    768: { items: 2 },
                    992: { items: 3 }
                }
            });
        }

        // as flight tabs
        $(document).on('click', '.flight-tab', function () {
            $('.flight-tab').removeClass('active');
            $(this).addClass('active');

            var type = $(this).data('type');
            $('#partidas-body, #chegadas-body').hide();
            $('#' + type + '-body').show();
        });

        // flight details Modal
        var flightModal = document.getElementById('flightModal');
        // ve se o element existe e se o Bootstrap modal API ta bom 
        if (flightModal) {
            flightModal.addEventListener('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var modal = $(this);

                // Use attr to get raw string values
                modal.find('.modal-title').text('Flight ' + button.attr('data-flight'));
                modal.find('#modal-flight-origin').text(button.attr('data-origin'));
                modal.find('#modal-flight-destination').text(button.attr('data-destination'));
                modal.find('#modal-flight-date').text(button.attr('data-date'));
                modal.find('#modal-flight-status').text(button.attr('data-status'));
                modal.find('#modal-flight-gate').text(button.attr('data-gate'));
                modal.find('#modal-flight-airline').text(button.attr('data-airline'));

                var imgUrl = button.attr('data-airline-image');
                if (imgUrl) {
                    modal.find('#modal-airline-image').attr('src', imgUrl).show();
                } else {
                    modal.find('#modal-airline-image').hide();
                }
            });
        }

    });
})(jQuery);
