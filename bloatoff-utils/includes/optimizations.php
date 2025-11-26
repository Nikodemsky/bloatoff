<?php 

/* Frontend Optimizations */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die;
}

/** List of optimizations **/

// Load all options
$bloatoff_options = get_option('bloatoff_settings', array());

// #01 Gutenberg styles and scripts
function bu_remove_gutenberg_styles() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_script('wp-editor');
}

// #02 Emoji removal - styles and scripts
function bu_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}

// #02 Emoji removal - TinyMCE plugin
function bu_disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    }
    return array();
}

// #02 Emoji removal - CDN hostname from DNS prefetching hints.
function bu_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
    return $urls;
}

// #03 RSS feeds removal
function bu_disable_feeds() {
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

function bu_disable_feeds_callback() {
    wp_die(__('No feeds available!', 'bloatoff-utils'));
}

// #04 Really Simple Discovery removal
function bu_disable_rsd() {
    remove_action( 'wp_head', 'rsd_link' );
}

// #05 Shortlink removal
function bu_disable_shortlink() {
    remove_action('wp_head', 'wp_shortlink_wp_head', 10);
}

// #06 Admin dashboard widgets
function bu_remove_all_dashboard_widgets() {

    // Remove Welcome Panel
    remove_action( 'welcome_panel', 'wp_welcome_panel' );

    // Remove Widgets
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Quick Draft
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // Activity
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress News
    remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' ); // Site Health
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // At a Glance
}

// #07 REST link in header
function bu_remove_rest_link() {
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
}

// #08 oEmbed discovery link in header
function bu_remove_oembed_link() {
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
}

// #09 Native XML Sitemap
function bu_disable_native_sitemap() {
    add_filter('wp_sitemaps_enabled', '__return_false');
}

// #10 Admin help tabs
function bu_remove_help_tabs($old_help, $screen_id, $screen){
    $screen->remove_help_tabs();
    return $old_help;
}

// #11 WP logo submenu and thank you message, the function has been taken from: https://wordpress.org/plugins/remove-admin-bar-logo
function bu_admin_bar_remove_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
    add_filter( 'admin_footer_text', fn () => '', 99, 0 );
}

/** List of checks **/

// #01 Gutenberg styles and scripts
if (!empty($bloatoff_options['gutenberg'])) {
    add_action('wp_enqueue_scripts', 'bu_remove_gutenberg_styles', 100);
}

// #02 Emoji
if (!empty($bloatoff_options['emojis'])) {
    add_action( 'init', 'bu_disable_emojis' );
    add_filter( 'tiny_mce_plugins', 'bu_disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'bu_disable_emojis_remove_dns_prefetch', 10, 2 );
}

// #03 RSS feeds
if (!empty($bloatoff_options['rss'])) {
    add_action('init', 'bu_disable_feeds');
}

// #04 Really Simple Discovery
if (!empty($bloatoff_options['rsdl'])) {
    add_action('init', 'bu_disable_rsd');
}

// #05 Shortlink
if (!empty($bloatoff_options['shortlink'])) {
    add_action('init', 'bu_disable_shortlink');
}

// #06 Admin dashboard widgets
if (!empty($bloatoff_options['adminwidgets'])) {
    add_action( 'wp_dashboard_setup', 'bu_remove_all_dashboard_widgets' );
}

// #07 REST link in header
if (!empty($bloatoff_options['restapilink'])) {
    add_action( 'after_setup_theme', 'bu_remove_rest_link' );
}

// #08 oEmbed discovery link in header
if (!empty($bloatoff_options['oembeddisclink'])) {
    add_action( 'after_setup_theme', 'bu_remove_oembed_link' );
}

// #09 Native XML Sitemap
if (!empty($bloatoff_options['nativexmlsitemap'])) {
    add_action('init', 'bu_disable_native_sitemap');
}

// #10 Admin help tabs
if (!empty($bloatoff_options['adminhelptabs'])) {
    add_filter( 'contextual_help', 'bu_remove_help_tabs', 999, 3 );
}

// #11 WP logo submenu and thank you message
if (!empty($bloatoff_options['wplogoty'])) {
    add_action('wp_before_admin_bar_render','bu_admin_bar_remove_logo', 0 );
}