<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
// no direct access
defined('ABSPATH') or die('Restricted access');

// Create a shortcut for params.
$category = get_the_category();
?>

			<?php /** Begin Post **/ ?>
				
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				<?php /** Begin Article Title **/ ?>

				<?php if ($gantry->get('blog-title')) : ?>

					<h2>
						<?php if ($gantry->get('blog-link-title')) : ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						<?php else : ?>
							<?php the_title(); ?>
						<?php endif; ?>
					</h2>

				<?php endif; ?>

				<?php /** End Article Title **/ ?>

				<?php /** Begin Extended Meta **/ ?>

				<?php if ($gantry->get('blog-meta-date') || $gantry->get('blog-meta-modified') || $gantry->get('blog-meta-author') || $gantry->get('blog-meta-comments')) : ?>
				
					<dl class="article-info">

						<?php /** Begin Parent Category **/ ?>
						
						<?php if ($gantry->get('blog-type') == 'post' && ($gantry->get('blog-meta-category-parent') && $category[0]->parent != '0')) : ?>

							<dd class="parent-category-name">
								<?php
									$parent_category = get_category((int)$category[0]->parent);
									$title = $parent_category->cat_name;
									$link = get_category_link($parent_category);
									$url = '<a href="' . esc_url($link) . '">' . $title . '</a>'; 
								?>
			
								<?php if ($gantry->get('blog-meta-link-category-parent')) : ?>
									<?php echo $url; ?>
								<?php else : ?>
									<?php echo $title; ?>
								<?php endif; ?>
							</dd>

						<?php endif; ?>

						<?php /** End Parent Category **/ ?>

						<?php /** Begin Category **/ ?>

						<?php if ($gantry->get('blog-type') == 'post' && $gantry->get('blog-meta-category')) : ?>

							<dd class="category-name">
								<?php 
									$title = $category[0]->cat_name;
									$link = get_category_link($category[0]->cat_ID);
									$url = '<a href="' . esc_url($link) . '">' . $title . '</a>';
								?>
			
								<?php if ($gantry->get('blog-meta-link-category')) : ?>
									<?php echo $url; ?>
								<?php else : ?>
									<?php echo $title; ?>
								<?php endif; ?>
							</dd>

						<?php endif; ?>

						<?php /** End Category **/ ?>

						<?php /** Begin Date & Time **/ ?>

						<?php if($gantry->get('blog-meta-date')) : ?>

							<dd class="create"><?php _re('Published on'); ?> <?php the_time('l, d F Y H:i'); ?></dd>

						<?php endif; ?>

						<?php /** End Date & Time **/ ?>

						<?php /** Begin Modified Date **/ ?>
	
						<?php if($gantry->get('blog-meta-modified')) : ?>
	
							<dd class="modified"><?php _re('Last Updated on'); ?> <?php the_modified_date('d F Y'); ?></dd>
	
						<?php endif; ?>
	
						<?php /** End Modified Date **/ ?>

						<?php /** Begin Author **/ ?>
					
						<?php if ($gantry->get('blog-meta-author')) : ?>

							<dd class="createdby"><?php _re('Written by'); ?> <?php the_author(); ?></dd>

						<?php endif; ?>
	
						<?php /** End Author **/ ?>
	
						<?php /** Begin Comments Count **/ ?>
	
						<?php if($gantry->get('blog-meta-comments')) : ?>
	
							<?php if($gantry->get('blog-meta-link-comments')) : ?>
	
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
			
				<?php if($gantry->get('blog-content') == 'content') : ?>
				
					<?php the_content(false); ?>
									
				<?php else : ?>
									
					<?php the_excerpt(); ?>
										
				<?php endif; ?>
				
				<?php if(preg_match('/<!--more(.*?)?-->/', $post->post_content)) : ?>
				
					<p class="readmore">																			
						<a href="<?php the_permalink(); ?>"><?php echo $gantry->get('blog-readmore'); ?></a>
					</p>
				
				<?php endif; ?>
				
				<?php /** End Post Content **/ ?>

			</div>
			
			<?php /** End Post **/ ?>

			<div class="item-separator"></div>