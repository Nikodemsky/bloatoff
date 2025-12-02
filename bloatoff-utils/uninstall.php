<?php

// If uninstall not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete plugin options
delete_option('bloatoff_settings');

// For multisite, delete from all sites
if (is_multisite()) {
    $sites = get_sites(array('fields' => 'ids'));
    
    foreach ($sites as $blog_id) {
        switch_to_blog($blog_id);
        delete_option('bloatoff_settings');
        restore_current_blog();
    }
}

// Clear any cached data
wp_cache_flush();