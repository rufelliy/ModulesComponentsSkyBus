<?php

defined('_JEXEC') or exit();

class BusesViewItem extends JViewLegacy {

	protected $item;

	function display($tpl = null) {

		$this->item = $this->get('Item');//getItem

		parent::display($tpl);

	}
}