<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrylayout');

/**
 *
 * @package gantry
 * @subpackage html.layouts
 */
class GantryLayoutComment_Standard extends GantryLayout {
    var $render_params = array(
        'comment' => null,
        'depth' => 0,
        'args' => array()
    );

    function render($params = array()) {
        global $gantry;
        $fparams = $this->_getParams($params);
    }

    function render_comment($comment, $args, $depth){
        global $gantry;
        ob_start();

        $GLOBALS['comment'] = $comment;
        
        $avatar = get_avatar($comment, $size = 48);
        $avatar = str_replace("class='", "class='rt-image ", $avatar);

		$get_comment_classes = get_comment_class('', $comment->comment_ID, $comment->comment_post_ID);

		$body_style = $gantry->get('main-body');

		foreach($get_comment_classes as $class) {
			if(preg_match('/thread-even/', $class)) {
				($body_style == 'dark') ? $variation = 'box1' : $variation = 'box2';
			} elseif(preg_match('/thread-odd/', $class)) {
				$variation = 'box4';
			}
		}

		$comment_classes = 'class="' . join( ' ', $get_comment_classes ) . ' ' . $variation . '"';

		?>
        
        <div <?php echo $comment_classes; ?> id="comment-item-<?php comment_ID() ?>">

			<div class="rbox">
						
				<div class="rbox_tr">
					<div class="rbox_tl">
						<div class="rbox_t"></div>
					</div>
				</div>
				
				<div class="rbox_m">
					<div class="rbox_m2">
						<div class="rbox_m3">
						
							<div class="rt-block">
								<div class="module-surround">

						            <div id="comment-<?php comment_ID(); ?>" class="rok-comment-entry">
			            
										<div class="comment-avatar"><?php echo $avatar; ?></div>
						            
						            	<div class="comment-box avatar-indent">
						            		
						            		<span class="comment-author"><?php echo get_comment_author_link(); ?></span>
											<span class="comment-date"><?php echo get_comment_date('d-m-Y, H:i'); ?></span>
						            	
											<div class="comment-body" id="comment-body-<?php comment_ID(); ?>">
													
												<?php if ($comment->comment_approved == '0') : ?>
					               
					               					<div class="attention">
					               						<div class="typo-icon">
						               						<?php _re('Your comment is awaiting moderation.') ?>
					               						</div>
					               					</div>
					            
					            				<?php endif; ?>
					            
					          					<?php comment_text(); ?>
					
												<span class="comments-buttons">
													<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
												</span>
												
											</div>
										</div>
										<div class="clear"></div>

									</div>

								</div>
							</div>

						</div>		
					</div>
				</div>
				
				<div class="rbox_br">
					<div class="rbox_bl">
						<div class="rbox_b"></div>
					</div>
				</div>
				
			</div>       
		 
        <?php
        unset($comment_classes, $get_comment_classes);
        echo ob_get_clean();
        return;
    }
}