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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php
		$gantry->displayHead();
		$colorstyle = $gantry->get('main-body');
		$gantry->addStyles(array('gantry-core.css','wordpress-core.css', $colorstyle.'.css','fusionmenu.css','splitmenu.css','template.css','error.css','wp.css','custom.css'));
	?>

	<style type="text/css">
		<?php 
			$accentColor = new Color($gantry->get('main-accent'));
		    echo 'a, .menutop.fusion-js-container ul li > .item:hover, .splitmenu li .item:hover, .splitmenu li a:hover, .menutop.fusion-js-container li.f-menuparent-itemfocus > .item, .menutop li.root:hover > .item, .menutop li.root.f-mainparent-itemfocus > .item, #rt-subnavigation .splitmenu .item:hover, #rt-subnavigation .menu li.active .item, #rt-subnavigation .menutop li.active .item, .rt-totop:hover, .sprocket-tabs-nav li.active .sprocket-tabs-inner, .component-content .item h2 a:hover, .fusion-js-container .active > .item, .module-content ul.menu li.parent > li a:hover span, .module-content ul.menu li.parent > li .nolink:hover span, .module-content ul.menu li.parent li .item:hover span, .module-content ul.menu li.parent li a:hover span, .module-content ul.menu li.parent li .separator:hover, .module-content ul.menu li.parent .separator:hover, #rt-main .module-content ul.menu > li > a:hover, .component-content .items-leading h2 a:hover, .component-content .item-page h2 a:hover, #rt-menu a:hover, #k2Container .latestItemTitle a:hover {color:'.$gantry->get('main-accent').';}'."\n";
		    echo '.button:hover, .readon:hover, .readmore:hover, button.validate:hover, #member-profile a:hover, #member-registration a:hover, .formelm-buttons button:hover, .layout-showcase .sprocket-features-arrows .arrow:hover, .sprocket-mosaic-loadmore:hover, .title1 .module-title, .layout-showcase .readon, #k2Container .itemCommentsForm .button:hover, .sprocket-mosaic .sprocket-mosaic-filter li:hover, .sprocket-mosaic .sprocket-mosaic-order li:hover, .sprocket-mosaic .sprocket-mosaic-filter li.active, .sprocket-mosaic .sprocket-mosaic-order li.active, .fronttabs .image-description, .title4 .arrow-box, .menutop.level1 > li.active .item {background-color:'.$accentColor->lighten('5%').';}'."\n";
		    echo '.rt-totop:hover .totop-arrow, .module-content .menu li > a:hover > span > .menu-arrow, .module-content .menu li > .nolink:hover > span > .menu-arrow, .sprocket-lists-title, .sprocket-lists-arrows .arrow:hover, .sprocket-headlines-navigation .arrow:hover, .layout-slideshow .sprocket-features-arrows .arrow, .title2 .arrow-box, .module-content .menu li.current.active > a span .menu-arrow, .module-content .menu li.active#current > a span .menu-arrow {background-color: '.$gantry->get('main-accent').';}'."\n";
		    echo '.block-module .title3 .module-surround .module-title, #rt-main .title3 .module-surround .module-title, .title3 .module-surround .module-title, .component-content .item h2, #rt-footer .title, .component-content h1, .component-content .items-leading h2, .component-content .item-page h2, .component-content .item-page h2:after, .component-content .blog h2:after, .component-block .component-content h2, .component-content .weblink-category h2:after, .component-content .contact h2:after, .component-content .login h1:after, .component-content h2:after, .component-content h1:after, .title3.noblock .title:after, .component-content h2, .component-content .weblink-category h2, .title3.noblock .module-title:after {border-color: '.$gantry->get('main-accent').';}'."\n";
		?>
	</style>
</head>
<body <?php echo $gantry->displayBodyTag(); ?>>
	<?php /** Begin Header **/ if ($gantry->countModules('navigation')) : ?>
	<div id="rt-navigation">
		<div class="rt-container">
			<?php echo $gantry->displayModules('navigation','standard','standard'); ?>
			<div class="clear"></div>
		</div>
	</div>
	<?php /** End Header **/ endif; ?>
	<div id="rt-error-body">
		<div class="rt-container">
			<div id="rt-body-surround" class="component-block component-content">
				<div class="rt-error-box">
					<h1 class="error-title title"><span>404</span> - <?php _re('Page not found'); ?></h1>
					<div class="error-content">
					<p><strong><?php _re('You may not be able to visit this page because of:'); ?></strong></p>
					<ol>
						<li><?php _re('an out-of-date bookmark/favourite'); ?></li>
						<li><?php _re('a search engine that has an out-of-date listing for this site'); ?></li>
						<li><?php _re('a mistyped address'); ?></li>
						<li><?php _re('you have no access to this page'); ?></li>
						<li><?php _re('The requested resource was not found.'); ?></li>
						<li><?php _re('An error has occurred while processing your request.'); ?></li>
					</ol>
					<p></p>
					<p><a href="<?php echo $gantry->baseUrl; ?>" class="readon"><span>&larr; <?php _re('Home'); ?></span></a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $gantry->displayFooter(); ?>
</body>
</html>
<?php
$gantry->finalize();
?>
