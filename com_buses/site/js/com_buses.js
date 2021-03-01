$(document).ready(function() {


    //Збільшення іконки при наведенні на зображення автобуса на сторінці автобуси
    $('.img_buses').mouseover(function () {
        $( ".img_buses .search" ).addClass('animate');
    });
    $('.img_buses').mouseleave(function () {
        $( ".img_buses .search" ).removeClass('animate');
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


