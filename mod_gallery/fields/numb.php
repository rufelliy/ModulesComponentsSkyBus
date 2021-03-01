<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldNumb extends JFormField
{

	protected $type = 'Numb';

	protected function getOptions()
	{
		$options = array();


		reset($options);
		return $options;
	}

	protected function getInput() {
		$options = $this->getOptions();

		$pool = '
				window.onload = setInterval(function() {
					var forms = document.getElementsByClassName(\'subform-repeatable-group\');
					var slide = document.getElementsByClassName(\'input-appen\');
					for (i = 1; i<= 30; i++) {
					    if (forms[i-1]) {
					        slide[i-1].innerHTML = "'. JText::_("MOD_GALLERY_NEW_GALLERY") .' " + i;
					    }
					}
				},100)';


		JFactory::getDocument()->addScriptDeclaration( $pool );



		//Возвращаем сформированное поле
		return '<br /><h3 style="margin-top: -50px"><div class="input-appen"></div></h3>';
	 
	 }
}