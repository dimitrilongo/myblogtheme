<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
// no direct access
defined('ABSPATH') or die('Restricted access');

global $post, $posts, $query_string, $s, $wp_query;

?>

	<?php /** Begin Query Setup **/ ?>
	
	<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$query = $wp_query->query;
	if (!is_array($query)) parse_str($query, $query); 
	
	$custom_query = new WP_Query(array_merge($query, array('posts_per_page' => $gantry->get('search-count'), 'paged' => $paged))); ?>

	<?php /** End Query Setup **/ ?>

	<?php if($custom_query->have_posts()) : ?>
	
	<?php if($gantry->get('search-page-title')) : ?>
					
	<h1>
		<?php _re('Search Results for'); ?>&nbsp;&#8216;<?php the_search_query(); ?>&#8217;
	</h1>
	
	<?php endif; ?>
													
	<?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
	
	<?php

	// Create a shortcut for params.
	$category = get_the_category();

	?>

	<?php /** Begin Post **/ ?>

	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<?php /** Begin Article Title **/ ?>

		<?php if ($gantry->get('search-title')) : ?>

			<h2>
				<?php if ($gantry->get('search-link-title')) : ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				<?php else : ?>
					<?php the_title(); ?>
				<?php endif; ?>
			</h2>

		<?php endif; ?>

		<?php /** End Article Title **/ ?>

		<?php /** Begin Extended Meta **/ ?>

		<?php if ($gantry->get('search-meta-date') || $gantry->get('search-meta-modified') || $gantry->get('search-meta-author') || $gantry->get('search-meta-comments')) : ?>
		
			<dl class="article-info">

				<?php /** Begin Parent Category **/ ?>
				
				<?php if ($gantry->get('search-type') == 'post' && ($gantry->get('search-meta-category-parent') && $category[0]->parent != '0')) : ?>

					<dd class="parent-category-name">
						<?php
							$parent_category = get_category((int)$category[0]->parent);
							$title = $parent_category->cat_name;
							$link = get_category_link($parent_category);
							$url = '<a href="' . esc_url($link) . '">' . $title . '</a>'; 
						?>
	
						<?php if ($gantry->get('search-meta-link-category-parent')) : ?>
							<?php echo $url; ?>
						<?php else : ?>
							<?php echo $title; ?>
						<?php endif; ?>
					</dd>

				<?php endif; ?>

				<?php /** End Parent Category **/ ?>

				<?php /** Begin Category **/ ?>

				<?php if ($gantry->get('search-type') == 'post' && $gantry->get('search-meta-category')) : ?>

					<dd class="category-name">
						<?php 
							$title = $category[0]->cat_name;
							$link = get_category_link($category[0]->cat_ID);
							$url = '<a href="' . esc_url($link) . '">' . $title . '</a>';
						?>
	
						<?php if ($gantry->get('search-meta-link-category')) : ?>
							<?php echo $url; ?>
						<?php else : ?>
							<?php echo $title; ?>
						<?php endif; ?>
					</dd>

				<?php endif; ?>

				<?php /** End Category **/ ?>

				<?php /** Begin Date & Time **/ ?>

				<?php if($gantry->get('search-meta-date')) : ?>

					<dd class="create"><?php _re('Published on'); ?> <?php the_time('l, d F Y H:i'); ?></dd>

				<?php endif; ?>

				<?php /** End Date & Time **/ ?>

				<?php /** Begin Modified Date **/ ?>

				<?php if($gantry->get('search-meta-modified')) : ?>

					<dd class="modified"><?php _re('Last Updated on'); ?> <?php the_modified_date('d F Y'); ?></dd>

				<?php endif; ?>

				<?php /** End Modified Date **/ ?>

				<?php /** Begin Author **/ ?>
			
				<?php if ($gantry->get('search-meta-author')) : ?>

					<dd class="createdby"><?php _re('Written by'); ?> <?php the_author(); ?></dd>

				<?php endif; ?>

				<?php /** End Author **/ ?>

				<?php /** Begin Comments Count **/ ?>

				<?php if($gantry->get('search-meta-comments')) : ?>

					<?php if($gantry->get('search-meta-link-comments')) : ?>

						<dd class="comments-count">
							<a href="<?php the_permalink(); ?>#comments">
								<?php comments_number(_r('0 Comments'), _r('1 Comment'), _r('% Comments')); ?>
							</a>
						</dd>

					<?php else : ?>

						<dd class="comments-count"><?php comments_number(_r('0 Comments'), _r('1 Comment'), _r('% Comments')); ?></dd>

					<?php endif; ?>

				<?php endif; ?>

				<?php /** End Comments Count **/ ?>

			</dl>
		
		<?php endif; ?>

		<?php /** End Extended Meta **/ ?>

		<?php /** Begin Thumbnail **/ ?>

		<?php if(function_exists('the_post_thumbnail') && has_post_thumbnail()) : ?>

			<div class="img-intro-<?php echo $gantry->get('thumb-position'); ?>">
				<?php the_post_thumbnail('gantryThumb', array('class' => 'rt-image ')); ?>			
			</div>
		
		<?php endif; ?>

		<?php /** End Thumbnail **/ ?>
		
		<?php /** Begin Post Content **/ ?>	
	
		<?php if($gantry->get('search-content') == 'content') : ?>
		
			<?php the_content(false); ?>
							
		<?php else : ?>
							
			<?php the_excerpt(); ?>
								
		<?php endif; ?>
		
		<?php if(preg_match('/<!--more(.*?)?-->/', $post->post_content)) : ?>
		
			<p class="readmore">																			
				<a href="<?php the_permalink(); ?>"><span><?php echo $gantry->get('search-readmore'); ?></span></a>
			</p>
		
		<?php endif; ?>
		
		<?php /** End Post Content **/ ?>

	</div>
	
	<?php /** End Post **/ ?>

	<div class="item-separator"></div>
	
	<?php endwhile;?>
	
	<?php /** Begin Navigation **/ ?>
	
	<?php if($gantry->get('pagination-style') == 'full' && $custom_query->max_num_pages > 1) { ?>

		<?php if (!$current_page = get_query_var('paged')) $current_page = 1;
		
		$permalinks = get_option('permalink_structure');
		$format = empty($permalinks) || is_search() ? '&paged=%#%' : 'page/%#%/';
		
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
	
	<?php else : ?>
																											
		<h1>
			<?php _re("No posts found. Try a different search?"); ?>
		</h1>
													
	<?php endif; ?>
													
	<?php wp_reset_query(); ?>