<?php
/**
 * Settings Page HTML Output
 * Contains only the HTML markup for the settings page
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die;
}

// This file expects $options to be available
?>

<form method="post" action="options.php">
    <?php settings_fields('bloatoff_options_group'); ?>

    <!-- #01 BLOAT SETTINGS -->
    <div id="bou-settings-bloat" class="postbox boubox first-boubox">
        
        <div class="postbox-header">
            <h1><?php esc_html_e('Bloat', 'bloatoff-utils'); ?></h1>
        </div>

        <div class="inside">
            
            <!-- Settings -->
            <?php

            // Gutenberg setting
            bu_render_settings_block(array(
                'title' => __('Gutenberg styles', 'bloatoff-utils'),
                'description' => __('This will remove all gutenberg-related css files from loading on the frontend.', 'bloatoff-utils'),
                'savings' => __('About ~117kb of savings, ~162kb if WooCommerce is active.', 'bloatoff-utils'),
                'setting_id' => 'gutenberg',
                'warning' => __('WARNING: IT MAY brake your site, if you\'re using theme based on Gutenberg blocks.', 'bloatoff-utils'),
                'label' => __('Remove Gutenberg styles?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Emojis setting
            bu_render_settings_block(array(
                'title' => __('WordPress Emojis', 'bloatoff-utils'),
                'description' => __('This option will remove all the styles and scripts related to native Wordpress emoji module; be aware - it will also remove emojis from TinyMCE editor.', 'bloatoff-utils'),
                'savings' => __('About ~20kb of savings + removal of CDN calls and stylesheets.'),
                'setting_id' => 'emojis',
                'label' => __('Disable WordPress emojis?', 'bloatoff-utils'),
                'options' => $options
            ));

            // RSS Setting
            bu_render_settings_block(array(
                'title' => __('RSS feeds', 'bloatoff-utils'),
                'description' => __('This will remove the native option of RSS feeds - including comments RSS feed.', 'bloatoff-utils'),
                'setting_id' => 'rss',
                'label' => __('Disable RSS feeds?', 'bloatoff-utils'),
                'options' => $options
            ));

            // RSD Setting
            bu_render_settings_block(array(
                'title' => __('Really Simple Discovery', 'bloatoff-utils'),
                'description' => __('Removes RSD links from header; there\'s no need in having those, if you\'re not using services like Pingback or dedicated application requiring it.', 'bloatoff-utils'),
                'setting_id' => 'rsdl',
                'label' => __('Remove RSD?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Shortlink
            bu_render_settings_block(array(
                'title' => __('Shortlink', 'bloatoff-utils'),
                'description' => __('Removes shortlink to current post/page from header.', 'bloatoff-utils'),
                'setting_id' => 'shortlink',
                'label' => __('Remove shortlink?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Rest API link
            bu_render_settings_block(array(
                'title' => __('REST discovery link', 'bloatoff-utils'),
                'description' => __('Removes REST discovery link from head. Needed for specific uses/apps, otherwise not required.', 'bloatoff-utils'),
                'setting_id' => 'restapilink',
                'label' => __('Remove REST discovery link?', 'bloatoff-utils'),
                'options' => $options
            ));

            // oEmbed discovery link
            bu_render_settings_block(array(
                'title' => __('oEmbed discovery link', 'bloatoff-utils'),
                'description' => __('Removes oEmbed discovery link from header. Some external services may need it for creating fetch output.', 'bloatoff-utils'),
                'warning' => __('WARNING: May cause issues, while fetching content on external, non-wp related services.', 'bloatoff-utils'),
                'setting_id' => 'oembeddisclink',
                'label' => __('Remove oEmbed discovery link?', 'bloatoff-utils'),
                'options' => $options
            ));

            // jQuery Migrate
            bu_render_settings_block(array(
                'title' => __('jQuery Migrate', 'bloatoff-utils'),
                'description' => __('Tool for backward jQuery compability (It basically allows to preserve compability with jQuery versions prior to 1.9.), mostly redundant nowadays and disabled by default from WP versions 5.5.0 onwards; some plugins, scripts or modules might have kept it enabled.', 'bloatoff-utils'),
                'savings' => __('About ~14kb of savings.'),
                'setting_id' => 'jquerymigrate',
                'readmore' => 'https://make.wordpress.org/core/2020/06/29/updating-jquery-version-shipped-with-wordpress/',
                'label' => __('Remove jQuery Migrate script?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Admin Widgets
            bu_render_settings_block(array(
                'title' => __('Admin widgets in Dashboard', 'bloatoff-utils'),
                'description' => __('Removes all default widgets in admin dashboard - like quick draft, activity, news etc.', 'bloatoff-utils'),
                'setting_id' => 'adminwidgets',
                'label' => __('Remove all default Wordpress admin widgets in dashboard?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Native Sitemap
            bu_render_settings_block(array(
                'title' => __('Native XML Sitemap', 'bloatoff-utils'),
                'description' => __('Version 5.5.0 of Wordpress introduced native XML sitemaps, those are created by default via /wp-sitemap.xml; if you\'re using any SEO plugin with sitemap enabled, then this (native) functionality is redundant.', 'bloatoff-utils'),
                'setting_id' => 'nativexmlsitemap',
                'readmore' => 'https://wordpress.org/documentation/wordpress-version/version-5-5/#search',
                'label' => __('Remove native XML Sitemap?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Admin help tabs
            bu_render_settings_block(array(
                'title' => __('Admin help tabs', 'bloatoff-utils'),
                'description' => __('Removes all help tabs from the contextual help for the screen.', 'bloatoff-utils'),
                'setting_id' => 'adminhelptabs',
                'label' => __('Remove admin help tabs?', 'bloatoff-utils'),
                'options' => $options
            ));

            // WP Logo and Thank you setting
            bu_render_settings_block(array(
                'title' => __('WP Logo sub-menu & Thank you message', 'bloatoff-utils'),
                'description' => __('This will remove "About Wordpress" sub-menu from top of admin menu and "Thank you" message at the bottom of footer area in admin panel.', 'bloatoff-utils'),
                'setting_id' => 'wplogoty',
                'label' => __('Disable WP sub-menu and thank you message?', 'bloatoff-utils'),
                'options' => $options
            ));

            ?>

        </div>
    </div>

    <!-- #02 UTILITIES -->
    <div id="bou-settings-utilities" class="postbox boubox second-boubox">

        <div class="postbox-header">
            <h1><?php esc_html_e('Utilities', 'bloatoff-utils'); ?></h1>
        </div>

        <div class="inside">

            <!-- Settings -->
            <?php

            // Comments system setting
            bu_render_settings_block(array(
                'title' => __('Comments system removal', 'bloatoff-utils'),
                'description' => __('It will disable comments system completely; also set proper redirections and removes admin pages for comment managament.', 'bloatoff-utils'),
                'setting_id' => 'comments',
                'label' => __('Disable built-in Wordpress comment system?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Widgets setting
            bu_render_settings_block(array(
                'title' => __('Widgets removal', 'bloatoff-utils'),
                'description' => __('It will remove native widgets system (Appearance sub-menu).', 'bloatoff-utils'),
                'setting_id' => 'widgets',
                'label' => __('Remove widget support?', 'bloatoff-utils'),
                'options' => $options
            ));

            // oEmbed setting
            bu_render_settings_block(array(
                'title' => __('oEmbed restriction', 'bloatoff-utils'),
                'description' => __('It will disable oEmbed on site, while keeping it enabled for external platforms/apps.', 'bloatoff-utils'),
                'setting_id' => 'oembed',
                'label' => __('Restrict oEmbed?', 'bloatoff-utils'),
                'options' => $options
            ));

            // XMLRPC setting
            bu_render_settings_block(array(
                'title' => __('XML-RPC', 'bloatoff-utils'),
                'description' => __('May be required by some external apps/platforms, but otherwise should be switched off.', 'bloatoff-utils'),
                'setting_id' => 'xmlrpc',
                'readmore' => 'https://codex.wordpress.org/XML-RPC_Support',
                'label' => __('Disable XML-RPC?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Self-pingbacks setting
            bu_render_settings_block(array(
                'title' => __('Self-pingbacks', 'bloatoff-utils'),
                'description' => __('Disables self-pingbacks, after new posts creation or on-site linking.', 'bloatoff-utils'),
                'setting_id' => 'selfping',
                'readmore' => 'https://en.wikipedia.org/wiki/Pingback',
                'label' => __('Disable self-pingbacks?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Heartbeat
            bu_render_number_block(array(
                'title' => __('WordPress Heartbeat API', 'bloatoff-utils'),
                'description' => __('The Heartbeat API is used for autosaving, post locking, and other real-time features. Increasing the interval reduces server load but may delay these features.', 'bloatoff-utils'),
                'savings' => __('Reduces server requests and CPU usage on both frontend and backend.', 'bloatoff-utils'),
                'setting_id' => 'heartbeat',
                'checkbox_label' => __('Modify WordPress Heartbeat interval?', 'bloatoff-utils'),
                'number_label' => __('Interval (seconds):', 'bloatoff-utils'),
                'number_min' => 1,
                'number_max' => 86400,
                'number_default' => 15,
                'number_description' => __('Default: 15 seconds. Range: 1-86400 seconds (1 day).', 'bloatoff-utils'),
                'warning' => __('WARNING: Be VERY careful, when changing that interval, it could brake some essential functionalities on your website.', 'bloatoff-utils'),
                'options' => $options
            ));

            ?>

        </div>

    </div>

    <?php submit_button(__('Save Settings', 'bloatoff-utils')); ?>
</form>

<?php if (isset($_GET['settings-updated'])) { 
    echo '<div class="bou-settings-notices">'; 
        settings_errors('bloatoff_messages'); 
    echo '</div>'; } 
?>