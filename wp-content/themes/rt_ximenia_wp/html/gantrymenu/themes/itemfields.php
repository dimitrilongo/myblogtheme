<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class GantryMenuItemFieldsDefault {
    public $fields = array(
        'gantrymenu_subtext',
        'gantrymenu_icon',
        'gantrymenu_submenu_cols',
       	'gantrymenu_fusion_distribution',
       	'gantrymenu_fusion_manual_distribution',
        'gantrymenu_fusion_children_group',
        'gantrymenu_fusion_dropdown_width',
        'gantrymenu_fusion_column_widths'
    );

    public function renderFields($item_id, $item, $depth, $args) {
        global $gantry;

        ob_start();
        ?>
        <p class="field-gantrymenu_subtext description description-thin">
            <label for="edit-menu-item-gantrymenu_subtext-<?php echo $item_id; ?>">
            <?php _e('Subtext'); ?><br/>
                <input type="text" id="edit-menu-item-gantrymenu_subtext-<?php echo $item_id; ?>"
                       class="widefat code edit-menu-item-gantrymenu_subtext"
                       name="menu-item-gantrymenu_subtext[<?php echo $item_id; ?>]"
                       value="<?php echo esc_attr($item->gantrymenu_subtext); ?>"/>
            </label>
        </p>
        <p class="field-gantrymenu_icon description description-thin">
            <label for="edit-menu-item-gantrymenu_icon-<?php echo $item_id; ?>">
            <?php _e('Icon'); ?><br/>
                <select id="edit-menu-item-gantrymenu_icon-<?php echo $item_id; ?>"
                        class="widefat edit-menu-item-gantrymenu_icon"
                        name="menu-item-gantrymenu_icon[<?php echo $item_id; ?>]">
                    <option value=""<?php if (esc_attr($item->gantrymenu_icon) == ''): ?>
                            selected="selected"<?php endif;?>></option>
                <?php
                $icon_path = $gantry->templatePath . '/images/icons';
                $icons = array();
                if (file_exists($icon_path) && is_dir($icon_path)) {
                    $d = dir($icon_path);
                    while (false !== ($entry = $d->read())) {
                        if (!preg_match('/^\./', $entry) && preg_match('/\.png$/', $entry)) {
                            $icon_name = basename($entry, '.png');
                            $icons[$entry] = $icon_name;
                        }
                    }
                }?>
                <?php foreach ($icons as $iconurl => $iconname): ?>
                    <option value="<?php echo $iconurl;?>"<?php if (esc_attr($item->gantrymenu_icon) == $iconurl): ?>
                            selected="selected"<?php endif;?>><?php echo $iconname;?></option>
                <?php endforeach;?>
                </select>
            </label>
        </p>
        <p class="field-gantrymenu_submenu_cols description description-thin">
            <label for="edit-menu-item-gantrymenu_submenu_cols-<?php echo $item_id; ?>">
            <?php _e('Number of Columns in Submenu'); ?><br/>
                <select id="edit-menu-item-gantrymenu_submenu_cols-<?php echo $item_id; ?>"
                        class="widefat edit-menu-item-gantrymenu_submenu_cols"
                        name="menu-item-gantrymenu_submenu_cols[<?php echo $item_id; ?>]">
                    <option value="1"<?php if (esc_attr($item->gantrymenu_submenu_cols) == 1): ?> selected="selected"<?php endif;?>>1</option>
                    <option value="2"<?php if (esc_attr($item->gantrymenu_submenu_cols) == 2): ?> selected="selected"<?php endif;?>>2</option>
                    <option value="3"<?php if (esc_attr($item->gantrymenu_submenu_cols) == 3): ?> selected="selected"<?php endif;?>>3</option>
                    <option value="4"<?php if (esc_attr($item->gantrymenu_submenu_cols) == 4): ?> selected="selected"<?php endif;?>>4</option>
                </select>
            </label>
        </p>
        <p class="field-gantrymenu_fusion_distribution description description-thin">
            <label for="gantrymenu_fusion_distribution">
            <?php _e('Item Distribution'); ?><br/>
            	<input id="gantrymenu_fusion_distributioneven-<?php echo $item_id; ?>" type="radio" value="evenly" name="menu-item-gantrymenu_fusion_distribution[<?php echo $item_id; ?>]" <?php if (esc_attr($item->gantrymenu_fusion_distribution) == 'evenly' || esc_attr($item->gantrymenu_fusion_distribution) == ''): ?> checked="checked"<?php endif;?> />
            	<label for="gantrymenu_fusion_distributioneven-<?php echo $item_id; ?>"><?php _e('Evenly'); ?></label>         	
            	<input id="gantrymenu_fusion_distributionorder-<?php echo $item_id; ?>" type="radio" value="inorder" name="menu-item-gantrymenu_fusion_distribution[<?php echo $item_id; ?>]" <?php if (esc_attr($item->gantrymenu_fusion_distribution) == 'inorder'): ?> checked="checked"<?php endif;?> />
            	<label for="gantrymenu_fusion_distributionorder-<?php echo $item_id; ?>"><?php _e('In Order'); ?></label>
            	<input id="gantrymenu_fusion_distributionmanual-<?php echo $item_id; ?>" type="radio" value="manual" name="menu-item-gantrymenu_fusion_distribution[<?php echo $item_id; ?>]" <?php if (esc_attr($item->gantrymenu_fusion_distribution) == 'manual'): ?> checked="checked"<?php endif;?> />
            	<label for="gantrymenu_fusion_distributionmanual-<?php echo $item_id; ?>"><?php _e('Manually'); ?></label>
            </label>
        </p>
        <p class="field-gantrymenu_fusion_manual_distribution description description-thin">
            <label for="edit-menu-item-gantrymenu_fusion_manual_distribution-<?php echo $item_id; ?>">
            <?php _e('Manual Item Distribution'); ?><br/>
                <input type="text" id="edit-menu-item-gantrymenu_fusion_manual_distribution-<?php echo $item_id; ?>"
                       class="widefat code edit-menu-item-gantrymenu_fusion_manual_distribution"
                       name="menu-item-gantrymenu_fusion_manual_distribution[<?php echo $item_id; ?>]"
                       value="<?php echo esc_attr($item->gantrymenu_fusion_manual_distribution); ?>"/>
            </label>
        </p>
        <p class="field-gantrymenu_fusion_children_group description description-thin">
            <label for="edit-menu-item-gantrymenu_fusion_children_group-<?php echo $item_id; ?>">
            <?php _e('Group Child Items'); ?><br/>
                <select id="edit-menu-item-gantrymenu_fusion_children_group-<?php echo $item_id; ?>"
                        class="widefat edit-menu-item-gantrymenu_fusion_children_group"
                        name="menu-item-gantrymenu_fusion_children_group[<?php echo $item_id; ?>]">
                    <option value="0"<?php if (esc_attr($item->gantrymenu_fusion_children_group) == 0): ?> selected="selected"<?php endif;?>>No</option>
                    <option value="1"<?php if (esc_attr($item->gantrymenu_fusion_children_group) == 1): ?> selected="selected"<?php endif;?>>Yes</option>
                </select>
            </label>
        </p>
        <p class="field-gantrymenu_fusion_dropdown_width description description-thin">
            <label for="edit-menu-item-gantrymenu_fusion_dropdown_width-<?php echo $item_id; ?>">
            <?php _e('Drop-Down Width (px)'); ?><br/>
                <input type="text" id="edit-menu-item-gantrymenu_fusion_dropdown_width-<?php echo $item_id; ?>"
                       class="widefat code edit-menu-item-gantrymenu_fusion_dropdown_width"
                       name="menu-item-gantrymenu_fusion_dropdown_width[<?php echo $item_id; ?>]"
                       value="<?php echo esc_attr($item->gantrymenu_fusion_dropdown_width); ?>"/>
            </label>
        </p>
        <p class="field-gantrymenu_fusion_column_widths description description-thin">
            <label for="edit-menu-item-gantrymenu_fusion_column_widths-<?php echo $item_id; ?>">
            <?php _e('Column Widths (px)'); ?><br/>
                <input type="text" id="edit-menu-item-gantrymenu_fusion_column_widths-<?php echo $item_id; ?>"
                       class="widefat code edit-menu-item-gantrymenu_fusion_column_widths"
                       name="menu-item-gantrymenu_fusion_column_widths[<?php echo $item_id; ?>]"
                       value="<?php echo esc_attr($item->gantrymenu_fusion_column_widths); ?>"/>
            </label>
        </p>

        <script type="text/javascript">
            ((function(){
            var evenly = document.id('gantrymenu_fusion_distributioneven-<?php echo $item_id; ?>'),
                inorder = document.id('gantrymenu_fusion_distributionorder-<?php echo $item_id; ?>'),
                manually = document.id('gantrymenu_fusion_distributionmanual-<?php echo $item_id; ?>'),
                field = document.id('edit-menu-item-gantrymenu_fusion_manual_distribution-<?php echo $item_id; ?>');

            $$(evenly, inorder, manually).addEvent('click', function(){
                var isManual = this.id.contains('gantrymenu_fusion_distributionmanual');
                if (!isManual) field.getParent('p').setStyle('display', 'none');
                else field.getParent('p').setStyle('display', 'block');
            }).filter(function(input){ return input.get('checked'); }).fireEvent('click');

            })());
        </script>

        <?php
        echo ob_get_clean();
    }
}
