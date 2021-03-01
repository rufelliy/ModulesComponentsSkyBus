<?php
/**
 * Created by PhpStorm.
 * User: Rufelliy
 * Date: 02.04.2018
 * Time: 14:07
 */
defined('_JEXEC') or exit();

class RoutesModelRoutes extends JModelList{

    protected function getListQuery() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        //SELECT .....
	    $query->select('*');


	    //FROM ...
        $query->from('#__routes');

        //WHERE ...
//        $query->where('`published` = 1');
//
//        //ORDER BY ...
//        $query->order('`publish_up` DESC');

        return $query;
    }
}