<?php
/**
 * Created by PhpStorm.
 * User: Rufelliy
 * Date: 02.04.2018
 * Time: 13:42
 */
defined('_JEXEC') or exit();

class RoutesControllerRoutes extends JControllerAdmin {

    public  function getModel($name = 'Item', $prefix = 'RoutesModel', $config = array()) {
        return parent::getModel($name, $prefix, $config);
    }
}