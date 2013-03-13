<?php
/**
 * @version   $Id$
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

global $RokSprocket_plugin_path, $RokSprocket_plugin_url;
?>

<div style="margin: 0 auto;">
    <div>

        <div style="float:left;clear:none;">
            <?php echo $that->searchbox; ?>
        </div>
        <div style="float:left;clear:none;">
            <?php echo $that->typelist; ?>
        </div>
    </div>
    <div style="clear:both;"></div>

    <table cellspacing="0" class="widefat" style="margin: 0 auto;">
        <thead>
        <tr>
            <th align="left">
                <span>Title</span>
                <a class="arrow_up"
                   href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'title', 'order' => 'ASC'));?>"><img
                    src="<?php echo $that->images_path;?>bullet_arrow_up.png" width="16" height="16" alt="" title=""
                    style="vertical-align:middle;"/></a>
                <a class="arrow_down"
                   href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'title', 'order' => 'DESC'));?>"><img
                    src="<?php echo $that->images_path;?>bullet_arrow_down.png" width="16" height="16" alt=""
                    title=""
                    style="vertical-align:middle;"/></a>
            </th>

            <th align="left">
                <span>PodType</span>
                <a class="arrow_up"
                   href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'pod_type', 'order' => 'ASC'));?>"><img
                    src="<?php echo $that->images_path;?>bullet_arrow_up.png" width="16" height="16" alt="" title=""
                    style="vertical-align:middle;"/></a>
                <a class="arrow_down"
                   href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'pod_type', 'order' => 'DESC'));?>"><img
                    src="<?php echo $that->images_path;?>bullet_arrow_down.png" width="16" height="16" alt=""
                    title=""
                    style="vertical-align:middle;"/></a>
            </th>

            <th align="left">
                <span>Date</span>
                <a class="arrow_up"
                   href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'post_date', 'order' => 'ASC'));?>"><img
                    src="<?php echo $that->images_path;?>bullet_arrow_up.png" width="16" height="16" alt="" title=""
                    style="vertical-align:middle;"/></a>
                <a class="arrow_down"
                   href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'post_date', 'order' => 'DESC'));?>"><img
                    src="<?php echo $that->images_path;?>bullet_arrow_down.png" width="16" height="16" alt=""
                    title=""
                    style="vertical-align:middle;"/></a>
            </th>
        </tr>

        </thead>
        <tbody>

        <?php $j = 0; foreach ($that->posts as $post) : $j++; ?>
        <tr class="<?php echo (($j % 2 == 0) ? 'alternate ' : '');?>iedit">
            <td>
                <a class="article-link"
                   href="#"
                   rel="<?php echo 'permalink'?>"
                   title="<?php echo $post->post_title;?>"
                   pid="<?php echo $post->post_id?>"
                   ptype="<?php echo $post->pod_type?>">
                    <span><?php echo $post->post_title; ?></span></a>
            </td>
            <td>
                <a class="thickbox"
                   href="<?php echo RokCommon_URL::updateParams($that->link, array('pod_type' => $post->pod_type_id));?>">
                    <span><?php echo $post->pod_type; ?></span></a>
            </td>
            <td>
                <span><?php echo $post->post_date; ?></span>
            </td>
        </tr>
            <?php endforeach; ?>

        </tbody>
        <tfoot>
        <tr>
            <td class="pagination" align="center">
                <div class="aligncenter"></div>
                <?php
                if ($that->total_pages > 1) {
                    for ($k = 1; $k <= $that->total_pages; $k++) {
                        if ($k == $that->paged) {
                            ?>
                            <span class=""><?php echo $k?></span>
                            <?php } else { ?>
                            <a class=""
                               href="<?php echo RokCommon_URL::updateParams($that->link, array('paged' => $k))?>"><?php echo $k?></a>
                            <?php
                        }
                    }
                }
                ?>
</div>
</td>
</tr>
</tfoot>
</table>
</div>


<div style="clear:both;"></div>
