<?php
/**
 * @version   $Id$
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

if (!defined('ABSPATH'))
    die('You are not allowed to call this page directly.');

global $wpdb;
//rs_load_class('RokSprocket_Forms_Fields_Widgetpicker');

@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RokSprocket</title>
    <meta http-equiv="Content-Type"
          content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>"/>
    <?php wp_head();?>
    <script type ="text/javascript" >
        window.addEvent('domready', function () {
            document.id('rs_shorttag_insert').addEvent('click', function (e) {
                e.preventDefault();
                var roksprocket_id = document.id('rs_shorttag_select').getSelected().get('value');
                if(roksprocket_id=='') {
                    alert("None Selected! Please Select a RokSprocket Widget to Insert!");
                } else {
                    var shorttag = '[roksprocket id="' + roksprocket_id + '"]';
                    var wpActiveEditor = 'content';
                    if (window.tinyMCE) {
                        window.tinyMCE.execCommand('mceInsertContent', false, shorttag);
                    } else if (window.parent.QTags) {
                        window.parent.QTags.insertContent(shorttag);
                    }

                    window.parent.tb_remove();
                }
            })
        });
    </script>
    <base target="_self"/>
</head>
<body id="link rs_tinymce_window"  onload="" style="height:130px;width:400px;min-width:0px;">
<div>
    <div class="alignleft actions page-header wrap">
        <div class="icon32" id="icon-roksprocket"></div>
        <h2>RokSprocket</h2>
    </div>
    <div class="alignleft actions select-label">Widget Selection</div>
    <div class="alignleft actions" style="margin-top:5px;margin-left:15px;">
        <div class="alignleft actions">
            <?php
            $instances = RokSprocket_Model_Widgets::getAvailableInstances();
            $instancesselect = '<select id="rs_shorttag_select">';
            foreach ($instances as $instance) {
                $instancesselect .= '<option value="' . $instance['id'] . '">' . ucwords($instance['title']) . '</option>';
            }
            $instancesselect .= '</select>';
            echo $instancesselect;
            ?>
        </div>
        <div  class="alignleft actions" style="margin-top: 5px;">
            <a href="#" id="rs_shorttag_insert" class="button action">
                <span>Insert</span>
            </a>
        </div>
    </div>
</div>
</body>
</html>
