$(document).ready(function() {

    $(function () {
        //script for popups
        $('a.show_popup').click(function () {
            $('div.'+$(this).attr("rel")).fadeIn(500);
            $("body").append("<div id='overlay'></div>");
            $('#overlay').show().css({'filter' : 'alpha(opacity=80)'});
            return false;
        });
        $('a.close').click(function () {
            $(this).parent().fadeOut(100);
            $('#overlay').remove('#overlay');
            return false;
        });
    });

    //Приховуєм модальне вікно
    PopUpHide();



    //Закриваємо модальне вікно при натисканні за межами форми у маршрутах
    // var raz = document.getElementById('popup_form');
    // raz.onclick = function(event) {
    //     event = event || window.event; // window.event для IE ниже 8 версії
    //     var t = event.target || event.srcElement; // srcElement для IE ниже 8 версії
    //     if (t != this) { return true; }
    //     $("#popup_form").hide();
    // }

    //Повернення до сторінки після відправки повідомлення на сторінці маршрутів
    $("#callback_message_rout").click(function() {
        $("#popup_return").hide();
        return false;
    });

    //Розмір карти на мсторінках маршрутів
    var i=0;
    function loadMap() {
        if (window.innerWidth < 998) {
            $('#map_routes').css({'height': '420px'});
        } else {
            var height = $('.abt_rout').height();
            $('#map_routes').css({'height': height});
        }
        $(window).resize(function () {
            if (window.innerWidth < 998) {
                $('#map_routes').css({'height': '420px'});
            } else {
                var height = $('.abt_rout').height();
                $('#map_routes').css({'height': height});
            }
        });
        i++;
        if (i > 5) {
            clearInterval(loadPage);
        }
    }
    var loadPage = setInterval(loadMap,50);



    $('.multiple-items').slick({
        infinite: true,
        arrows: true,
        slidesToShow: 7,
        slidesToScroll: 1,
        prevArrow: '<a id="prev_arrow" href="#"><img src="/images/prew.png"></a>',
        nextArrow: '<a id="next_arrow" href="#"><img src="/images/next.png"></a>'
    });

    $('.multipl-items').slick({
        infinite: true,
        arrows: true,
        slidesToShow: 4,
        slidesToScroll: 1
    });


});

//Функції показу і приховання модального вікна
function PopUpShow() {
    $("#popup_form").show();
    // $("#callbak").css({'display': 'block'});
}
function PopUpHide() {
    $("#popup_form").hide();
}



