<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
// no direct access
defined('ABSPATH') or die('Restricted access');

global $gantry;

function isBrowserCapable(){
	global $gantry;
	
	$browser = $gantry->browser;
	
	// ie.
	if ($browser->name == 'ie' && $browser->version < 8) return false;
	
	return true;
}
// get the current preset
$gpreset = str_replace(' ','',strtolower($gantry->get('name')));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >
<head>
	<?php if ($gantry->get('layout-mode') == '960fixed') : ?>
	<meta name="viewport" content="width=960px" />
	<?php elseif ($gantry->get('layout-mode') == '1200fixed') : ?>
	<meta name="viewport" content="width=1200px" />
	<?php else : ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php endif; ?>	
	<?php
		$gantry->displayHead();

		// Load Gantry 4 Responsive Grid
		$gantry->addStyle('grid-responsive.css', 5);

		$gantry->addStyles(array('template.css','wp.css','custom.css'));

		if ($gantry->browser->platform != 'iphone')
			$gantry->addInlineScript('window.addEvent("domready", function(){ if (typeof SmoothScroll != "undefined") new SmoothScroll(); else new Fx.SmoothScroll(); });');

		if ($gantry->get('loadtransition') && isBrowserCapable()){
			$gantry->addScript('load-transition.js');
			$hidden = ' class="rt-hidden"';
		} else {
			$hidden = '';
		}

	?>
</head>
	<body <?php echo $gantry->displayBodyTag(); ?>>
		<div id="rt-headerblock">
			<?php /** Begin Drawer **/ if ($gantry->countModules('drawer')) : ?>
			<div id="rt-drawer">
				<div class="rt-container">
					<?php echo $gantry->displayModules('drawer','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Drawer **/ endif; ?>
			<?php /** Begin Top **/ if ($gantry->countModules('top')) : ?>
			<div id="rt-top" class="block-module">
				<div class="rt-container">
					<?php echo $gantry->displayModules('top','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Top **/ endif; ?>
			<?php /** Begin Header **/ if ($gantry->countModules('header')) : ?>
			<div id="rt-header">
				<div class="rt-container">
					<?php echo $gantry->displayModules('header','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Header **/ endif; ?>
			<?php /** Begin Navigation **/ if ($gantry->countModules('navigation')) : ?>
			<div id="rt-navigation">
				<div class="rt-container">
					<?php echo $gantry->displayModules('navigation','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Navigation **/ endif; ?>
		</div>
		<?php /** Begin Sub Navigation **/ if ($gantry->countModules('subnavigation')) : ?>
		<div id="rt-subnavigation">
			<div class="rt-container">
				<?php echo $gantry->displayModules('subnavigation','standard','menu'); ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Sub Navigation **/ endif; ?>
		<div id="rt-transition"<?php echo $hidden; ?>>
			<?php /** Begin Showcase **/ if ($gantry->countModules('showcase')) : ?>
			<div id="rt-showcase">
				<div class="rt-container">
					<?php echo $gantry->displayModules('showcase','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Showcase **/ endif; ?>
			<?php /** Begin Feature **/ if ($gantry->countModules('feature')) : ?>
			<div id="rt-feature" class="block-module">
				<div class="rt-container">
					<?php echo $gantry->displayModules('feature','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Feature **/ endif; ?>
			<?php /** Begin Utility **/ if ($gantry->countModules('utility')) : ?>
			<div id="rt-utility" class="block-module">
				<div class="rt-container">
					<?php echo $gantry->displayModules('utility','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Utility **/ endif; ?>
			<?php /** Begin Main Top **/ if ($gantry->countModules('maintop')) : ?>
			<div id="rt-maintop" class="block-module">
				<div class="rt-container">
					<?php echo $gantry->displayModules('maintop','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Main Top **/ endif; ?>
			<?php /** Begin Breadcrumbs **/ if ($gantry->countModules('breadcrumb')) : ?>
			<div id="rt-breadcrumbs">
				<div class="rt-container">
					<?php echo $gantry->displayModules('breadcrumb','basic','breadcrumbs'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Breadcrumbs **/ endif; ?>
			<?php ob_start(); ?>