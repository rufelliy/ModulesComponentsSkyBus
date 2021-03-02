<?php

defined('_JEXEC') or exit();

$i = 1;
?>

<div class="news_info">
    <div class="container">
        <div class="col-md-12">
            <div class="content-text">
                <div class="row">
                    <div class="our_news">
                        <div class="icon_news">
                        </div>
                        <p><?php echo JText::_('COM_NEWS_NEWS'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($this->items) && is_array($this->items)) :?>

	<?php foreach ($this->items as $item) :?>

        <div class="news new<?php echo $i; ?>" id="news<?php echo $item->id; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="news_block">
                            <div class="news_short_content">
                                <h3><?php echo $item->title; ?></h3>
								<?php
								# Переменная с датой с базы
								$mysqldate = $item->publish_up;

								# Перевод даты с базы  в формат времени Unix
								$time = strtotime($mysqldate);

								# Создаем асоциативный массив где каждому числу месяца присваиваем название месяца
								$month_name = array( 1 => JText::_('COM_NEWS_JANUARY'), 2 => JText::_('COM_NEWS_FEBRUARY'), 3 => JText::_('COM_NEWS_MARCH'), 4 => JText::_('COM_NEWS_APRIL'), 5 => JText::_('COM_NEWS_MAY'), 6 => JText::_('COM_NEWS_JUNE'), 7 => JText::_('COM_NEWS_JULY'), 8 => JText::_('COM_NEWS_AUGUST'), 9 => JText::_('COM_NEWS_SEPTEMBER'), 10 => JText::_('COM_NEWS_OCTOBER'), 11 => JText::_('COM_NEWS_NOVEMBER'), 12 => JText::_('COM_NEWS_DECEMBER'));

								#Получаем название месяца, сдесь исспользуется наш созданный массив
								$month = $month_name[ date( 'n',$time ) ];

								$day   = date( 'j',$time ); # с помощью функции date() получаем число дня
								$year  = date( 'Y',$time ); # получаем год
								$hour  = date( 'G',$time ); # получаем значения часов
								$min   = date( 'i',$time ); # получаем минуты

								$date = "$day $month $year, $hour:$min";  # собираем пазл из переменных

								?>
                                <p class="date"><?php echo $hour.':'.$min;?><br><?php echo $day.' '.$month.' '.$year;?></p>
                                <div class="full_text">
                                    <p><?php echo $item->text;?></p>
                                </div>
                            </div>
                            <div class="news_buttn">
                                <a href="" id="<?php echo $i; ?>" class="show-hide"><?php echo JText::_('COM_NEWS_MORE'); ?></a>
                                <a href=""><div class="print_icon" style="visibility: hidden">

                                    </div></a>
                                <a href=""><div class="send_icon" style="visibility: hidden">

                                    </div></a>
                            </div>
                        </div>
                    </div>
					<?php if (!empty($item->images)) :?>
                        <div class="col-md-5">
                            <div class="news_img" style="background-image: url(/<?php echo $item->images->image1;?>);">

                            </div>
                        </div>
					<?php endif;?>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="news_content">
                        <div class="news_content_text">
                            <p><?php echo $item->text;?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $i++; ?>
	<?php endforeach;?>
<?php endif;?>
