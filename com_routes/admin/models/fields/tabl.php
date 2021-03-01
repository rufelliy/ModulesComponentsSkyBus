<?php

/**
 * Class JFormFieldTest класс поля
 */
class JFormFieldTabl extends JFormField
{
	/**
	 * @var string Тип поля (Должен называться как файл с полем)
	 */
	protected $type = 'Tabl';

	/**
	 * Создание поля
	 * @return string
	 */
	protected function getInput()
	{

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$th = $this->value;

		//Возвращаем сформированное пол

		$div = '<div class="input-apend" style="margin-bottom: 15px; margin-left: 20px; margin-top: -20px; float: left;">
					<ul border="0" style="display:block; list-style-type: none; width: 800px;">

							<li style="float: left;width: 150px"><input type="tabl" name="' . $this->name . '[str]" 
							id="' . $this->id . '" 
							value="'
			. htmlspecialchars($th[str], ENT_COMPAT, 'UTF-8') . '" placeholder="'.JText::_("COM_ROUTES_START_POINT").'" style="width: 150px" /></l>
							<li style="float: left;width: 150px"><input type="tabl" name="' . $this->name . '[intr]" id="' .
			$this->id . '" 
							value="'
			. htmlspecialchars($th[intr], ENT_COMPAT, 'UTF-8') . '"placeholder="'.JText::_("COM_ROUTES_INT_POINT").'" style="width: 150px" /></l>
							<li style="float: left;width: 150px"><input type="tabl" name="' . $this->name . '[intrm]" id="' .
			$this->id . '" 
							value="'
			. htmlspecialchars($th[intrm], ENT_COMPAT, 'UTF-8') . '" placeholder="'.JText::_("COM_ROUTES_INT_POINT").'" style="width: 150px" /></l>
							<li style="float: left;width: 150px"><input type="tabl" name="' . $this->name . '[intrmd]" id="' . $this->id . '" 
							value="'
			. htmlspecialchars($th[intrmd], ENT_COMPAT, 'UTF-8') . '" placeholder="'.JText::_("COM_ROUTES_INT_POINT").'" style="width: 150px" /></l>
							<li style="float: left;width: 150px"><input type="tabl" name="' . $this->name . '[fin]" id="' . $this->id . '" 
							value="'
			. htmlspecialchars($th[fin], ENT_COMPAT, 'UTF-8') . '" placeholder="'.JText::_("COM_ROUTES_FINISH_POINT").'" style="width: 150px" /></l>
					
					</ul>';
		for ($i = 1; $i <= 20; $i++)
		{
			$div .= '<ul border="1" style="display:block; list-style-type: none; width: 800px;">

							<li style="float: left;width: 150px"><input type="tabl" name="' . $this->name . '[str'.$i
				.']" 
							id="' . $this->id . '" 
							value="'
				. htmlspecialchars($th["str".$i], ENT_COMPAT, 'UTF-8') . '" placeholder="'.JText::_("COM_ROUTES_TIME_VIEW").'" style="width: 150px" /></l>
							<li style="float: left;width: 150px"><input type="tabl" name="' . $this->name . '[intr'
				.$i.']" id="' .
				$this->id . '" 
							value="'
				. htmlspecialchars($th["intr".$i], ENT_COMPAT, 'UTF-8') . '"placeholder="'.JText::_("COM_ROUTES_TIME_VIEW").'" style="width: 150px" /></l>
							<li style="float: left;width: 150px"><input type="tabl" name="' . $this->name . '[intrm'
				.$i.']" id="' .
				$this->id . '" 
							value="'
				. htmlspecialchars($th["intrm".$i], ENT_COMPAT, 'UTF-8') . '" placeholder="'.JText::_("COM_ROUTES_TIME_VIEW").'" style="width: 150px" /></l>
							<li style="float: left;width: 150px"><input type="tabl" name="' . $this->name . '[intrmd'
				.$i.']" id="' . $this->id . '" 
							value="'
				. htmlspecialchars($th["intrmd".$i], ENT_COMPAT, 'UTF-8') . '" placeholder="'.JText::_("COM_ROUTES_TIME_VIEW").'" style="width: 150px" /></l>
							<li style="float: left;width: 150px"><input type="tabl" name="' . $this->name . '[fin'
				.$i.']" id="' . $this->id . '" 
							value="'
				. htmlspecialchars($th["fin".$i], ENT_COMPAT, 'UTF-8') . '" placeholder="'.JText::_("COM_ROUTES_TIME_VIEW").'" style="width: 150px" /></l>
					
					</ul>
					<style>
						*::-webkit-input-placeholder {
						    color: #94caf1;
						    opacity: 0.5;
						    font-weight: lighter;
						}
						*:-moz-placeholder {
						    color: #94caf1;
						    opacity: 0.5;
						    font-weight: lighter;
						}
						*:-moz-placeholder {
						    color: #94caf1;
						    opacity: 0.5;
						    font-weight: lighter;
						}
						*:-ms-input-placeholder {
						    color: #94caf1;
						    opacity: 0.5;
						    font-weight: lighter;
						}
						#jform_timetable {
							color: #1b2129;
							font-weight: bold;
						}
					</style>
					';
		}
		$div .= '</div><br><br>';

		return $div;
	}
}