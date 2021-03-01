<?php

/**
 * Class JFormFieldTest класс поля
 */
class JFormFieldRang extends JFormField
{
	/**
	 * @var string Тип поля (Должен называться как файл с полем)
	 */
	protected $type = 'Rang';

	/**
	 * Создание поля
	 * @return string
	 */
	protected function getInput()
	{


		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$id = JRequest::getInt('id');

		//'SELECT `id`, `title`, `alias`, `published`'
		$query->select('`speed`');

		//FROM #__routes
		$query->from('#__routes');
		$query->where('id='.(int)$id);

		$db->setQuery($query);
		$speed = $db->loadResult();
		
		if ($speed == '') {
			$speed = 30;
		}


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
					<input type="text" id="minv" style="width: 10px; margin-left: -15px; border: none; 
					background-color: transparent; box-shadow: none"> 
                 	<input type="range" name="jform[speed]" id="jform_speed" min="0" max="100" step="5" 
                 	id="r1" oninput="fun1()" value="'.$speed.'">
					<input type="text" id="maxv" style="width: 20px; margin-left: 0px; border: none; 
					background-color: transparent; box-shadow: none">
					<input type="text" id="intv" style="width: auto; max-width: 20px; min-width: 10px; text-align: 
					center;margin-left: 0px; border-radius: 20px; border: none; background-color: #d1d1d2; 
					box-shadow: none;" value="'.$speed.'"> 
					<script>
						var rng=document.getElementById("jform_speed"); //rng - це повзунок
						var maxval = rng.getAttribute("max");
						var minval = rng.getAttribute("min");
						var minv=document.getElementById("minv"); // i1 - input
						minv.value=minval;
						var maxv=document.getElementById("maxv"); // i1 - input
						maxv.value=maxval;
						var rng=document.getElementById("jform_speed"); //rng - це повзунок
						intv.value=rng.value;
						function fun1() {
						    var rng=document.getElementById("jform_speed"); //rng - це повзунок
						    intv.value=rng.value;
						}
					</script>
                </div>';
	}
}