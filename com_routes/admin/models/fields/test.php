<?php

/**
 * Class JFormFieldTest класс поля
 */
class JFormFieldTest extends JFormField
{
	/**
	 * @var string Тип поля (Должен называться как файл с полем)
	 */
	protected $type = 'Test';

	/**
	 * Создание поля
	 * @return string
	 */
	protected function getInput()
	{


		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$id = htmlspecialchars( $this->value, ENT_COMPAT, 'UTF-8' );

		//'SELECT `id`, `title`, `alias`, `published`'
		$query->select('`intermediate_point1`, `intermediate_point2`, `intermediate_point3`, `intermediate_point4`, `intermediate_point5`, `intermediate_point6`, `intermediate_point7`, `intermediate_point8`');

		//FROM #__routes
		$query->from('#__routes');
		$query->where('id='.(int)$id);

		$db->setQuery($query);
		$list = $db->loadObjectList();
		$i = 0;
		
		$script = ' function addP() {
		          var count = document.getElementById(\'count\');
		          var point = document.getElementById(\'count\').textContent;
		          poin = Number(point);
		          if (poin == 8) {
		            return;
		          }
		          poin = poin + 1;
		          id1 = poin;
		          id2 = id1 + 10;
		          count.textContent = poin;
                  var appDiv = document.createElement(\'div\'); 
                  nameP = document.createElement(\'p\');
				  elemP = document.createElement("input");
				  putDv = document.querySelector(\'[id="block '.JText::_("COM_ROUTES_ITEM_MAP").'"]\');
				  putDiv = putDv.querySelector(\'[class="span9"]\');
				  putDiv.appendChild(appDiv);
				  appDiv.setAttribute(\'class\', \'control-group\');
				  appDiv.setAttribute(\'id\', "point"+id1);
				  var appDiv1 = document.createElement(\'div\');
				  putDiv1 = document.querySelector(\'[id="point\'+id1+\'"]\');
				  putDiv1.appendChild(appDiv1);
				  appDiv1.setAttribute(\'class\', \'controls\');
				  appDiv1.setAttribute(\'id\', "point"+id2);
                  putElemP = document.querySelector(\'[id="point\'+id2+\'"]\');
                  putElemP.appendChild(nameP);
                  nameP.setAttribute(\'id\', \'name\'+id2);
                  var textP = document.getElementById(\'name\'+id2);
                  var text = "'.JText::_("COM_ROUTES_INT_POINT").' "+id1;
                  textP.innerHTML = text;
                  putElemP.appendChild(elemP);
                  elemP.setAttribute(\'type\', \'text\');
                  elemP.setAttribute(\'name\', \'jform[intermediate_point\'+poin+\']' .'\');
                  elemP.setAttribute(\'id\', \'jform_intermediate_point\'+poin+\'' .'\');
                  elemP.setAttribute(\'value\', \'\');
                  elemP.setAttribute(\'class\', \'input-xlarge\');
			}';


		foreach ($list as $route)
		{
			foreach ($route as $key => $value)
			{
				if ($value != '')
				{
					$a = $i + 1;
					$b = $a + 10;
					$i++;
				}
			}
		}

		$pool = '
						window.onload = function() {
							for (i = 1; i<=8; i++ ){
								elem = document.getElementById(\'jform_intermediate_point\'+i);
								elemText = document.getElementById(\'jform_intermediate_point\'+i).value;
								if (elemText == "") {
									elem.style.display="none";
								}
							}
						}';

		JFactory::getDocument()->addScriptDeclaration( $pool );

		JFactory::getDocument()->addScriptDeclaration( $script );

		//Инициализация атрибутов поля
		//Класс поля
		$class = $this->element['class'] ? ' class="' . (string)$this->element['class'] . '"' : '';
		//Поле только для чтения
		$readonly = ( (string)$this->element['readonly'] == 'true' ) ? ' readonly="readonly"' : '';
		//Поле недоступно
		$disabled = ( (string)$this->element['disabled'] == 'true' ) ? ' disabled="disabled"' : '';
		//Событие при изменения данных в поле
		$onchange = $this->element['onchange'] ? ' onchange="' . (string)$this->element['onchange'] . '"' : '';
		//Возвращаем сформированное поле
		return '<div class="input-append">
                    <input type="button" value="'.  JText::_('COM_ROUTES_INTERMEDIAL_POINT_ADD') .'" class="btn btn-success" onclick="addP()" /><br>
                </div>
                <div id="count" style="display: none">'.$i.'</div>';
	}
}