<?php

defined('_JEXEC') or exit();

class RoutesViewItem extends JViewLegacy {

    protected $item;

    function display($tpl = null) {

        $this->item = $this->get('Item');//getItem

	    $this->setDocument();

        parent::display($tpl);

    }

	protected function setDocument() {
		$document = JFactory::getDocument();

		$document->addCustomTag('<link href="'.JURI::root(true).'/components/com_routes/slick/slick.css" rel="stylesheet" type="text/css" />');
		$document->addCustomTag('<link href="'.JURI::root(true).'/components/com_routes/slick/slick-theme.css" rel="stylesheet" type="text/css" />');
		$document->addCustomTag('<link href="'.JURI::root(true).'/components/com_routes/css/com_routes.css" rel="stylesheet" type="text/css" />');
		$document->addCustomTag('<link href="'.JURI::root(true).'/components/com_routes/css/com_routes_media.css" rel="stylesheet" type="text/css" />');

		$document->addCustomTag('<script src="'.JURI::root(true).'/components/com_routes/slick/slick.min.js" type="text/javascript"></script>');
		$document->addCustomTag('<script src="'.JURI::root(true).'/components/com_routes/js/com_routes.js" type="text/javascript"></script>');
		$document->addCustomTag('<script src="'.JURI::root(true).'/components/com_routes/js/com_routes_slider.js" type="text/javascript"></script>');
	}
}