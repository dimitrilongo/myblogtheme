<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
// no direct access
defined('ABSPATH') or die('Restricted access');
?>

<?php global $post, $posts, $query_string; ?>

	<div class="blog-featured">
	
		<?php /** Begin Page Title **/ ?>

		<?php if ($gantry->get('blog-page-title') != '') : ?>
		
		<h1>
			<?php echo $gantry->get('blog-page-title'); ?>
		</h1>
		
		<?php endif; ?>
		
		<?php /** End Page Title **/ ?>
		
		<?php /** Begin Query Setup **/ ?>

		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			
		if ($gantry->get('blog-query') != '') : 
		
			$custom_query = new WP_Query('posts_per_page='.$gantry->get('blog-count').'&paged='.$paged.'&'.$gantry->get('blog-query'));
		
		else :
		
			$custom_query = new WP_Query('posts_per_page='.$gantry->get('blog-count').'&paged='.$paged.'&orderby='.$gantry->get('blog-order').'&cat='.$gantry->get('blog-cat').'&post_type='.$gantry->get('blog-type'));
		
		endif;
		
		?>

		<?php /** End Query Setup **/ ?>

		<?php /** Begin Leading Posts **/ ?>

		<?php if($custom_query->have_posts() && $gantry->get('blog-lead-items') > 0) : ?>

			<?php $leadingcount = 0; 
			if($gantry->get('blog-lead-items') > $gantry->get('blog-count')) $gantry->set('blog-lead-items', $gantry->get('blog-count')); ?>

			<div class="items-leading">

				<?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

				<div class="leading-<?php echo $leadingcount; ?>">
			
					<?php $this->locate_type(array('post-blog.php'), true, false); ?>

				</div>

				<?php $leadingcount++; ?>

				<?php if($leadingcount == $gantry->get('blog-lead-items') || $leadingcount == $gantry->get('blog-count')) break; ?>

				<?php endwhile; ?>

			</div>

		<?php endif; ?>

		<?php /** End Leading Posts **/ ?>

		<?php /** Begin Posts **/ ?>

		<?php if($custom_query->have_posts()) : ?>

			<?php $introcount = ($custom_query->post_count - $leadingcount); 
			$counter = 0; 
			if($gantry->get('blog-columns') <= 0) $gantry->set('blog-columns', 1);
			if($gantry->get('blog-columns') > 4) $gantry->set('blog-columns', 4); ?>

			<?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

			<?php $key = ($custom_query->current_post - $leadingcount) + 1;
			$rowcount = ( ((int)$key - 1) % (int) $gantry->get('blog-columns')) + 1;
			$row = $counter / $gantry->get('blog-columns');

			if ($rowcount == 1) : ?>
			<div class="items-row cols-<?php echo (int) $gantry->get('blog-columns'); ?> <?php echo 'row-' . $row; ?>">
			<?php endif; ?>

			<div class="item column-<?php echo $rowcount;?>">

				<?php $this->locate_type(array('post-blog.php'), true, false); ?>
			
			</div>

			<?php $counter++; ?>
			<?php if (($rowcount == $gantry->get('blog-columns')) || ($counter == $introcount)) : ?>
				<span class="row-separator"></span>
			</div>
			<?php endif; ?>

			<?php endwhile; ?>

		<?php endif; ?>

		<?php /** End Posts **/ ?>
		
		<?php /** Begin Navigation **/ ?>
		
		<?php if($gantry->get('pagination-style') == 'full' && $custom_query->max_num_pages > 1) { ?>
	
			<?php if (!$current_page = get_query_var('paged')) $current_page = 1;
			
			$permalinks = get_option('permalink_structure');
			if(is_front_page()) {
				$format = empty($permalinks) ? '?paged=%#%' : 'page/%#%/';
			} else {
				$format = empty($permalinks) ? '&paged=%#%' : 'page/%#%/';
			}
			
			$pagination = paginate_links(array(
				'base' => get_pagenum_link(1) . '%_%',
				'format' => $format,
				'current' => $current_page,
				'total' => $custom_query->max_num_pages,
				'mid_size' => $gantry->get('pagination-count'),
				'type' => 'list',
				'next_text' => _r('Next'),
				'prev_text' => _r('Previous')
			));

			$pagination = explode("\n", $pagination);
			$pagination_mod = array();

			foreach ($pagination as $item) {
				(preg_match('/<ul class=\'page-numbers\'>/i', $item)) ? $item = str_replace('<ul class=\'page-numbers\'>', '<ul>', $item) : $item;
				(preg_match('/class="prev/i', $item)) ? $item = str_replace('<li', '<li class="pagination-prev"', $item) : $item;
				(preg_match('/class="next/i', $item)) ? $item = str_replace('<li', '<li class="pagination-next"', $item) : $item;
				(preg_match('/class=\'page-numbers/i', $item)) ? $item = str_replace('class=\'page-numbers', 'class=\'page-numbers pagenav', $item) : $item;
				$pagination_mod[] .= $item;
			}
			
			?>
			
			<div class="pagination nav">
				<div class="full-nav">
			
					<?php 
					foreach($pagination_mod as $page) {
						echo $page;
					}
					?>
				
				</div>
			</div>
									
		<?php } else { ?>							
									
			<?php if($custom_query->max_num_pages > 1) : ?>
					
			<div class="pagination nav">
				<div class="alignleft">
					<?php next_posts_link(_r('Previous'), $custom_query->max_num_pages); ?>
				</div>
				<div class="alignright">
					<?php previous_posts_link(_r('Next'), $custom_query->max_num_pages); ?>
				</div>
				<div class="clear"></div>
			</div>
						
			<?php endif; ?>

		<?php } ?>

		<?php /** End Navigation **/ ?>
		
	</div>