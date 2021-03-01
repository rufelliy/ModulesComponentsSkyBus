<?php

defined('_JEXEC') or exit();

//Получаем меню
$menu =& JSite::getMenu();
$menutype = $menu->getActive()->menutype;
$titlePage = $menu->getActive()->title;
$menu_items = $menu->getItems('menutype',$menutype);

$i = 1;

?>


<div class="buses_info">
    <div class="container">
        <div class="col-md-12">
            <div class="content-text">
                <div class="row">
                    <div class="our_bus">
                        <div class="icon_our_bus">
                        </div>
                        <p><?php echo JText::_('COM_BUSES_BUSES'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if (!empty($this->items) && is_array($this->items)) :?>

	<?php foreach ($this->items as $item) :?>

        <div class="container buscont">
            <div class="row">
                <div class="bus_container" id="bus<?php echo $item->id; ?>">
                    <div class="col-md-5">
                        <div id="img_buses_container">
                            <div id="img_buses" class="img_buses" style="background-image: url(/<?php echo $item->images->image1;?>)">
	                            <?php foreach ($menu_items as $item_menu) : ?>
		                            <?php if (trim($item_menu->title) == JText::_('COM_BUSES_GALLERY')) : ?>
                                        <a href="<?php echo JRoute::_("index.php?Itemid=". $item_menu->id); ?>" class="transition"><div class="search"></div></a>
		                            <?php endif; ?>
	                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="col-md-4">
                            <div class="title_bus">
                                <h3><?php echo $item->brand;?></h3>
                                <h5><?php echo $item->model;?></h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="bus_icons">
                                <div class="wifi" title="<?php echo JText::_('COM_BUSES_WIFI'); ?>">
									<?php if ($item->wifi) : ?>
										<?php echo '<div class="wifi_icon"></div>';?>
									<?php endif;?>
                                </div>
                                <div class="tv" title="<?php echo JText::_('COM_BUSES_TV'); ?>">
									<?php if ($item->tv) : ?>
										<?php echo '<div class="tv_icon"></div>';?>
									<?php endif;?>
                                </div>
                                <div class="music" title="<?php echo JText::_('COM_BUSES_MUSIC'); ?>">
									<?php if ($item->music) : ?>
										<?php echo '<div class="music_icon"></div>';?>
									<?php endif;?>
                                </div>
                                <div class="wc" title="<?php echo JText::_('COM_BUSES_WC'); ?>">
									<?php if ($item->wc) : ?>
										<?php echo '<div class="wc_icon"></div>';?>
									<?php endif;?>
                                </div>
                                <div class="climat" title="<?php echo JText::_('COM_BUSES_CLIMAT'); ?>">
									<?php if ($item->climat) : ?>
										<?php echo '<div class="climat_icon"></div>';?>
									<?php endif;?>
                                </div>
                                <div class="comfort" title="<?php echo JText::_('COM_BUSES_COMFORT'); ?>">
									<?php if ($item->comfort) : ?>
										<?php echo '<div class="comfort_icon"></div>';?>
									<?php endif;?>
                                </div>
                                <div class="usb" title="<?php echo JText::_('COM_BUSES_USB'); ?>">
									<?php if ($item->usb) : ?>
										<?php echo ' <div class="usb_icon"></div>';?>
									<?php endif;?>
                                </div>
                                <div class="food" title="<?php echo JText::_('COM_BUSES_FOOD'); ?>">
									<?php if ($item->food) : ?>
										<?php echo '<div class="food_icon"></div>';?>
									<?php endif;?>
                                </div>
                                <div class="feel">
                                    <div class="feel_icon">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="bus_descr">
                            <p><?php echo $item->description;?></p>
                        </div>
                    </div>
                    <div class="gallery_but">
	                <?php foreach ($menu_items as $item_menu) : ?>
		                <?php if (trim($item_menu->title) == JText::_('COM_BUSES_GALLERY')) : ?>
                            <a href="<?php echo JRoute::_("index.php?Itemid=". $item_menu->id); ?>#galery" class="button
                                 gallery transition"><?php echo JText::_('COM_BUSES_GALLERY'); ?></a>
		                <?php endif; ?>
	                <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php $i++; ?>

	<?php endforeach;?>
<?php endif;?>