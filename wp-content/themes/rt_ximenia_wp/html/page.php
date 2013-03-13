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

	<div class="item-page">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<?php /** Begin Post **/ ?>
				
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

			<?php /** Begin Article Title **/ ?>

			<?php if ($gantry->get('page-title')) : ?>

				<h2>
					<?php the_title(); ?>
				</h2>

			<?php endif; ?>

			<?php /** End Article Title **/ ?>

			<?php /** Begin Extended Meta **/ ?>

			<?php if ($gantry->get('page-meta-date') || $gantry->get('page-meta-modified') || $gantry->get('page-meta-author') || $gantry->get('page-meta-comments')) : ?>
			
				<dl class="article-info">

					<?php /** Begin Parent Category **/ ?>
					
					<?php if ($gantry->get('page-meta-category-parent') && $category[0]->parent != '0') : ?>

						<dd class="parent-category-name">
							<?php
								$parent_category = get_category((int)$category[0]->parent);
								$title = $parent_category->cat_name;
								$link = get_category_link($parent_category);
								$url = '<a href="' . esc_url($link) . '">' . $title . '</a>'; 
							?>
		
							<?php if ($gantry->get('page-meta-link-category-parent')) : ?>
								<?php echo $url; ?>
							<?php else : ?>
								<?php echo $title; ?>
							<?php endif; ?>
						</dd>

					<?php endif; ?>

					<?php /** End Parent Category **/ ?>

					<?php /** Begin Category **/ ?>

					<?php if ($gantry->get('page-meta-category')) : ?>

						<dd class="category-name">
							<?php 
								$title = $category[0]->cat_name;
								$link = get_category_link($category[0]->cat_ID);
								$url = '<a href="' . esc_url($link) . '">' . $title . '</a>';
							?>
		
							<?php if ($gantry->get('page-meta-link-category')) : ?>
								<?php echo $url; ?>
							<?php else : ?>
								<?php echo $title; ?>
							<?php endif; ?>
						</dd>

					<?php endif; ?>

					<?php /** End Category **/ ?>

					<?php /** Begin Date & Time **/ ?>

					<?php if($gantry->get('page-meta-date')) : ?>

						<dd class="create"><?php _re('Published on'); ?> <?php the_time('l, d F Y H:i'); ?></dd>

					<?php endif; ?>

					<?php /** End Date & Time **/ ?>

					<?php /** Begin Modified Date **/ ?>

					<?php if($gantry->get('page-meta-modified')) : ?>

						<dd class="modified"><?php _re('Last Updated on'); ?> <?php the_modified_date('d F Y'); ?></dd>

					<?php endif; ?>

					<?php /** End Modified Date **/ ?>

					<?php /** Begin Author **/ ?>
				
					<?php if ($gantry->get('page-meta-author')) : ?>

						<dd class="createdby"><?php _re('Written by'); ?> <?php the_author(); ?></dd>

					<?php endif; ?>

					<?php /** End Author **/ ?>

					<?php /** Begin Comments Count **/ ?>

					<?php if($gantry->get('page-meta-comments')) : ?>

						<?php if($gantry->get('page-meta-link-comments')) : ?>

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

			<?php /** Begin Post Content **/ ?>		
					
			<?php the_content(); ?>
			
			<?php wp_link_pages('before=<div class="pagination">'._r('Pages:').'&after=</div><br />'); ?>
																										
			<?php edit_post_link(_r('Edit this entry.'), '<div class="edit-entry">', '</div>'); ?>
				
			<?php if(comments_open() && $gantry->get('page-comments-form')) : ?>
														
				<?php echo $gantry->displayComments(true, 'standard', 'standard'); ?>
			
			<?php endif; ?>
			
			<?php /** End Post Content **/ ?>

		</div>
		
		<?php /** End Post **/ ?>
		
		<?php endwhile; ?>
		
		<?php else : ?>
																	
			<h1>
				<?php _re('Sorry, no pages matched your criteria.'); ?>
			</h1>
			
		<?php endif; ?>
		
		<?php wp_reset_query(); ?>

	</div>