

require('./bootstrap');

window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app',
});

$(document).ready(function () {

    // FADE-OUT MESSAGGI CON SUCCESSO
    var alert = $('.alert-success');
    alert.fadeOut(4000);

    // HAMBURGER MENU
    $('.responsive-icon').click(function(){
        $('.responsive-icon').hide();
        $('.dx-responsive').show(1000);
      }
    );
    
    $(".jumbotron, .header-sx, .container-fluid").click(function(){
        $('.dx-responsive').slideUp(1000);
        $('.responsive-icon').show(2500);
      }
    );
});
