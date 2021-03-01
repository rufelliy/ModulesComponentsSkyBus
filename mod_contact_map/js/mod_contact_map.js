$(document).ready(function() {

    //Попап менеджер FancyBox
    $(".fancybox").fancybox();

    $('a[href="/#map"]').removeClass();
    $('a[href="/#map"]').addClass('trans');

    $('a[href="/#map"]').click( function (event) {
        event.preventDefault();
        $(this).attr("href", "#map");
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
        return false;
    });
    $('a[href="/#compan"]').click( function (event) {
        event.preventDefault();
        $(this).attr("href", "#compan");
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
        return false;
    });
    $('a[href="/#partner"]').click( function (event) {
        event.preventDefault();
        $(this).removeClass('transitior');
        $(this).attr("href", "#partner");
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
        return false;
    });

     //Переворот контактів до форми зворотнього звязку
    $('#button_callback').click(function () {
        $("#callback_message").css({'display': 'none'});
        $('#callback').css("opacity","1");
        var wrap = $('#contacts');
        $(wrap).css({ '-webkit-box-shadow': 'none'});
        $(wrap).css({ '-moz-box-shadow': 'none'});
        $(wrap).css({ 'box-shadow': 'none'});
        $(wrap).css({ '-o-transform': 'scaleX(-1)'});
        $(wrap).css({ '-ms-transform': 'scaleX(-1)'});
        $(wrap).css({ '-moz-transform': 'scaleX(-1)'});
        $(wrap).css({ '-webkit-transform': 'scaleX(-1)'});
        $(wrap).css({ 'transform': 'scaleX(-1)'});
        var wrap1 = $('#callback');
        $(wrap1).css({ '-webkit-box-shadow': '8px 8px 25px 0px rgba(0,0,0,0.2)'});
        $(wrap1).css({ '-moz-box-shadow': '8px 8px 25px 0px rgba(0,0,0,0.2)'});
        $(wrap1).css({ 'box-shadow': '8px 8px 25px 0px rgba(0,0,0,0.2)'});
        $(wrap1).css({'-o-transform': 'scaleX(1)'});
        $(wrap1).css({'-ms-transform': 'scaleX(1)'});
        $(wrap1).css({'-moz-transform': 'scaleX(1)'});
        $(wrap1).css({'-webkit-transform': 'scaleX(1)'});
        $(wrap1).css({'transform': 'scaleX(1)'});
        function delay() {
            $(wrap).css("visibility","hidden");
        }
        function delay1() {
            $('#callback').css("visibility","visible");
        }
        setTimeout(delay, 0);
        setTimeout(delay1, 0);
    });
    $('#map').click(function () {
        if ($('#callback_form').css('display') != 'none' ) {
            $('#callback').css("opacity", "0");
            var wrap = $('#contacts');
            $(wrap).css({'-webkit-box-shadow': '8px 8px 25px 0px rgba(0,0,0,0.2)'});
            $(wrap).css({'-moz-box-shadow': '8px 8px 25px 0px rgba(0,0,0,0.2)'});
            $(wrap).css({'box-shadow': '8px 8px 25px 0px rgba(0,0,0,0.2)'});
            $(wrap).css({'-o-transform': 'scaleX(1)'});
            $(wrap).css({'-ms-transform': 'scaleX(1)'});
            $(wrap).css({'-moz-transform': 'scaleX(1)'});
            $(wrap).css({'-webkit-transform': 'scaleX(1)'});
            $(wrap).css({'transform': 'scaleX(1)'});
            var wrap1 = $('#callback');
            $(wrap1).css({'-webkit-box-shadow': 'none'});
            $(wrap1).css({'-moz-box-shadow': 'none'});
            $(wrap1).css({'box-shadow': 'none'});
            $(wrap1).css({'-o-transform': 'scaleX(-1)'});
            $(wrap1).css({'-ms-transform': 'scaleX(-1)'});
            $(wrap1).css({'-moz-transform': 'scaleX(-1)'});
            $(wrap1).css({'-webkit-transform': 'scaleX(-1)'});
            $(wrap1).css({'transform': 'scaleX(-1)'});

            function delay() {
                $(wrap1).css("visibility", "hidden");
            }

            function delay1() {
                $('#contacts').css("visibility", "visible");
            }

            setTimeout(delay, 0);
            setTimeout(delay1, 0);
        }
    });


    //Аякс відправка форм з головної сторінки
    $("#callback_form").submit(function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $("#popup_load").show();
            $.ajax({
                type: "GET",
                url: "/modules/mod_contact_map/mod_contact_map_mail.php",
                data: $("#callback_form").serialize()
            }).done(function () {
                $("#popup_load").hide();
                setTimeout(function () {
                    $("#callback_form").css({'display': 'none'});
                    $("#callback_message").css({'display': 'block'});
                }, 1);
            });
            return false;
    });

    //Повернення до контактів після відправки повідомлення на головній сторінці
    $("#callback_message button").click(function() {
        setTimeout(function() {
            $('#callback').css("opacity","0");
            var wrap = $('#contacts');
            $(wrap).css({ '-webkit-box-shadow': '8px 8px 25px 0px rgba(0,0,0,0.2)'});
            $(wrap).css({ '-moz-box-shadow': '8px 8px 25px 0px rgba(0,0,0,0.2)'});
            $(wrap).css({ 'box-shadow': '8px 8px 25px 0px rgba(0,0,0,0.2)'});
            $(wrap).css({ '-o-transform': 'scaleX(1)'});
            $(wrap).css({ '-ms-transform': 'scaleX(1)'});
            $(wrap).css({ '-moz-transform': 'scaleX(1)'});
            $(wrap).css({ '-webkit-transform': 'scaleX(1)'});
            $(wrap).css({ 'transform': 'scaleX(1)'});
            var wrap1 = $('#callback');
            $(wrap1).css({ '-o-transform': 'scaleX(-1)'});
            $(wrap1).css({ '-ms-transform': 'scaleX(-1)'});
            $(wrap1).css({ '-moz-transform': 'scaleX(-1)'});
            $(wrap1).css({ '-webkit-transform': 'scaleX(-1)'});
            $(wrap1).css({ 'transform': 'scaleX(-1)'});
            function delay() {
                $(wrap1).css("visibility","hidden");
            }
            function delay1() {
                $('#contacts').css("visibility","visible");
            }
            setTimeout(delay, 0);
            setTimeout(delay1, 0);
        }, 0);
        // $("#callback_message").css({'display': 'none'});
        $("#callback_form").css({'display': 'block'});
        return false;
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


