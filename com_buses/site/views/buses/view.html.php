<?php
/**
 * Created by PhpStorm.
 * User: rufel
 * Date: 02.05.2018
 * Time: 15:34
 */
defined('_JEXEC') or exit();

class BusesViewBuses extends JViewLegacy {

	protected $items;
	protected $pagination;

	function display($tpl = null) {

		$this->items = $this->get('Items');//getItems
		$this->pagination = $this->get('Pagination');//getPagination

		foreach ($this->items as $item) {
			$item->images = json_decode($item->images);
		}

		$this->setDocument();

		parent::display($tpl);
	}

	protected function setDocument() {
		$document = JFactory::getDocument();

		$document->addCustomTag('<link href="'.JURI::root(true).'/components/com_buses/css/com_buses.css" rel="stylesheet" type="text/css" />');
		$document->addCustomTag('<link href="'.JURI::root(true).'/components/com_buses/css/com_buses_media.css" rel="stylesheet" type="text/css" />');

		$document->addCustomTag('<script src="'.JURI::root(true).'/components/com_buses/js/com_buses.js" type="text/javascript"></script>');


	}
}