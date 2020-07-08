$(document).ready(function () {

    var registerButton = $('.register-button');
    var scrolledButton = $('#scrolled-button');
    // HEADER SCROLL
    $(document).scroll(function () {
        var scrollDocument = $(document).scrollTop();
        if (scrollDocument != 0) {
            $('header').css({
                'background-color': 'white',
                'box-shadow': '1px 1px 15px 5px grey'
            });

            $('.header-dx ul li a').css({
                'color': 'rgb(225, 60, 60)'
            });
            registerButton.addClass('scrolled');


        } else {
            registerButton.removeClass('scrolled');
            $('header').css({
                'background-color': 'transparent',
                'box-shadow': 'none'
            });
            $('.header-dx ul a').css({
                'color': 'white'
            });

        }

        // scrolled-button
        if (scrollDocument >  $('.container-fluid').offset().top) {
            scrolledButton.css('display', 'block');
        }

        if (scrollDocument < $('.container-fluid').offset().top) {
            scrolledButton.css('display', 'none');
        }
    });

    // click sul scrolled-Button
    scrolledButton.click(function () {

        window.scrollTo({
            top: 0,
            left: 0,
            behavior: 'smooth'
        })
    });

    // hover register-button
    registerButton.mouseenter(function(){
        registerButton.css({
            'background-color': 'rgb(225, 60, 60)',
        });

        $('.register-button a').css({
        'color': 'white',
        });

    });

    // hover register-button
    registerButton.mouseleave(function(){

        registerButton.css({
            'background-color': 'transparent'
        });

        if (registerButton.hasClass('scrolled')) {

            $('.register-button a').css({
                'color': 'rgb(225, 60, 60)',
            });
        } else {

            $('.register-button a').css({
                'color': 'white',
            });
        }
    });
});
