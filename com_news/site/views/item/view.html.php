<?php

defined('_JEXEC') or exit();

class NewsViewItem extends JViewLegacy {

	protected $item;

	function display($tpl = null) {

		$this->item = $this->get('Item');//getItem

		parent::display($tpl);

	}
}