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
                'warning' => __('%1$sWARNING:%2$s IT MAY brake your site, if you\'re using theme/plugin/module based on Gutenberg blocks.', 'bloatoff-utils'),
                'label' => __('Remove Gutenberg styles?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Site Health setting
            bu_render_settings_block(array(
                'title' => __('Site Health', 'bloatoff-utils'),
                'description' => __('Since there\'s no safe way of removing Site Health module completely from WP, without modifiying the core this function is limited to:%3$s1. fatal error handler removal;%3$s2. REST API endpoints removal;%3$s3. disabling all scheduled checks;%3$s4. disabling all initial tests;%3$s5. disabling access to site-health.php page for all roles, including super-admins.%3$sNote: Site-health metabox, from dashboard is handled by "Admin widgets in Dashboard" option.', 'bloatoff-utils'),
                'setting_id' => 'wpsitehealth',
                'warning' => __('%1$sWARNING:%2$s Some plugins may depend on that functionality; additionally your admin/super-admin/support might need access to site technical data; consider enabling this option carefuly.', 'bloatoff-utils'),
                'label' => __('Disable Site Health?', 'bloatoff-utils'),
                'readmore' => 'https://wordpress.org/documentation/article/site-health-screen/',
                'options' => $options
            ));

            // Emojis setting
            bu_render_settings_block(array(
                'title' => __('WordPress Emojis', 'bloatoff-utils'),
                'description' => __('This option will remove all the styles and scripts related to native Wordpress emoji module;%3$s be aware - it will also remove emojis from TinyMCE editor.', 'bloatoff-utils'),
                'savings' => __('About ~20kb of savings + removal of CDN calls and stylesheets.'),
                'setting_id' => 'emojis',
                'readmore' => 'https://wordpress.org/documentation/wordpress-version/version-4-2/#emoji',
                'label' => __('Disable WordPress emojis?', 'bloatoff-utils'),
                'options' => $options
            ));

            // RSS Setting
            bu_render_settings_block(array(
                'title' => __('RSS feeds', 'bloatoff-utils'),
                'description' => __('This will remove the native option of RSS feeds - including comments RSS feed.', 'bloatoff-utils'),
                'setting_id' => 'rss',
                'readmore' => 'https://developer.wordpress.org/advanced-administration/wordpress/feeds/',
                'label' => __('Disable RSS feeds?', 'bloatoff-utils'),
                'options' => $options
            ));

            // RSD Setting
            bu_render_settings_block(array(
                'title' => __('Really Simple Discovery', 'bloatoff-utils'),
                'description' => __('Removes RSD links from header; there\'s no need in having those, if you\'re not using services like Pingback or dedicated application requiring it.', 'bloatoff-utils'),
                'setting_id' => 'rsdl',
                'label' => __('Remove RSD?', 'bloatoff-utils'),
                'readmore' => 'https://developer.wordpress.org/reference/functions/rsd_link/',
                'options' => $options
            ));

            // Shortlink
            bu_render_settings_block(array(
                'title' => __('Shortlink', 'bloatoff-utils'),
                'description' => __('Removes shortlink to current post/page from header.', 'bloatoff-utils'),
                'setting_id' => 'shortlink',
                'label' => __('Remove shortlink?', 'bloatoff-utils'),
                'readmore' => 'https://developer.wordpress.org/reference/functions/wp_shortlink_wp_head/',
                'options' => $options
            ));

            // Rest API link
            bu_render_settings_block(array(
                'title' => __('REST discovery link', 'bloatoff-utils'),
                'description' => __('Removes REST discovery link from head.%3$s Needed for specific uses/apps, otherwise not required.', 'bloatoff-utils'),
                'setting_id' => 'restapilink',
                'label' => __('Remove REST discovery link?', 'bloatoff-utils'),
                'readmore' => 'https://developer.wordpress.org/reference/functions/rest_output_link_wp_head/',
                'options' => $options
            ));

            // oEmbed discovery link
            bu_render_settings_block(array(
                'title' => __('oEmbed discovery link', 'bloatoff-utils'),
                'description' => __('Removes oEmbed discovery link from header.%3$s Some external services may need it for creating fetch output.', 'bloatoff-utils'),
                'warning' => __('%1$sWARNING:%2$s May cause issues, while fetching content on external, non-wp related services.', 'bloatoff-utils'),
                'setting_id' => 'oembeddisclink',
                'label' => __('Remove oEmbed discovery link?', 'bloatoff-utils'),
                'readmore' => 'https://developer.wordpress.org/reference/functions/wp_oembed_add_discovery_links/',
                'options' => $options
            ));

            // Admin Widgets
            bu_render_settings_block(array(
                'title' => __('Admin widgets in Dashboard', 'bloatoff-utils'),
                'description' => __('Removes all default widgets in admin dashboard - like quick draft, activity, news etc.', 'bloatoff-utils'),
                'setting_id' => 'adminwidgets',
                'readmore' => 'https://wordpress.org/documentation/article/dashboard-screen/#dashboard-%e2%86%92-home',
                'label' => __('Remove all default Wordpress admin widgets in dashboard?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Native Sitemap
            bu_render_settings_block(array(
                'title' => __('Native XML Sitemap', 'bloatoff-utils'),
                'description' => __('Version 5.5.0 of Wordpress introduced native XML sitemaps, those are created by default via /wp-sitemap.xml; if you\'re using any SEO plugin with sitemap enabled, then this (native) functionality is redundant.', 'bloatoff-utils'),
                'setting_id' => 'nativexmlsitemap',
                'readmore' => 'https://wordpress.org/documentation/wordpress-version/version-5-5/#search',
                'label' => __('Disable native XML Sitemap?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Admin help tabs
            bu_render_settings_block(array(
                'title' => __('Admin help tabs', 'bloatoff-utils'),
                'description' => __('Removes all help tabs from the contextual help for the screen.', 'bloatoff-utils'),
                'setting_id' => 'adminhelptabs',
                'readmore' => 'https://wordpress.org/documentation/article/administration-screens/#help',
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

            // Import/Export pages
            bu_render_settings_block(array(
                'title' => __('Import/Export Pages', 'bloatoff-utils'),
                'description' => __('This will simply remove and restrict access to import/export pages from Tools admin menu tab.', 'bloatoff-utils'),
                'setting_id' => 'importexport',
                'label' => __('Disable Import/Export pages?', 'bloatoff-utils'),
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
                'warning' => __('%1$sWARNING:%2$s If you\'re connected to external comment systems like Disqus via native comment support (for example, by installing official Disqus plugin), it will also remove/disable that connection.', 'bloatoff-utils'),
                'setting_id' => 'comments',
                'label' => __('Disable built-in Wordpress comment system?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Widgets setting
            bu_render_settings_block(array(
                'title' => __('Widgets removal', 'bloatoff-utils'),
                'description' => __('It will remove native widgets system (Appearance admin menu tab).', 'bloatoff-utils'),
                'setting_id' => 'widgets',
                'readmore' => 'https://wordpress.org/documentation/article/manage-wordpress-widgets/',
                'label' => __('Remove widget support?', 'bloatoff-utils'),
                'options' => $options
            ));

            // oEmbed setting
            bu_render_settings_block(array(
                'title' => __('oEmbed restriction', 'bloatoff-utils'),
                'description' => __('It will disable oEmbed on site, while keeping it enabled for external platforms/apps.', 'bloatoff-utils'),
                'setting_id' => 'oembed',
                'readmore' => 'https://developer.wordpress.org/advanced-administration/wordpress/oembed/',
                'label' => __('Restrict oEmbed?', 'bloatoff-utils'),
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

            // Image processing engine
            bu_render_settings_block(array(
                'title' => __('Image Processing engine', 'bloatoff-utils'),
                'description' => __('WordPress is using Imagick by default, if available - this option forces usage of GD, which is generally faster. The downside is, that it supports a lot less image formats and image quality may drop.', 'bloatoff-utils'),
                'warning' => __('%1$sWARNING:%2$s Since GD PHP extension requires additional configuration for webp/avif formats, those may not be available to use, for plugins like CompressX or even natively processed in media library.', 'bloatoff-utils'),
                'setting_id' => 'ipe',
                'readmore' => 'https://github.com/WordPress/WordPress/blob/master/wp-includes/media.php#L4292',
                'label' => __('Force GD Image Processing engine?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Tags taxonomy - default posts
            bu_render_settings_block(array(
                'title' => __('Tags taxonomy removal', 'bloatoff-utils'),
                'description' => __('It will remove native tags taxonomy from default post type (Posts->Tags admin menu tab).%3$s Many non-blogs websites don\'t need those at all.', 'bloatoff-utils'),
                'warning' => __('%1$sWARNING:%2$s If you have any tags indexed and at least some traffic comes through those - this option can affect your position at search engines like Google.', 'bloatoff-utils'),
                'setting_id' => 'tagstax',
                'readmore' => 'https://developer.wordpress.org/themes/classic-themes/basics/categories-tags-custom-taxonomies/#default-taxonomies',
                'label' => __('Unregister default tags taxonomy?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Author archives
            bu_render_settings_block(array(
                'title' => __('Author archives', 'bloatoff-utils'),
                'description' => __('Authors archive pages can be considered redundant on installations, where posts are not categorized by WP users (as authors). %3$s Since author archives are part of WP Core and can\'t be "removed" per se, this function is limited to:%3$s 1. redirection of any author archive page queries to homepage (301 redirect); %3$s 2. removal of any author\'s links from functions like author_link\the_author_posts_link; %3$s 3. removal of author\'s from native sitemaps (if it\'s actively used). %3$s Note: Most of the times, author\'s archives indexation or handling can be configured in settings of most of the popular SEO plugins. ', 'bloatoff-utils'),
                'warning' => __('%1$sWARNING:%2$s If you have any author pages indexed and those are considered vital for your website blog categorization - this option can affect your position at search engines like Google.', 'bloatoff-utils'),
                'setting_id' => 'authorarchives',
                'readmore' => 'https://codex.wordpress.org/Author_Templates',
                'label' => __('Disable author archives?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Heartbeat
            bu_render_number_block(array(
                'title' => __('WordPress Heartbeat API', 'bloatoff-utils'),
                'description' => __('The Heartbeat API is used for autosaving, post locking, and other real-time features. Increasing the interval reduces server load but may cause issues on functionalities, that heavily relies on Heartbeat API.', 'bloatoff-utils'),
                'savings' => __('Reduces server requests and CPU usage on both frontend and backend.', 'bloatoff-utils'),
                'setting_id' => 'heartbeat',
                'checkbox_label' => __('Modify WordPress Heartbeat interval?', 'bloatoff-utils'),
                'number_label' => __('Interval (seconds):', 'bloatoff-utils'),
                'number_min' => 1,
                'number_max' => 3600,
                'number_default' => 15,
                'readmore' => 'https://developer.wordpress.org/plugins/javascript/heartbeat-api/',
                'number_description' => __('Default: 15 seconds. Range: 1-3600 seconds (1 hour).', 'bloatoff-utils'),
                'warning' => __('%1$sWARNING:%2$s Be VERY careful, when changing that interval, it could brake some essential functionalities on your website.', 'bloatoff-utils'),
                'options' => $options
            ));

            // Global revisions
            bu_render_number_block(array(
                'title' => __('Revisions', 'bloatoff-utils'),
                'description' => __('This option allows to change global number of revisions (including all post types, that actually supports revisions) per post/page. By default WordPress do not limit revisions number in any way and this usually makes database way bigger, than it should be - especially on content-heavy websites like blogs; this leads to worse website load times.%3$s How it works:%3$s %1$s-1 / Off%2$s - Default, no limit on revisions.%3$s %1$s0%2$s - revisions are disabled. %3$s %1$s1-999%2$s - revisions number for all posts type are limited to this number.%3$s Note: revisions WON\'T be removed right away, once this option is enabled - you need to update specific post/page, to have it\'s revisions removed.%3$s If you want to clear your installation off revisions globally, then try using plugins like "WP-Sweep" or "Optimize Database after Deleting Revisions"', 'bloatoff-utils'),
                'savings' => __('Reduces load on database and it\'s size on the long run.', 'bloatoff-utils'),
                'setting_id' => 'revisions',
                'checkbox_label' => __('Modify global revisions number?', 'bloatoff-utils'),
                'number_label' => __('Revisions:', 'bloatoff-utils'),
                'number_min' => 0,
                'number_max' => 99,
                'number_default' => -1,
                'readmore' => 'https://wordpress.org/documentation/article/revisions/',
                'number_description' => __('Default: -1 (unlimited). Range: 1-99.', 'bloatoff-utils'),
                'warning' => __('%1$sWARNING:%2$s This option is not designed to override specific post type capabilities - if it doesn\'t support revisions, then this option won\'t change it in any way.', 'bloatoff-utils'),
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