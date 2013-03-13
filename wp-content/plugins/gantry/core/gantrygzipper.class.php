<?php
/**
 * @version   $Id: gantrygzipper.class.php 58625 2012-12-15 22:41:23Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
defined('GANTRY_VERSION') or die();


/**
 * @package    gantry
 * @subpackage core
 */
class GantryGZipper
{
	function process()
	{

	}

	function processCSSFiles()
	{
		global $gantry;

		$cache_time   = $gantry->get("gzipper-time");
		$expires_time = $gantry->get("gzipper-expirestime", 1440);
		$strip_css    = $gantry->get("gzipper-stripwhitespace", 1);

		$grouped_priories = array();
		$output           = array();

		foreach ($gantry->_styles as $priorities) {
			foreach ($priorities as $links) {
				$css_links[$links->path] = $links->url;
			}
		}

//		$css_links = $gantry->_styles;

		ksort($gantry->_styles);

		foreach ($gantry->_styles as $style_priority => $styles) {
			$order_keeper = 0;
			$bump_ok      = false;
			foreach ($styles as $style_entry) {
				if ($style_entry->type == 'url') {
					$directory = 'REMOTE_URL';
					$filename  = $style_entry->url;
					$bump_ok   = true;
				} else {
					$directory = dirname($style_entry->path);
					$filename  = basename($style_entry->path);
				}
				$grouped_priories[$style_priority][$order_keeper][$directory][$filename] = $style_entry;
				if ($bump_ok) {
					$order_keeper++;
					$bump_ok = false;
				}
			}
		}
		foreach ($grouped_priories as $priority => $order_kept_entries) {
			foreach ($order_kept_entries as $ordered_files) {
				foreach ($ordered_files as $dir => $files) {
					// Process full urls
					if ($dir == 'REMOTE_URL') {
						foreach ($files as $file => $link) {
							$output[0][] = $link;
						}
						continue;
					} // Process
					else {

						if (!is_writable($dir)) {
							foreach ($files as $css_file) {
								$output[0][] = $css_file;
							}
							continue;
						}
						$md5sum = "";
						$path   = "";

						//first trip through to build filename
						foreach ($files as $file => $details) {
							$md5sum .= md5($details->url);
							$detailspath = $dir . DS . $file;
							if (file_exists($detailspath)) {
								$path = dirname($details->url);
							}
						}

						$cache_filename = "css-" . md5($md5sum) . ".php";
						$cache_fullpath = $dir . DS . $cache_filename;

						//see if file is stale
						if (file_exists($cache_fullpath)) {
							$diff = (time() - filectime($cache_fullpath));
						} else {
							$diff = $cache_time + 1;
						}

						if ($diff > $cache_time) {
							$outfile = GantryGZipper::_getOutHeader("css", $expires_time);
							foreach ($files as $file => $details) {
								$detailspath = $dir . DS . $file;

								if (file_exists($detailspath)) {
									$css_content = file_get_contents($detailspath);
									if ($strip_css) {
										$css_content = GantryGZipper::_stripCSSWhiteSpace($css_content);
									}
									$outfile .= "\n\n/*** " . $file . " ***/\n\n" . $css_content;
								}
							}
							file_put_contents($cache_fullpath, $outfile);
						}

						$cache_file_name = $path . "/" . $cache_filename;
						$output[0][]     = new GantryStyleLink('local', $cache_fullpath, $cache_file_name);
					}
				}
			}
		}
		$gantry->_styles = & $output;
	}

	function processJsFiles()
	{
		global $gantry;

		$path         = $gantry->basePath;
		$cache_time   = $gantry->get("gzipper-time");
		$expires_time = $gantry->get("gzipper-expirestime", 1440);
		$cache_dir    = $gantry->templatePath . DS . 'cache';


		$ordered_files = array();
		$output        = array();
		$md5sum        = "";

		$script_tags = $gantry->_scripts;

		foreach ($script_tags as $filepath => $file) {
			$md5sum .= md5($filepath);
			$ordered_files[] = array(dirname($filepath), basename($filepath), $file);
		}

		if (!is_writable($cache_dir)) {
			foreach ($this->_scripts as $js_file) {
				$output[] = $js_file;
			}
			return;
		}

		if (count($ordered_files) > 0) {
			$cache_filename = "js-" . md5($md5sum) . ".php";
			$cache_fullpath = $cache_dir . DS . $cache_filename;


			//see if file is stale
			if (file_exists($cache_fullpath)) {
				$diff = (time() - filectime($cache_fullpath));
			} else {
				$diff = $cache_time + 1;
			}

			if ($diff > $cache_time) {
				$outfile = GantryGZipper::_getOutHeader("js", $expires_time);
				foreach ($ordered_files as $files) {
					$dir      = $files[0];
					$filename = $files[1];
					$details  = $files[2];

					$detailspath = $dir . DS . $filename;
					if (file_exists($detailspath)) {
						$jsfile = file_get_contents($detailspath);
						// fix for stupid joolma code
						if (strpos($filename, 'joomla.javascript.js') !== false or strpos($filename, 'mambojavascript.js') !== false) {
							$jsfile = str_replace("// <?php !!", "// ", $jsfile);
						}
						$outfile .= "\n\n/*** " . $filename . " ***/\n\n" . $jsfile;
					}
				}
				file_put_contents($cache_fullpath, $outfile);
			}

			$cache_file_name = $path . "/cache/" . $cache_filename;
			$cache_url_name  = $gantry->templateUrl . "/cache/" . $cache_filename;
			$output[]        = $cache_url_name;
		}
		$gantry->_scripts = & $output;
	}

	function _getOutHeader($type = "css", $expires_time = 1440)
	{
		if ($type == "css") {
			$header = '<?php
ob_start ("ob_gzhandler");
header("Content-type: text/css; charset: UTF-8");
header("Cache-Control: must-revalidate");
$expires_time = ' . $expires_time . ';
$offset = 60 * $expires_time ;
$ExpStr = "Expires: " .
gmdate("D, d M Y H:i:s",
time() + $offset) . " GMT";
header($ExpStr);
                ?>';
		} else {
			$header = '<?php
ob_start ("ob_gzhandler");
header("Content-type: application/x-javascript; charset: UTF-8");
header("Cache-Control: must-revalidate");
$expires_time = ' . $expires_time . ';
$offset = 60 * $expires_time ;
$ExpStr = "Expires: " .
gmdate("D, d M Y H:i:s",
time() + $offset) . " GMT";
header($ExpStr);
                ?>';
		}
		return $header;
	}

	function _stripCSSWhiteSpace($css_content)
	{
		// remove comments
		$css_content = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css_content);
		// remove tabs, spaces, newlines, etc.
		$css_content = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css_content);
		return $css_content;
	}
}


class _compression_set
{
	var $base;
	var $fileurlmap = array();
}