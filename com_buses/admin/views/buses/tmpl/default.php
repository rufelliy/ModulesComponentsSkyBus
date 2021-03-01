<?php

defined('_JEXEC') or exit();

?>
<ul class="nav nav-tabs">
    <li id="al-AL" class="active">
        <a href="#"><?php echo JText::_('COM_BUSES_ALL');?></a>
    </li>
    <li id="uk-UA">
        <a href="#"><?php echo JText::_('COM_BUSES_UA');?></a>
    </li>
    <li id="ru-RU">
        <a href="#"><?php echo JText::_('COM_BUSES_RU');?></a>
    </li>
    <li id="en-GB">
        <a href="#"><?php echo JText::_('COM_BUSES_EN');?></a>
    </li>
</ul>
<form action="index.php?option=com_buses&view=buses" method="post" id="adminForm" name="adminForm">

    <table class="table table-striped table-hover">

        <thead>

        <tr>

            <th width="1%"><?php echo JText::_('COM_BUSES_NUM');?></th>
            <th width="1%"><?php echo JHtml::_('grid.checkall');?></th>
            <th width="1%"><?php echo JText::_('COM_BUSES_ITEM_BRAND');?></th>
            <th width="1%"><?php echo JText::_('COM_BUSES_ITEM_MODEL');?></th>
            <th width="2%"><?php echo JText::_('COM_BUSES_ITEM_STATE');?></th>
            <th width="1%"><?php echo JText::_('COM_BUSES_ITEM_LANGUAGE');?></th>
            <th width="1%"><?php echo JText::_('COM_BUSES_ITEM_ID');?></th>

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
                <?php $link = 'index.php?option=com_buses&task=item.edit&id='.$row->id; ?>
                <tr class="news_form <?php echo $row->language; ?>">
                    <td><?php echo $this->pagination->getRowOffset($i); ?></td>

                    <td><?php echo JHtml::_('grid.id', $i, $row->id);?></td>
                    <td><a href="<?php echo $link; ?>"><h4 style="text-transform: uppercase;"><?php echo $row->brand;?></h4></a></td>
                    <td><h4 style="text-transform: uppercase;"><?php echo $row->model;?></h4></td>

                    <td align="center"><?php echo JHTml::_('jgrid.published', $row->published, $i, 'buses.', true);?></td>

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