<?php

defined('_JEXEC') or exit();

class BusesModelBuses extends JModelList{

	protected function getListQuery() {

        $lang = JFactory::getLanguage();
        $tag = $lang->getTag();

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		//SELECT .....
		$query->select('`id`, `brand`, `model`, `alias`, `description`, `images`, `wifi`, `tv`, `music`, `wc`, `climat`, `comfort`, `usb`, `food`');

		//FROM ...
		$query->from('#__buses');

		//WHERE ...
        $query->where($db->quoteName('published'). '=' . $db->quote('1'),'AND')
            ->where($db->quoteName('language'). '=' . $db->quote($tag));

		//ORDER BY ...
		$query->order('`id` DESC');

		return $query;
	}
}