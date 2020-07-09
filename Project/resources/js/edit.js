$(document).ready(function () {
    
    var header = $('header');
    var links = $('header a');
    var images = $('img');
    var overlay = $('.overlay-image');
    var img = $('<img></img>');

    header.css({
        'background-color': 'white',
        'box-shadow': '1px 1px 15px rgba(0, 0, 0, .1)'
    });

    links.css({
        'color': 'rgb(225, 60, 60)'
    });

    // overlay con immagine centrata
    overlay.html(img);

    images.click(function() {

        var src = $(this).attr('src');
        overlay.show();
        img.attr('src', src);
        console.log(src);
        
    });

    overlay.click(function() {

        overlay.hide();
    })

});