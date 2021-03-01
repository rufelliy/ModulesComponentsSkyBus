<?php
/**
 * Created by PhpStorm.
 * User: rufel
 * Date: 02.05.2018
 * Time: 15:31
 */
defined('_JEXEC') or exit();

class NewsViewItem extends JViewLegacy {

	protected $item;

	function display($tpl = null) {

		$this->item = $this->get('Item');//getItem

		parent::display($tpl);

	}
}