<?php
/**
 * Created by PhpStorm.
 * User: rufel
 * Date: 02.05.2018
 * Time: 15:21
 */
defined('_JEXEC') or exit();

JHtml::_('formbehavior.chosen', 'select');//Для красивого отображения опубликовано/неопубликовано
JHtml::_('behavior.formvalidation');//JHtmlBehavior(Валидация формы при создании новости - заголовок статьи)
?>

<form action="index.php?option=com_news&layout=edit&id=<?php echo $this->item->id;?>"
      method="post" id="adminForm" name="adminForm" class="form-validate">

	<div class="form-horizontal">

		<?php foreach ($this->form->getFieldsets() as $name => $fieldset) :?>
			<fieldset class="adminForm">

				<legend><?php echo JText::_($fieldset->label);?></legend>
				<div class="row-fluid">

					<div class="span9">

						<?php foreach ($this->form->getFieldset($name) as $field) :?>
							<div class="control-group">

								<div class="control-label"><?php echo $field->label; ?></div>
								<div class="controls"><?php echo $field->input; ?></div>

							</div>
						<?php endforeach;?>

					</div>

				</div>

			</fieldset>
		<?php endforeach;?>

	</div>

	<input type="hidden" name="task" value="">
	<?php echo JHtml::_('form.token');?>

</form>