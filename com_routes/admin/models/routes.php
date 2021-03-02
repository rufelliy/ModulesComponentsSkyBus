<?php

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