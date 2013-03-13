<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
 
class XimeniaTouchMenuTheme extends AbstractRokMenuTheme {

    protected $defaults = array(

    );

    public function getFormatter($args){
        require_once(dirname(__FILE__).'/formatter.php');
        return new XimeniaTouchMenuFormatter($args);
    }

    public function getLayout($args){
        require_once(dirname(__FILE__).'/layout.php');
        return new XimeniaTouchMenuLayout($args);
    }
}
