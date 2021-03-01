<?php
/**
 * Created by PhpStorm.
 * User: Rufelliy
 * Date: 06.06.2018
 * Time: 11:02
 */
defined('_JEXEC') or exit();

require_once JPATH_SITE . '/libraries/joomla/form/fields/list.php';

class JFormFieldRoutes extends JFormFieldList
{
    /**
     * The field type
     *
     * @var string
     */
    protected $type = 'Routes';

    /**
     * Method to get a list of option for a list input
     *
     * @return array An array of JHtml options
     */
    protected function getOptions()
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('id,title');
        $query->from('#__routes');
        $db->setQuery((string)$query);
        $items = $db->loadObjectList();
        $options = array();

        $db->setQuery((string)$query);
        $items = $db->loadObjectList();

        $options = array();
        if ($items) {
            foreach ($items as $item) {
                $options[] = JHtml::_('select.option', $item->id, $item->title);

            }
        }
        $options = array_merge(parent::getOptions(), $options);
        return $options;
    }
}