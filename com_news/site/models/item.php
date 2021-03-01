<?php
/**
 * Created by PhpStorm.
 * User: rufel
 * Date: 02.05.2018
 * Time: 15:29
 */
defined('_JEXEC') or exit();

class NewsModelItem extends JModelItem {

	protected $item;

	protected function populateState() {
		$input = JFactory::getApplication()->input;

		$id = $input->get('id', 1, 'INT');
		$this->setState('item.id',$id);
	}

	public function getItem() {

		$id = $this->getState('item.id');

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('`id`, `title`, `publish_up`, `text`, `images`, `alias`');
		$query->from('#__news');
		$query->where('id='.(int)$id);

		$db->setQuery($query);

		$this->item = $db->loadObject();
		if ($this->item) {
			$this->item->images = json_decode($this->item->images);
		}
		return $this->item;
	}
}