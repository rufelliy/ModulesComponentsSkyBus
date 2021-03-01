<?php
/**
 * Created by PhpStorm.
 * User: rufel
 * Date: 02.05.2018
 * Time: 15:25
 */
defined('_JEXEC') or exit();

class BusesViewBuses extends JViewLegacy {

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
		JToolbarHelper::title(JText::_('COM_BUSES_MANAGER_BUSES'));

		JToolbarHelper::addNew('item.add');
		JToolbarHelper::editList('item.edit');

		JToolbarHelper::deleteList('','buses.delete');
	}

	protected function setDocument() {

		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_BUSES_ADMINISTRATION'));
	}
}