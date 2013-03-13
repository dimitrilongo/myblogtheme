<?php
 /**
 * @version   $Id$
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

global $rokgallery_plugin_path;

if (!defined('DS')) { define('DS', DIRECTORY_SEPARATOR); }

if (!defined('WORDPRESS_ROKGALLERY_LIB')) {
    /**
     * load rokcommon and rokgallery library
     */
    define('WORDPRESS_ROKGALLERY_LIB', 'WORDPRESS_ROKGALLERY_LIB');
    if (!defined('ROKCOMMON_LIB_PATH')){
        define('ROKCOMMON_LIB_PATH', ROKCOMMON_LIB_PATH);
    }

    $include_file = @realpath(realpath($rokgallery_plugin_path . '/lib/include.php'));
    $included_files = get_included_files();
    if (!in_array($include_file, $included_files) && ($loaderrors = require_once($include_file)) !== 'ROKGALLERY_LIB_INCLUDED') {
        return $loaderrors;
    }

    //if rokcommon isn't installed and/or activated we deactivate rokgallery if rokgallery isn't installed w/ its db we don't allow rokcommon to be called
    if (file_exists(ROKCOMMON_LIB_PATH) && rg_rokcommon_check() && rg_db_check()) {
        RokGallery_Doctrine::addModelPath($rokgallery_plugin_path . '/lib');
        RokGallery_Doctrine::useMemDBCache('RokGallery');

        RokCommon_Composite::addPackagePath('rokgallery', $rokgallery_plugin_path . '/templates');
        $container = RokCommon_Service::getContainer();
        RokCommon_Composite::addPackagePath('rokgallery', $container->platforminfo->getDefaultTemplatePath() . '/overrides/rokgallery/templates',20);

        RokCommon_Composite::addPackagePath('wp_views', $rokgallery_plugin_path . '/views');
        RokCommon_Composite::addPackagePath('wp_assets', $rokgallery_plugin_path . '/assets');
        RokCommon_Composite::addPackagePath('wp_forms', $rokgallery_plugin_path . '/forms');
        RokCommon_Composite::addPackagePath('wp_tinymce', $rokgallery_plugin_path . '/tinymce');
    }
}
return 'WORDPRESS_ROKGALLERY_LIB_INCLUDED';