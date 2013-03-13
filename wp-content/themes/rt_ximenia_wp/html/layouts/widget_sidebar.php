<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrylayout');

/**
 *
 * @package gantry
 * @subpackage html.layouts
 */
class GantryLayoutWidget_Sidebar extends GantryLayout {
    var $render_params = array(
        'contents'       =>  null,
        'position'      =>  null,
        'gridCount'     =>  null,
        'pushPull'      =>  '',
        'extraClass' => ''
    );
    function render($params = array()){
        global $gantry;

        $chars = "abcdefghijk";
        $params = $gantry->renderLayout("chrome_".$params[0]['chrome'], $params);

        $params[0]['position_open'] ='';
        $params[0]['position_close'] ='';

        $rparams = $this-> _getParams($params[0]);
        $start_tag = "";

        if (null != $rparams->widget_map[$rparams->position]['pushPull'] && trim($rparams->widget_map[$rparams->position]['pushPull']) != '') {
            $sidebar_side = 'sidebar-left';
        } else {
            $sidebar_side = 'sidebar-right';
        }
        
        $classes = trim('rt-grid-'.trim($rparams->widget_map[$rparams->position]['gridCount']." ".$sidebar_side." ".$rparams->widget_map[$rparams->position]['pushPull']." ".$rparams->widget_map[$rparams->position]['extraClass']));
		$classes = preg_replace('/\s\s+/', ' ', $classes);
        
        // see if this is the first widget in the postion
        if (property_exists($rparams,'start') && $rparams->start == $rparams->widget_id) {
            ob_start();
            ?>
            <div class="<?php echo $classes;?>">
                <div id="rt-sidebar-<?php echo substr($chars,$rparams->position-1,1); ?>">
            <?php
            $start_tag = ob_get_clean();
            $params[0]['position_open']  = $start_tag;
        }

        if (property_exists($rparams,'end') && $rparams->end == $rparams->widget_id) {
             $params[0]['position_close'] = "</div></div>";
        }
        
        $params[0]['before_widget'] = $params[0]['position_open'].$params[0]['before_widget'] ;
        $params[0]['after_widget'] = $params[0]['after_widget'] . $params[0]['position_close'];
        
        return $params;
    }
}