<?php
/**
 * @version   1.5 November 13, 2012
 * @author    RocketTheme, LLC http://www.rockettheme.com
 * @copyright Copyright � 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
 
$enable_statuses = ($option['enable_statuses'] == "1") ? 1 : 0;
$enable_usernames = ($option['enable_usernames'] == "1") ? 1 : 0;
$enable_search = ($option['enable_search'] == "1") ? 1 : 0;

$header_style = $option['header_style'];
$show_default_avatar = ($option['show_default_avatar'] == "1") ? 1 : 0;
$show_feed = ($option['show_feeds'] == "1") ? 1 : 0;
$show_follow_updates = ($option['show_follow_updates'] == "1") ? 1 : 0;
$show_bio = ($option['show_bio'] == "1") ? 1 : 0;
$show_web = ($option['show_web'] == "1") ? 1 : 0;
$show_location = ($option['show_location'] == "1") ? 1 : 0;
$show_updates = ($option['show_updates'] == "1") ? 1 : 0;
$show_feed = ($option['show_feed'] == "1") ? 1 : 0;
$show_followers = ($option['show_followers'] == "1") ? 1 : 0;
$show_following = ($option['show_following'] == "1") ? 1 : 0;
$show_following_icons = ($option['show_following_icons'] == "1") ? 1 : 0;
$following_icons_count = $option['following_icons_count'];
$show_viewall = ($option['show_viewall'] == "1") ? 1 : 0;
if (!$following_icons_count) $show_following_icons = 0;

$externals = ($option['status_external'] == "1") ? 1 : 0;

if ($externals) $ext = " class='external'";
else $ext = "";

$https = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == 'on';
?>

<div id="roktwittie" class="roktwittie">
	<?php if ($enable_statuses && is_array($status)): ?>
	<div class="status">
		<?php foreach($status as $id => $user): ?>
		<?php 
			if ($https) {
				$user->profile_image_url = str_replace("http:", "https:", $user->profile_image_url);
			}
		?>
		<div class="user">
			<div class="header-wrapper <?php echo $header_style; ?>"><div class="header">
				<div class="status-wrapper">
					<div class="avatar<?php if($show_default_avatar){echo " showavatar";} ?>" style="width: 48px; height: 48px;"><img src="<?php echo $user->profile_image_url?>" width="48" height="48" alt="<?php echo $id; ?>'s avatar" /></div>
					<div class="info">
		    			<span class="name"><?php echo $user->name; ?></span>
    					<span class="nick"><?php echo $id; ?></span>
					</div>
					<div class="clr"></div>
				</div>				
			</div></div>
			<div class="content">
				<?php if ($show_feed || $show_follow_updates): ?>
				<ul class="subscribe">
					<?php if ($show_feed): ?>
						<li class="tweets-feed"><div class="title"><?php _e('feed:', 'roktwittie'); ?></div> <div class="content feed"><a <?php echo $ext; ?>  href="https://twitter.com/statuses/user_timeline/<?php echo $id; ?>.rss"><?php _e('RSS Feed', 'roktwittie'); ?></a></div></li>
					<?php endif; ?>
					<?php if ($show_follow_updates): ?>
						<li class="tweets-follow"><div class="title"><?php _e('follow:', 'roktwittie'); ?></div> <div class="content"><a <?php echo $ext; ?> href="http://twitter.com/<?php echo $id; ?>"><?php _e('Follow updates', 'roktwittie'); ?></a></div></li>
					<?php endif; ?>
				</ul>
				<?php endif;?>
				<ul class="stats">
					<?php if ($show_bio && strlen($user->description)): ?>
						<li class="tweets-bio"><div class="title"><?php _e('bio:', 'roktwittie'); ?></div> <div class="content"><?php echo str_replace("&", "&amp;", $user->description); ?></div></li>
					<?php endif; ?>
					
					<?php if ($show_web && strlen($user->url)): ?>
					<li class="tweets-web"><div class="title"><?php _e('web:', 'roktwittie'); ?></div> <div class="content"><a <?php echo $ext; ?> href="<?php echo $user->url; ?>">
						<?php echo $user->url; ?></a></div>
					</li>
					<?php endif; ?>
					
					<?php if ($show_location && strlen($user->location)): ?>
						<li class="tweets-location"><div class="title"><?php _e('location:', 'roktwittie'); ?></div> <div class="content"><?php echo $user->location; ?></div></li>
					<?php endif; ?>
					
					<?php if ($show_updates): ?>
						<li class="tweets-updates-count"><div class="title"><?php _e('updates:', 'roktwittie'); ?></div> <div class="content"><?php echo $user->statuses_count; ?></div></li>
					<?php endif;?>

					<?php if ($show_followers): ?>
						<li class="tweets-followers-count"><div class="title"><?php _e('followers:', 'roktwittie'); ?></div> <div class="content"><?php echo $user->followers_count; ?></div></li>
					<?php endif; ?>
					
					<?php if ($show_following): ?>
						<li class="tweets-following-count"><div class="title"><?php _e('following:', 'roktwittie'); ?></div> <div class="content"><?php echo $user->friends_count; ?></div></li>
					<?php endif; ?>
				</ul>
				<?php if ($show_following_icons && count($friends[$id]) > 1): ?>
				<div class="friends_list">
					<div class="title">
						<?php 
							if (count($friends[$id]) > ($following_icons_count + 1)) echo str_replace("_COUNT_", $following_icons_count, __('Following:', 'roktwittie'));
							else _e('Last _COUNT_ tweets from _USER_:', 'roktwittie');
						?>
					</div>
					<?php $count = 1; foreach($friends[$id] as $fid => $fuser): ?>
						<?php
							if ($fid == "rate_limit") continue;
							if ($https) $fuser->profile_image_url = str_replace("http:", "https:", $fuser->profile_image_url);
						?>
						<span class="vcard">
							<a <?php echo $ext; ?> title="<?php echo $fuser->name; ?>" rel="contact" href="http://twitter.com/<?php echo $fuser->screen_name; ?>">
								<img src="<?php echo $fuser->profile_image_url; ?>" width="24" height="24" alt="<?php echo $fuser->screen_name; ?>'s avatar" />
							</a>
						</span>
						<?php 
							$count++; 
							if ($count > $following_icons_count) break; 
						?>
					<?php endforeach; ?>
					
					<?php if (count($friends[$id]) > ($following_icons_count + 1) && $show_viewall): ?>
						<div class="viewall"><a <?php echo $ext; ?> href="http://twitter.com/<?php echo $id;?>/following"><?php _e('View All...', 'roktwittie'); ?></a></div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	
	<?php if ($enable_usernames || $enable_search): ?>
	<div class="loading"><span><?php _e('Loading...', 'roktwittie'); ?></span></div>
	<?php endif; ?>
	
	<?php if ($enable_usernames): ?>
	<div class="tweets-wrapper">
		<div class="tweets-title-surround"><p class="title"><?php echo str_replace("_COUNT_", $option['usernames_count_size'], str_replace("_USER_", $option['usernames'], __('Last _COUNT_ tweets from _USER_:', 'roktwittie'))); ?></p></div>
		<div class="tweets"></div>
	</div>
	<?php endif; ?>
	
	<?php if ($enable_search): ?>
	<div class="query-wrapper">
		<div class="tweets-title-surround"><p class="title"><?php echo str_replace("_SEARCH_", "<strong>'".stripslashes($option['search'])."'</strong>", __('People talking about _SEARCH_', 'roktwittie')); ?></p></div>
		<div class="query"></div>
	</div>
	<?php endif; ?>
	
	<?php if ($externals): ?>
		<script type="text/javascript">window.addEvent("domready",function(){var A=$$("#roktwittie .external");if(A.length){A.setProperty("target","_blank");}});</script>
	<?php endif; ?>
</div>