$(document).ready(function() {


    // Вираховуємо висоту картинки в новинах,показуємо чи приховуємо контент новини
    var numberOfNews = $('.news').length;
    var i=0;
    function loadNews() {
        for (var num = 1; num <= numberOfNews; num++) {
            var heightOfTitle = $('.new' + num + ' h3').height();
            if (heightOfTitle > 50) {
                if (window.innerWidth < 480) {
                    $('.new' + num + ' .news_img').css({'height': '320px'});
                    $('.new' + num + ' .news_block').css({'height': 'auto'});
                } else {
                    $('.new' + num + ' .news_img').css({'height': '320px'});
                    $('.new' + num + ' .news_block').css({'height': '320px'});
                }
                // $('.new'+num+' .news_img').css({'height':'333px'});
                // $('.new'+num+' .news_block').css({'height':'333px'});
            }
			if (heightOfTitle > 70) {
                if (window.innerWidth < 480) {
                    $('.new' + num + ' .news_img').css({'height': '343px'});
                    $('.new' + num + ' .news_block').css({'height': 'auto'});
                } else {
                    $('.new' + num + ' .news_img').css({'height': '343px'});
                    $('.new' + num + ' .news_block').css({'height': '343px'});
                }
                // $('.new'+num+' .news_img').css({'height':'333px'});
                // $('.new'+num+' .news_block').css({'height':'333px'});
            }
        }
        i++;
        if (i > 5) {
            clearInterval(loadPage);
        }
    }
    var loadPage = setInterval(loadNews,50);
    var halfOfImg = $('.news_img').height() / 6;//Короткий текст займає частину блока
    var halfImg = Math.round(halfOfImg);//Округляємо висоту до цілого чмсла
    $('.full_text').css('height', halfImg);
    var textHeightNone = 0;
    $('.news_content').css('height', textHeightNone);
    $('.show-hide').click(function (e) {
        var id = $(this).attr("id");//Визначаємо id натиснутої кнопки
        e.preventDefault();
        e.stopImmediatePropagation();
        var newsBlockHeight = $('.new'+id+' .news_content_text').height();
        if ($('.new'+id+' .full_text').innerHeight() == halfImg) {
            $(this).removeClass();
            $(this).addClass('opened bttn');
            $('.new'+id+' .full_text').css({'color':'#ffffff'});
			$('.new'+id+' .full_text p').css({'visibility':'hidden'});
            $('.new'+id+' .full_text').animate({height: 0}, 250);
            $('.new'+id+' .news_block').animate({height: '-=55px'}, 250);
            $('.new'+id+' .news_img').css({'border-bottom-right-radius':'0px'});
            if( window.innerWidth < 992 )  $('.new'+id+' .news_img').css({'border-bottom-left-radius':'0px'});
            $('.new'+id+' .news_img').animate({height: '-=55px'}, 250);
            $('.new'+id+' .news_content').css({'height': '100%'}, 250);
            var fullText =  $('.new'+id+' .news_content').height();
            $('.new'+id+' .news_content').css({'height': '0px'}, 250);
            $('.new'+id+' .news_content').animate({height: fullText}, 250);
            $('.new'+id+' .news_content').animate({height: '100%'}, 250);

            var lang = $('.lang-active a')[0];
            if (lang.id == 'Українська (Україна)') {
                tex = 'Згорнути';
                $(this).css({'padding': '15px 39px 15px 39px'});
            }else if (lang.id == 'Russian (Russia)') {
                tex = 'Свернуть';
                $(this).css({'padding': '15px 37px 15px 37px'});
            }else if (lang.id == 'English (United Kingdom)') {
                tex = 'Hide';
                $(this).css({'padding': '15px 33px 15px 33px'});
            }

            $(this).text(tex);
        } else {
            $(this).removeClass();
            $(this).addClass('show-hide bttn');
			$('.new'+id+' .full_text p').css({'visibility':'visible'});
            $('.new'+id+' .full_text').css({'color':'#000000'});
            $('.new'+id+' .full_text').animate({height: halfImg}, 250);
            $('.new'+id+' .news_block').animate({height: '+=55px'}, 250);
            $('.new'+id+' .news_img').animate({height: '+=55px'}, 250);
            $('.new'+id+' .news_img').css({'border-bottom-right-radius':'5px'});
            if( window.innerWidth < 992 )  $('.new'+id+' .news_img').css({'border-bottom-left-radius':'5px'});
            $('.new'+id+' .news_content').animate({height: textHeightNone}, 250);

            var language = $('.lang-active a')[0];
            if (language.id == 'Українська (Україна)') {
                text = 'Детальніше';
            }else if (language.id == 'Russian (Russia)') {
                text = 'Подробнее';
            }else if (language.id == 'English (United Kingdom)') {
                text = 'More';
            }
            $(this).css({'padding': '15px 30px 15px 30px'});
            $(this).text(text);
        }
    });


    $(window).resize(function(){
        if( window.innerWidth < 992 ) {
            $('.news_block').css({'height': 'auto'});
            $('.news_img').css({'border-bottom-left-radius':'5px'});
        }else {
            for (var num = 1; num <= numberOfNews; num++) {
                var heightOfTitle = $('.new'+num+' h3').height();
				if (heightOfTitle > 70) {
                    $('.new'+num+' .news_img').css({'height':'343px'});
                    $('.new'+num+' .news_block').css({'height':'343px'});
                }else if (heightOfTitle > 50) {
                    $('.new'+num+' .news_img').css({'height':'320px'});
                    $('.new'+num+' .news_block').css({'height':'320px'});
				}else {
                    $('.new'+num+' .news_img').css({'height':'300px'});
                    $('.new'+num+' .news_block').css({'height':'300px'});
                }
            }
        }
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