$(document).ready(function() {

    //Каруселька
    //Документация: http://owlgraphic.com/owlcarousel/
    var owl = $(".carousel");
    owl.owlCarousel({
        items : 4,
        autoHeight : true
    });
    $(".next_button").click(function(){
        owl.trigger("owl.next");
    });
    $(".prev_button").click(function(){
        owl.trigger("owl.prev");
    });

    var num = $('.owl-item').length;


    if( window.innerWidth <= 496 ) {
        if (num <= 1) {
            $('.prev_button').css({'display': 'none'});
            $('.next_button').css({'display': 'none'});
        }else {
            $('.prev_button').css({'display': 'block'});
            $('.next_button').css({'display': 'block'});
        }
    }else if( window.innerWidth <= 785 ) {
        if (num <= 2) {
            $('.prev_button').css({'display': 'none'});
            $('.next_button').css({'display': 'none'});
        }else {
            $('.prev_button').css({'display': 'block'});
            $('.next_button').css({'display': 'block'});
        }
    } else if( window.innerWidth <= 996 ) {
        if (num <= 3) {
            $('.prev_button').css({'display': 'none'});
            $('.next_button').css({'display': 'none'});
        }else {
            $('.prev_button').css({'display': 'block'});
            $('.next_button').css({'display': 'block'});
        }
    } else{
        if (num <= 4) {
            $('.prev_button').css({'display': 'none'});
            $('.next_button').css({'display': 'none'});
        }else {
            $('.prev_button').css({'display': 'block'});
            $('.next_button').css({'display': 'block'});
        }
    }
    $(window).resize(function(){
        if( window.innerWidth <= 496 ) {
            if (num <= 1) {
                $('.prev_button').css({'display': 'none'});
                $('.next_button').css({'display': 'none'});
            }else {
                $('.prev_button').css({'display': 'block'});
                $('.next_button').css({'display': 'block'});
            }
        }else if( window.innerWidth <= 785 ) {
            if (num <= 2) {
                $('.prev_button').css({'display': 'none'});
                $('.next_button').css({'display': 'none'});
            }else {
                $('.prev_button').css({'display': 'block'});
                $('.next_button').css({'display': 'block'});
            }
        } else if( window.innerWidth <= 996 ) {
            if (num <= 3) {
                $('.prev_button').css({'display': 'none'});
                $('.next_button').css({'display': 'none'});
            }else {
                $('.prev_button').css({'display': 'block'});
                $('.next_button').css({'display': 'block'});
            }
        } else{
            if (num <= 4) {
                $('.prev_button').css({'display': 'none'});
                $('.next_button').css({'display': 'none'});
            }else {
                $('.prev_button').css({'display': 'block'});
                $('.next_button').css({'display': 'block'});
            }
        }
    });

});