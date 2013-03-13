<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Contact form based on the original code by Orman Clark
 * http://www.premiumpixels.com
 */
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrybodylayout');

/**
 *
 * @package gantry
 * @subpackage html.layouts
 */
class GantryLayoutBody_ContactForm extends GantryBodyLayout {
	var $render_params = array(
		'schema'        =>  null,
		'pushPull'      =>  null,
		'classKey'      =>  null,
		'sidebars'      =>  '',
		'contentTop'    =>  null,
		'contentBottom' =>  null,
		'component_content' => ''
	);

	function render($params = array()) {
		global $gantry, $post, $posts, $query_string;

		$fparams = $this-> _getParams($params);

		// logic to determine if the component should be displayed
		$display_mainbody = !($gantry->get("mainbody-enabled", true) == false);
		$display_component = !($gantry->get("component-enabled", true) == false);
		
		$mbClasses = trim("rt-grid-" . trim($fparams->schema['mb'] . " " . $fparams->pushPull[0]));
		$mbClasses = preg_replace('/\s\s+/', ' ', $mbClasses);
		
		$name_error = '';
		$email_error = '';
		$message_error = '';
		
		if(isset($_POST['submitted'])) {
		
			if(trim($_POST['rt-contact-name']) === '') {
				$name_error = 'Please enter your name.';
				$hasError = true;
			} else {
				$name = trim($_POST['rt-contact-name']);
			}
			
			if(trim($_POST['rt-contact-email']) === '')  {
				$email_error = 'Please enter your email address.';
				$hasError = true;
			} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['rt-contact-email']))) {
				$email_error = 'You entered an invalid email address.';
				$hasError = true;
			} else {
				$email = trim($_POST['rt-contact-email']);
			}
				
			if(trim($_POST['rt-contact-message']) === '') {
				$message_error = 'Please enter a message.';
				$hasError = true;
			} else {
				if(function_exists('stripslashes')) {
					$comments = stripslashes(trim($_POST['rt-contact-message']));
				} else {
					$comments = trim($_POST['rt-contact-message']);
				}
			}
				
			if(!isset($hasError)) {
				$emailTo = $gantry->get('contact-email');
				if (!isset($emailTo) || ($emailTo == '') ){
					$emailTo = get_option('admin_email');
				}
				$subject = '[Contact Form] From '.$name;
				$body = "Name: $name \n\nEmail: $email \n\nMessage: $comments";
				$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
				
				if(isset($_POST['rt-send-copy']) && $_POST['rt-send-copy'] == true) {
					mail($email, $subject, $body, $headers);
				}
				
				mail($emailTo, $subject, $body, $headers);
				$emailSent = true;
			}
			
		}
		
		ob_start();
		// XHTML LAYOUT
		?>
		<?php if ($display_mainbody) : ?>
		<div id="rt-main" class="<?php echo $fparams->classKey; ?>">
			<div class="rt-container">
				<div class="<?php echo $mbClasses; ?>">
		
					<?php if (isset($fparams->contentTop)) : ?>
					<div id="rt-content-top">
						<?php echo $fparams->contentTop; ?>
						<div class="clear"></div>
					</div>
					<?php endif; ?>
					
					<?php if ($display_component) : ?>
					<div class="rt-block component-block">
						<div class="component-content">

							<?php /** Begin Contact Form Template **/ ?>
							
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

												<dd class="createdby"><?php the_author(); ?></dd>

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
					
									<?php /** Begin Email Confirmation **/ ?>
																			
									<?php if(isset($emailSent) && $emailSent == true) { ?>

										<?php /** Post Content **/ ?>	

										<?php the_content(); ?>

										<?php /** Post Content **/ ?>

										<div class="approved">
											<div class="typo-icon">
												<?php _re('Thanks, your email was sent successfully.'); ?>
											</div>
										</div>
					
									<?php } else { ?>
									
										<?php /** End Email Confirmation **/ ?>
								
										<?php /** Begin Post Content **/ ?>	

										<?php the_content(); ?>

										<?php /** End Post Content **/ ?>

										<?php /** Begin Error Notification **/ ?>
										
										<?php if(isset($hasError)) { ?>
										
										<div class="alert">
											<div class="typo-icon">
												<?php _re('Sorry, an error occurred.') ?>
											</div>
										</div>
										
										<?php } ?>

										<?php /** End Error Notification **/ ?>
										
										<?php /** Begin Contact Form **/ ?>
										
										<form action="<?php the_permalink(); ?>" id="rt-contact-form" method="post">
											
											<?php if($name_error != '') { ?>
												<div class="alert">
													<div class="typo-icon">
														<?php echo $name_error; ?>
													</div>
												</div>
											<?php } ?>
											<p>
												<label for="rt-contact-name" class="contact-label"><?php _re('Name'); ?> <span class="required">*</span></label>
												<input name="rt-contact-name" id="rt-contact-name" value="<?php if(isset($_POST['rt-contact-name'])) echo $_POST['rt-contact-name'];?>" class="inputbox" />
											</p>
											
											<?php if($email_error != '') { ?>
												<div class="alert">
													<div class="typo-icon">
														<?php echo $email_error; ?>
													</div>
												</div>
											<?php } ?>
											<p>
												<label for="rt-contact-email" class="contact-label"><?php _re('Email'); ?> <span class="required">*</span></label>
												<input name="rt-contact-email" id="rt-contact-email" value="<?php if(isset($_POST['rt-contact-email'])) echo $_POST['rt-contact-email'];?>" class="inputbox" />
											</p>
											
											<?php if($message_error != '') { ?>
												<div class="alert">
													<div class="typo-icon">
														<?php echo $message_error; ?>
													</div>
												</div>
											<?php } ?>
											<p>
												<label for="rt-contact-message" class="contact-label"><?php _re('Message'); ?> <span class="required">*</span></label>
												<textarea name="rt-contact-message" id="rt-contact-message" rows="10" cols="50" class="inputbox"></textarea>
											</p>
											
											<div id="contact-form-buttons">
												<input type="checkbox" name="rt-send-copy" id="rt-send-copy" value="true" />
												<label for="rt-send-copy" class="rt-send-copy"><?php _re('Send me a copy of this email.'); ?></label>
												<div id="contact-form-send">
													<button class="button" type="submit" name="submit" tabindex="5" id="submit"><?php _re('Send Email'); ?></button>
												</div>
												<input type="hidden" name="submitted" id="submitted" value="true" />
												<div style="clear:both;"></div>
											</div>
											
										</form>
										
										<?php /** End Contact Form **/ ?>
									
									<?php } ?>
									
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
							
							<?php /** End Contact Form Template **/ ?>
						
						</div>
						<div class="clear"></div>
					</div>
					<?php endif; ?>
					
		
					<?php if (isset($fparams->contentBottom)) : ?>
					<div id="rt-content-bottom">
						<?php echo $fparams->contentBottom; ?>
						<div class="clear"></div>
					</div>
					<?php endif; ?>
				</div>    
				<?php echo $fparams->sidebars; ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php endif; ?>
		<?php
		return ob_get_clean();
	}
}