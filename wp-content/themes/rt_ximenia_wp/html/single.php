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

		<?php

		// Create a shortcut for params.
		$category = get_the_category();

		?>

		<?php /** Begin Post **/ ?>
				
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

			<?php /** Begin Article Title **/ ?>

			<?php if ($gantry->get('post-title')) : ?>

				<h2>
					<?php the_title(); ?>
				</h2>

			<?php endif; ?>

			<?php /** End Article Title **/ ?>

			<?php /** Begin Extended Meta **/ ?>

			<?php if ($gantry->get('post-meta-date') || $gantry->get('post-meta-modified') || $gantry->get('post-meta-author') || $gantry->get('post-meta-comments')) : ?>
			
				<dl class="article-info">

					<?php /** Begin Parent Category **/ ?>
					
					<?php if ($gantry->get('post-meta-category-parent') && $category[0]->parent != '0') : ?>

						<dd class="parent-category-name">
							<?php
								$parent_category = get_category((int)$category[0]->parent);
								$title = $parent_category->cat_name;
								$link = get_category_link($parent_category);
								$url = '<a href="' . esc_url($link) . '">' . $title . '</a>'; 
							?>
		
							<?php if ($gantry->get('post-meta-link-category-parent')) : ?>
								<?php echo $url; ?>
							<?php else : ?>
								<?php echo $title; ?>
							<?php endif; ?>
						</dd>

					<?php endif; ?>

					<?php /** End Parent Category **/ ?>

					<?php /** Begin Category **/ ?>

					<?php if ($gantry->get('post-meta-category')) : ?>

						<dd class="category-name">
							<?php 
								$title = $category[0]->cat_name;
								$link = get_category_link($category[0]->cat_ID);
								$url = '<a href="' . esc_url($link) . '">' . $title . '</a>';
							?>
		
							<?php if ($gantry->get('post-meta-link-category')) : ?>
								<?php echo $url; ?>
							<?php else : ?>
								<?php echo $title; ?>
							<?php endif; ?>
						</dd>

					<?php endif; ?>

					<?php /** End Category **/ ?>

					<?php /** Begin Date & Time **/ ?>

					<?php if($gantry->get('post-meta-date')) : ?>

						<dd class="create"><?php _re('Published on'); ?> <?php the_time('l, d F Y H:i'); ?></dd>

					<?php endif; ?>

					<?php /** End Date & Time **/ ?>

					<?php /** Begin Modified Date **/ ?>

					<?php if($gantry->get('post-meta-modified')) : ?>

						<dd class="modified"><?php _re('Last Updated on'); ?> <?php the_modified_date('d F Y'); ?></dd>

					<?php endif; ?>

					<?php /** End Modified Date **/ ?>

					<?php /** Begin Author **/ ?>
				
					<?php if ($gantry->get('post-meta-author')) : ?>

						<dd class="createdby"><?php _re('Written by'); ?> <?php the_author(); ?></dd>

					<?php endif; ?>

					<?php /** End Author **/ ?>

					<?php /** Begin Comments Count **/ ?>

					<?php if($gantry->get('post-meta-comments')) : ?>

						<?php if($gantry->get('post-meta-link-comments')) : ?>

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

			<?php /** Begin Tags **/ ?>
			
			<?php if (has_tag() && $gantry->get('post-tags')) : ?>

				<?php 

					$body_style = $gantry->get('main-body'); 
					($body_style == 'dark') ? $variation = 'box1' : $variation = 'box2';

				?>
																															
				<div class="tags <?php echo $variation; ?>">
					<div class="rt-block">
						<div class="module-surround">
						
							<?php the_tags('<span>'._r('Tags:').' &nbsp;</span>', ' ', ''); ?>

						</div>
					</div>	
				</div>

			<?php endif; ?>

			<?php /** End Tags **/ ?>
			
			<?php edit_post_link(_r('Edit this entry.'), '<div class="edit-entry">', '</div>'); ?>
			
			<?php if($gantry->get('post-footer')) : ?>

				<div class="post-footer">
					<small>
					
						<?php _re('This entry was posted'); ?>
						<?php /* This is commented, because it requires a little adjusting sometimes.
						You'll need to download this plugin, and follow the instructions:
						http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */
						/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>
						<?php _re('on'); ?> <?php the_time('l, F jS, Y') ?> <?php _re('at'); ?> <?php the_time() ?>
						<?php _re('and is filed under'); ?> <?php the_category(', ') ?>.
						<?php _re('You can follow any responses to this entry through the'); ?> <?php post_comments_feed_link('RSS 2.0'); ?> <?php _re('feed'); ?>.

						<?php if (('open' == $post->comment_status) && ('open' == $post->ping_status)) {
						// Both Comments and Pings are open ?>
						<?php _re('You can'); ?> <a href="#respond"><?php _re('leave a response'); ?></a>, <?php _re('or'); ?> <a href="<?php trackback_url(); ?>" rel="trackback"><?php _re('trackback'); ?></a> <?php _re('from your own site.'); ?>

						<?php } elseif (!('open' == $post->comment_status) && ('open' == $post->ping_status)) {
						// Only Pings are Open ?>
						<?php _re('Responses are currently closed, but you can'); ?> <a href="<?php trackback_url(); ?> " rel="trackback"><?php _re('trackback'); ?></a> <?php _re('from your own site.'); ?>

						<?php } elseif (('open' == $post->comment_status) && !('open' == $post->ping_status)) {
						// Comments are open, Pings are not ?>
						<?php _re('You can skip to the end and leave a response. Pinging is currently not allowed.'); ?>

						<?php } elseif (!('open' == $post->comment_status) && !('open' == $post->ping_status)) {
						// Neither Comments, nor Pings are open ?>
						<?php _re('Both comments and pings are currently closed.'); ?>

						<?php } edit_post_link(_r('Edit this entry'),'','.'); ?>

					</small>
				</div>
												
			<?php endif; ?>
				
			<?php if(comments_open() && $gantry->get('post-comments-form')) : ?>
														
				<?php echo $gantry->displayComments(true, 'standard', 'standard'); ?>
			
			<?php endif; ?>
			
			<?php /** End Post Content **/ ?>

		</div>
		
		<?php /** End Post **/ ?>
		
		<?php endwhile; ?>
		
		<?php else : ?>
																	
			<h1>
				<?php _re('Sorry, no posts matched your criteria.'); ?>
			</h1>
			
		<?php endif; ?>
		
		<?php wp_reset_query(); ?>

	</div>