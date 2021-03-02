<?php

defined('_JEXEC') or exit();

class RoutesViewRoutes extends JViewLegacy {

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
	    $document->addStyleSheet(JUri::base().'components/com_routes/css/com_routes.css');
	    $document->addStyleSheet(JUri::base().'components/com_routes/css/com_routes_media.css');

	    $document->addScript(JUri::base().'components/com_routes/js/com_routes.js');
    }
}