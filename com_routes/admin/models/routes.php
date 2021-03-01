<?php
/**
 * Created by PhpStorm.
 * User: Rufelliy
 * Date: 02.04.2018
 * Time: 12:50
 */
defined('_JEXEC') or exit();

class RoutesModelRoutes extends JModelList {


    protected  function getListQuery() {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        //'SELECT `id`, `title`, `alias`, `published`'
        $query->select('`id`, `published`, `title`, `start_point_name`, `finish_point_name`, `language`');

        //FROM #__routesua
        $query->from('#__routes');

        return $query;
    }
}