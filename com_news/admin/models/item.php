<?php

use Joomla\Registry\Registry;

defined('_JEXEC') or exit();

class NewsModelItem extends JModelAdmin {

	public  function getForm($data = array(), $loadData = true) {


		$form = $this->loadForm(
			'com_news.item',
			'item',
			array(
				'control'=>'jform',
				'load_data'=> $loadData
			)
		);
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	public function getTable($type = 'Item', $prefix = 'NewsTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	protected function prepareTable($table) {

		if (isset($table->images) && is_array($table->images)) {
			$registry = new Registry;
			$registry->loadArray($table->images);
			$table->images = (string)$registry;
		}
	}

	protected function loadFormData() {
		$data = $this->getItem();

		return $data;
	}

	public  function getItem($pk = null) {
		if ($item = parent::getItem($pk)) {

			$registry = new Registry;
			$registry->loadString($item->images);
			$item->images = $registry->toArray();

			return $item;
		}
		return false;
	}
}