<?php
/**
 * Created by PhpStorm.
 * User: rufel
 * Date: 24.03.2018
 * Time: 14:31
 */
defined('_JEXEC') or exit();

$controller = JControllerLegacy::getInstance('Buses');//BusesController
$input = JFactory::getApplication()->input;


$controller->execute($input->get('task', 'display'));

$controller->redirect();