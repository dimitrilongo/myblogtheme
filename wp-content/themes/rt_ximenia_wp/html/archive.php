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

<?php global $post, $posts, $query_string, $wp_query; ?>

	<?php /** Begin Query Setup **/ ?>
	
	<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	if (is_category()) {
		$post_count = $gantry->get('category-count');
		$page_title = $gantry->get('category-page-title');
		$custom_page_title = $gantry->get('category-custom-page-title');
		$title = $gantry->get('category-title');
		$title_link = $gantry->get('category-link-title');
		$author = $gantry->get('category-meta-author');
		$date = $gantry->get('category-meta-date');
		$comments = $gantry->get('category-meta-comments');
		$comments_link = $gantry->get('category-meta-link-comments');
		$modified = $gantry->get('category-meta-modified');
		$content = $gantry->get('category-content');
		$category_meta = $gantry->get('category-meta-category');
		$category_meta_link = $gantry->get('category-meta-link-category');
		$category_meta_parent = $gantry->get('category-meta-category-parent');
		$category_meta_parent_link = $gantry->get('category-meta-link-category-parent');
		$readmore = $gantry->get('category-readmore');
	} else if (is_tag()) {
		$post_count = $gantry->get('tags-count');
		$page_title = $gantry->get('tags-page-title');
		$custom_page_title = $gantry->get('tags-custom-page-title');
		$title = $gantry->get('tags-title');
		$title_link = $gantry->get('tags-link-title');
		$author = $gantry->get('tags-meta-author');
		$date = $gantry->get('tags-meta-date');
		$comments = $gantry->get('tags-meta-comments');
		$comments_link = $gantry->get('tags-meta-link-comments');
		$modified = $gantry->get('tags-meta-modified');
		$content = $gantry->get('tags-content');
		$category_meta = $gantry->get('tags-meta-category');
		$category_meta_link = $gantry->get('tags-meta-link-category');
		$category_meta_parent = $gantry->get('tags-meta-category-parent');
		$category_meta_parent_link = $gantry->get('tags-meta-link-category-parent');
		$readmore = $gantry->get('tags-readmore');
	} else {
		$post_count = $gantry->get('archive-count');
		$page_title = $gantry->get('archive-page-title');
		$custom_page_title = $gantry->get('archive-custom-page-title');
		$title = $gantry->get('archive-title');
		$title_link = $gantry->get('archive-link-title');
		$author = $gantry->get('archive-meta-author');
		$date = $gantry->get('archive-meta-date');
		$comments = $gantry->get('archive-meta-comments');
		$comments_link = $gantry->get('archive-meta-link-comments');
		$modified = $gantry->get('archive-meta-modified');
		$content = $gantry->get('archive-content');
		$category_meta = $gantry->get('archive-meta-category');
		$category_meta_link = $gantry->get('archive-meta-link-category');
		$category_meta_parent = $gantry->get('archive-meta-category-parent');
		$category_meta_parent_link = $gantry->get('archive-meta-link-category-parent');
		$readmore = $gantry->get('archive-readmore');
	}
	
	$query = $wp_query->query;

	if (!is_array($query)) parse_str($query, $query); 
	
	$custom_query = new WP_Query(array_merge($query, array('posts_per_page' => $post_count, 'paged' => $paged))); ?>

	<?php /** End Query Setup **/ ?>

	<?php if($custom_query->have_posts()) : ?>
	
	<?php /** Begin Page Title **/ ?>
	
	<?php if($page_title) : ?>
	
		<?php if($custom_page_title != '') : ?>
		
			<h1><?php echo strip_tags($custom_page_title); ?></h1>
		
		<?php else : ?>
																											
			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			<?php /* If this is a category archive */ if (is_category()) { ?>
				<h1><?php _re('Category:'); ?> <?php single_cat_title(); ?></h1>
			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h1><?php _re('Posts Tagged'); ?> &#8216;<?php single_tag_title(); ?>&#8217;</h1>
			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h1><?php _re('Archive for'); ?> <?php the_time('F jS, Y'); ?></h1>
					<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h1><?php _re('Archive for'); ?> <?php the_time('F, Y'); ?></h1>
			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h1><?php _re('Archive for'); ?> <?php the_time('Y'); ?></h1>
			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h1><?php _re('Author Archive'); ?></h1>
			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1><?php _re('Blog Archives'); ?></h1>
			<?php } ?>

		<?php endif; ?>

	<?php endif; ?>
	
	<?php /** End Page Title **/ ?>

	<?php /** Begin Posts **/ ?>
													
	<?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

	<?php

	// Create a shortcut for params.
	$category = get_the_category();

	?>

	<?php /** Begin Post **/ ?>
			
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<?php /** Begin Article Title **/ ?>

		<?php if ($title) : ?>

			<h2>
				<?php if ($title_link) : ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				<?php else : ?>
					<?php the_title(); ?>
				<?php endif; ?>
			</h2>

		<?php endif; ?>

		<?php /** End Article Title **/ ?>

		<?php /** Begin Extended Meta **/ ?>

		<?php if ($date || $modified || $author || $comments) : ?>
		
			<dl class="article-info">

				<?php /** Begin Parent Category **/ ?>
				
				<?php if ($category_meta_parent && $category[0]->parent != '0') : ?>

					<dd class="parent-category-name">
						<?php
							$parent_category = get_category((int)$category[0]->parent);
							$title = $parent_category->cat_name;
							$link = get_category_link($parent_category);
							$url = '<a href="' . esc_url($link) . '">' . $title . '</a>'; 
						?>
	
						<?php if ($category_meta_parent_link) : ?>
							<?php echo $url; ?>
						<?php else : ?>
							<?php echo $title; ?>
						<?php endif; ?>
					</dd>

				<?php endif; ?>

				<?php /** End Parent Category **/ ?>

				<?php /** Begin Category **/ ?>

				<?php if ($category_meta) : ?>

					<dd class="category-name">
						<?php 
							$title = $category[0]->cat_name;
							$link = get_category_link($category[0]->cat_ID);
							$url = '<a href="' . esc_url($link) . '">' . $title . '</a>';
						?>
	
						<?php if ($category_meta_link) : ?>
							<?php echo $url; ?>
						<?php else : ?>
							<?php echo $title; ?>
						<?php endif; ?>
					</dd>

				<?php endif; ?>

				<?php /** End Category **/ ?>

				<?php /** Begin Date & Time **/ ?>

				<?php if($date) : ?>

					<dd class="create"><?php _re('Published on'); ?> <?php the_time('l, d F Y H:i'); ?></dd>

				<?php endif; ?>

				<?php /** End Date & Time **/ ?>

				<?php /** Begin Modified Date **/ ?>

				<?php if($modified) : ?>

					<dd class="modified"><?php _re('Last Updated on'); ?> <?php the_modified_date('d F Y'); ?></dd>

				<?php endif; ?>

				<?php /** End Modified Date **/ ?>

				<?php /** Begin Author **/ ?>
			
				<?php if ($author) : ?>

					<dd class="createdby"><?php _re('Written by'); ?> <?php the_author(); ?></dd>

				<?php endif; ?>

				<?php /** End Author **/ ?>

				<?php /** Begin Comments Count **/ ?>

				<?php if($comments) : ?>

					<?php if($comments_link) : ?>

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
	
		<?php if($content == 'content') : ?>
		
			<?php the_content(false); ?>
							
		<?php else : ?>
							
			<?php the_excerpt(); ?>
								
		<?php endif; ?>
		
		<?php if(preg_match('/<!--more(.*?)?-->/', $post->post_content)) : ?>
		
			<p class="readmore">																			
				<a href="<?php the_permalink(); ?>"><span><?php echo $readmore; ?></span></a>
			</p>
		
		<?php endif; ?>
		
		<?php /** End Post Content **/ ?>

	</div>
	
	<?php /** End Post **/ ?>

	<div class="item-separator"></div>
	
	<?php endwhile; ?>
	
	<?php /** End Posts **/ ?>

	<?php /** Begin Navigation **/ ?>
	
	<?php if($gantry->get('pagination-style') == 'full' && $custom_query->max_num_pages > 1) { ?>

		<?php if (!$current_page = get_query_var('paged')) $current_page = 1;
		
		$permalinks = get_option('permalink_structure');
		$format = empty($permalinks) ? '&paged=%#%' : 'page/%#%/';
		
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
			<?php _re("Sorry, but there aren't any posts matching your query."); ?>
		</h1>
													
	<?php endif; ?>
													
	<?php wp_reset_query(); ?>