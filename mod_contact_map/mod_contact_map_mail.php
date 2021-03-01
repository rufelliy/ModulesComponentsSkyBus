<?php
	//Проверка переменной Joomla

    $recepient = trim($_GET["repicient"]);
    $sitename = trim($_GET["sitename"]);

    $name = trim($_GET["name"]);
    $phone = trim($_GET["email"]);
    $text = trim($_GET["message"]);

    $pagetitle = "Нове повідомлення з сайту \"$sitename\"";
    $message = "Ім'я: $name \nE-mail: $phone \nПовідомлення: $text";
    mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");
?>