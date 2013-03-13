<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
 
class XimeniaSplitMenuTheme extends AbstractRokMenuTheme {

    protected $defaults = array(
        'fusion_load_css' => 0,
        'fusion_enable_js' => 1,
        'fusion_opacity' => 1,
        'fusion_effect' => 'slidefade',
        'fusion_hidedelay' => 500,
        'fusion_menu_animation' => 'Circ.easeOut',
        'fusion_menu_duration' => 300,
        'fusion_centeredOffset' => 0,
        'fusion_tweakInitial_x' => -8,
        'fusion_tweakInitial_y' => -6,
        'fusion_tweakSubsequent_x' => -8,
        'fusion_tweakSubsequent_y' => -11,
        'fusion_tweak-width' => 18,
        'fusion_tweak-height' => 20,
        'fusion_enable_current_id' => 0,
        'fusion_responsive-menu' => 'panel'
    );

    public function getFormatter($args){
        require_once(dirname(__FILE__).'/formatter.php');
        return new XimeniaSplitMenuFormatter($args);
    }

    public function getLayout($args){
        require_once(dirname(__FILE__).'/layout.php');
        return new XimeniaSplitMenuLayout($args);
    }
}
