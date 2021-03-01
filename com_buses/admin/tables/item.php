<?php

defined('_JEXEC') or exit();

class BusesTableItem extends JTable {

	public function __construct(&$db)
	{
		parent::__construct('#__buses', 'id', $db);
	}
}