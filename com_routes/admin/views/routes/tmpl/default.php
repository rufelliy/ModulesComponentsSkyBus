<?php
/**
 * Created by PhpStorm.
 * User: rufel
 * Date: 02.05.2018
 * Time: 15:24
 */
defined('_JEXEC') or exit();

?>
<ul class="nav nav-tabs">
    <li id="al-AL" class="active">
        <a href="#"><?php echo JText::_('COM_ROUTES_ALL');?></a>
    </li>
    <li id="uk-UA">
        <a href="#"><?php echo JText::_('COM_ROUTES_UA');?></a>
    </li>
    <li id="ru-RU">
        <a href="#"><?php echo JText::_('COM_ROUTES_RU');?></a>
    </li>
    <li id="en-GB">
        <a href="#"><?php echo JText::_('COM_ROUTES_EN');?></a>
    </li>
</ul>
<form action="index.php?option=com_routes&view=routes" method="post" id="adminForm" name="adminForm">

    <table class="table table-striped table-hover">

        <thead>

        <tr>

            <th width="1%"><?php echo JText::_('COM_ROUTES_NUM');?></th>
            <th width="1%"><?php echo JHtml::_('grid.checkall');?></th>
            <th width="4%"><?php echo JText::_('COM_ROUTES_ITEM_TITLE');?></th>
            <th width="1%"><?php echo JText::_('COM_ROUTES_ITEM_STATE');?></th>
            <th width="1%"><?php echo JText::_('COM_ROUTES_ITEM_LANGUAGE');?></th>
            <th width="1%"><?php echo JText::_('COM_ROUTES_ITEM_ID');?></th>

        </tr>

        </thead>

        <tfoot>

        <tr>

            <td colspan="5">

                <div class="pagination">
					<?php echo $this->pagination->getListFooter() ?>
                </div>
            </td>

        </tr>

        </tfoot>

        <tbody>

		<?php if(!empty($this->items)) :?>
			<?php foreach ($this->items as $i => $row) :?>
				<?php $link = 'index.php?option=com_routes&task=item.edit&id='.$row->id; ?>
                <tr class="news_form <?php echo $row->language; ?>">
                    <td><?php echo $this->pagination->getRowOffset($i); ?></td>

                    <td><?php echo JHtml::_('grid.id', $i, $row->id);?></td>
                    <td><a href="<?php echo $link; ?>"><h4 style="text-transform: uppercase;"><?php echo $row->title;?></h4></a></td>

                    <td align="center"><?php echo JHTml::_('jgrid.published', $row->published, $i, 'routes.', true);
                    ?></td>

                    <td align="center"><?php echo $row->language;?></td>

                    <td align="center"><?php echo $row->id;?></td>
                </tr>
			<?php endforeach;?>
		<?php endif;;?>

        </tbody>

        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />

		<?php echo JHtml::_('form.token'); ?>

    </table>

</form>
<script>
    var inputs = document.getElementsByTagName('li');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener("click", choose);
    }
    function choose() {
        var elems = document.getElementsByClassName('active')[0];
        elems.classList.remove('active');
        document.getElementById(this.id).className = 'active';
        var divs = document.getElementsByClassName('news_form');
        for (var i = 0; i < divs.length; i++) {
            if (this.id == "al-AL") {
                divs[i].style.display = "table-row";
            }else if (divs[i].className.substr(-5) == this.id) {
                divs[i].style.display = "table-row";
            }else {
                divs[i].style.display = "none";
            }
        }
    }
</script>