<?php
/**
 * Created by PhpStorm.
 * User: rufel
 * Date: 02.05.2018
 * Time: 15:19
 */
defined('_JEXEC') or exit();

class BusesTableItem extends JTable {

	public function __construct(&$db)
	{
		parent::__construct('#__buses', 'id', $db);
	}
}