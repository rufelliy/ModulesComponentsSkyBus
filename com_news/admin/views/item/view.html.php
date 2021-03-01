<?php
/**
 * Created by PhpStorm.
 * User: rufel
 * Date: 02.05.2018
 * Time: 15:22
 */
defined('_JEXEC') or exit();

class NewsViewItem extends JViewLegacy {

	protected $form;
	protected $item;

	public  function display($tpl = null) {


		$this->form = $this->get('Form');//getForm
		$this->item = $this->get('Item');//getItem

		$this->addToolBar();

		parent::display($tpl);

		$this->setDocument();
	}

	protected function addToolBar() {
		JToolbarHelper::title(JText::_('COM_NEWS_MANAGER_ITEM_NEW'));

		JToolbarHelper::apply('item.apply');
		JToolbarHelper::save('item.save');
		JToolbarHelper::cancel('item.cancel');

	}

	protected function setDocument() {

		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_NEWS_ADMINISTRATION'));
	}
}