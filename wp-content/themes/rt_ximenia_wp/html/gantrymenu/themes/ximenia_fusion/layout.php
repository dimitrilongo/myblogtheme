<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class XimeniaFusionMenuLayout extends AbstractRokMenuLayout {

	static $jsLoaded = false;

	public function stageHeader() {
		global $gantry;
		
		$tweakInitial_x = $this->args['fusion_tweakInitial_x'];
		$tweakInitial_y = $this->args['fusion_tweakInitial_y'];

		if (strtolower($gantry->browser->name) == 'firefox'){
            $tweakInitial_x += 1;
        }
		
		if ($this->args['fusion_centeredOffset'] == "1") {
			$tweakInitial_x = 20;
			$tweakInitial_y = 0;
		}
		
		if ($this->args['fusion_effect'] == 'slidefade') $this->args['fusion_effect'] = "slide and fade";

		if ($gantry->browser->name == "ie" && $this->args['fusion_effect'] == 'slide and fade') $this->args['fusion_effect'] = "slide";
		if ($gantry->browser->name == 'ie' && $gantry->browser->shortversion == '8') $tweakInitial_x -= 1;

		if (!self::$jsLoaded) {
			$mobileScript = "
			window.addEvent('domready', function(){
				document.getElements('[data-rt-menu-mobile]').addEvent('change', function(){
					window.location.href = this.value;
				});
			});";

			if ($this->args['fusion_enable_js']) {
				$gantry->addScript("fusion.js");

				ob_start();
				?>
				new Fusion('ul.menutop', {
					effect: '<?php echo $this->args['fusion_effect']; ?>',
					opacity:  <?php echo $this->args['fusion_opacity']; ?>,
					hideDelay:  <?php echo $this->args['fusion_hidedelay']; ?>,
					centered:  <?php echo $this->args['fusion_centeredOffset']; ?>,
					tweakInitial: {'x': <?php echo $tweakInitial_x; ?>, 'y': <?php echo $tweakInitial_y; ?>},
					tweakSubsequent: {'x':  <?php echo $this->args['fusion_tweakSubsequent_x']; ?>, 'y':  <?php echo $this->args['fusion_tweakSubsequent_y']; ?>},
					tweakSizes: {'width': <?php echo $this->args['fusion_tweak-width']; ?>, 'height': <?php echo $this->args['fusion_tweak-height']; ?>},
					menuFx: {duration:  <?php echo $this->args['fusion_menu_duration']; ?>, transition: Fx.Transitions.<?php echo $this->args['fusion_menu_animation']; ?>},
				});
				<?php
				$inline = ob_get_clean();
				$gantry->addDomReadyScript($inline."\n".$mobileScript);	
			} else {
				$gantry->addDomReadyScript($mobileScript);
	        }

			self::$jsLoaded = true;
        }

		$gantry->addStyle('fusionmenu.css');
		
		if ($this->args['fusion_load_css']) {
			$gantry->addStyle($gantry->templateUrl."/html/gantrymenu/themes/gantry_fusion/css/fusion.css");
		}

	}

	protected function renderItem(RokMenuNode &$item, &$menu) {
		global $gantry;
		
		$wrapper_css = '';
		$ul_css = '';
		$group_css = '';
		
		//get custom image
		if ($item->getAttribute('icon'))
			$item->addLinkClass('image');
		else
			$item->addLinkClass('bullet');
		
		// get menu item subtext
		if ($item->getAttribute('subtext'))
			$item->addLinkClass('subtext');
			
		//get columns count for children
		$columns = $item->getAttribute('submenu_cols');
			
		$dropdown_width = $item->getAttribute('fusion_dropdown_width');
		$column_widths = explode(",",$item->getAttribute('fusion_column_widths'));

		if (trim($columns)=='') $columns = 1;
		if (trim($dropdown_width)=='') $dropdown_width = 180;

		$wrapper_css = ' style="width:'.trim($dropdown_width).'px;"';

		$col_total = 0;$cols_left=$columns;
		if (trim($column_widths[0] != '')) {
			for ($i=0; $i < $columns; $i++) {
				if (isset($column_widths[$i])) {
					$ul_css[] = ' style="width:'.trim($column_widths[$i]).'px;"';
					$col_total += $column_widths[$i];
					$cols_left--;
				} else {
					$col_width = floor(intval((intval($dropdown_width) - $col_total) / $cols_left));
					$ul_css[] = ' style="width:'.$col_width.'px;"';
				}
			}
		} else {
			for ($i=0; $i < $columns; $i++) {
				$col_width = floor(intval($dropdown_width)/$columns);
				$ul_css[] = ' style="width:'.$col_width.'px;"';
			}
		}
		
		// Menu Item Grouping
		
		$grouping = $item->getAttribute('fusion_children_group');
		if ($grouping == 1) $item->addListItemClass('grouped-parent');    
		$child_type = 'menuitems';
		
		$distribution = $item->getAttribute('fusion_distribution');
		$manual_distribution = explode(",", $item->getAttribute('fusion_manual_distribution'));
				  
		?>
		
		<li <?php if($item->hasListItemClasses()) : ?>class="<?php echo $item->getListItemClasses();?>"<?php endif;?> <?php if ($item->getCssId()): ?>id="<?php echo $item->getCssId();?>"<?php endif;?>>
			<a <?php if ($item->hasLinkClasses()): ?>class="<?php echo $item->getLinkClasses().$activeToTop; ?>" <?php endif;?><?php if ($item->hasLink()): ?>href="<?php echo $item->getLink();?>" <?php endif;?><?php if ($item->getTarget()): ?>target="<?php echo $item->getTarget();?>" <?php endif;?><?php if ($item->hasLinkAttribs()): ?><?php echo $item->getLinkAttribs(); ?><?php endif;?>>
				<span>
					<?php
					$icon = $item->getAttribute('icon');
					?>
					<?php if (!empty($icon)) : ?>
						<img src="<?php echo $gantry->templateUrl.'/images/icons/'.$icon; ?>" alt="<?php echo $icon; ?>" />
					<?php endif; ?>
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
				<?php
				if ($grouping == 0 or $item->getLevel() == 0) :
					if ($distribution == 'inorder') {
						$count = sizeof($item->getChildren());
						$items_per_col = intval(ceil($count / $columns));
						$children_cols = array_chunk($item->getChildren(),$items_per_col);
					} elseif ($distribution == 'manual') {
						$children_cols = $this->array_fill($item->getChildren(), $columns, $manual_distribution);
					} else {
						$children_cols = $this->array_chunkd($item->getChildren(),$columns);
					}
					$col_counter = 0;
					?>
				<div class="fusion-submenu-wrapper level<?php echo intval($item->getLevel())+2; ?> <?php if ($columns > 1) echo ' columns'.$columns; ?>"<?php echo $wrapper_css; ?>>
					<?php foreach($children_cols as $col) : ?>
					<ul class="level<?php echo intval($item->getLevel()) + 2; ?>"<?php echo $ul_css[$col_counter++]; ?>>
						<?php foreach ($col as $child) : ?>
							<?php echo $this->renderItem($child, $menu); ?>
						<?php endforeach; ?>
					</ul>
					<?php endforeach;?>
					<div class="drop-bot"></div>
				</div>
				<?php else : ?>
					<div class="fusion-grouped<?php echo $group_css; ?>">
						<ol>
							<?php foreach ($item->getChildren() as $child) : ?>
								<?php echo $this->renderItem($child, $menu); ?>
							<?php endforeach; ?>
						</ol>
					</div>
				<?php endif; ?>
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
	
	function array_fill(array $array, $columns, $manual_distro) {
	
		$new_array = array();
		
		//$array = array("first", "second", "third", "fourth", "fifth", "sixth", "seventh", "eighth", "ninth");
	
//    	var_dump ($array);
//    	var_dump ($columns);
//    	var_dump ($manual_distro);
		
		array_unshift($array, null);
		
		for ($i=0;$i<$columns;$i++) {
			if (isset($manual_distro[$i])) {
				$manual_count = $manual_distro[$i];
				for ($c=0;$c<$manual_count;$c++) {
					//echo "i:c " . $i . ":". $c;
					$element = next($array);
					if ($element) $new_array[$i][$c] = $element;
				}
			}
		}
		
		return $new_array;
	
	}
	
	protected function array_chunkd(array $array, $chunk) {
		if ($chunk === 0)
			return $array;

		// number of elements in an array
		$size = count($array);

		// average chunk size
		$chunk_size = $size / $chunk;

		// calculate how many not-even elements eg in array [3,2,2] that would be element "3"
		$real_chunk_size = floor($chunk_size);
		$diff = $chunk_size - $real_chunk_size;
		$not_even = $diff > 0 ? round($chunk * $diff) : 0;

		// initialise values for return
		$result = array();
		$current_chunk = 0;

		foreach ($array as $key => $element)
		{
			$count = isset($result[$current_chunk]) ? count($result[$current_chunk]) : 0;

			// move to a new chunk?
			if ($count == $real_chunk_size && $current_chunk >= $not_even || $count > $real_chunk_size && $current_chunk < $not_even)
				$current_chunk++;

			// save value
			$result[$current_chunk][$key] = $element;
		}

		return $result;
	}
	
	public function calculate_sizes (array $array) {
		return implode(', ', array_map('count', $array));
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
		if (!$this->args['fusion_enable_js']) $isJSEnabled = 'nojs';   	
		ob_start(); ?>
		<div class="rt-menubar fusionmenu">
			<ul class="menutop level1 <?php echo $isJSEnabled; ?>">
				<?php foreach ($menu->getChildren() as $item) : ?>
					<?php echo $this->renderItem($item, $menu); ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="rt-menu-mobile">
			<select data-rt-menu-mobile>
				<?php foreach ($menu->getChildren() as $item) : ?>
				<?php $this->renderMobileItem($item, $menu); ?>
				<?php endforeach; ?>
			</select>
		</div>
		<?php return ob_get_clean();
	}
	
}