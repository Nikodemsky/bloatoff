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
function disable_emojis() {
    $options = get_option('bloatoff_settings', array());

    if (!empty($options['emojis'])) {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
        add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
    }
}
add_action( 'init', 'disable_emojis' );

// Emoji removal - TinyMCE plugin
function disable_emojis_tinymce( $plugins ) {
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
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
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
    }
}
add_action('init', 'bu_disable_feeds');

function bu_disable_feeds_callback() {
    wp_die(__('No feeds available!', 'bloatoff-utils'));
}