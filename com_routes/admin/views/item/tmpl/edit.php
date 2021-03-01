<?php
/**
 * Created by PhpStorm.
 * User: Rufelliy
 * Date: 30.03.2018
 * Time: 14:44
 */
defined('_JEXEC') or exit();

JHtml::_('formbehavior.chosen', 'select');//Для красивого отображения опубликовано/неопубликовано
JHtml::_('behavior.formvalidation');//JHtmlBehavior(Валидация формы при создании новости - заголовок статьи)
?>

<form action="index.php?option=com_routes&layout=edit&id=<?php echo $this->item->id;?>"
      method="post" id="adminForm" name="adminForm" class="form-validate">

	<div class="form-horizontal" style="position: relative;">
        <?php $i = 1; ?>
        <table style="position: absolute;top: 0px;">
            <tr>
		<?php foreach ($this->form->getFieldsets() as $name => $fieldset) :?>

			<fieldset class="adminForm">

<!--				<legend>--><?php //echo JText::_($fieldset->label);?><!--</legend>-->

                    <td>
                        <style>
                           td a:hover,
                           td a:focus {
                                text-decoration: none;
                                background-color: #518CEE!important;
                            }
                            a.activ {
                                background-color: #518CEE!important;
                            }
                        </style>
				<a class="route_menu<?php if ($i == 1) echo ' activ'; ?>" href="#" id="<?php echo JText::_
                ($fieldset->label);?>" onclick="add(this)"
                   style="float: left;color: #ffffff; margin-top: -21px;
				background-color: #66b7ee; padding: 10px 20px;"><?php echo JText::_
                    ($fieldset->label);?></a>
                    </td>

					<div class="row-fluid block" style="display: <?php echo ''.($i == 1 ? 'block' : 'none'); ?>; margin-top: 80px" id="block <?php echo JText::_($fieldset->label);?>">

						<div class="span9">

							<?php foreach ($this->form->getFieldset($name) as $field) :?>
<!--                            --><?php //print_r($field); ?>

								<div class="control-group">

									<div class="control-label"><?php echo $field->label; ?></div>


<!--                                    --><?php //if ($field->input == '') :?>
									<div class="controls"><?php echo $field->input; ?></div>
<!--                                    --><?php //endif;; ?>

								</div>
							<?php endforeach;?>

						</div>

					</div>
			</fieldset>
        <?php $i++; ?>
		<?php endforeach;?>
            </tr>
        </table>
        <div id="insert">

        </div>
	</div>

	<input type="hidden" name="task" value="">
	<?php echo JHtml::_('form.token');?>

</form>
<?php
	$pool = '
    function add(obj){

                                    elemHide = document.getElementsByClassName(\'row-fluid block\');
                                    Array.prototype.forEach.call(elemHide, function(el) {
                                        el.style.display="none";
                                    });
                                    elemDel = document.getElementsByClassName(\'route_menu\');
                                    Array.prototype.forEach.call(elemDel, function(el) {
                                        el.classList.remove("activ");
                                    });
                                    elem = document.getElementById(\'block \'+obj.id);
                                    elem.style.display="block";
                                    idElem = obj.id;
                                    parElem = document.getElementById(idElem);
                                    parElem.classList.add("activ");
                            }';

	JFactory::getDocument()->addScriptDeclaration($pool);
?>


