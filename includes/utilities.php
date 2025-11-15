<?php 

/* Utilities - backend & frontend */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die;
}

/** List of available utilities **/

// Comments system removal
function bu_disable_comments() {
    $options = get_option('bloatoff_settings', array());
    
    if (!empty($options['comments'])) {
        
        // Redirect comments and discussion pages
        add_action('admin_init', function () {
            global $pagenow;
            
            if ($pagenow === 'edit-comments.php' || $pagenow === 'options-discussion.php') {
                wp_redirect(admin_url());
                exit;
            }

            // Remove comments dashboard widget
            remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

            // Remove comments support from all post types
            foreach (get_post_types() as $post_type) {
                if (post_type_supports($post_type, 'comments')) {
                    remove_post_type_support($post_type, 'comments');
                    remove_post_type_support($post_type, 'trackbacks');
                }
            }
        });

        // Close comments and pings
        add_filter('comments_open', '__return_false', 20, 2);
        add_filter('pings_open', '__return_false', 20, 2);
        add_filter('comments_array', '__return_empty_array', 10, 2);

        // Remove comments from admin menu
        add_action('admin_menu', function () {
            remove_menu_page('edit-comments.php');
            remove_submenu_page('options-general.php', 'options-discussion.php');
        });

        // Remove comments from admin bar
        add_action('init', function () {
            if (is_admin_bar_showing()) {
                remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
            }
        });

        // Remove comments from admin bar (alternative method)
        add_action('wp_before_admin_bar_render', function () {
            global $wp_admin_bar;
            $wp_admin_bar->remove_menu('comments');
        });
    }
}
add_action('init', 'bu_disable_comments');

// Widgets removal
function bu_remove_widget_support() {
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['widgets'])) {
        remove_theme_support( 'widgets-block-editor' );
        remove_theme_support( 'widgets' );
    }
}
add_action( 'after_setup_theme', 'bu_remove_widget_support' );

// oEmbed restriction
function bu_disable_oembed_on_site() {
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['oembed'])) {
        if (!is_admin()) {
            remove_filter( 'the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );
            remove_action( 'rest_api_init', 'wp_oembed_register_route' );
            add_filter( 'embed_oembed_discover', '__return_false' );
            add_filter( 'embed_preview', '__return_false' );
        }
    }
}
add_action( 'init', 'bu_disable_oembed_on_site' );

// XML-RPC removal
function bu_disable_xmlrpc() {
    $options = get_option('bloatoff_settings', array());
    
    if (!empty($options['xmlrpc'])) {
        add_filter('xmlrpc_enabled', '__return_false');
    }
}
add_action('init', 'bu_disable_xmlrpc');

// Self pingbacks removal
function bu_no_self_ping( &$links ) {
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['selfping'])) {
        $home = get_option( 'home' );
        foreach ( $links as $l => $link )
            if ( 0 === strpos( $link, $home ) )
                unset($links[$l]);
    }
}
add_action( 'pre_ping', 'bu_no_self_ping' );

// Heartbeat interval
function bu_modify_heartbeat() {
    $options = get_option('bloatoff_settings', array());
    
    if (!empty($options['heartbeat_enabled'])) {
        add_filter('heartbeat_settings', function($settings) use ($options) {
            $interval = isset($options['heartbeat_interval']) ? absint($options['heartbeat_interval']) : 15;
            
            // Ensure interval is within valid range
            if ($interval < 1) {
                $interval = 1;
            } elseif ($interval > 86400) {
                $interval = 86400;
            }
            
            $settings['interval'] = $interval;
            return $settings;
        });
    }
}
add_action('init', 'bu_modify_heartbeat');