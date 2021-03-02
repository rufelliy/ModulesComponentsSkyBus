<?php

defined('_JEXEC') or exit();

class NewsModelNews extends JModelList{

	protected function getListQuery() {

        $lang = JFactory::getLanguage();
        $tag = $lang->getTag();
        
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		//SELECT .....
		$query->select('`id`, `title`, `alias`, `text`, `images`, `publish_up`');

		//FROM ...
		$query->from('#__news');

		//WHERE ...
        $query->where($db->quoteName('published'). '=' . $db->quote('1'),'AND')
            ->where($db->quoteName('language'). '=' . $db->quote($tag));

		//ORDER BY ...
		$query->order('`publish_up` DESC');

		return $query;
	}
}




