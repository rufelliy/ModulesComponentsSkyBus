<?php

defined('_JEXEC') or exit();

class RoutesControllerRoutes extends JControllerAdmin {

    public  function getModel($name = 'Item', $prefix = 'RoutesModel', $config = array()) {
        return parent::getModel($name, $prefix, $config);
    }
}