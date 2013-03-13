<?php
/**
 * @version   1.5 November 13, 2012
 * @author    RocketTheme, LLC http://www.rockettheme.com
 * @copyright Copyright � 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

$error = (isset($status) && is_string($status)) ? $status : (isset($friends) ? $friends : '');
$error = (is_string($error)) ? $error : '';
?>

<div id="roktwittie" class="roktwittie">
	<div class="error">
		<?php echo $error; ?>
	</div>
</div>