<?php

defined('_JEXEC') or exit();


class RoutesViewItem extends JViewLegacy {

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
        JToolbarHelper::title(JText::_('COM_ROUTES_MANAGER_ITEM_NEW'));

        JToolbarHelper::apply('item.apply');
        JToolbarHelper::save('item.save');
        JToolbarHelper::cancel('item.cancel');

    }

    protected function setDocument() {

        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_ROUTES_ADMINISTRATION'));
    }
}