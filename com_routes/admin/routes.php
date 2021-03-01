<?php

defined('_JEXEC') or exit();

$controller = JControllerLegacy::getInstance('Routes');//RoutesuaController
$input = JFactory::getApplication()->input;


$controller->execute($input->get('task', 'display'));

$controller->redirect();
