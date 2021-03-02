<?php

defined('_JEXEC') or exit();

class NewsViewNews extends JViewLegacy {

	protected $items;
	protected $pagination;

	function display($tpl = null) {

		$this->items = $this->get('Items');//getItems
		$this->pagination = $this->get('Pagination');//getPagination

		foreach ($this->items as $item) {
			$item->images = json_decode($item->images);
		}

		$this->setDocument();

		parent::display($tpl);
	}

	protected function setDocument() {
		$document = JFactory::getDocument();

		$document->addCustomTag('<link href="'.JURI::root(true).'/components/com_news/css/com_news.css" rel="stylesheet" type="text/css" />');
		$document->addCustomTag('<link href="'.JURI::root(true).'/components/com_news/css/com_news_media.css" rel="stylesheet" type="text/css" />');

		$document->addCustomTag('<script src="'.JURI::root(true).'/components/com_news/js/com_news.js" type="text/javascript"></script>');

        JText::script('COM_NEWS_MORE');
        JText::script('COM_NEWS_HIDE');

	}
}