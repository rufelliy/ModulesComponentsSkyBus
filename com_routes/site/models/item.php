<?php
/**
 * Created by PhpStorm.
 * User: Rufelliy
 * Date: 03.04.2018
 * Time: 10:59
 */
defined('_JEXEC') or exit();

class RoutesModelItem extends JModelItem {

    protected $item;

    protected function populateState() {
        $input = JFactory::getApplication()->input;

        $id = $input->get('id', 1, 'INT');
        $this->setState('item.id',$id);
}

    public function getItem() {

        $id = $this->getState('item.id');

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

	    $query->select('*');

	    $query->from('#__routes');
        $query->where('id='.(int)$id);

        $db->setQuery($query);

        $this->item = $db->loadObject();
        if ($this->item) {
            $this->item->images = json_decode($this->item->images);
        }
        return $this->item;
    }

}