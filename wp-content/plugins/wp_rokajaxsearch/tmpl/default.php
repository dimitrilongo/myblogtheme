<?php
/**
 * @version   1.19 November 13, 2012
 * @author    RocketTheme, LLC http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

$theme = $option['theme'];
$api = ($option['google_api'] != '');

?>
<form name="rokajaxsearch" id="rokajaxsearch" class="<?php echo $theme; ?>" action="<?php bloginfo('url'); ?>/" method="get">
	<div class="rokajaxsearch">
		<div class="roksearch-wrapper">
			<input id="roksearch_search_str" name="s" type="text" class="inputbox" value="<?php _e('Search', 'rokajaxsearch'); ?>" />
		</div>
		<input type="hidden" name="limit" value="<?php echo $option['limit']; ?>" />
		<input type="hidden" name="ordering" value="<?php echo $option['order']; ?>" />
		<input type="hidden" name="task" value="search" />
	
		<?php if (($option['google_web'] || $option['google_blog'] || $option['google_images'] || $option['google_video']) && $api): ?>
			<div class="search_options">
				<label style="float: left; margin-right: 8px">
						<input type="radio" name="search_option[]" value="local" checked="checked" /><?php _e('Local', 'rokajaxsearch'); ?>
				</label>
				
				<?php if ($option['google_web']): ?>
				<label style="float: left;">
					<input type="radio" name="search_option[]" value="web" /><?php _e('Web', 'rokajaxsearch'); ?>
				</label>
				<?php endif; ?>
				
				<?php if ($option['google_web'] && $option['google_blog']): ?>
				<label style="float: left;">
					<input type="radio" name="search_option[]" value="blog" /><?php _e('Blogs', 'rokajaxsearch'); ?>
				</label>
				<?php endif; ?>
				
				<?php if ($option['google_web'] && $option['google_images']): ?>
				<label style="float: left;">
					<input type="radio" name="search_option[]" value="images" /><?php _e('Images', 'rokajaxsearch'); ?>
				</label>
				<?php endif; ?>
				
				<?php if ($option['google_web'] && $option['google_video']): ?>
				<label style="float: left;">
					<input type="radio" name="search_option[]" value="videos" /><?php _e('Videos', 'rokajaxsearch'); ?>
				</label>
				<?php endif; ?>
			</div>
			<div class="clr"></div>
		<?php endif; ?>
	
		<div id="roksearch_results"></div>
	</div>
	<div id="rokajaxsearch_tmp" style="visibility:hidden;display:none;"></div>
</form>