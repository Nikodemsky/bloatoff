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
    wp_die(esc_html__('No feeds available!', 'bloatoff-utils'));
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

// #10 Admin help tabs
function bu_remove_help_tabs() {
    $screen = get_current_screen();
    if ( $screen ) {
        $screen->remove_help_tabs();
    }
}

// #11 WP logo submenu and thank you message, the function has been taken from: https://wordpress.org/plugins/remove-admin-bar-logo
function bu_admin_bar_remove_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
    add_filter( 'admin_footer_text', fn () => '', 99, 0 );
}

// #12 Disable Site Health - initial tests
function bu_disable_site_health_tests($tests) {
    return [
        'direct' => [],
        'async'  => []
    ];
}

// #12 Disable Site Health - scheduled checks
function bu_disable_site_health_scheduled_check() {
    remove_action('wp_site_health_scheduled_check', 'wp_site_health_scheduled_check');
    wp_clear_scheduled_hook('wp_site_health_scheduled_check');
}

// #12 Disable Site Health - REST API endpoints
function bu_disable_site_health_rest_endpoints($endpoints) {
    foreach ($endpoints as $route => $endpoint) {
        if (strpos($route, '/wp-site-health/') === 0) {
            unset($endpoints[$route]);
        }
    }
    return $endpoints;
}

// #12 Disable Site Health - menu pages
function bu_remove_site_health_menu_pages() {
    remove_submenu_page('tools.php', 'site-health.php');
    remove_submenu_page('tools.php', 'health-check');
}

// #12 Disable Site Health - capabilities
function bu_remove_site_health_capabilities($allcaps, $caps, $args, $user) {
    if (isset($allcaps['view_site_health_checks'])) {
        $allcaps['view_site_health_checks'] = false;
    }
    if (isset($allcaps['view_site_health_checks_major'])) {
        $allcaps['view_site_health_checks_major'] = false;
    }
    return $allcaps;
}

// #13 Import/Export - menu pages
function bu_block_import_export_page_access() {
    global $pagenow;
    
    // Block direct access to export.php
    if ($pagenow === 'export.php') {
        wp_die(esc_html__('Export functionality has been disabled.', 'bloatoff-utils'), esc_html__('Export Disabled', 'bloatoff-utils'), ['response' => 403]);
    }
    
    // Block direct access to import.php
    if ($pagenow === 'import.php') {
        wp_die(esc_html__('Import functionality has been disabled.', 'bloatoff-utils'), esc_html__('Import Disabled', 'bloatoff-utils'), ['response' => 403]);
    }
}

function bu_remove_import_export_menu_pages() {
    remove_submenu_page('tools.php', 'export.php');
    remove_submenu_page('tools.php', 'import.php');
}

// #15 Remove Command palette and shortcut in admin bar and hint in block editor
function bu_remove_command_palette() {
    wp_dequeue_script( 'wp-core-commands' );
    wp_deregister_script( 'wp-core-commands' );
}

function bu_remove_command_palette_shortcut($wp_admin_bar) {
    $wp_admin_bar->remove_node('command-palette');
}

function bu_hide_command_pallete_be_hint() {
    $custom_css = "
    .editor-header__center .editor-document-bar__shortcut {
            display: none !important; pointer-events: none; visibility: hidden !important;
    }";
    wp_add_inline_style( 'wp-components', $custom_css );
}

// #16 jQuery Migrate removal
function bu_remove_jquery_migrate( $scripts ) {
    if ( isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) {
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}

// #17 View transitions
function bu_disable_view_transitions() {
    wp_dequeue_style( 'wp-view-transitions-admin' );
    wp_deregister_style( 'wp-view-transitions-admin' );
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
    remove_action( 'wp_head', 'rsd_link' );
}

// #05 Shortlink
if (!empty($bloatoff_options['shortlink'])) {
    remove_action('wp_head', 'wp_shortlink_wp_head', 10);
}

// #06 Admin dashboard widgets
if (!empty($bloatoff_options['adminwidgets'])) {
    add_action( 'wp_dashboard_setup', 'bu_remove_all_dashboard_widgets' );
}

// #07 REST link in header
if (!empty($bloatoff_options['restapilink'])) {
    add_action('init', function() {
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
    }, 11);
}

// #08 oEmbed discovery link in header
if (!empty($bloatoff_options['oembeddisclink'])) {
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
}

// #09 Native XML Sitemap
if (!empty($bloatoff_options['nativexmlsitemap'])) {
    add_filter('wp_sitemaps_enabled', '__return_false');
}

// #10 Admin help tabs
if (!empty($bloatoff_options['adminhelptabs'])) {
    add_action( 'admin_head', 'bu_remove_help_tabs' );
}

// #11 WP logo submenu and thank you message
if (!empty($bloatoff_options['wplogoty'])) {
    add_action('wp_before_admin_bar_render','bu_admin_bar_remove_logo', 0 );
}

// #12 Site Health 
if (!empty($bloatoff_options['wpsitehealth'])) {
    add_filter('site_status_tests', 'bu_disable_site_health_tests');
    add_action('wp_loaded', 'bu_disable_site_health_scheduled_check');
    add_filter('rest_endpoints', 'bu_disable_site_health_rest_endpoints');
    add_filter('wp_fatal_error_handler_enabled', '__return_false');
    add_action('admin_menu', 'bu_remove_site_health_menu_pages', 1);
    add_filter('user_has_cap', 'bu_remove_site_health_capabilities', 999, 4);
}

// #13 Import/Export - menu pages
if (!empty($bloatoff_options['importexport'])) {
    add_action('admin_init', 'bu_block_import_export_page_access', 1);
    add_action('admin_menu', 'bu_remove_import_export_menu_pages', 1);
}

// #14 Disable WordPress AI functions
if (!empty($bloatoff_options['wpai'])) {
    add_filter( 'wp_supports_ai', '__return_false', 999);
}

// #15 Remove Command Palette
if (!empty($bloatoff_options['commandpalette'])) {
    add_action('admin_enqueue_scripts', 'bu_remove_command_palette');
    add_action('admin_bar_menu', 'bu_remove_command_palette_shortcut', 999);
    add_action('enqueue_block_editor_assets', 'bu_hide_command_pallete_be_hint' );
}

// #16 jQuery Migrate removal
if (!empty($bloatoff_options['jquerymigrate'])) {
    add_action('wp_default_scripts', 'bu_remove_jquery_migrate' );
}

// #17 View transitions
if (!empty($bloatoff_options['adminviewtransitions'])) {
    add_action('admin_enqueue_scripts', 'bu_disable_view_transitions' );
}