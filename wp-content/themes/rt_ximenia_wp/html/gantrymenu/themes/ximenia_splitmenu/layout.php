<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class XimeniaSplitMenuLayout extends AbstractRokMenuLayout {

	static $jsLoaded = false;

	public function stageHeader() {
		global $gantry;

		$this->args['menu_suffix'] = (array_key_exists('startLevel', $this->args) && $this->args['startLevel'] == 1) ? '' : $this->args['menu_suffix'];
		$this->activeid = (array_key_exists('fusion_enable_current_id', $this->args) && $this->args['fusion_enable_current_id'] == 0) ? false : true;
		
		if($this->args['menu_suffix'] == 'top' && array_key_exists('startLevel', $this->args) && $this->args['startLevel'] == 0) {
			$gantry->addBodyClass('menu-type-splitmenu');
			$gantry->addStyle('splitmenu.css');
		}

		if (!self::$jsLoaded) {
			$mobileScript = "
			window.addEvent('domready', function(){
				document.getElements('[data-rt-menu-mobile]').addEvent('change', function(){
					window.location.href = this.value;
				});
			});";

			$gantry->addDomReadyScript($mobileScript);

			self::$jsLoaded = true;
        }
	}

	protected function renderItem(RokMenuNode &$item, &$menu) {
		global $gantry;

		if ($item->getAttribute('subtext'))
			$item->addLinkClass('subtext');

		?>
		<li <?php if($item->hasListItemClasses()) : ?>class="<?php echo $item->getListItemClasses();?>"<?php endif;?> <?php if ($item->getCssId()): ?>id="<?php echo $item->getCssId();?>"<?php endif;?>>
			<a <?php if ($item->hasLinkClasses()): ?>class="<?php echo $item->getLinkClasses().$activeToTop; ?>" <?php endif;?><?php if ($item->hasLink()): ?>href="<?php echo $item->getLink();?>" <?php endif;?><?php if ($item->getTarget()): ?>target="<?php echo $item->getTarget();?>" <?php endif;?><?php if ($item->hasLinkAttribs()): ?> <?php echo $item->getLinkAttribs(); ?><?php endif;?>>
				<span>
					<?php echo $item->getTitle();?>
					<?php
					$subtext = $item->getAttribute('subtext');
					if (is_array($subtext)) :
						$subtext = implode("\n", $subtext);
					endif;
					?>
					<?php if (!empty($subtext)): ?><em><?php echo stripslashes($subtext); ?></em><?php endif;?>
					<?php if ($item->getParent() == 0 && $item->hasChildren()): ?>
					<span class="daddyicon"></span>
					<?php endif; ?>
				</span>
			</a>
			<?php if ($item->hasChildren()): ?>
			<ul class="level<?php echo intval($item->getLevel()) + 2; ?>">
				<?php foreach ($item->getChildren() as $child) : ?>
					<?php echo $this->renderItem($child, $menu); ?>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</li>
		<?php
	}

	function renderMobileItem(RokMenuNode &$item, &$menu){
		$child_type = 'menuitems';
		$level = str_repeat("&mdash;", $item->getLevel()) . " ";
		$isActive = in_array('active', explode(" ", $item->getListItemClasses())) ? ' selected="selected"' : '';
		?>
		<option value="<?php echo $item->getLink();?>"<?php echo $isActive;?>><?php echo $level.$item->getTitle();?></option>

		<?php
			if ($item->hasChildren()){
				foreach($item->getChildren() as $child){
					$this->renderMobileItem($child, $menu);
				}
			}
		?>
		<?php
	}
	
	public function curPageURL($link) {
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
	
		$replace = str_replace('&', '&amp;', (preg_match("/^http/", $link) ? $pageURL : $_SERVER["REQUEST_URI"]));

		return $replace == $link;
	}
	
	public function renderMenu(&$menu) {
		global $gantry;
		ob_start();
		if($menu->getChildren()) : ?>
		<div class="rt-splitmenu">
			<div class="rt-menubar splitmenu">
				<ul class="menu<?php echo $this->args['menu_suffix']; ?> level1">
					<?php foreach ($menu->getChildren() as $item) : ?>
						<?php echo $this->renderItem($item, $menu); ?>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="rt-menu-mobile">
			<select data-rt-menu-mobile>
				<?php foreach ($menu->getChildren() as $item) : ?>
				<?php $this->renderMobileItem($item, $menu); ?>
				<?php endforeach; ?>
			</select>
		</div>
		<?php endif;
		return ob_get_clean();
	}
}