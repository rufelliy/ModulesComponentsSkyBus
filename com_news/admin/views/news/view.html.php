<?php

defined('_JEXEC') or exit();

class NewsViewNews extends JViewLegacy {

	protected $items;
	protected $pagination;

	public function display($tpl = null) {

		$this->items = $this->get('Items');//getItems
		$this->pagination = $this->get('Pagination');//getPagination

		$this->addToolBar();

		parent::display($tpl);

		$this->setDocument();
	}

	protected function addToolBar() {
		JToolbarHelper::title(JText::_('COM_NEWS_MANAGER_NEWS'));

		JToolbarHelper::addNew('item.add');
		JToolbarHelper::editList('item.edit');

		JToolbarHelper::deleteList('','news.delete');
	}

	protected function setDocument() {

		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_NEWS_ADMINISTRATION'));
	}
}