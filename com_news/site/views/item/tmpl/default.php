<?php

defined('_JEXEC') or exit();
?>
<?php if(!empty($this->item)) :?>

	<div>
		<h2><?php echo $this->item->title;?></h2>
		<span><?php echo $this->item->publish_up;?></span>

		<?php if(!empty($this->item->images->image1)) :?>
			<div>
				<img style="width=100%" src="<?php echo $this->item->images->image1; ?>">
			</div>
		<?php endif;?>
		<p>
			<?php echo $this->item->text;?>
		</p>
	</div>
<?php endif;?>