<?php 

/* Frontend Optimizations */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die;
}

/** List of optimizations **/

// Gutenberg styles and scripts
function bu_remove_gutenberg_styles() {
    $options = get_option('bloatoff_settings', array());
    
    if (!empty($options['gutenberg'])) {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-blocks-style');
        wp_dequeue_script('wp-editor');
    }
}
add_action('wp_enqueue_scripts', 'bu_remove_gutenberg_styles', 100);

// Emoji removal - styles and scripts
function bu_disable_emojis() {
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['emojis'])) {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        add_filter( 'tiny_mce_plugins', 'bu_disable_emojis_tinymce' );
        add_filter( 'wp_resource_hints', 'bu_disable_emojis_remove_dns_prefetch', 10, 2 );
    }
}
add_action( 'init', 'bu_disable_emojis' );

// Emoji removal - TinyMCE plugin
function bu_disable_emojis_tinymce( $plugins ) {
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['emojis'])) {
        if ( is_array( $plugins ) ) {
            return array_diff( $plugins, array( 'wpemoji' ) );
        } else {
            return array();
        }
    }
}

// Emoji removal - CDN hostname from DNS prefetching hints.
function bu_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['emojis'])) {
        if ( 'dns-prefetch' == $relation_type ) {
            $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
            $urls = array_diff( $urls, array( $emoji_svg_url ) );
        }
        return $urls;
    }
}

// RSS feeds removal
function bu_disable_feeds() {
    $options = get_option('bloatoff_settings', array());
    
    if (!empty($options['rss'])) {
        add_action('do_feed', 'bu_disable_feeds_callback', 1);
        add_action('do_feed_rdf', 'bu_disable_feeds_callback', 1);
        add_action('do_feed_rss', 'bu_disable_feeds_callback', 1);
        add_action('do_feed_rss2', 'bu_disable_feeds_callback', 1);
        add_action('do_feed_atom', 'bu_disable_feeds_callback', 1);
        add_action('do_feed_rss2_comments', 'bu_disable_feeds_callback', 1);
        add_action('do_feed_atom_comments', 'bu_disable_feeds_callback', 1);

        // Links removal from header
        remove_action( 'wp_head', 'feed_links', 2 );
        remove_action( 'wp_head', 'feed_links_extra', 3 );
    }
}
add_action('init', 'bu_disable_feeds');

function bu_disable_feeds_callback() {
    wp_die(__('No feeds available!', 'bloatoff-utils'));
}

// Really Simple Discovery removal
function bu_disable_rsd() {
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['rsdl'])) {
        remove_action( 'wp_head', 'rsd_link' );
    }
}
add_action('init', 'bu_disable_rsd');

// Shortlink
function bu_disable_shortlink() {
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['shortlink'])) {
        remove_action('wp_head', 'wp_shortlink_wp_head', 10);
    }
}
add_action('init', 'bu_disable_rsd');

// jQuery Migrate
/*function bu_remove_jquery_migrate( $scripts ) {
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['jquerymigrate'])) {
        if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
                $script = $scripts->registered['jquery'];
        if ( $script->deps ) { 
        // Check whether the script has any dependencies
        $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }}
    }
}
add_action( 'wp_default_scripts', 'bu_remove_jquery_migrate' );*/

// Admin dashboard widgets
function bu_remove_all_dashboard_widgets() {
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['adminwidgets'])) {

        // Remove Welcome Panel
        remove_action( 'welcome_panel', 'wp_welcome_panel' );

        // Remove Widgets
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Quick Draft
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // Activity
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress News
        remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' ); // Site Health
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // At a Glance
    }
}
add_action( 'wp_dashboard_setup', 'bu_remove_all_dashboard_widgets' );

// REST link in header
function bu_remove_rest_link() {
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['restapilink'])) {
        remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    }
}
add_action( 'after_setup_theme', 'bu_remove_rest_link' );

// oEmbed discovery link in header
function bu_remove_oembed_link() {
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['oembeddisclink'])) {
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
    }
}
add_action( 'after_setup_theme', 'bu_remove_oembed_link' );

// Native XML Sitemap
function bu_disable_native_sitemap() {
    $options = get_option('bloatoff_settings', array());
    
    if (!empty($options['nativexmlsitemap'])) {
        add_filter('wp_sitemaps_enabled', '__return_false');
    }
}
add_action('init', 'bu_disable_native_sitemap');

// Admin help tabs
function bu_remove_help_tabs($old_help, $screen_id, $screen){
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['adminhelptabs'])) {
        $screen->remove_help_tabs();
        return $old_help;
    }
}
add_filter( 'contextual_help', 'bu_remove_help_tabs', 999, 3 );

// WP logo submenu and thank you message 
// WP Logo function taken from: https://wordpress.org/plugins/remove-admin-bar-logo
function bu_admin_bar_remove_logo() {
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['wplogoty'])) {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu( 'wp-logo' );
        add_filter( 'admin_footer_text', fn () => '', 99, 0 );
    }
}
add_action('wp_before_admin_bar_render','bu_admin_bar_remove_logo', 0 );