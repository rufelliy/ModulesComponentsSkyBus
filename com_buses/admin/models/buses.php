<?php
/**
 * Created by PhpStorm.
 * User: rufel
 * Date: 02.05.2018
 * Time: 15:17
 */
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