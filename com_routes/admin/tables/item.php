<?php
//Описание класса таблиц

defined('_JEXEC') or exit();

class RoutesTableItem extends JTable {

	public function __construct(&$db)
	{

		parent::__construct('#__routes', 'id', $db);
	}
}