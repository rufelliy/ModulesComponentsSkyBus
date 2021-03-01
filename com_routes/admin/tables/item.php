<?php
/**
 * Created by PhpStorm.
 * User: rufel
 * Date: 31.03.2018
 * Time: 18:05
 */
//Описание класса таблиц

defined('_JEXEC') or exit();

class RoutesTableItem extends JTable {

	public function __construct(&$db)
	{

		parent::__construct('#__routes', 'id', $db);
	}
}