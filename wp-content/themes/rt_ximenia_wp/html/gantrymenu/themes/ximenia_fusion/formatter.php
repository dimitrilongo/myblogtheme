<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
 
class XimeniaFusionMenuFormatter extends AbstractRokMenuFormatter {

	protected $passes = 0;

    function format_subnode(&$node) {
    
    	// Add first-item class to the list
    	if ($this->passes == 0) {
    		$node->addListItemClass("first-item");
    	}
    	
    	$this->passes++;
    
        // Format the current node
        if ($node->hasChildren()) {
            $node->addLinkClass("daddy");
        } else {
            $node->addLinkClass("orphan");
        }

        $node->addLinkClass("item");

        if ($node->getLevel() == "0") {
            $node->addListItemClass("root");
        }
    }
}