<?php
//Проверка переменной Joomla
defined('_JEXEC') or die;

JPluginHelper::importPlugin('content');
$text = JHtml::_('content.prepare', $text);

use Joomla\Utilities\ArrayHelper;

//Отримуємо меню
$menu =& JSite::getMenu();
$menutype = $menu->getActive()->menutype;

$folder = ArrayHelper::getColumn((array) $params->get('addGallery'), 'folder');
$titleua = ArrayHelper::getColumn((array) $params->get('addGallery'), 'titleua');
$titleru = ArrayHelper::getColumn((array) $params->get('addGallery'), 'titleru');
$titleen = ArrayHelper::getColumn((array) $params->get('addGallery'), 'titleen');
$data = ArrayHelper::getColumn((array) $params->get('addGallery'), 'date');

$key = 0;

$doc = &JFactory::getDocument();
$module_name = 'mod_gallery';
//Підключаєм скріпт та стилі
$doc->addStylesheet( JURI::root(true) . "/modules/".$module_name."/css/".$module_name.".css" );
$doc->addStylesheet( JURI::root(true) . "/modules/".$module_name."/css/".$module_name."_media.css" );
$doc->addScript( JURI::root(true) . "/modules/".$module_name."/js/".$module_name.".js" );
$doc->addScript( JURI::root(true) . "/modules/".$module_name."/js/jquery.mosaicflow.min.js" );

require JModuleHelper::getLayoutPath($module_name, $params->get('layout', 'default'));

?>