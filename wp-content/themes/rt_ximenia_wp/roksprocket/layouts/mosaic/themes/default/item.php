<?php
/**
 * @version   $Id: item.php 4200 2012-10-08 15:43:27Z arifin $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

/**
 * @var $item RokSprocket_Item
 */
?>
<li<?php echo strlen($item->custom_tags) ? ' class="'.$item->custom_tags.'"' : ''; ?> data-mosaic-item>
	<div class="sprocket-mosaic-item" data-mosaic-content>
		<?php echo $item->custom_ordering_items; ?>
		<div class="sprocket-padding">

			<div class="sprocket-mosaic-head">
				<?php if ($item->getTitle()): ?>
				<h2 class="sprocket-mosaic-title">
					<?php if ($item->getPrimaryLink()): ?><a href="<?php echo $item->getPrimaryLink()->getUrl(); ?>"><?php endif; ?>
						<?php echo $item->getTitle();?>
					<?php if ($item->getPrimaryLink()): ?></a><?php endif; ?>
				</h2>
				<?php endif; ?>
			</div>

			<?php if ($item->getPrimaryImage()) :?>
			<div class="sprocket-mosaic-image-container">
				<?php if ($item->getPrimaryLink()) : ?><a href="<?php echo $item->getPrimaryLink()->getUrl(); ?>"><?php endif; ?>
				<img src="<?php echo $item->getPrimaryImage()->getSource(); ?>" alt="" class="sprocket-mosaic-image" />
				<?php if ($item->getPrimaryLink()) : ?>
				</a>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if ($parameters->get('mosaic_article_details')): ?>
			<div class="sprocket-mosaic-infos">
				<span class="date"><?php echo $item->getDate();?></span> <span class="author">by <?php echo $item->getAuthor(); ?></span>
			</div>
			<?php endif; ?>
			<?php if ($parameters->get('mosaic_article_details')): ?>
			<div class="sprocket-mosaic-infos">
				<?php if ($parameters->get('mosaic_article_details') != 'author'): ?><span class="date"><?php echo $item->getDate();?></span><?php endif; ?>
				<?php if ($parameters->get('mosaic_article_details') != 'date'): ?><span class="author">by <?php echo $item->getAuthor(); ?></span><?php endif; ?>
			</div>
			<?php endif; ?>

			<div class="sprocket-mosaic-text">
				<?php echo $item->getText(); ?>
			</div>
			<?php if ($item->getPrimaryLink()) : ?>
			<div class="sprocket-readon-container">
			<a href="<?php echo $item->getPrimaryLink()->getUrl(); ?>" class="readmore"><span><?php rc_e('READ_MORE'); ?> +</span></a>
			</div>
			<div class="clear"></div>
			<?php endif; ?>
			<?php if ($item->custom_tags) : ?>
			<ul class="sprocket-mosaic-tags">
			<?php
				foreach($item->custom_tags_list as $key => $value){
			 		echo ' <li>'.$value.'</li>';
				}
			?>
			</ul>
		<?php endif; ?>
		</div>
	</div>
</li>
