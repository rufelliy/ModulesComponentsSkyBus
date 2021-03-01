<?php
//Проверка переменной Joomla
defined('_JEXEC') or die;

//Вытаскиваем данные слайдов из админки
$street = $params->get('street');
$house = $params->get('house');
$town = $params->get('town');
$region = $params->get('region');
$index = $params->get('index');
$link1 = $params->get('link1');
$phone1 = $params->get('phone1');
$phone2 = $params->get('phone2');
$link2 = $params->get('link2');
$phone3 = $params->get('phone3');
$phone4 = $params->get('phone4');
$phone5 = $params->get('phone5');
$email = $params->get('email');
$APIkey = $params->get('APIkey');
$lat = $params->get('lat');
$lng = $params->get('lng');

//Отримуєм назву домена
$uri = JFactory::getURI();
$host = $uri->toString(array('host'));

$session =& JFactory::getSession();
$session->set("mail", $email);

//Отримуємо меню
$menu =& JSite::getMenu();
$menutype = $menu->getActive()->menutype;
$titlePage = $menu->getActive()->title;
$menu_items = $menu->getItems('menutype',$menutype);

$doc = &JFactory::getDocument();
$module_name = 'mod_contact_map';
//Підключаєм скріпт та стилі
$doc->addStylesheet( JURI::root(true) . "/modules/".$module_name."/css/".$module_name.".css" );
$doc->addStylesheet( JURI::root(true) . "/modules/".$module_name."/css/".$module_name."_media.css" );
$doc->addScript( JURI::root(true) . "/modules/".$module_name."/js/".$module_name.".js" );

require JModuleHelper::getLayoutPath($module_name, $params->get('layout', 'default'));

?>