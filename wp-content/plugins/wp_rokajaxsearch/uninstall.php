<?php
if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') )
    exit();
delete_option('rokajaxsearch_options');
delete_option('widget_rokajaxsearch');
