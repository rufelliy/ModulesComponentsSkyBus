<?php

defined('_JEXEC') or exit();

class NewsControllerNews extends JControllerAdmin {

	public  function getModel($name = 'Item', $prefix = 'NewsModel', $config = array()) {
		return parent::getModel($name, $prefix, $config);
	}
}