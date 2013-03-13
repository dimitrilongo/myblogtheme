<?php
        function replace_token_url($var){
        $out = $var;
        if (is_string($var)){
            $out = str_replace("@RT_SITE_URL@", get_bloginfo("wpurl"), $var);
        }
        return $out;
    }

    function filter_token_url($value, $oldvalue) {
        if (is_array($value)){
            return multidimensionalArrayMap("replace_token_url", $value);
        }
        else if (is_string($value))
            return replace_token_url($value);
        else
            return $value;
    }

    function multidimensionalArrayMap( $func, $arr )
    {
    $newArr = array();
    foreach( $arr as $key => $value )
        {
        $newArr[ $key ] = ( is_array( $value ) ? multidimensionalArrayMap( $func, $value ) : $func( $value ) );
        }
    return $newArr;
   }

    // unpublish hellow world
     $hello_world = array();
     $hello_world["ID"] = 1;
     $hello_world["post_status"] = "draft";
     wp_update_post( $hello_world );
      
    
        add_filter('pre_update_option_rt_ximenia_wp-template-options', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options',array (
  'template_full_name' => 'Ximenia',
  'template_author' => 'RocketTheme',
  'grid_system' => '12',
  'template_prefix' => 'ximenia-',
  'cookie_time' => '31536000',
  'name' => 'Preset1',
  'copy_lang_files_if_diff' => '1',
  'custom_widget_variations' => '1',
  'custom_widget_background' => '0',
  'blog' => 
  array (
    'cat' => '',
    'count' => '2',
    'lead-items' => '0',
    'columns' => '2',
    'type' => 'post',
    'content' => 'content',
    'order' => 'date',
    'page-title' => '',
    'title' => '1',
    'link-title' => '0',
    'meta-author' => '0',
    'meta-date' => '0',
    'meta-modified' => '0',
    'meta-comments' => '0',
    'meta-link-comments' => '0',
    'meta-category' => '0',
    'meta-link-category' => '1',
    'meta-category-parent' => '0',
    'meta-link-category-parent' => '0',
    'readmore' => 'Read more ...',
    'query' => '',
  ),
  'page' => 
  array (
    'title' => '1',
    'meta-author' => '0',
    'meta-date' => '0',
    'meta-modified' => '0',
    'meta-comments' => '0',
    'comments-form' => '0',
  ),
  'post' => 
  array (
    'title' => '1',
    'meta-author' => '1',
    'meta-date' => '1',
    'meta-modified' => '0',
    'meta-comments' => '1',
    'meta-category' => '0',
    'meta-link-category' => '1',
    'meta-category-parent' => '0',
    'meta-link-category-parent' => '0',
    'tags' => '1',
    'footer' => '1',
    'comments-form' => '0',
  ),
  'category' => 
  array (
    'count' => '5',
    'content' => 'content',
    'custom-page-title' => '',
    'page-title' => '1',
    'title' => '1',
    'link-title' => '0',
    'meta-author' => '1',
    'meta-date' => '1',
    'meta-modified' => '0',
    'meta-comments' => '1',
    'meta-link-comments' => '0',
    'meta-category' => '0',
    'meta-link-category' => '1',
    'meta-category-parent' => '0',
    'meta-link-category-parent' => '0',
    'readmore' => 'Read more ...',
  ),
  'archive' => 
  array (
    'count' => '5',
    'content' => 'content',
    'custom-page-title' => '',
    'page-title' => '1',
    'title' => '1',
    'link-title' => '0',
    'meta-author' => '1',
    'meta-date' => '1',
    'meta-modified' => '0',
    'meta-comments' => '1',
    'meta-link-comments' => '0',
    'meta-category' => '0',
    'meta-link-category' => '1',
    'meta-category-parent' => '0',
    'meta-link-category-parent' => '0',
    'readmore' => 'Read more ...',
  ),
  'tags' => 
  array (
    'count' => '5',
    'content' => 'content',
    'custom-page-title' => '',
    'page-title' => '1',
    'title' => '1',
    'link-title' => '0',
    'meta-author' => '1',
    'meta-date' => '1',
    'meta-modified' => '0',
    'meta-comments' => '1',
    'meta-link-comments' => '0',
    'meta-category' => '0',
    'meta-link-category' => '1',
    'meta-category-parent' => '0',
    'meta-link-category-parent' => '0',
    'readmore' => 'Read more ...',
  ),
  'search' => 
  array (
    'count' => '5',
    'content' => 'content',
    'page-title' => '1',
    'title' => '1',
    'link-title' => '0',
    'meta-author' => '1',
    'meta-date' => '1',
    'meta-modified' => '0',
    'meta-comments' => '1',
    'meta-link-comments' => '0',
    'meta-category' => '0',
    'meta-link-category' => '1',
    'meta-category-parent' => '0',
    'meta-link-category-parent' => '0',
    'readmore' => 'Read more ...',
  ),
  'thumbnails-enabled' => '1',
  'logo' => 
  array (
    'type' => 'ximenia',
    'custom' => 
    array (
      'image' => '',
    ),
  ),
  'main' => 
  array (
    'body' => 'light',
    'accent' => '#47B6E3',
    'bg' => 'blue',
  ),
  'loadtransition' => '1',
  'pagination' => 
  array (
    'style' => 'full',
    'count' => '8',
  ),
  'thumb' => 
  array (
    'width' => '336',
    'height' => '212',
    'position' => 'right',
  ),
  'webfonts' => 
  array (
    'enabled' => '0',
    'source' => 'google',
  ),
  'font' => 
  array (
    'family' => 'ximenia',
    'size' => 'default',
    'size-is' => 'default',
  ),
  'wordpress-comments' => '1',
  'customcss' => '',
  'rtl-priority' => '7',
  'childcss-priority' => '100',
  'thumbnails-priority' => '1',
  'webfonts-priority' => '5',
  'styledeclaration-enabled' => '1',
  'searchhighlight-enabled' => '1',
  'pagesuffix' => 
  array (
    'enabled' => '0',
    'class' => '',
    'priority' => '2',
  ),
  'feedlinks' => 
  array (
    'enabled' => '1',
    'priority' => '1',
  ),
  'smartload' => 
  array (
    'enabled' => '1',
    'text' => '200',
    'exclusion' => '',
    'priority' => '11',
  ),
  'title' => 
  array (
    'format' => '',
    'priority' => '5',
  ),
  'typographyshortcodes' => 
  array (
    'enabled' => '1',
    'priority' => '2',
  ),
  'widgetshortcodes' => 
  array (
    'enabled' => '1',
    'priority' => '2',
  ),
  'rokstyle' => 
  array (
    'enabled' => '1',
    'priority' => '5',
  ),
  'analytics' => 
  array (
    'enabled' => '0',
    'code' => '',
    'priority' => '3',
  ),
  'top' => 
  array (
    'layout' => '3,3,3,3',
    'showall' => '0',
    'showmax' => '6',
  ),
  'navigation' => 
  array (
    'layout' => 'a:1:{i:12;a:1:{i:2;a:2:{i:0;i:3;i:1;i:9;}}}',
    'showall' => '0',
    'showmax' => '6',
  ),
  'header' => 
  array (
    'layout' => '3,3,3,3',
    'showall' => '0',
    'showmax' => '6',
  ),
  'showcase' => 
  array (
    'layout' => '3,3,3,3',
    'showall' => '0',
    'showmax' => '6',
  ),
  'feature' => 
  array (
    'layout' => '3,3,3,3',
    'showall' => '0',
    'showmax' => '6',
  ),
  'utility' => 
  array (
    'layout' => '3,3,3,3',
    'showall' => '0',
    'showmax' => '6',
  ),
  'maintop' => 
  array (
    'layout' => '3,3,3,3',
    'showall' => '0',
    'showmax' => '6',
  ),
  'mainbodyPosition' => 'a:1:{i:12;a:1:{i:2;a:2:{s:2:"mb";i:8;s:2:"sa";i:4;}}}',
  'mainbottom' => 
  array (
    'layout' => '3,3,3,3',
    'showall' => '0',
    'showmax' => '6',
  ),
  'extension' => 
  array (
    'layout' => '3,3,3,3',
    'showall' => '0',
    'showmax' => '6',
  ),
  'bottom' => 
  array (
    'layout' => '3,3,3,3',
    'showall' => '0',
    'showmax' => '6',
  ),
  'footer-position' => 
  array (
    'layout' => '3,3,3,3',
    'showall' => '0',
    'showmax' => '6',
  ),
  'copyright' => 
  array (
    'layout' => '3,3,3,3',
    'showall' => '0',
    'showmax' => '6',
  ),
  'loadposition-enabled' => '1',
  'layout-mode' => 'responsive',
  'maintenancemode' => 
  array (
    'enabled' => '0',
    'message' => 'Site is currently in the maintenance mode. Please try again later.',
  ),
  'cache' => 
  array (
    'enabled' => '0',
    'time' => '900',
  ),
  'gzipper' => 
  array (
    'enabled' => '0',
    'time' => '600',
    'expirestime' => '1440',
    'stripwhitespace' => '1',
  ),
  'component-enabled' => '1',
  'mainbody-enabled' => '1',
  'rtl-enabled' => '1',
  'typography' => 
  array (
    'enabled' => '1',
    'style' => 'light',
  ),
  'autoparagraphs' => 
  array (
    'enabled' => '1',
    'type' => 'both',
    'priority' => '5',
  ),
  'texturize-enabled' => '0',
  'contact-email' => '',
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-1', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-1',array (
  'blog' => 
  array (
    'page-title' => 'Latest News.',
    'title' => '0',
  ),
  'pagesuffix' => 
  array (
    'enabled' => '1',
    'class' => '-feb13-home',
    'priority' => '2',
  ),
  'maintop' => 
  array (
    'layout' => 'a:1:{i:12;a:2:{i:4;a:4:{i:0;i:3;i:1;i:3;i:2;i:3;i:3;i:3;}i:2;a:2:{i:0;i:9;i:1;i:3;}}}',
    'showall' => '0',
    'showmax' => '6',
  ),
  'mainbodyPosition' => 'a:1:{i:12;a:1:{i:2;a:2:{s:2:"mb";i:9;s:2:"sa";i:3;}}}',
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-1', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-2', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-2',array (
  'page' => 
  array (
    'title' => '0',
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-2', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-3', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-3',array (
  'mainbodyPosition' => 'a:1:{i:12;a:1:{i:2;a:2:{s:2:"mb";i:6;s:2:"sa";i:6;}}}',
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-3', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-5', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-5',array (
  'page' => 
  array (
    'title' => '1',
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-5', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-7', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-7',array (
  'page' => 
  array (
    'title' => '0',
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-7', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-1', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-assignments-1',array (
  'templatepage' => 
  array (
    'home' => true,
    'front_page' => true,
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-1', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-2', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-assignments-2',array (
  'post_type' => 
  array (
    'page' => 
    array (
      0 => 27,
    ),
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-2', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-3', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-assignments-3',array (
  'post_type' => 
  array (
    'page' => 
    array (
      0 => 36,
    ),
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-3', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-4', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-assignments-4',array (
  'post_type' => 
  array (
    'page' => 
    array (
      0 => 39,
    ),
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-4', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-5', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-assignments-5',array (
  'post_type' => 
  array (
    'page' => 
    array (
      0 => 33,
    ),
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-5', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-6', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-assignments-6',array (
  'post_type' => 
  array (
    'page' => 
    array (
      0 => 542,
    ),
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-6', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-7', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-assignments-7',array (
  'post_type' => 
  array (
    'page' => 
    array (
      0 => 7,
    ),
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-7', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-8', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-assignments-8',array (
  'post_type' => 
  array (
    'page' => 
    array (
      0 => 42,
    ),
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-8', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-9', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-assignments-9',array (
  'post_type' => 
  array (
    'page' => 
    array (
      0 => 94,
    ),
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-assignments-9', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-1', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-sidebar-1',array (
  'wp_inactive_widgets' => 
  array (
  ),
  'showcase' => 
  array (
    0 => 'roksprocket_options-10014',
  ),
  'maintop' => 
  array (
    0 => 'roksprocket_options-10015',
    1 => 'text-10006',
    2 => 'gantrydivider-10007',
    3 => 'gantry_social-10002',
    4 => 'text-10005',
    5 => 'rokajaxsearch-10002',
  ),
  'sidebar' => 
  array (
    0 => 'widget-roktwittie-10002',
    1 => 'text-10007',
    2 => 'roksprocket_options-10013',
    3 => 'text-10012',
  ),
  'content-top' => 
  array (
    0 => 'text-10008',
    1 => 'text-10011',
    2 => 'gantrydivider-10008',
    3 => 'text-10009',
    4 => 'text-10010',
  ),
  'content-bottom' => 
  array (
    0 => 'rokgallery_options-10003',
  ),
  'bottom' => 
  array (
    0 => 'text-10013',
  ),
  'footer-position' => 
  array (
    0 => 'text-10014',
    1 => 'gantrydivider-10009',
    2 => 'text-10015',
    3 => 'gantrydivider-10010',
    4 => 'text-10016',
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-1', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-2', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-sidebar-2',array (
  'sidebar' => 
  array (
  ),
  'wp_inactive_widgets' => 
  array (
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-2', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-3', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-sidebar-3',array (
  'sidebar' => 
  array (
    0 => 'text-30005',
    1 => 'text-30006',
    2 => 'text-30007',
  ),
  'mainbottom' => 
  array (
    0 => 'text-30008',
  ),
  'footer-position' => 
  array (
    0 => 'text-30009',
    1 => 'gantrydivider-30007',
    2 => 'text-30010',
  ),
  'wp_inactive_widgets' => 
  array (
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-3', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-4', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-sidebar-4',array (
  'wp_inactive_widgets' => 
  array (
  ),
  'sidebar' => 
  array (
    0 => 'text-40015',
    1 => 'text-40016',
    2 => 'text-40017',
    3 => 'text-40018',
  ),
  'content-bottom' => 
  array (
    0 => 'text-40005',
    1 => 'text-40006',
    2 => 'text-40009',
    3 => 'text-40010',
    4 => 'text-40013',
    5 => 'gantrydivider-40007',
    6 => 'text-40007',
    7 => 'text-40008',
    8 => 'text-40011',
    9 => 'text-40012',
    10 => 'text-40014',
  ),
  'footer-position' => 
  array (
    0 => 'text-40019',
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-4', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-5', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-sidebar-5',array (
  'sidebar' => 
  array (
  ),
  'wp_inactive_widgets' => 
  array (
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-5', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-6', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-sidebar-6',array (
  'sidebar' => 
  array (
    0 => 'text-60005',
    1 => 'text-60006',
    2 => 'text-60007',
    3 => 'gantry_loginform-60003',
  ),
  'footer-position' => 
  array (
    0 => 'text-60008',
    1 => 'gantrydivider-60007',
    2 => 'text-60009',
    3 => 'gantrydivider-60008',
    4 => 'text-60010',
  ),
  'wp_inactive_widgets' => 
  array (
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-6', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-7', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-sidebar-7',array (
  'wp_inactive_widgets' => 
  array (
  ),
  'top' => 
  array (
    0 => 'roksprocket_options-80014',
  ),
  'sidebar' => 
  array (
  ),
  'content-bottom' => 
  array (
    0 => 'roksprocket_options-80013',
  ),
  'footer-position' => 
  array (
    0 => 'text-70005',
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-7', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-8', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-sidebar-8',array (
  'wp_inactive_widgets' => 
  array (
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-8', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-9', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-sidebar-9',array (
  'feature' => 
  array (
    0 => 'text-90005',
  ),
  'footer-position' => 
  array (
    0 => 'text-90006',
    1 => 'gantrydivider-90007',
    2 => 'text-90007',
  ),
  'wp_inactive_widgets' => 
  array (
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-sidebar-9', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-1', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-widgets-1',array (
  'widget_gantry_menu' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_loginform' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_meta' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_roksprocket_options' => 
  array (
    10013 => 
    array (
      'title' => 'Ximenia Guide',
      'module_id' => '18',
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title2',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => 'titletabs',
    ),
    '_multiwidget' => 1,
    10014 => 
    array (
      'title' => '',
      'module_id' => '19',
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => 'noblock',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    10015 => 
    array (
      'title' => '',
      'module_id' => '20',
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => 'noblock',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => 'nopaddingleft nopaddingright nopaddingbottom demo-sprocket-tabs',
    ),
  ),
  'widget_widget-roktwittie' => 
  array (
    10002 => 
    array (
      'title' => 'Latest Tweets',
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title2',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => 'fp-roktwittie title1',
    ),
    '_multiwidget' => 1,
  ),
  'widget_gantrydivider' => 
  array (
    10007 => 
    array (
    ),
    10008 => 
    array (
    ),
    10009 => 
    array (
    ),
    10010 => 
    array (
    ),
    '_multiwidget' => 1,
  ),
  'widget_gantry_social' => 
  array (
    10002 => 
    array (
      'social-text' => 'Follow Us',
      'social-facebook' => 'https://www.facebook.com/rockettheme',
      'social-twitter' => 'https://twitter.com/#!/rockettheme',
      'social-google' => 'https://plus.google.com/114430407008695950828/posts',
      'social-rss' => 'http://www.rockettheme.com/blog?format=feed&amp;type=rss',
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => 'demo-roksocial',
    ),
    '_multiwidget' => 1,
  ),
  'widget_rokajaxsearch' => 
  array (
    10002 => 
    array (
      'title' => '',
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => 'noblock',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => 'nopaddingleft nopaddingtop nopaddingbottom',
    ),
    '_multiwidget' => 1,
  ),
  'widget_text' => 
  array (
    10005 => 
    array (
      'title' => 'Top Features',
      'text' => '<div class="smallpaddingtop">
  <div class="rt-image rt-floatleft medmarginbottom nomarginright">
    <img src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/frontpage/general/sidebar-1.jpg" alt="image">
    <span class="cornertab"></span>
    <span class="image-description">Fusion with MegaMenu or SplitMenu menu options.</span>
    <span class="corner-symbol">&#043;</span>    
  </div>
  <div class="clear smallmarginbottom">&nbsp;</div>
  <div class="rt-image rt-floatleft medmarginbottom nomarginright">
    <img src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/frontpage/general/sidebar-2.jpg" alt="image">
    <span class="cornertab"></span>
    <span class="image-description">Eight elegant, subtle and conservative styles.</span>
    <span class="corner-symbol">&#043;</span>    
  </div>
  <div class="clear smallmarginbottom">&nbsp;</div>
  <div class="rt-image rt-floatleft medmarginbottom nomarginright">
    <img src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/frontpage/general/sidebar-3.jpg" alt="image">
    <span class="cornertab"></span>
    <span class="image-description">RokSprocket style integration.</span>
    <span class="corner-symbol">&#043;</span>    
  </div>
  <div class="clear"></div>
</div>

<a class="readon smallmargintop smallmarginleft" href="#"><span>See More</span></a>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title2',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => 'fronttabs',
    ),
    10006 => 
    array (
      'title' => 'Interview Creative Director.',
      'text' => '<div class="rt-image rt-floatright">
  <img src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/frontpage/general/maintop-a.jpg" width="336" height="212" alt="image" />
</div>

<p><em class="bold nobold."><strong>Ximenia</strong>, the February 2013 template release, is an elegant, <strong>subtle</strong> and conservative <strong>design</strong>, with <strong>soft</strong> tones and shapes.</em></p>

<p><em class="bold nobold">The theme is perfect for any site that prefers a more <strong>moderate</strong> appearance. An assortment of plugins, such as <strong>RokSprocket</strong> have integrated styling.</em></p>

<a class="readon" href="#"><span>More Information</span></a>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title3',
      'block-variation' => 'noblock',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => 'nomarginbottom',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => 'rt-largetitle',
    ),
    10007 => 
    array (
      'title' => 'More Features',
      'text' => '<ul class="menu">
<li class="item-180"><span class="separator">Multiple Styles</span>
</li><li class="item-181"><span class="separator">Versatile Layout</span>
</li><li class="item-182"><span class="separator">Widget Variants</span>
</li><li class="item-183"><span class="separator">Powerful Menu</span>
</li><li class="item-184"><span class="separator">Beautiful Content</span>
</li><li class="item-186"><span class="separator">RokSprocket Styled</span>
</li><li class="item-187"><span class="separator">Logo Picker</span>
</li><li class="item-188"><span class="separator">WordPress Styled</span>
</li></ul>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title2',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    10008 => 
    array (
      'title' => 'Fusion with MegaMenu',
      'text' => '<span class="icon-check fp-icon"></span>

<h4 class="nomargintop largepaddingtop"><a href="#"><em>A CSS based dropdown menu enhanced by Mootools</em></a></h4>

<div class="clear"></div>

<p><strong>Fusion</strong> has many features, inclusive of, but not limited to: Mootools animations, multiple columns, inline subtext and icons.</p>

<p class="rt-center nomarginbottom"><a class="readon" href="#"><span>See More</span></a></p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title1',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    10009 => 
    array (
      'title' => 'RokSprocket Layouts',
      'text' => '<span class="icon-th fp-icon"></span>

<h4 class="nomargintop largepaddingtop"><a href="#"><em>RokSprocket is a revolutionary content plugin</em></a></h4>

<div class="clear"></div>

<p><strong>RokSprocket</strong> has support for numerous content layout types, these as <strong>Mosaic,</strong> Headlines, Tabs and Features, as shown on this frontpage and <a href="#">subpages</a>.</p>

<p class="rt-center nomarginbottom"><a class="readon" href="#"><span>See More</span></a></p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title1',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    10010 => 
    array (
      'title' => 'Core Gantry Framework',
      'text' => '<div class="rt-image rt-floatleft smallmargintop largemarginbottom">
  <img class="rt-image" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/frontpage/general/content-top-4.jpg" width="99" height="92" alt="image" />
</div>

<p class="smallmargintop"><strong>Gantry provides all major features and functions in the template</strong>, inclusive of the rich, user friendly administrator, the 960 Grid System, iPhone / Android support and more.</p>

<p class="rt-center nomarginbottom"><a class="readon" href="#"><span>See More</span></a></p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => 'center',
    ),
    10011 => 
    array (
      'title' => 'RokGallery Styling',
      'text' => '<span class="icon-list-alt fp-icon"></span>

<h4 class="nomargintop largepaddingtop"><a href="#"><em>RokGallery is a versatile tag-based, feature rich gallery plugin</em></a></h4>

<div class="clear"></div>

<p><strong>RokGallery</strong> is an advanced gallery plugin, resting on a custom tag based architecture. It has an non-destructive <strong>slice editor</strong> to allow you edit photos easily and swiftly. </p>

<p class="rt-center nomarginbottom"><a class="readon" href="#"><span>See More</span></a></p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title1',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    10012 => 
    array (
      'title' => 'Advertisement',
      'text' => '<a href="http://www.rockettheme.com/" target="_blank">
  <span class="rt-image rt-floatleft smallmargintop">
    <img width="190" height="150" alt="RocketTheme" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/frontpage/general/rockettheme.jpg" />
  </span>
</a>
',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title1',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    10013 => 
    array (
      'title' => '',
      'text' => '<ul class="menu">
<li class="item-189"><span class="separator">Template Features</span>
</li><li class="item-190"><span class="separator">Integrated Extensions</span>
</li><li class="item-191"><span class="separator">Preset Styles</span>
</li><li class="item-192"><span class="separator">Powerful Menu</span>
</li><li class="item-193"><span class="separator">Template Tutorials</span>
</li></ul>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => 'horizmenu bottom-menu',
    ),
    10014 => 
    array (
      'title' => 'Top Plugins',
      'text' => '<ul class="dots">
  <li>
    <a href="@RT_SITE_URL@/plugins/">
      <em class="bold">RokSprocket</em>
    </a>
    <br />A <strong>revolutionary</strong> multi-purpose WordPress content widget to display your <strong>content</strong>, in <strong>multliple</strong> formats such as <strong>Tabs</strong>.
  </li>
  <li>
    <a href="@RT_SITE_URL@/plugins/">
      <em class="bold">RokGallery</em>
    </a>
    <br />A powerful <strong>gallery</strong> plugin based on a custom tag <strong>architecture</strong>, with a flexible, non-destructive <strong>slice</strong> editor.
  </li>
</ul>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title3',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => 'largemargintop largepaddingtop',
    ),
    10015 => 
    array (
      'title' => 'Demo Information',
      'text' => '<p><strong>NOTE:</strong> All demo content is for <strong>sample</strong> purposes only, intended to show a live site. All images are licensed from <a target="_blank" href="http://www.shutterstock.com"><strong>ShutterStock</strong></a> for  exclusive use on this <strong>demo</strong> site only.</p>

<p><strong>RocketLauncher</strong> is a custom WordPress package that will <a href="@RT_SITE_URL@/tutorials/rocketlauncher/"><strong>install</strong></a> the <strong>demo</strong> onto your site. Demo images are replaced with <strong>sample images</strong> to avoid any copyright issue.</p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title3',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => 'largemargintop largepaddingtop',
    ),
    10016 => 
    array (
      'title' => 'Contact Details',
      'text' => '<img class="rt-floatleft" alt="image" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/frontpage/general/fp-footer-icon1.png" />
<a href="#"><em class="bold"> 1 (555) 555-555-5555</em></a><br />
<a href="#"><em class="bold"> 1 (555) 555-555-5556</em></a>

<div class="clear largemarginbottom">&nbsp;</div>

<img class="rt-floatleft" alt="image" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/frontpage/general/fp-footer-icon2.png" />
<em class="bold">
  <strong>Ximenia Template LLC</strong><br />
</em>
<em class="bold nobold">
  123 WordPress! Boulevard<br />
  Seattle, WA 00000<br />
  United States of America
</em>

<div class="clear largemarginbottom">&nbsp;</div>

<img class="rt-floatleft" alt="image" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/frontpage/general/fp-footer-icon3.png" />
<em class="bold">noreply@domain.com</em>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title3',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => 'largemargintop largepaddingtop',
    ),
    '_multiwidget' => 1,
  ),
  'widget_rokgallery_options' => 
  array (
    10003 => 
    array (
      'title' => 'Adobe Fireworks PNG Sources Available',
      'gallery_id' => '1',
      'link' => 'rokbox_full',
      'default_menuitem' => '@RT_SITE_URL@/',
      'show_title' => '0',
      'caption' => '0',
      'sort_by' => 'gallery_ordering',
      'sort_direction' => 'ASC',
      'limit_count' => '4',
      'style' => 'light',
      'layout' => 'grid',
      'columns' => '4',
      'arrows' => 'onhover',
      'navigation' => 'thumbnails',
      'animation_type' => 'random',
      'animation_duration' => '500',
      'autoplay_enabled' => '0',
      'autoplay_delay' => '7',
      'showcase_arrows' => 'onhover',
      'showcase_image_position' => 'left',
      'showcase_imgpadding' => '0',
      'showcase_fixedheight' => '0',
      'showcase_animatedheight' => '1',
      'showcase_animation_type' => 'random',
      'showcase_captionsanimation' => 'crossfade',
      'showcase_animation_duration' => '500',
      'showcase_autoplay_enabled' => '0',
      'showcase_autoplay_delay' => '7',
      'showcase_responsive_arrows' => 'onhover',
      'showcase_responsive_image_position' => 'left',
      'showcase_responsive_imgpadding' => '0',
      'showcase_responsive_animation_type' => 'random',
      'showcase_responsive_captionsanimation' => 'crossfade',
      'showcase_responsive_animation_duration' => '500',
      'showcase_responsive_autoplay_enabled' => '0',
      'showcase_responsive_autoplay_delay' => '7',
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title2',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    '_multiwidget' => 1,
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-1', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-2', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-widgets-2',array (
  'widget_gantry_menu' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_loginform' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_meta' => 
  array (
    '_multiwidget' => 1,
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-2', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-3', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-widgets-3',array (
  'widget_gantry_menu' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_loginform' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_meta' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_text' => 
  array (
    30005 => 
    array (
      'title' => 'Gantry Grid Distribution',
      'text' => '<p>Configure at <strong>Admin Dashboard &rarr; Ximenia Theme</strong>, then go to <strong>Layouts</strong> to set the grid widths and allocated positions.</p>

<p class="rt-center"><img src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/widget-positions/grid-distribution.jpg" alt="image" class="rt-image" /></p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    30006 => 
    array (
      'title' => 'Injected Gantry Gizmos',
      'text' => '<p class="rt-center"><img width="412" height="170" alt="Non-Standard Elements" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/widget-positions/injected-features.jpg" class="rt-image" /></p>

<p>There are <strong>Gizmos</strong> that are injected into a site when enabled in the <strong>Administrator</strong>, and are stacked vertically.</p> 

<p>These are the Google Analytics, Page Suffix, Smart Load Images, Typography Shortcodes, Page Class Suffix, RokStyle, Build Title-Spans, Disable Auto Paragraphs, Disable Texturize and IE6 Redirect.</p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    30007 => 
    array (
      'title' => 'Forced Positions',
      'text' => '<p>There are times when you just don\'t want to have your widgets taking up all the room in a horizontal row no matter what the layout. For example you might want to have a widget on the left and a widget on the right, with nothing in the middle.</p>

<p>This is made easy with Gantry with the Force Positions parameter for each layout, allowing you to set the count to a specific row number, such as 4, even if 4 widgets are not published for that row.</p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    30008 => 
    array (
      'title' => 'MainBody/Sidebar Layouts',
      'text' => '<p>Configure at <strong>Admin Dashboard &rarr; Ximenia Theme &rarr; Layouts</strong> the varying Mainbody/Sidebar layout possibilities.</p>

<div class="rt-demo-width-33 rt-center rt-demo-block">
<div class="rt-demo-space">
  <img src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/widget-positions/position-config-mb1.jpg" width="290" height="75" class="rt-image" alt="image"/>
</div>
</div>

<div class="rt-demo-width-33 rt-center rt-demo-block">
<div class="rt-demo-space">
  <img src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/widget-positions/position-config-mb2.jpg" width="290" height="75" class="rt-image" alt="image"/>
</div>
</div>

<div class="rt-demo-width-33 rt-center rt-demo-block">
<div class="rt-demo-space">
  <img src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/widget-positions/position-config-mb3.jpg" width="290" height="75" class="rt-image" alt="image"/>
</div>
</div>

<div class="clear"></div><br />

<p class="attention">Note: If no widgets are assigned to the Sidebar positions, the Mainbody will become full width.</p>

<p class="rt-center"><img class="rt-image" width="920" height="506"  alt="Widget Positions" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/widget-positions/gantry-layout.jpg" /></p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    30009 => 
    array (
      'title' => 'Basic: Using Layouts in Ximenia',
      'text' => '<a rel="rokbox[745 505]" title="Video Tutorial :: Using Gantry Layouts" href="http://gantry-framework.org/videos/wordpress/widget_widths.mp4">
  <img class="rt-image rt-floatleft" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/widget-positions/using-layouts.jpg" alt="Using Layouts" width="150" height="150" /></a>

<p>To find out about <strong>Gantry Layouts</strong> and <strong>Widget Widths</strong>, check out this screencast which covers basic concepts of configuring layout with a combination of widget setting and the Gantry layout control.</p>

<a class="readon smallmargintop" href="http://gantry-framework.org/documentation/wordpress/configure/layouts" target="_blank"><span>View : Using Gantry Layouts</span></a>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    30010 => 
    array (
      'title' => 'Advanced: Adding Widget Positions',
      'text' => '<a rel="rokbox[745 505]" title="Video Tutorial :: Widget Positions" href="http://gantry-framework.org/videos/wordpress/widget_positions.mp4">
  <img class="rt-image rt-floatleft" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/widget-positions/module-positions.jpg" alt="Widge Positions" width="150" height="150" /></a>

<p>Check out this quick screencast on <strong>Widget Positions</strong> to get an overview of how widget positions work within Gantry Framework. Click below to learn how to <strong>add a new row of widget positions</strong>.</p>

<a class="readon smallmargintop" href="http://gantry-framework.org/documentation/wordpress/customize/adding-widget-positions" target="_blank"><span>Learn : Adding Widget Positions</span></a>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    '_multiwidget' => 1,
  ),
  'widget_gantrydivider' => 
  array (
    30007 => 
    array (
    ),
    '_multiwidget' => 1,
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-3', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-4', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-widgets-4',array (
  'widget_text' => 
  array (
    40005 => 
    array (
      'title' => 'title1',
      'text' => '<div class="customtitle1 nomargintop">
	<p>An example widget using the <strong>title1</strong> variation.</p>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title1',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    40006 => 
    array (
      'title' => 'title3',
      'text' => '<div class="customtitle3">
	<p>An example module using the <strong>title3</strong> module class suffix.</p>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title3',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    40007 => 
    array (
      'title' => 'title2',
      'text' => '<div class="customtitle2 nomargintop">
	<p>An example module using the <strong>title2</strong> module class suffix.</p>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title2',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    40008 => 
    array (
      'title' => 'title4',
      'text' => '<div class="customtitle4">
	<p>An example module using the <strong>title4</strong> module class suffix.</p>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title4',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    40009 => 
    array (
      'title' => 'box1',
      'text' => '<div class="custombox1">
	<p>An example module using the <strong>box1</strong> module class suffix.</p>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => 'box1',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    40010 => 
    array (
      'title' => 'box3',
      'text' => '<div class="custombox3">
	<p>An example module using the <strong>box3</strong> module class suffix.</p>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => 'box3',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    40011 => 
    array (
      'title' => 'box2',
      'text' => '<div class="custombox2">
	<p>An example module using the <strong>box2</strong> module class suffix.</p>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => 'box2',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    40012 => 
    array (
      'title' => 'box4',
      'text' => '<div class="custombox4">
	<p>An example module using the <strong>box4</strong> module class suffix.</p>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => 'box4',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    40013 => 
    array (
      'title' => 'rt-largetitle',
      'text' => '<div class="customrt-largetitle">
	<p>An example module using the <strong>rt-largetitle</strong> module class suffix.</p>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'rt-largetitle',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    40014 => 
    array (
      'title' => 'noblock',
      'text' => '<div class="customnoblock">
	<p>An example module using the <strong>noblock</strong> module class suffix.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet nibh.</p>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => 'noblock',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    40015 => 
    array (
      'title' => 'Using a Variation',
      'text' => '<p>Choose any available variations at <strong>Appearance &rarr; Widgets &rarr; <em>Widget</em> &rarr; selectboxes at the bottom of the widget settings</strong>.</p>
<p class="notice nomarginbottom">You can compound multiple variations together such as: <strong><em>box1 title3</em></strong>.</p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    40016 => 
    array (
      'title' => 'box1 title4',
      'text' => '<div class="custombox1 title4">
	<p>An example widget using the <strong>box1 title4</strong> variation.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet nibh.</p>
<a class="readon" href="#"><span>More</span></a>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => 'box1',
      'title-variation' => 'title4',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    40017 => 
    array (
      'title' => 'box2 title2',
      'text' => '<div class="custombox2 title2">
	<p>An example widget using the <strong>box2 title2</strong> variation.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet nibh.</p>
<a class="readon" href="#"><span>More</span></a>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => 'box2',
      'title-variation' => 'title2',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    40018 => 
    array (
      'title' => 'box3 title1',
      'text' => '<div class="custombox3 title1">
	<p>An example widget using the <strong>box3 title1</strong> variation.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet nibh.</p>
<a class="readon" href="#"><span>More</span></a>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => 'box3',
      'title-variation' => 'title1',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    40019 => 
    array (
      'title' => 'Standard Variations: 25 Additional Widget Variations',
      'text' => '<div class="rt-demo-width-33 rt-demo-block nomarginbottom">
<ul class="rt-demo-space">
  <li><strong>rt-center:</strong> centres the content of the widget.</li>
  <li><strong>shadow2-10</strong> adds varying shadows around the widget.</li>
  <li><strong>square, basic:</strong> changes the border style of the widget.</li>
</ul>
</div>
<div class="rt-demo-width-33 rt-demo-block nomarginbottom">
<ul class="rt-demo-space">
  <li><strong>standardcase, uppercase, lowercase:</strong> change the case of the widget title.</li>  
  <li><strong>nomargintop, nomarginright, nomarginbottom, nomarginleft, nomarginall:</strong> removes the various margins around the widget.</li>
</ul>
</div>
<div class="rt-demo-width-33 rt-demo-block nomarginbottom">
<ul class="rt-demo-space">
  <li><strong>nopaddingtop, nopaddingright, nopaddingbottom, nopaddingleft, nopaddingall:</strong> removes the various paddings around the widget</li>
</ul>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    '_multiwidget' => 1,
  ),
  'widget_gantrydivider' => 
  array (
    40007 => 
    array (
    ),
    '_multiwidget' => 1,
  ),
  'widget_gantry_menu' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_loginform' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_meta' => 
  array (
    '_multiwidget' => 1,
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-4', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-5', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-widgets-5',array (
  'widget_gantry_menu' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_loginform' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_meta' => 
  array (
    '_multiwidget' => 1,
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-5', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-6', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-widgets-6',array (
  'widget_gantry_menu' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_loginform' => 
  array (
    60003 => 
    array (
      'title' => 'Member Access',
      'user_greeting' => 'Hi,',
      'pretext' => '',
      'posttext' => '',
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    '_multiwidget' => 1,
  ),
  'widget_gantry_meta' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_text' => 
  array (
    60005 => 
    array (
      'title' => 'Fusion Menu',
      'text' => '<p>A Mootools enhanced CSS dropdown menu, with multi-columns, icons and more.</p>
<a href="#" class="readon"><span>FusionMenu</span></a>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    60006 => 
    array (
      'title' => 'Splitmenu',
      'text' => '<p>A static two level menu with 1st level items in the header area, and all others in the sidebar.</p>
<a href="#" class="readon"><span>SplitMenu</span></a>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    60007 => 
    array (
      'title' => 'No Menu',
      'text' => '<p>An option to remove the menu widget, allowing to use of the WordPress core widgets or 3rd party plugins instead.</p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    60008 => 
    array (
      'title' => 'SubText Line',
      'text' => '<p><img width="260" height="100" alt="Diametric" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/menu-options/subtext.jpg" class="rt-image" /></p>
<p>The option that allows you to insert additional text to the Menu Item Title. There is separate styling for this, making it useful for adding brief descriptions to menu items.</p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    60009 => 
    array (
      'title' => 'Menu Item Image',
      'text' => '<p><img width="260" height="100" alt="Ximenia" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/menu-options/menuimage.jpg" class="rt-image" /></p>
<p>RokNavMenu provides the option to display a small icon image for the menu item. The menu icon can be displayed both for the parent items and the child items.</p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    60010 => 
    array (
      'title' => 'Multiple Columns',
      'text' => '<p><img width="260" height="100" alt="Ximenia" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/menu-options/multiplecols.jpg" class="rt-image" /></p>
<p>Who needs a single dropdown column when you can have as many as you want? Using the built-in configurable parameters, you can make incredible multi column dropdowns.</p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    '_multiwidget' => 1,
  ),
  'widget_gantrydivider' => 
  array (
    60007 => 
    array (
    ),
    60008 => 
    array (
    ),
    '_multiwidget' => 1,
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-6', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-7', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-widgets-7',array (
  'widget_gantry_menu' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_loginform' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_meta' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_text' => 
  array (
    70005 => 
    array (
      'title' => '',
      'text' => '<div class="rt-demo-width-60 rt-demo-block">
  <div class="rt-demo-space">
<h3 class="nobold smallpaddingbottom">All RocketTheme Plugins</h3>
  
  <p>Many of our plugins were developed to accompany RocketTheme themes but we have now created versions that are intended to work independently of our themes if you wish.</p><br/>
  
  <div class="module-title">
    <h3 class="title"><span>Club</span> Plugins</h3>
  </div>
  
  <div class="rt-demo-width-30 rt-demo-block">
    <div class="rt-demo-space">
    <ul class="circle">
      <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/club/2837-rokgallery" target="_blank">RokGallery</a></li>
      <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/club/2621-rokstories" target="_blank">RokStories</a></li>
      <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/club/2620-rokstock" target="_blank">RokStock</a></li>
    </ul>
  </div>
  </div>
  
  <div class="rt-demo-width-30 rt-demo-block">
    <div class="rt-demo-space">
    <ul class="circle">
      <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/club/2619-roknewspager" target="_blank">RokNewsPager</a></li>
      <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/club/2618-rokmicronews" target="_blank">RokMicroNews</a></li>
      <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/club/2617-rokintroscroller" target="_blank">RokIntroScroller</a></li>
    </ul>
  </div>
  </div>
  
  <div class="rt-demo-width-30 rt-demo-block">
    <div class="rt-demo-space">
    <ul class="circle">
      <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/club/2622-rokweather" target="_blank">RokWeather</a></li>
      <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/club/3105-roktwittie" target="_blank">RokTwittie</a></li>
      <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/club/2616-rokfeaturetable" target="_blank">RokFeatureTable</a></li>
    </ul>  
  </div>
  </div>
  
  <div class="clear"></div>
  
  <div class="module-title">
    <h3 class="title"><span>Free</span> Plugins</h3>
  </div>
  <div class="rt-demo-width-30 rt-demo-block">
    <div class="rt-demo-space">
    <ul class="circle nomarginbottom">
      <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/free/2625-rokbox" target="_blank">RokBox</a></li>
      <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/free/2624-rokajaxsearch" target="_blank">RokAjaxSearch</a></li>
    </ul>
    </div>
  </div>
  
  <div class="rt-demo-width-30 rt-demo-block">
    <div class="rt-demo-space">
    <ul class="circle nomarginbottom">
      <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/free/2626-roknewsflash" target="_blank">RokNewsFlash</a></li>
      <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/free/2627-roktabs" target="_blank">RokTabs</a></li>
    </ul>
  </div>
  </div>
  
  <div class="rt-demo-width-30 rt-demo-block">
    <div class="rt-demo-space">
<ul class="circle nomarginbottom">
    <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/free/2623-gantry-buddypress" target="_blank">Gantry BuddyPress</a></li>
    <li><a href="http://www.rockettheme.com/wordpress-downloads/plugins/free/2838-rokcommon" target="_blank">RokCommon</a></li>
</ul>
  </div>
</div>
</div>
</div>

<div class="rt-demo-width-40 rt-demo-block">
  <div class="rt-demo-space">
<p class="alert" style="margin-top: 63px;">NOTE: RokSprocket plugin requires RokCommon 3.1&#43;</p>
  <p>You can download the Ximenia Plugins from:</p>
  
  <ul class="normalfont nomarginbottom checkmark">
    <li><strong>Ximenia Download Page:</strong> <strong><br />rt_ximenia_wp-plugins.zip</strong>. Unzip the file, it contains all the plugins used for Ximenia.</li>
    <li class="nomarginbottom"><strong>RocketTheme Plugins Download Section:</strong><br />Contains all individual plugins are available from the Plugins section of WordPress RokDownloads.</li>
  </ul>
  
  <a href="http://www.rockettheme.com/wordpress-downloads/2565-plugins" target="_blank" class="readon largemargintop floatright"><span>Download : Ximenia Plugins</span></a>
  </div>
</div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    '_multiwidget' => 1,
  ),
  'widget_gantrydivider' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_roksprocket_options' => 
  array (
    80013 => 
    array (
      'title' => '',
      'module_id' => '16',
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => 'noblock nopaddingtop nomargintop',
    ),
    '_multiwidget' => 1,
    80014 => 
    array (
      'title' => '',
      'module_id' => '17',
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => 'noblock mod-flushtop',
    ),
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-7', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-8', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-widgets-8',array (
  'widget_gantry_menu' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_loginform' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_gantry_meta' => 
  array (
    '_multiwidget' => 1,
  ),
  'widget_widget-roktwittie' => 
  array (
    '_multiwidget' => 1,
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-8', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-9', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-override-widgets-9',array (
  'widget_text' => 
  array (
    90005 => 
    array (
      'title' => '8 Preset Styles - Preview Live',
      'text' => '<p class="notice">View all styles live by appending <strong>?presets=preset#</strong> or <strong>&amp;presets=preset#</strong> to the end of your URL such as <strong><a href="#">http://yoursite.com/index.php?presets=preset4</a></strong>.</p>

<p>In sequential order, <strong>Preset 1 - Preset 8</strong>. Please click on the image to load a live example of each style variation.</p>

<div class="rt-demo-width-80" style="margin: 0 auto;">
<a href="@RT_SITE_URL@/?presets=preset1">
  <span class="rt-image rt-floatleft">
    <img class="demo-image" alt="Preset 1" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/styles/ss1.jpg" width="215" height="609" />
  </span>
</a>
<a href="@RT_SITE_URL@/?presets=preset2">
  <span class="rt-image rt-floatleft">
    <img class="demo-image" alt="Preset 2" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/styles/ss2.jpg" width="215" height="609" />
  </span>
</a>
<a href="@RT_SITE_URL@/?presets=preset3">
  <span class="rt-image rt-floatleft">
    <img class="demo-image" alt="Preset 3" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/styles/ss3.jpg" width="215" height="609" />
  </span>
</a>
<a href="@RT_SITE_URL@/?presets=preset4">
  <span class="rt-image rt-floatleft nomarginright">
    <img class="demo-image" alt="Preset 4" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/styles/ss4.jpg" width="215" height="609" />
  </span>
</a>

<div class="clear largemarginbottom">&nbsp;</div>

<a href="@RT_SITE_URL@/?presets=preset5">
  <span class="rt-image rt-floatleft">
    <img class="demo-image" alt="Preset 5" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/styles/ss5.jpg" width="215" height="609" />
  </span>
</a>
<a href="@RT_SITE_URL@/?presets=preset6">
  <span class="rt-image rt-floatleft">
    <img class="demo-image" alt="Preset 6" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/styles/ss6.jpg" width="215" height="609" />
  </span>
</a>
<a href="@RT_SITE_URL@/?presets=preset7">
  <span class="rt-image rt-floatleft">
    <img class="demo-image" alt="Preset 7" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/styles/ss7.jpg" width="215" height="609" />
  </span>
</a>
<a href="@RT_SITE_URL@/?presets=preset8">
  <span class="rt-image rt-floatleft nomarginright">
    <img class="demo-image" alt="Preset 8" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/styles/ss8.jpg" width="215" height="609" />
  </span>
</a>
</div>

<div class="clear"></div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => 'title1',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    90006 => 
    array (
      'title' => 'Creating your own Preset Style(s)',
      'text' => '<ul class="bullet-1">
  <li>Go to <strong>Admin Dashboard &rarr; Ximenia Theme</strong></li>
  <li>Configure the Settings</li>
  <li>Click <strong>Save Custom Presets as New</strong></li>
  <li>Follow the <strong>Preset Saver procedure</strong></li>
</ul>
<br />
<p class="notice">You can edit the prebuilt presets in the <strong>gantry.config.php</strong> file, or use the User Interface method outlined above.</p>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    90007 => 
    array (
      'title' => '',
      'text' => '<br /><br />
<p class="rt-center">
<img class="rt-image medmarginright " alt="Image" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/styles/style-1.jpg" height="132" width="200" />
<img class="rt-image" alt="Image" src="@RT_SITE_URL@/wp-content/rockettheme/rt_ximenia_wp/styles/style-2.jpg" height="132" width="200" />
</p>
<div class="clear"></div>',
      'filter' => false,
      'widget-style' => '',
      'box-variation' => '',
      'title-variation' => '',
      'block-variation' => '',
      'shadow-variation' => '',
      'corner-variation' => '',
      'align-variation' => '',
      'margin-variation' => '',
      'padding-variation' => '',
      'title-style' => '',
      'custom-variations' => '',
    ),
    '_multiwidget' => 1,
  ),
  'widget_gantrydivider' => 
  array (
    90007 => 
    array (
    ),
    '_multiwidget' => 1,
  ),
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-override-widgets-9', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rt_ximenia_wp-template-options-overrides', 'filter_token_url', 10, 2);

        update_option('rt_ximenia_wp-template-options-overrides',array (
  1 => 'Front Page',
  2 => 'Theme Features',
  3 => 'Widget Positions',
  4 => 'Widget Variations',
  5 => 'Typography',
  6 => 'Menu Options',
  7 => 'Plugins',
  8 => 'Tutorials',
  9 => 'Preset Styles',
));

        remove_filter('pre_update_option_rt_ximenia_wp-template-options-overrides', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rokajaxsearch_options', 'filter_token_url', 10, 2);

        update_option('rokajaxsearch_options',array (
  'theme' => 'light',
  'load_custom_css' => '1',
  'google_api' => '',
  'show_description' => '1',
  'show_readmore' => '1',
  'read_more' => 'Read More ...',
  'hide_divs' => '',
  'display_content' => 'excerpt',
  'order' => 'date',
  'per_page' => '3',
  'limit' => '10',
  'google_web' => '1',
  'google_blog' => '1',
  'google_images' => '0',
  'google_video' => '0',
  'image_size' => 'MEDIUM',
  'safesearch' => 'MODERATE',
  'pagination' => '1',
  'show_category' => '1',
  'show_estimated' => '1',
  'include_link' => '1',
));

        remove_filter('pre_update_option_rokajaxsearch_options', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rokbox_options', 'filter_token_url', 10, 2);

        update_option('rokbox_options',array (
  'theme' => 'light',
  'thumb_system' => 'default',
  'custom_theme' => 'sample',
  'custom_settings' => '0',
  'transition' => 'Quad.easeOut',
  'duration' => '200',
  'chase' => '40',
  'frame-border' => '20',
  'content-padding' => '0',
  'arrows-height' => '35',
  'effect' => 'quicksilver',
  'captions' => '1',
  'captionsDelay' => '800',
  'scrolling' => '0',
  'keyEvents' => '1',
  'overlay_background' => '#000000',
  'overlay_opacity' => '0.85',
  'overlay_duration' => '200',
  'overlay_transition' => 'Quad.easeInOut',
  'width' => '640',
  'height' => '460',
  'autoplay' => 'true',
  'controller' => 'true',
  'bgcolor' => '#f3f3f3',
  'ytautoplay' => '0',
  'ythighquality' => '0',
  'vimeoColor' => '00adef',
  'vimeoPortrait' => '0',
  'vimeoTitle' => '0',
  'vimeoFullScreen' => '1',
  'vimeoByline' => '0',
));

        remove_filter('pre_update_option_rokbox_options', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rokcommon_activated', 'filter_token_url', 10, 2);

        update_option('rokcommon_activated','1');

        remove_filter('pre_update_option_rokcommon_activated', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rokcommon_configs', 'filter_token_url', 10, 2);

        update_option('rokcommon_configs',array (
  'rokgallery_container' => 
  array (
    'file' => '/wp-content/plugins//wp_rokgallery/container.xml',
    'extension' => 'rokgallery',
    'priority' => 10,
    'type' => 'container',
  ),
  'rokgallery_library' => 
  array (
    'file' => '/wp-content/plugins//wp_rokgallery/lib',
    'extension' => 'rokgallery',
    'priority' => 10,
    'type' => 'library',
  ),
  'roksprocket_container' => 
  array (
    'file' => 'wp-content/plugins/wp_roksprocket/container.xml',
    'extension' => 'roksprocket',
    'priority' => 10,
    'type' => 'container',
  ),
  'roksprocket_library' => 
  array (
    'file' => 'wp-content/plugins/wp_roksprocket/lib',
    'extension' => 'roksprocket',
    'priority' => 10,
    'type' => 'library',
  ),
));

        remove_filter('pre_update_option_rokcommon_configs', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rokcommon_installed', 'filter_token_url', 10, 2);

        update_option('rokcommon_installed','1');

        remove_filter('pre_update_option_rokcommon_installed', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rokgallery_activated', 'filter_token_url', 10, 2);

        update_option('rokgallery_activated','1');

        remove_filter('pre_update_option_rokgallery_activated', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rokgallery_installed', 'filter_token_url', 10, 2);

        update_option('rokgallery_installed','1');

        remove_filter('pre_update_option_rokgallery_installed', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rokgallery_plugin_settings', 'filter_token_url', 10, 2);

        update_option('rokgallery_plugin_settings',array (
  'allow_duplicate_files' => 1,
  'publish_slices_on_file_publish' => 0,
  'gallery_remove_slice' => 1,
  'gallery_autopublish' => 1,
  'default_thumb_xsize' => 150,
  'default_thumb_ysize' => 150,
  'default_thumb_keep_aspect' => 1,
  'default_thumb_background' => '#000',
  'jpeg_quality' => 80,
  'png_compression' => 0,
  'love_text' => 'Love',
  'unlove_text' => 'Unlove',
));

        remove_filter('pre_update_option_rokgallery_plugin_settings', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_rokgallery_version', 'filter_token_url', 10, 2);

        update_option('rokgallery_version','1.0');

        remove_filter('pre_update_option_rokgallery_version', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_roknewspager_options', 'filter_token_url', 10, 2);

        update_option('roknewspager_options',array (
  'theme' => 'light',
  'thumb_generator' => 'default',
  'load_custom_css' => '1',
));

        remove_filter('pre_update_option_roknewspager_options', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_roksocialbuttons', 'filter_token_url', 10, 2);

        update_option('roksocialbuttons',array (
  'addthis_id' => '',
  'enable_twitter' => '1',
  'enable_facebook' => '1',
  'enable_google' => '1',
  'prepend_text' => '',
  'extra_class' => '',
));

        remove_filter('pre_update_option_roksocialbuttons', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_roksprocket_activated', 'filter_token_url', 10, 2);

        update_option('roksprocket_activated','1');

        remove_filter('pre_update_option_roksprocket_activated', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_roksprocket_installed', 'filter_token_url', 10, 2);

        update_option('roksprocket_installed','1');

        remove_filter('pre_update_option_roksprocket_installed', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_roksprocket_version', 'filter_token_url', 10, 2);

        update_option('roksprocket_version','1.1');

        remove_filter('pre_update_option_roksprocket_version', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_roktabs_options', 'filter_token_url', 10, 2);

        update_option('roktabs_options',array (
  'theme' => 'custom',
  'icons_path' => '__plugin__/icons',
));

        remove_filter('pre_update_option_roktabs_options', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_roktwittie_options', 'filter_token_url', 10, 2);

        update_option('roktwittie_options',array (
  'use_oauth' => '0',
  'consumer_key' => '',
  'consumer_secret' => '',
  'load_css' => '0',
  'enable_cache' => '1',
  'timeout_connect' => '3',
  'timeout_response' => '6',
  'enable_cache_time' => '60',
  'usernames' => 'rockettheme',
  'inactive_opacity' => '0.5',
  'show_default_avatar' => '0',
  'header_style' => 'light',
  'include_rts' => '0',
  'enable_statuses' => '0',
  'status_external' => '0',
  'show_feed' => '0',
  'show_follow_updates' => '0',
  'show_bio' => '0',
  'show_web' => '0',
  'show_location' => '0',
  'show_updates' => '0',
  'show_followers' => '0',
  'show_following' => '0',
  'show_following_icons' => '0',
  'following_icons_count' => '10',
  'show_viewall' => '1',
  'enable_usernames' => '1',
  'enable_usernames_avatar' => '0',
  'usernames_avatar_size' => '48',
  'usernames_count_size' => '2',
  'usernames_count_merged' => '1',
  'enable_usernames_externals' => '1',
  'enable_usernames_source' => '1',
  'enable_usernames_user' => '1',
  'enable_search' => '0',
  'search' => '@rockettheme',
  'enable_search_avatar' => '0',
  'search_avatar_size' => '48',
  'search_count_size' => '2',
  'enable_search_externals' => '1',
  'enable_search_source' => '1',
  'enable_search_user' => '1',
  'oauth_token' => '',
  'oauth_token_secret' => '',
));

        remove_filter('pre_update_option_roktwittie_options', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_rokajaxsearch', 'filter_token_url', 10, 2);

        update_option('widget_rokajaxsearch',array (
  '_multiwidget' => 1,
  10002 => 
  array (
    'title' => '',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => 'noblock',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => 'nopaddingleft nopaddingtop nopaddingbottom',
  ),
));

        remove_filter('pre_update_option_widget_rokajaxsearch', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_rokfeaturetable', 'filter_token_url', 10, 2);

        update_option('widget_rokfeaturetable',array (
  '_multiwidget' => 1,
  80002 => 
  array (
    'title' => '',
    'highlight-col' => '1',
    'builtin_css' => '0',
    'data-col1' => 'name::Free
price::$0
price-sub::per month
row-3::<b>2</b> Users
row-4::<b>1 GB</b> Storage
row-5::<b>No</b> Customization
row-6::height:89px;|??? iPhone App
button-text::Sign Up Now
button-text-sub::Sign Up to get access now!
button-text-link::#
button-text-classes::button4
',
    'data-col2' => 'name::Basic
price::$29
price-sub::per month
row-3::<b>10</b> Users
row-4::<b>5GB</b> Storage
row-5::<b>Basic</b> Customization
row-6::height:89px;|??? iPhone App<br />??? Basic Audit Trail
button-text::Sign Up Now
button-text-sub::Sign Up to get access now!
button-text-link::#
button-text-classes::button4
',
    'data-col3' => 'name::Pro
price::$49
price-sub::per month
row-3::<b>50</b> Users
row-4::<b>25GB</b> Storage
row-5::<b>Full</b> Customization
row-6::height:89px;|??? iPhone App<br />??? Full Audit Trail<br />??? Enhanced Security (SSL)<br />??? Custom Domains
button-text::Sign Up Now
button-text-sub::Sign Up to get access now!
button-text-link::#
',
    'data-col4' => 'name::Enterprise
price::$199
price-sub::per month
row-3::<b>Unlimited</b> Users
row-4::<b>100GB</b> Storage
row-5::<b>Full</b> Customization
row-6::height:89px;|??? iPhone App<br />??? Full Audit Trail<br />??? Enhanced Security (SSL)<br />??? Custom Domains
button-text::Sign Up Now
button-text-sub::Sign Up to get access now!
button-text-link::#
button-text-classes::button4
',
    'data-col5' => '',
    'data-col6' => '',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'icon-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  80003 => 
  array (
    'title' => '',
    'highlight-col' => '1',
    'builtin_css' => '0',
    'data-col1' => 'name::Free
price::$0
price-sub::per month
row-3::<b>2</b> Users
row-4::<b>1 GB</b> Storage
row-5::<b>No</b> Customization
row-6::height:89px;|??? iPhone App
button-text::Sign Up Now
button-text-sub::Sign Up to get access now!
button-text-link::#
button-text-classes::button4
',
    'data-col2' => 'name::Basic
price::$29
price-sub::per month
row-3::<b>10</b> Users
row-4::<b>5GB</b> Storage
row-5::<b>Basic</b> Customization
row-6::height:89px;|??? iPhone App<br />??? Basic Audit Trail
button-text::Sign Up Now
button-text-sub::Sign Up to get access now!
button-text-link::#
button-text-classes::button4
',
    'data-col3' => 'name::Pro
price::$49
price-sub::per month
row-3::<b>50</b> Users
row-4::<b>25GB</b> Storage
row-5::<b>Full</b> Customization
row-6::height:89px;|??? iPhone App<br />??? Full Audit Trail<br />??? Enhanced Security (SSL)<br />??? Custom Domains
button-text::Sign Up Now
button-text-sub::Sign Up to get access now!
button-text-link::#
',
    'data-col4' => 'name::Enterprise
price::$199
price-sub::per month
row-3::<b>Unlimited</b> Users
row-4::<b>100GB</b> Storage
row-5::<b>Full</b> Customization
row-6::height:89px;|??? iPhone App<br />??? Full Audit Trail<br />??? Enhanced Security (SSL)<br />??? Custom Domains
button-text::Sign Up Now
button-text-sub::Sign Up to get access now!
button-text-link::#
button-text-classes::button4
',
    'data-col5' => '',
    'data-col6' => '',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => 'nopaddingbottom',
    'title-style' => '',
    'custom-variations' => '',
  ),
));

        remove_filter('pre_update_option_widget_rokfeaturetable', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_rokgallery_options', 'filter_token_url', 10, 2);

        update_option('widget_rokgallery_options',array (
  '_multiwidget' => 1,
  10002 => 
  array (
    'title' => 'Adobe Fireworks PNG Sources',
    'gallery_id' => '1',
    'link' => 'none',
    'default_menuitem' => '@RT_SITE_URL@/',
    'show_title' => '0',
    'caption' => '0',
    'sort_by' => 'gallery_ordering',
    'sort_direction' => 'ASC',
    'limit_count' => '6',
    'style' => 'light',
    'layout' => 'grid',
    'columns' => '3',
    'arrows' => 'onhover',
    'navigation' => 'thumbnails',
    'animation_type' => 'random',
    'animation_duration' => '500',
    'autoplay_enabled' => '0',
    'autoplay_delay' => '7',
    'showcase_arrows' => 'onhover',
    'showcase_image_position' => 'left',
    'showcase_imgpadding' => '0',
    'showcase_fixedheight' => '0',
    'showcase_animatedheight' => '1',
    'showcase_animation_type' => 'random',
    'showcase_captionsanimation' => 'crossfade',
    'showcase_animation_duration' => '500',
    'showcase_autoplay_enabled' => '0',
    'showcase_autoplay_delay' => '7',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => 'fp-rokgallery bg5',
    'custom-background' => '@RT_SITE_URL@/wp-content/rockettheme/rt_fresco_wp/frontpage/module-title-bg/bg5.jpg',
  ),
  10003 => 
  array (
    'title' => 'Adobe Fireworks PNG Sources Available',
    'gallery_id' => '1',
    'link' => 'rokbox_full',
    'default_menuitem' => '@RT_SITE_URL@/',
    'show_title' => '0',
    'caption' => '0',
    'sort_by' => 'gallery_ordering',
    'sort_direction' => 'ASC',
    'limit_count' => '4',
    'style' => 'light',
    'layout' => 'grid',
    'columns' => '4',
    'arrows' => 'onhover',
    'navigation' => 'thumbnails',
    'animation_type' => 'random',
    'animation_duration' => '500',
    'autoplay_enabled' => '0',
    'autoplay_delay' => '7',
    'showcase_arrows' => 'onhover',
    'showcase_image_position' => 'left',
    'showcase_imgpadding' => '0',
    'showcase_fixedheight' => '0',
    'showcase_animatedheight' => '1',
    'showcase_animation_type' => 'random',
    'showcase_captionsanimation' => 'crossfade',
    'showcase_animation_duration' => '500',
    'showcase_autoplay_enabled' => '0',
    'showcase_autoplay_delay' => '7',
    'showcase_responsive_arrows' => 'onhover',
    'showcase_responsive_image_position' => 'left',
    'showcase_responsive_imgpadding' => '0',
    'showcase_responsive_animation_type' => 'random',
    'showcase_responsive_captionsanimation' => 'crossfade',
    'showcase_responsive_animation_duration' => '500',
    'showcase_responsive_autoplay_enabled' => '0',
    'showcase_responsive_autoplay_delay' => '7',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => 'title2',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
));

        remove_filter('pre_update_option_widget_rokgallery_options', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_roknewspager', 'filter_token_url', 10, 2);

        update_option('widget_roknewspager',array (
  '_multiwidget' => 1,
  100002 => 
  array (
    'title' => '',
    'category' => 'sample-content',
    'order' => 'date',
    'posts_per_page' => '5',
    'show_text' => '1',
    'content' => 'content',
    'post_title' => '0',
    'date' => '0',
    'author' => '0',
    'comments' => '0',
    'thumbs' => '0',
    'thumb_width' => '170',
    'thumb_height' => '136',
    'thumb_link' => '0',
    'more' => '1',
    'more_label' => 'Read More ...',
    'paging' => '1',
    'max_pages' => '8',
    'accordion' => '1',
    'allowed_tags' => 'a,br,strong,em,img,b',
    'auto_update' => '0',
    'update_delay' => '5000',
    'offset' => '0',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'icon-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  100003 => 
  array (
    'title' => 'RokNewsPager',
    'category' => 'sample-content',
    'order' => 'date',
    'posts_per_page' => '4',
    'show_text' => '1',
    'content' => 'content',
    'post_title' => '0',
    'date' => '0',
    'author' => '0',
    'comments' => '0',
    'thumbs' => '0',
    'thumb_width' => '170',
    'thumb_height' => '136',
    'thumb_link' => '1',
    'more' => '0',
    'more_label' => 'Read More ...',
    'paging' => '1',
    'max_pages' => '8',
    'accordion' => '1',
    'allowed_tags' => 'a,br,strong,em,img,b',
    'auto_update' => '0',
    'update_delay' => '5000',
    'offset' => '0',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
));

        remove_filter('pre_update_option_widget_roknewspager', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_roksprocket_options', 'filter_token_url', 10, 2);

        update_option('widget_roksprocket_options',array (
  '_multiwidget' => 1,
  10004 => 
  array (
    'title' => '',
    'module_id' => '8',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'lineshadow-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => 'nopaddingleft nopaddingright nopaddingtop',
  ),
  10005 => 
  array (
    'title' => '',
    'module_id' => '9',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'lineshadow-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => 'nopaddingright nopaddingbottom nopaddingleft ',
  ),
  10006 => 
  array (
    'title' => 'Most Popular',
    'module_id' => '7',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => 'title6',
    'lineshadow-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  10007 => 
  array (
    'title' => '',
    'module_id' => '11',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'lineshadow-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  10008 => 
  array (
    'title' => 'Popular Features',
    'module_id' => '10',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => 'title5',
    'lineshadow-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  10009 => 
  array (
    'title' => 'Gantry Extras',
    'module_id' => '12',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => 'bg4',
    'custom-background' => '@RT_SITE_URL@/wp-content/rockettheme/rt_fresco_wp/frontpage/module-title-bg/bg4.jpg',
  ),
  10010 => 
  array (
    'title' => '',
    'module_id' => '13',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => 'fp-rsfeatures',
    'custom-background' => '',
  ),
  10011 => 
  array (
    'title' => '',
    'module_id' => '14',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => 'fp-rstabs',
    'custom-background' => '',
  ),
  10012 => 
  array (
    'title' => '',
    'module_id' => '15',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
    'custom-background' => '',
  ),
  10013 => 
  array (
    'title' => 'Ximenia Guide',
    'module_id' => '18',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => 'title2',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => 'titletabs',
  ),
  10014 => 
  array (
    'title' => '',
    'module_id' => '19',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => 'noblock',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  10015 => 
  array (
    'title' => '',
    'module_id' => '20',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => 'noblock',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => 'nopaddingleft nopaddingright nopaddingbottom demo-sprocket-tabs',
  ),
  80013 => 
  array (
    'title' => '',
    'module_id' => '16',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => 'noblock nopaddingtop nomargintop',
  ),
  80014 => 
  array (
    'title' => '',
    'module_id' => '17',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => 'noblock mod-flushtop',
  ),
));

        remove_filter('pre_update_option_widget_roksprocket_options', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_rokstories_globals', 'filter_token_url', 10, 2);

        update_option('widget_rokstories_globals',array (
  'load_css' => '0',
));

        remove_filter('pre_update_option_widget_rokstories_globals', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_sidebars_widgets', 'filter_token_url', 10, 2);

        update_option('sidebars_widgets',array (
  'wp_inactive_widgets' => 
  array (
  ),
  'drawer' => 
  array (
  ),
  'top' => 
  array (
  ),
  'header' => 
  array (
  ),
  'navigation' => 
  array (
    0 => 'gantry_logo-2',
    1 => 'gantrydivider-2',
    2 => 'gantry_menu-2',
  ),
  'subnavigation' => 
  array (
  ),
  'showcase' => 
  array (
  ),
  'utility' => 
  array (
  ),
  'feature' => 
  array (
  ),
  'maintop' => 
  array (
  ),
  'breadcrumb' => 
  array (
  ),
  'sidebar' => 
  array (
    0 => 'gantry_menu-3',
    1 => 'gantry_loginform-2',
    2 => 'gantry_meta-2',
  ),
  'content-top' => 
  array (
  ),
  'content-bottom' => 
  array (
  ),
  'mainbottom' => 
  array (
  ),
  'extension' => 
  array (
  ),
  'bottom' => 
  array (
  ),
  'footer-position' => 
  array (
    0 => 'text-2',
    1 => 'gantrydivider-4',
    2 => 'text-3',
    3 => 'gantrydivider-3',
    4 => 'text-4',
  ),
  'copyright' => 
  array (
    0 => 'gantry_copyright-2',
    1 => 'gantrydivider-5',
    2 => 'gantry_totop-2',
    3 => 'gantrydivider-6',
    4 => 'gantry_branding-2',
  ),
  'analytics' => 
  array (
  ),
  'debug' => 
  array (
  ),
  'popup' => 
  array (
  ),
  'login' => 
  array (
  ),
  'array_version' => 3,
));

        remove_filter('pre_update_option_sidebars_widgets', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_posts_per_page', 'filter_token_url', 10, 2);

        update_option('posts_per_page','1');

        remove_filter('pre_update_option_posts_per_page', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_gantry_bugfix_WGANTRYFW_5', 'filter_token_url', 10, 2);

        update_option('gantry_bugfix_WGANTRYFW_5','1');

        remove_filter('pre_update_option_gantry_bugfix_WGANTRYFW_5', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_permalink_structure', 'filter_token_url', 10, 2);

        update_option('permalink_structure','/%postname%/');

        remove_filter('pre_update_option_permalink_structure', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_ecwid_pb_categoriesperrow', 'filter_token_url', 10, 2);

        update_option('ecwid_pb_categoriesperrow','3');

        remove_filter('pre_update_option_ecwid_pb_categoriesperrow', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_ecwid_pb_defaultview', 'filter_token_url', 10, 2);

        update_option('ecwid_pb_defaultview','grid');

        remove_filter('pre_update_option_ecwid_pb_defaultview', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_ecwid_pb_productspercolumn_grid', 'filter_token_url', 10, 2);

        update_option('ecwid_pb_productspercolumn_grid','3');

        remove_filter('pre_update_option_ecwid_pb_productspercolumn_grid', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_ecwid_pb_productsperpage_list', 'filter_token_url', 10, 2);

        update_option('ecwid_pb_productsperpage_list','10');

        remove_filter('pre_update_option_ecwid_pb_productsperpage_list', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_ecwid_pb_productsperpage_table', 'filter_token_url', 10, 2);

        update_option('ecwid_pb_productsperpage_table','20');

        remove_filter('pre_update_option_ecwid_pb_productsperpage_table', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_ecwid_pb_productsperrow_grid', 'filter_token_url', 10, 2);

        update_option('ecwid_pb_productsperrow_grid','3');

        remove_filter('pre_update_option_ecwid_pb_productsperrow_grid', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_ecwid_pb_searchview', 'filter_token_url', 10, 2);

        update_option('ecwid_pb_searchview','list');

        remove_filter('pre_update_option_ecwid_pb_searchview', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_ecwid_store_id', 'filter_token_url', 10, 2);

        update_option('ecwid_store_id','879302');

        remove_filter('pre_update_option_ecwid_store_id', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_ecwid_store_page_id', 'filter_token_url', 10, 2);

        update_option('ecwid_store_page_id','4');

        remove_filter('pre_update_option_ecwid_store_page_id', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_active_plugins', 'filter_token_url', 10, 2);

        update_option('active_plugins',array (
  0 => 'gantry/gantry.php',
  1 => 'wp_rokajaxsearch/rokajaxsearch.php',
  2 => 'wp_rokbox/rokbox.php',
  3 => 'wp_rokcommon/rokcommon.php',
  4 => 'wp_rokgallery/rokgallery.php',
  5 => 'wp_roksocialbuttons/roksocialbuttons.php',
  6 => 'wp_roksprocket/roksprocket.php',
  7 => 'wp_roktwittie/roktwittie.php',
));

        remove_filter('pre_update_option_active_plugins', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_gantry_logo', 'filter_token_url', 10, 2);

        update_option('widget_gantry_logo',array (
  2 => 
  array (
    'css' => 'body #logo-inner',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  '_multiwidget' => 1,
));

        remove_filter('pre_update_option_widget_gantry_logo', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_gantrydivider', 'filter_token_url', 10, 2);

        update_option('widget_gantrydivider',array (
  2 => 
  array (
  ),
  3 => 
  array (
  ),
  4 => 
  array (
  ),
  5 => 
  array (
  ),
  6 => 
  array (
  ),
  '_multiwidget' => 1,
));

        remove_filter('pre_update_option_widget_gantrydivider', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_gantry_menu', 'filter_token_url', 10, 2);

        update_option('widget_gantry_menu',array (
  2 => 
  array (
    'title' => '',
    'nav_menu' => 'main-menu',
    'theme' => 'ximenia_fusion',
    'limit_levels' => '0',
    'startLevel' => '0',
    'endLevel' => '0',
    'showAllChildren' => '1',
    'show_empty_menu' => '0',
    'maxdepth' => '10',
    'menu_classes' => 'menu-block',
    'fusion_load_css' => '0',
    'fusion_enable_js' => '1',
    'fusion_opacity' => '1',
    'fusion_effect' => 'slidefade',
    'fusion_hidedelay' => '500',
    'fusion_menu_animation' => 'Circ.easeOut',
    'fusion_menu_duration' => '300',
    'fusion_centeredOffset' => '0',
    'fusion_tweakInitial_x' => '-8',
    'fusion_tweakInitial_y' => '-6',
    'fusion_tweakSubsequent_x' => '-8',
    'fusion_tweakSubsequent_y' => '-11',
    'fusion_enable_current_id' => '0',
    'menu_suffix' => '',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  3 => 
  array (
    'title' => 'Main Menu',
    'nav_menu' => 'main-menu',
    'theme' => 'ximenia_splitmenu',
    'limit_levels' => '1',
    'startLevel' => '0',
    'endLevel' => '1',
    'showAllChildren' => '0',
    'show_empty_menu' => '0',
    'maxdepth' => '10',
    'menu_classes' => '',
    'fusion_load_css' => '0',
    'fusion_enable_js' => '1',
    'fusion_opacity' => '1',
    'fusion_effect' => 'slidefade',
    'fusion_hidedelay' => '500',
    'fusion_menu_animation' => 'Circ.easeOut',
    'fusion_menu_duration' => '300',
    'fusion_centeredOffset' => '0',
    'fusion_tweakInitial_x' => '-8',
    'fusion_tweakInitial_y' => '-6',
    'fusion_tweakSubsequent_x' => '-8',
    'fusion_tweakSubsequent_y' => '-11',
    'fusion_enable_current_id' => '0',
    'menu_suffix' => '',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  '_multiwidget' => 1,
));

        remove_filter('pre_update_option_widget_gantry_menu', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_gantry_loginform', 'filter_token_url', 10, 2);

        update_option('widget_gantry_loginform',array (
  2 => 
  array (
    'title' => 'Member Access',
    'user_greeting' => 'Hi,',
    'pretext' => '',
    'posttext' => '',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  '_multiwidget' => 1,
));

        remove_filter('pre_update_option_widget_gantry_loginform', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_gantry_meta', 'filter_token_url', 10, 2);

        update_option('widget_gantry_meta',array (
  2 => 
  array (
    'title' => 'Meta',
    'menu_class' => 'menu',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  '_multiwidget' => 1,
));

        remove_filter('pre_update_option_widget_gantry_meta', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_text', 'filter_token_url', 10, 2);

        update_option('widget_text',array (
  2 => 
  array (
    'title' => 'WordPress Guides',
    'text' => '<div class="custom">
	<p>WordPress.org is an invaluable resource for general instructions and information on how to use, configure and modify WordPress.</p>
<a target="_blank" class="readon" href="http://codex.wordpress.org"><span>Read More</span></a></div>',
    'filter' => false,
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  3 => 
  array (
    'title' => 'RocketTheme Help',
    'text' => '<p>RocketTheme provides tutorials of template installation, RocketLauncher, and various topics related to RocketTheme templates.</p>
<a href="http://www.rockettheme.com/wordpress" class="readon" target="_blank"><span>Read More</span></a>',
    'filter' => false,
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  4 => 
  array (
    'title' => 'Gantry Support',
    'text' => '<div class="custom">
	<p>More extensive details of the Gantry Framework, inclusive of both written and video tutorials, please visit dedicated Gantry Site.</p>
<a class="readon" target="_blank" href="http://www.gantry-framework.org/"><span>Learn More</span></a></div>',
    'filter' => false,
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  '_multiwidget' => 1,
));

        remove_filter('pre_update_option_widget_text', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_gantry_copyright', 'filter_token_url', 10, 2);

        update_option('widget_gantry_copyright',array (
  2 => 
  array (
    'text' => 'Designed by RocketTheme',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  '_multiwidget' => 1,
));

        remove_filter('pre_update_option_widget_gantry_copyright', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_gantry_totop', 'filter_token_url', 10, 2);

        update_option('widget_gantry_totop',array (
  2 => 
  array (
    'text' => 'Top',
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  '_multiwidget' => 1,
));

        remove_filter('pre_update_option_widget_gantry_totop', 'filter_token_url', 10, 2);

        add_filter('pre_update_option_widget_gantry_branding', 'filter_token_url', 10, 2);

        update_option('widget_gantry_branding',array (
  2 => 
  array (
    'widget-style' => '',
    'box-variation' => '',
    'title-variation' => '',
    'block-variation' => '',
    'shadow-variation' => '',
    'corner-variation' => '',
    'align-variation' => '',
    'margin-variation' => '',
    'padding-variation' => '',
    'title-style' => '',
    'custom-variations' => '',
  ),
  '_multiwidget' => 1,
));

        remove_filter('pre_update_option_widget_gantry_branding', 'filter_token_url', 10, 2);

$gantry_menu_items = array();
function rokimport_get_post_from_guid($guid) {
    global $wpdb;
    $guid = replace_token_url($guid);
    $posts = $wpdb->get_results("SELECT ID FROM " . $wpdb->posts . " WHERE guid = '" . $guid . "'");
    return (count($posts) > 0) ? $posts[0]->ID : 0;
}
function rokimport_get_taxonomy($name, $taxonomy) {
    $taxfield = get_term_by( "slug", $name, $taxonomy);
    return $taxfield->term_id;
}
global $wp_version;
if (version_compare($wp_version,"3.0",">=")){
$importing_menu = wp_get_nav_menu_object("main-menu");$menu_item_mapping = array(0=>0);$menu_item_mapping[1150] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[0],'menu-item-type' => 'custom','menu-item-title' => 'Home','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '1','menu-item-attr-title' => '','menu-item-url' => '@RT_SITE_URL@/'));$gantry_menu_items["main-menu"][$menu_item_mapping[1150]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1151] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[0],'menu-item-type' => 'post_type','menu-item-title' => 'Features','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '2','menu-item-attr-title' => '','menu-item-object-id' => rokimport_get_post_from_guid('@RT_SITE_URL@/?page_id=27'),'menu-item-object' => 'page'));$gantry_menu_items["main-menu"][$menu_item_mapping[1151]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1152] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1151],'menu-item-type' => 'post_type','menu-item-title' => 'Widget Positions','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '3','menu-item-attr-title' => '','menu-item-object-id' => rokimport_get_post_from_guid('@RT_SITE_URL@/?page_id=36'),'menu-item-object' => 'page'));$gantry_menu_items["main-menu"][$menu_item_mapping[1152]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1153] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1151],'menu-item-type' => 'post_type','menu-item-title' => 'Widget Variations','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '4','menu-item-attr-title' => '','menu-item-object-id' => rokimport_get_post_from_guid('@RT_SITE_URL@/?page_id=39'),'menu-item-object' => 'page'));$gantry_menu_items["main-menu"][$menu_item_mapping[1153]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1154] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1151],'menu-item-type' => 'post_type','menu-item-title' => 'Typography','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '5','menu-item-attr-title' => '','menu-item-object-id' => rokimport_get_post_from_guid('@RT_SITE_URL@/?page_id=33'),'menu-item-object' => 'page'));$gantry_menu_items["main-menu"][$menu_item_mapping[1154]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1155] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1151],'menu-item-type' => 'post_type','menu-item-title' => 'Menu Options','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '6','menu-item-attr-title' => '','menu-item-object-id' => rokimport_get_post_from_guid('@RT_SITE_URL@/?page_id=542'),'menu-item-object' => 'page'));$gantry_menu_items["main-menu"][$menu_item_mapping[1155]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1156] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1155],'menu-item-type' => 'post_type','menu-item-title' => 'Sample Menu','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '7','menu-item-attr-title' => '','menu-item-object-id' => rokimport_get_post_from_guid('@RT_SITE_URL@/?page_id=30'),'menu-item-object' => 'page'));$gantry_menu_items["main-menu"][$menu_item_mapping[1156]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1157] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1156],'menu-item-type' => 'custom','menu-item-title' => 'Child Item','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '8','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1157]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1158] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1156],'menu-item-type' => 'custom','menu-item-title' => 'Child Item','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '9','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1158]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1159] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1156],'menu-item-type' => 'custom','menu-item-title' => 'Child Item','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '10','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1159]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1160] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1156],'menu-item-type' => 'custom','menu-item-title' => 'Child Parent','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '11','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1160]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1161] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1160],'menu-item-type' => 'custom','menu-item-title' => 'Child Item','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '12','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1161]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1162] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1160],'menu-item-type' => 'custom','menu-item-title' => 'Child Item','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '13','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1162]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1163] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1160],'menu-item-type' => 'custom','menu-item-title' => 'Child Item','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '14','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1163]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1164] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1163],'menu-item-type' => 'custom','menu-item-title' => 'Child Item','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '15','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1164]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1165] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1163],'menu-item-type' => 'custom','menu-item-title' => 'Child Item','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '16','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1165]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1166] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1163],'menu-item-type' => 'custom','menu-item-title' => 'Child Item','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '17','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1166]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1167] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1160],'menu-item-type' => 'custom','menu-item-title' => 'Child Item','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '18','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1167]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1168] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1156],'menu-item-type' => 'custom','menu-item-title' => 'Child Item','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '19','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1168]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1169] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1155],'menu-item-type' => 'custom','menu-item-title' => 'Menu Icons','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '20','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1169]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '4',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '600',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1170] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Add Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '21','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1170]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-add.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1171] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Briefcase Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '22','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1171]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-briefcase.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1172] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Calendar Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '23','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1172]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-calendar.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1173] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Crank Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '24','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1173]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-crank.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1174] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Delete Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '25','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1174]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-delete.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1175] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Docs Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '26','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1175]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-docs.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1176] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Email Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '27','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1176]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-email.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1177] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Flag Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '28','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1177]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-flag.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1178] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Home Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '29','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1178]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-home.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1179] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Info Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '30','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1179]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-info.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1180] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Key Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '31','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1180]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-key.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1181] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Left Arrow Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '32','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1181]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-leftarrow.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1182] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Like Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '33','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1182]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-like.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1183] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Lock Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '34','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1183]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-lock.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1184] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Minus Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '35','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1184]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-minus.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1185] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Monitor Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '36','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1185]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-monitor.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1186] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Notes Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '37','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1186]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-notes.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1187] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Post Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '38','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1187]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-post.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1188] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Printer Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '39','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1188]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-printer.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1189] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Right Arrow Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '40','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1189]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-rightarrow.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1190] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'RSS Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '41','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1190]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-rss.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1191] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Unlock Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '42','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1191]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-unlock.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1192] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Warning Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '43','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1192]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-warning.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1193] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1169],'menu-item-type' => 'custom','menu-item-title' => 'Write Icon','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '44','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1193]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => 'icon-write.png',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1194] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1155],'menu-item-type' => 'custom','menu-item-title' => 'Child Item','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '45','menu-item-attr-title' => '','menu-item-url' => '#'));$gantry_menu_items["main-menu"][$menu_item_mapping[1194]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1195] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1151],'menu-item-type' => 'post_type','menu-item-title' => 'Plugins','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '46','menu-item-attr-title' => '','menu-item-object-id' => rokimport_get_post_from_guid('@RT_SITE_URL@/?page_id=7'),'menu-item-object' => 'page'));$gantry_menu_items["main-menu"][$menu_item_mapping[1195]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '2',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '280',
  'gantrymenu_fusion_column_widths' => '140,140',
);$menu_item_mapping[1196] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1151],'menu-item-type' => 'custom','menu-item-title' => '404 Error Page','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '47','menu-item-attr-title' => '','menu-item-url' => '@RT_SITE_URL@/?p=1337'));$gantry_menu_items["main-menu"][$menu_item_mapping[1196]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1277] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1151],'menu-item-type' => 'custom','menu-item-title' => 'More Details','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '48','menu-item-attr-title' => '','menu-item-url' => 'http://rockettheme.com/wordpress-themes/ximenia'));$gantry_menu_items["main-menu"][$menu_item_mapping[1277]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1278] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[0],'menu-item-type' => 'post_type','menu-item-title' => 'Tutorials','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '49','menu-item-attr-title' => '','menu-item-object-id' => rokimport_get_post_from_guid('@RT_SITE_URL@/?page_id=42'),'menu-item-object' => 'page'));$gantry_menu_items["main-menu"][$menu_item_mapping[1278]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1279] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1278],'menu-item-type' => 'post_type','menu-item-title' => 'Installation','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '50','menu-item-attr-title' => '','menu-item-object-id' => rokimport_get_post_from_guid('@RT_SITE_URL@/?page_id=48'),'menu-item-object' => 'page'));$gantry_menu_items["main-menu"][$menu_item_mapping[1279]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1280] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1278],'menu-item-type' => 'post_type','menu-item-title' => 'Logo Editing','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '51','menu-item-attr-title' => '','menu-item-object-id' => rokimport_get_post_from_guid('@RT_SITE_URL@/?page_id=60'),'menu-item-object' => 'page'));$gantry_menu_items["main-menu"][$menu_item_mapping[1280]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1281] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1278],'menu-item-type' => 'post_type','menu-item-title' => 'RocketLauncher','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '52','menu-item-attr-title' => '','menu-item-object-id' => rokimport_get_post_from_guid('@RT_SITE_URL@/?page_id=51'),'menu-item-object' => 'page'));$gantry_menu_items["main-menu"][$menu_item_mapping[1281]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1282] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1278],'menu-item-type' => 'custom','menu-item-title' => 'Forum Guides','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '53','menu-item-attr-title' => '','menu-item-url' => 'http://www.rockettheme.com/forum/index.php?f=710&amp;rb_v=viewforum'));$gantry_menu_items["main-menu"][$menu_item_mapping[1282]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1283] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1278],'menu-item-type' => 'custom','menu-item-title' => 'Gantry Framework','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '54','menu-item-attr-title' => '','menu-item-url' => 'http://www.gantry-framework.org/documentation'));$gantry_menu_items["main-menu"][$menu_item_mapping[1283]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1284] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[0],'menu-item-type' => 'post_type','menu-item-title' => 'Preset Styles','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '55','menu-item-attr-title' => '','menu-item-object-id' => rokimport_get_post_from_guid('@RT_SITE_URL@/?page_id=94'),'menu-item-object' => 'page'));$gantry_menu_items["main-menu"][$menu_item_mapping[1284]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '2',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '200',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1285] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1284],'menu-item-type' => 'custom','menu-item-title' => 'Preset 1','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '56','menu-item-attr-title' => '','menu-item-url' => '@RT_SITE_URL@/?presets=preset1'));$gantry_menu_items["main-menu"][$menu_item_mapping[1285]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1287] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1284],'menu-item-type' => 'custom','menu-item-title' => 'Preset 3','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '57','menu-item-attr-title' => '','menu-item-url' => '@RT_SITE_URL@/?presets=preset3'));$gantry_menu_items["main-menu"][$menu_item_mapping[1287]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1289] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1284],'menu-item-type' => 'custom','menu-item-title' => 'Preset 5','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '58','menu-item-attr-title' => '','menu-item-url' => '@RT_SITE_URL@/?presets=preset5'));$gantry_menu_items["main-menu"][$menu_item_mapping[1289]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1291] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1284],'menu-item-type' => 'custom','menu-item-title' => 'Preset 7','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '59','menu-item-attr-title' => '','menu-item-url' => '@RT_SITE_URL@/?presets=preset7'));$gantry_menu_items["main-menu"][$menu_item_mapping[1291]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1286] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1284],'menu-item-type' => 'custom','menu-item-title' => 'Preset 2','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '60','menu-item-attr-title' => '','menu-item-url' => '@RT_SITE_URL@/?presets=preset2'));$gantry_menu_items["main-menu"][$menu_item_mapping[1286]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1288] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1284],'menu-item-type' => 'custom','menu-item-title' => 'Preset 4','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '61','menu-item-attr-title' => '','menu-item-url' => '@RT_SITE_URL@/?presets=preset4'));$gantry_menu_items["main-menu"][$menu_item_mapping[1288]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1290] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1284],'menu-item-type' => 'custom','menu-item-title' => 'Preset 6','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '62','menu-item-attr-title' => '','menu-item-url' => '@RT_SITE_URL@/?presets=preset6'));$gantry_menu_items["main-menu"][$menu_item_mapping[1290]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1292] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[1284],'menu-item-type' => 'custom','menu-item-title' => 'Preset 8','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '63','menu-item-attr-title' => '','menu-item-url' => '@RT_SITE_URL@/?presets=preset8'));$gantry_menu_items["main-menu"][$menu_item_mapping[1292]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);$menu_item_mapping[1293] = wp_update_nav_menu_item($importing_menu->term_id, 0, array('menu-item-parent-id' => $menu_item_mapping[0],'menu-item-type' => 'custom','menu-item-title' => 'RocketTheme','menu-item-status' => 'publish','menu-item-target' => '','menu-item-classes' => '','menu-item-description' => '','menu-item-xfn' => '','menu-item-position' => '64','menu-item-attr-title' => '','menu-item-url' => 'http://rockettheme.com'));$gantry_menu_items["main-menu"][$menu_item_mapping[1293]] = array (
  'gantrymenu_subtext' => '',
  'gantrymenu_icon' => '',
  'gantrymenu_submenu_cols' => '1',
  'gantrymenu_fusion_distribution' => 'evenly',
  'gantrymenu_fusion_manual_distribution' => '',
  'gantrymenu_fusion_children_group' => '0',
  'gantrymenu_fusion_dropdown_width' => '',
  'gantrymenu_fusion_column_widths' => '',
);update_option("gantry_menu_items",$gantry_menu_items);}