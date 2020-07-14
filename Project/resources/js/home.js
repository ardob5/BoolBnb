$(document).ready(function () {

    var registerButton = $('.register-button');
    var scrolledButton = $('#scrolled-button');

    // HEADER SCROLL
    $(document).scroll(function () {
        var scrollDocument = $(document).scrollTop();
        if (scrollDocument != 0) {
            $('.logobnb').attr('src', 'img/LOGO_UNO_MOD.png');
            $('header').css({
                'background-color': 'white',
                'box-shadow': '1px 1px 15px 5px grey'
            });

            $('.header-dx ul li a').css({
                'color': 'rgb(225, 60, 60)'
            });
            registerButton.addClass('scrolled');



        } else {
            $('.logobnb').attr('src', 'img/LOGO_UNO_MOD_BA.png');
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

    // home responsive

    if (window.matchMedia('(max-width: 1170px)').matches){
      $('.mediaquery_change').removeClass('col-md-4');
      $('.mediaquery_change').addClass('col-md-6');
    }

});

// responsive JS

// document.addEventListener('DOMContentLoaded', init);
//
// function init(){
//   let query = window.matchMedia("(max-width: 980px)");
//
//   if(query.matches){
//     document.querySelector('.bnb-btn').style.background = "blue";
//   }else{
//     document.querySelector('h1').style.color = "black";
//   }
// }
