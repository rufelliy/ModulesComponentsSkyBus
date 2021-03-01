<?php
/**
 * Created by PhpStorm.
 * User: Rufelliy
 * Date: 30.03.2018
 * Time: 10:52
 */
defined('_JEXEC') or exit();

class RoutesViewRoutes extends JViewLegacy {

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
        JToolbarHelper::title(JText::_('COM_ROUTES_MANAGER_ROUTES'));

        JToolbarHelper::addNew('item.add');
        JToolbarHelper::editList('item.edit');

        JToolbarHelper::deleteList('','routes.delete');
    }

    protected function setDocument() {

        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_ROUTES_ADMINISTRATION'));
    }
}