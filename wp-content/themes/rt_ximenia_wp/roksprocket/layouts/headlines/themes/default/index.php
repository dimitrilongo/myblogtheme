<?php
/**
 * @version   $Id: index.php 1407 2012-06-30 20:31:43Z josh $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
/**
 * @var $layout     RokSprocket_Layout_Headlines
 * @var $items      RokSprocket_Item[]
 * @var $parameters RokCommon_Registry
 */

?>
<div class="sprocket-headlines navigation-active animation-<?php echo $parameters->get('headlines_animation'); ?>" data-headlines="<?php echo $parameters->get('module_id'); ?>">
	<div class="sprocket-headlines-innershadow">
		<div class="sprocket-headlines-container">
			<?php if ($parameters->get('headlines_label_text')) : ?>
			<div class="sprocket-headlines-badge">
				<span><?php echo $parameters->get('headlines_label_text'); ?></span>
			</div>
			<?php endif; ?>
			<ul class="sprocket-headlines-list">
				<?php
					$index = 0;
					foreach ($items as $item){
						echo $layout->getThemeContext()->load('item.php', array('item'=> $item, 'index'=>$index));
						$index++;
					}
				?>
			</ul>
			<?php if ($parameters->get('headlines_show_arrows')!='hide') : ?>
			<div class="sprocket-headlines-navigation">
				<span class="arrow next" data-headlines-next><span></span></span>
				<span class="arrow prev" data-headlines-previous><span></span></span>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
