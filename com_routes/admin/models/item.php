 <?php
/**
 * Created by PhpStorm.
 * User: Rufelliy
 * Date: 30.03.2018
 * Time: 14:53
 */

use Joomla\Registry\Registry;

defined('_JEXEC') or exit();

class RoutesModelItem extends JModelAdmin {

    public  function getForm($data = array(), $loadData = true) {

        $form = $this->loadForm(
                                'com_routes.item',
                                'item',
                                array(
                                    'control'=>'jform',
                                    'load_data'=> $loadData
                                     )
                                );
        if (empty($form)) {
            return false;
        }


        return $form;
    }

    public function getTable($type = 'Item', $prefix = 'RoutesTable', $config = array())
    {
	    return JTable::getInstance($type, $prefix, $config);
    }

    protected function prepareTable($table) {

        if (isset($table->img_start) && is_array($table->img_start)) {
            $registry = new Registry;
            $registry->loadArray($table->img_start);
            $table->img_start = (string)$registry;
        }

	    if (isset($table->img_finish) && is_array($table->img_finish)) {
		    $registry = new Registry;
		    $registry->loadArray($table->img_finish);
		    $table->img_finish = (string)$registry;
	    }

	    if (isset($table->img_route) && is_array($table->img_route)) {
		    $registry = new Registry;
		    $registry->loadArray($table->img_route);
		    $table->img_route = (string)$registry;
	    }

	    if (isset($table->buses) && is_array($table->buses)) {
		    $registry = new Registry;
		    $registry->loadArray($table->buses);
		    $table->buses = (string)$registry;
	    }

	    if (isset($table->timetable) && is_array($table->timetable)) {
		    $registry = new Registry;
		    $registry->loadArray($table->timetable);
		    $table->timetable = (string)$registry;
	    }

    }

    protected function loadFormData() {
        $data = $this->getItem();

        return $data;
    }

	public  function getItem($pk = null) {
        if ($item = parent::getItem($pk)) {

            $registry = new Registry;
            $registry->loadString($item->img_start);
            $item->img_start = $registry->toArray();

	        $registry->loadString($item->img_finish);
	        $item->img_finish = $registry->toArray();

	        $registry->loadString($item->img_route);
	        $item->img_route = $registry->toArray();

	        $registry->loadString($item->buses);
	        $item->buses = $registry->toArray();

	        $registry->loadString($item->timetable);
	        $item->timetable = $registry->toArray();

            return $item;
        }
        return false;
    }

	public function delete($data) {

		foreach ($data as $id) {

			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select('`title`, `language`');
			$query->from('#__routes');
			$query->where('id='.(int)$id);
			$db->setQuery($query);

			$list = $db->loadObjectList();

			foreach ($list as $service) {
				$title = $service->title;
				$language = $service->language;
			}

			if (parent::delete($id)) {

				$db = JFactory::getDBO();
				$query = $db->getQuery(true);
				$conditions = array($db->quoteName('title'). '=' . $db->quote($title),$db->quoteName('language').'='
					.$db->quote($language));
				$query->delete($db->quoteName('#__menu'))
					->where($conditions);
				$db->setQuery($query);
				$db->execute();


			}

		}

		return false;

	}

	public function save($data) {

		if (parent::save($data)) {

			$last_id = (int) $this->getState($this->getName(). '.id');

			$db = &JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select('`id`, `title`, `alias`, `language`');
			$query->from('#__routes');
			$query->where('id='.$last_id);
			$db->setQuery($query);
			$list = $db->loadObjectList();

			foreach ($list as $service) {
				$title = $service->title;
				$alias = $service->alias;
				$language = $service->language;
			}

			$link = 'index.php?option=com_routes&view=item&id='.$last_id;

			if ($language == 'uk-UA')
			{
				$menutype = 'mainmenu-uk-ua';
			}elseif ($language == 'ru-RU') {
				$menutype = 'mainmenu-ru-ru';
			}elseif ($language == 'en-GB') {
				$menutype = 'mainmenu-en-gb';
			}

			$menu =& JSite::getMenu();
			$menu_items = $menu->getItems();

			foreach ($menu_items as $item_menu) {
				if (trim($item_menu->title) == 'Маршрути' && $language == 'uk-UA') {
					$parent_id = $item_menu->id;
					$path = $item_menu->alias . '/' . $alias;
				}
				if (trim($item_menu->title) == 'Маршруты' && $language == 'ru-RU') {
					$parent_id = $item_menu->id;
					$path = $item_menu->alias . '/' . $alias;
				}
				if (trim($item_menu->title) == 'Routes' && $language == 'en-GB') {
					$parent_id = $item_menu->id;
					$path = $item_menu->alias . '/' . $alias;
				}
				if (trim($item_menu->link) == $link) {
					$duplicate = true;
					$duplicate_id = $item_menu->id;
				}
			}

			$query = $db->getQuery(true);
			$query->select('component_id');
			$query->from('#__menu');
			$query->where($db->quoteName('path'). '=' . $db->quote('com_routes'),'OR')
				->where($db->quoteName('path'). '=' . $db->quote('com-routes'));
			$db->setQuery($query);
			$component_id = $db->loadResult();

			$type = 'component';
			$published = 1;

			if ($duplicate)
				{

					// Получаем объект запроса
					$query = $db->getQuery(true);

					//Отримуємо мову пункта меню
					$query->select('language');
					$query->from('#__menu');
					$query->where($db->quoteName('id'). '=' . $db->quote($duplicate_id));
					$db->setQuery($query);
					$dup_lang = $db->loadResult();

					if ($dup_lang == $language)
					{

						$query = $db->getQuery(true);

						// Поля для обновления
						$fields = array(
							$db->quoteName('menutype') . ' = ' . $db->quote($menutype),
							$db->quoteName('title') . ' = ' . $db->quote($title),
							$db->quoteName('alias') . ' = ' . $db->quote($alias),
							$db->quoteName('path') . ' = ' . $db->quote($path),
							$db->quoteName('type') . ' = ' . $db->quote($type),
							$db->quoteName('component_id') . ' = ' . $db->quote($component_id),
							$db->quoteName('language') . ' = ' . $db->quote($language),
							$db->quoteName('published') . ' = ' . $db->quote($published),
							$db->quoteName('link') . ' = ' . $db->quote($link)
						);

						// Условия обновления
						$conditions = $db->quoteName('id') . ' = ' . $db->quote($duplicate_id);

						$query->update($db->quoteName('#__menu'))->set($fields)->where($conditions);

						// Устанавливаем и выполняем запрос
						$db->setQuery($query)->execute();
					}else {

						$query = $db->getQuery(true);

						$conditions = $db->quoteName('id') . ' = ' . $db->quote($duplicate_id);

						$query->delete($db->quoteName('#__menu'))->where($conditions);

						// Устанавливаем и выполняем запрос
						$db->setQuery($query)->execute();

						// sorts out the lft rgt issue
						$menuTable = JTableNested::getInstance('Menu');

						// this is heading menu item but what data you have and require will vary per case - just look at an appropriate                    row in yr menu table
						$menuData = array(
							'menutype'     => $menutype,
							'title'        => $title,
							'alias'        => $alias,
							'path'         => $path,
							'type'         => $type,
							'component_id' => $component_id,
							'language'     => $language,
							'published'    => $published,
							'link'         => $link,
						);

						// this item is at the root so the parent id needs to be 1
						$menuTable->setLocation($parent_id, 'last-child');

						// save is the shortcut method for bind, check and store
						if (!$menuTable->save($menuData))
						{
							$this->setError($menuTable->getError());

							return false;
						}
					}

					return true;

			}else {

				// sorts out the lft rgt issue
				$menuTable = JTableNested::getInstance('Menu');

				// this is heading menu item but what data you have and require will vary per case - just look at an appropriate                    row in yr menu table
				$menuData = array(
					'menutype'     => $menutype,
					'title'        => $title,
					'alias'        => $alias,
					'path'         => $path,
					'type'         => $type,
					'component_id' => $component_id,
					'language'     => $language,
					'published'    => $published,
					'link'         => $link,
				);

				// this item is at the root so the parent id needs to be 1
				$menuTable->setLocation($parent_id, 'last-child');

				// save is the shortcut method for bind, check and store
				if (!$menuTable->save($menuData))
				{
					$this->setError($menuTable->getError());

					return false;
				}
			}

			return true;

		}



		return false;

	}

}