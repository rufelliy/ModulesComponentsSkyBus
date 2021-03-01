<?php

defined('_JEXEC') or exit();

class BusesModelBuses extends JModelList {


	protected  function getListQuery() {

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		//'SELECT `id`, `brand`, `model`, `alias`, `published`'
		$query->select('`id`, `published`, `brand`, `alias`, `model`, `language`');

		//FROM #__buses
		$query->from('#__buses');

		return $query;
	}
}