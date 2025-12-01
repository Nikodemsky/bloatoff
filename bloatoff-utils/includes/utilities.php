<?php 

/* Utilities - backend & frontend */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die;
}

/** List of available utilities **/

// Load all options
$bloatoff_options = get_option('bloatoff_settings', array());

// #01 Comments system removal
function bu_disable_comments() {

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

// #02 Widgets removal
function bu_remove_widget_support() {
    remove_theme_support( 'widgets-block-editor' );
    remove_theme_support( 'widgets' );
}

// #03 oEmbed restriction
function bu_disable_oembed_on_site() {
    if (!is_admin()) {
        remove_filter( 'the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );
        remove_action( 'rest_api_init', 'wp_oembed_register_route' );
        add_filter( 'embed_oembed_discover', '__return_false' );
        add_filter( 'embed_preview', '__return_false' );
    }
}

// #04 Self pingbacks removal
function bu_no_self_ping( &$links ) {
    $home = get_option( 'home' );
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}

// #05 Heartbeat interval
function bu_modify_heartbeat() {
    add_filter('heartbeat_settings', function($settings) use ($options) {
        $interval = isset($bloatoff_options['heartbeat_number']) ? absint($bloatoff_options['heartbeat_number']) : 15;
        
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

// #06 Revisions
function bu_limit_post_revisions( $num, $post ) {
    $bloatoff_options = get_option('bloatoff_settings', array());
    $revisions = isset($bloatoff_options['revisions_interval']) ? absint($bloatoff_options['revisions_interval']) : -1;

    // Ensure revisions number is within valid range
    if ($revisions < 1) {
        $revisions = 1;
    } elseif ($revisions > 99) {
        $revisions = 99;
    }
    
    return $revisions; // Return the number, not $settings
}

// #07 Image Process Engine
function bou_image_editor_default_to_gd( $editors ) {
    $gd_editor = 'WP_Image_Editor_GD';
    $editors = array_diff( $editors, array( $gd_editor ) );
    array_unshift( $editors, $gd_editor );
    return $editors;
}

// #08 Default tags taxonomy
function bou_unregister_default_tags_taxonomy() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}

// #09 Author archive pages
function bou_disable_author_archives() {
    if ( is_author() ) {
        wp_redirect( home_url(), 301 );
        exit;
    }
}

function bou_remove_users_sitemap_provider( $providers ) {
    unset( $providers['users'] );
    return $providers;
}

/** List of checks **/

// #01 Comments system
if (!empty($bloatoff_options['comments'])) {
    add_action('init', 'bu_disable_comments');
}

// #02 Widgets
if (!empty($bloatoff_options['widgets'])) {
    add_action( 'after_setup_theme', 'bu_remove_widget_support' );
}

// #03 oEmbed
if (!empty($bloatoff_options['oembed'])) {
    add_action( 'init', 'bu_disable_oembed_on_site' );
}

// #04 Self pingbacks
if (!empty($bloatoff_options['selfping'])) {
    add_action( 'pre_ping', 'bu_no_self_ping' );
}

// #05 Heartbeat
if (!empty($bloatoff_options['heartbeat_enabled'])) {
    add_action('init', 'bu_modify_heartbeat');
}

// #06 Revisions
if (!empty($bloatoff_options['revisions_enabled'])) {
    add_filter( 'wp_revisions_to_keep', 'bu_limit_post_revisions', 99, 2 );
}

// #07 Image Process Engine
if (!empty($bloatoff_options['ipe'])) {
    add_filter( 'wp_image_editors', 'bou_image_editor_default_to_gd' );
}

// #08 Default tags taxonomy
if (!empty($bloatoff_options['tagstax'])) {
    add_action('init', 'bou_unregister_default_tags_taxonomy');
}

// #09 Author archive pages
if (!empty($bloatoff_options['authorarchives'])) {
    add_action( 'template_redirect', 'bou_disable_author_archives', 1 );
    add_filter( 'wp_sitemaps_register_providers', 'bou_remove_users_sitemap_provider' );
    add_filter( 'author_link', '__return_empty_string' );
    add_filter( 'the_author_posts_link', 'get_the_author', 99 );
}