<?php

/**
 * Class JFormFieldTest класс поля
 */
class JFormFieldTel extends JFormField
{
	/**
	 * @var string Тип поля (Должен называться как файл с полем)
	 */
	protected $type = 'Tel';

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
		$query->select('`phone_dispatcher1`, `phone_dispatcher2`, `phone_dispatcher3`, `phone_dispatcher4`, `phone_dispatcher5`, `phone_dispatcher6`, `phone_dispatcher7`, `phone_dispatcher8`');

		//FROM #__routes
		$query->from('#__routes');
		$query->where('id='.(int)$id);

		$db->setQuery($query);
		$list = $db->loadObjectList();
		$i = 0;

		$scrpt = ' function addD() {
		          var count = document.getElementById(\'coun\');
		          var pont = document.getElementById(\'coun\').textContent;
		          pon = Number(pont);
		          if (pon == 8) {
		            return;
		          }
		          pon = pon + 1;
		          idr1 = pon;
		          idr2 = idr1 + 10;
		          count.textContent = pon;
                  var appDiv = document.createElement(\'div\'); 
                  nameP = document.createElement(\'p\');
				  elemP = document.createElement("input");
				  putDv = document.querySelector(\'[id="block '.JText::_("COM_ROUTES_ITEM_TABLE").'"]\');
				  putDiv = putDv.querySelector(\'[class="span9"]\');
				  putDiv.appendChild(appDiv);
				  appDiv.setAttribute(\'class\', \'control-group\');
				  appDiv.setAttribute(\'id\', "tel"+idr1);
				  var appDiv1 = document.createElement(\'div\');
				  putDiv1 = document.querySelector(\'[id="tel\'+idr1+\'"]\');
				  putDiv1.appendChild(appDiv1);
				  appDiv1.setAttribute(\'class\', \'controls\');
				  appDiv1.setAttribute(\'id\', "tel"+idr2);
                  putElemP = document.querySelector(\'[id="tel\'+idr2+\'"]\');
                  putElemP.appendChild(nameP);
                  nameP.setAttribute(\'id\', \'names\'+idr2);
                  var textP = document.getElementById(\'names\'+idr2);
                  var text = "'.JText::_("COM_ROUTES_NOTE_DISPATCHER").' "+idr1;
                  textP.innerHTML = text;
                  putElemP.appendChild(elemP);
                  elemP.setAttribute(\'type\', \'text\');
                  elemP.setAttribute(\'name\', \'jform[phone_dispatcher\'+pon+\']' .'\');
                  elemP.setAttribute(\'id\', \'jform_phone_dispatcher\'+pon+\'' .'\');
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

		$pol = '
						window.onload = function() {
							for (i = 1; i<=8; i++ ){
								//Вибираємо поля з проміжними точками і телефонами диспетчерів
								elem = document.getElementById(\'jform_phone_dispatcher\'+i);
								elemText = document.getElementById(\'jform_phone_dispatcher\'+i).value;
								elem1 = document.getElementById(\'jform_intermediate_point\'+i);
								elemText1 = document.getElementById(\'jform_intermediate_point\'+i).value;
								//Якщо вони пусті то приховуємо їх
								if (elemText1 == "") {
									elem1.style.display="none";
								}else {
									//Інакше показуємо їх і задаємо назви
									nameP = document.createElement(\'p\');
									putElemP = document.getElementById(\'jform_intermediate_point\'+i).parentNode ;
									var theFirstChild = putElemP.firstChild;
									putElemP.insertBefore(nameP, theFirstChild);
						            nameP.setAttribute(\'id\', \'nams\'+i);
						            var textP = document.getElementById(\'nams\'+i);
						            var text = "'.JText::_("COM_ROUTES_INT_POINT").' "+i;
						            textP.innerHTML = text;
						        }if (elemText == "") {
									elem.style.display="none";
								}else {
						            nameP1 = document.createElement(\'p\');
									putElemP1 = document.getElementById(\'jform_phone_dispatcher\'+i).parentNode ;
									var theFirstChild1 = putElemP1.firstChild;
									putElemP1.insertBefore(nameP1, theFirstChild1);
						            nameP1.setAttribute(\'id\', \'namd\'+i);
						            var textP1 = document.getElementById(\'namd\'+i);
						            var text1 = "'.JText::_("COM_ROUTES_NOTE_DISPATCHER").' "+i;
						            textP1.innerHTML = text1;
								}
							}
						}';

		JFactory::getDocument()->addScriptDeclaration( $pol );

		JFactory::getDocument()->addScriptDeclaration( $scrpt );

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
		return '<div class="input-appnd">
                    <input type="button" value="'.  JText::_('COM_ROUTES_DISPATCHER_ADD') .'" class="btn btn-success" onclick="addD()" /><br>
                </div>
                <div id="coun" style="display: none">'.$i.'</div>';
	}
}