<?php

defined('_JEXEC') or exit();

class BusesControllerBuses extends JControllerAdmin {

	public  function getModel($name = 'Item', $prefix = 'BusesModel', $config = array()) {
		return parent::getModel($name, $prefix, $config);
	}
}