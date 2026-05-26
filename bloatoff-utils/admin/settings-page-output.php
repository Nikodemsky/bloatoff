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

            // AI settings
            bu_render_settings_block(array(
                'title' => __('WordPress AI', 'bloatoff-utils'),
                'description' => __('This option will forcibly disable all of the WordPress AI functions introduced in version 7.0.', 'bloatoff-utils'),
                'setting_id' => 'wpai',
                // Translators: %1$s - <strong>, :%2$s - </strong>
                'warning' => __('%1$sWARNING:%2$s This option has no effect on versions prior to 7.0.', 'bloatoff-utils'),
                'label' => __('Disable AI functions in WordPress?', 'bloatoff-utils'),
                'readmore' => 'https://make.wordpress.org/core/2026/05/14/wordpress-7-0-field-guide/#ai-building-blocks-of-the-future',
                'options' => $options
            ));

            // View transitions
            bu_render_settings_block(array(
                'title' => __('View transitions', 'bloatoff-utils'),
                'description' => __('This option will disable transition effect animation introduced in version 7.0.', 'bloatoff-utils'),
                'setting_id' => 'adminviewtransitions',
                // Translators: %1$s - <strong>, :%2$s - </strong>
                'label' => __('Disable view transitions?', 'bloatoff-utils'),
                'readmore' => 'https://core.trac.wordpress.org/ticket/64470',
                'options' => $options
            ));

            // Gutenberg setting
            bu_render_settings_block(array(
                'title' => __('Gutenberg styles', 'bloatoff-utils'),
                'description' => __('This will remove all Gutenberg-related css files from loading on the frontend.', 'bloatoff-utils'),
                'savings' => __('Approximately 117KB of savings, or 162KB if WooCommerce is active.', 'bloatoff-utils'),
                'setting_id' => 'gutenberg',
                // Translators: %1$s - <strong>, :%2$s - </strong>
                'warning' => __('%1$sWARNING:%2$s This may break your site, if you\'re using theme, plugin or module based on Gutenberg blocks.', 'bloatoff-utils'),
                'label' => __('Remove Gutenberg styles?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Site Health setting
            bu_render_settings_block(array(
                'title' => __('Site Health', 'bloatoff-utils'),
                // Translators: %3$s3 - <br>
                'description' => __('Since there\'s no safe way to completely remove the Site Health module from WP, without modifying the core, this function is limited to:%3$s1. fatal error handler removal;%3$s2. REST API endpoints removal;%3$s3. disabling all scheduled checks;%3$s4. disabling all initial tests;%3$s5. disabling access to site-health.php page for all roles, including super-admins.%3$sNote: The Site Health metabox on the dashboard is handled by "Admin widgets in Dashboard" option.', 'bloatoff-utils'),
                'setting_id' => 'wpsitehealth',
                // Translators: %1$s - <strong>, :%2$s - </strong>
                'warning' => __('%1$sWARNING:%2$s Some plugins may depend on that functionality; additionally your admin, super-admin or support might need access to site technical data.', 'bloatoff-utils'),
                'label' => __('Disable Site Health?', 'bloatoff-utils'),
                'readmore' => 'https://wordpress.org/documentation/article/site-health-screen/',
                'options' => $options
            ));

            // Command Palette setting
            bu_render_settings_block(array(
                'title' => __('Command Palette', 'bloatoff-utils'),
                // Translators: %3$s3 - <br>
                'description' => __('This option will remove the shortcut command palette, available in the admin panel after clicking on the magnifier icon (admin top bar) or pressing Ctrl+K.', 'bloatoff-utils'),
                'setting_id' => 'commandpalette',
                // Translators: %1$s - <strong>, :%2$s - </strong>
                'label' => __('Disable Command Palette?', 'bloatoff-utils'),
                'readmore' => 'https://wordpress.org/documentation/article/site-editor-command-palette/',
                'options' => $options
            ));

            // jQuery migrate
            bu_render_settings_block(array(
                'title' => __('jQuery Migrate', 'bloatoff-utils'),
                // Translators: %3$s3 - <br>
                'description' => __('This option will remove the outdated jQuery Migrate script included in Admin Panel by default.', 'bloatoff-utils'),
                'savings' => __('Approximately 14KB of savings.', 'bloatoff-utils'),
                'warning' => __('%1$sWARNING:%2$s While in most cases you probably won\'t need it, make sure that none of your plugins/themes/modules or anything else will require backward compatibility with older jQuery versions.', 'bloatoff-utils'),
                'setting_id' => 'jquerymigrate',
                'readmore' => 'https://github.com/jquery/jquery-migrate#jquery-migrate',
                'label' => __('Disable jQuery Migrate?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Emojis setting
            bu_render_settings_block(array(
                'title' => __('WordPress Emojis', 'bloatoff-utils'),
                // Translators: %3$s3 - <br>
                'description' => __('This option will remove all the styles and scripts related to native WordPress emojis module;%3$s be aware — it will also remove emojis from TinyMCE editor.', 'bloatoff-utils'),
                'savings' => __('Approximately 20KB of savings, plus removal of CDN calls.', 'bloatoff-utils'),
                'setting_id' => 'emojis',
                'readmore' => 'https://wordpress.org/documentation/wordpress-version/version-4-2/#emoji',
                'label' => __('Disable WordPress emojis?', 'bloatoff-utils'),
                'options' => $options
            ));

            // RSS Setting
            bu_render_settings_block(array(
                'title' => __('RSS feeds', 'bloatoff-utils'),
                'description' => __('This will remove the native RSS feed functionality — including the comments RSS feed.', 'bloatoff-utils'),
                'setting_id' => 'rss',
                'readmore' => 'https://developer.wordpress.org/advanced-administration/wordpress/feeds/',
                'label' => __('Disable RSS feeds?', 'bloatoff-utils'),
                'options' => $options
            ));

            // RSD Setting
            bu_render_settings_block(array(
                'title' => __('Really Simple Discovery', 'bloatoff-utils'),
                'description' => __('Removes RSD links from the header. There\'s no need for these if you\'re not using services like Pingback or a dedicated application that requires them.', 'bloatoff-utils'),
                'setting_id' => 'rsdl',
                'label' => __('Remove RSD?', 'bloatoff-utils'),
                'readmore' => 'https://developer.wordpress.org/reference/functions/rsd_link/',
                'options' => $options
            ));

            // Shortlink
            bu_render_settings_block(array(
                'title' => __('Shortlink', 'bloatoff-utils'),
                'description' => __('Removes shortlink to current post or page from the header.', 'bloatoff-utils'),
                'setting_id' => 'shortlink',
                'label' => __('Remove shortlink?', 'bloatoff-utils'),
                'readmore' => 'https://developer.wordpress.org/reference/functions/wp_shortlink_wp_head/',
                'options' => $options
            ));

            // Rest API link
            bu_render_settings_block(array(
                'title' => __('REST discovery link', 'bloatoff-utils'),
                // Translators: %3$s3 - <br>
                'description' => __('Removes the REST discovery link from the head.%3$s Only needed for specific uses or apps — otherwise not required.', 'bloatoff-utils'),
                'setting_id' => 'restapilink',
                'label' => __('Remove REST discovery link?', 'bloatoff-utils'),
                'readmore' => 'https://developer.wordpress.org/reference/functions/rest_output_link_wp_head/',
                'options' => $options
            ));

            // oEmbed discovery link
            bu_render_settings_block(array(
                'title' => __('oEmbed discovery link', 'bloatoff-utils'),
                // Translators: %3$s3 - <br>
                'description' => __('Removes the oEmbed discovery link from the header.%3$s Some external services may need this to fetch content from your site.', 'bloatoff-utils'),
                // Translators: %1$s - <strong>, :%2$s - </strong>
                'warning' => __('%1$sWARNING:%2$s May cause issues when fetching content on external, non-WordPress services.', 'bloatoff-utils'),
                'setting_id' => 'oembeddisclink',
                'label' => __('Remove oEmbed discovery link?', 'bloatoff-utils'),
                'readmore' => 'https://developer.wordpress.org/reference/functions/wp_oembed_add_discovery_links/',
                'options' => $options
            ));

            // Admin Widgets
            bu_render_settings_block(array(
                'title' => __('Admin widgets in Dashboard', 'bloatoff-utils'),
                'description' => __('Removes all default widgets from the admin dashboard — like Quick Draft, Activity, News, etc.', 'bloatoff-utils'),
                'setting_id' => 'adminwidgets',
                'readmore' => 'https://wordpress.org/documentation/article/dashboard-screen/#dashboard-%e2%86%92-home',
                'label' => __('Remove all default Wordpress admin widgets in dashboard?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Native Sitemap
            bu_render_settings_block(array(
                'title' => __('Native XML Sitemap', 'bloatoff-utils'),
                // Translators: %3$s3 - <br>
                'description' => __('WordPress 5.5.0 introduced native XML sitemaps, which are created by default at /wp-sitemap.xml.%3$s If you\'re using an SEO plugin with its own sitemap enabled, this native functionality is redundant.', 'bloatoff-utils'),
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
                'description' => __('This will remove the "About WordPress" sub-menu from the top of the admin menu and the "Thank you" message from the footer area in the admin panel.', 'bloatoff-utils'),
                'setting_id' => 'wplogoty',
                'label' => __('Disable WP sub-menu and thank you message?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Import/Export pages
            bu_render_settings_block(array(
                'title' => __('Import/Export Pages', 'bloatoff-utils'),
                'description' => __('This will remove and restrict access to the import/export pages from the Tools admin menu.', 'bloatoff-utils'),
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
                'description' => __('This will disable the comments system completely, set proper redirects, and remove admin pages for comment management.', 'bloatoff-utils'),
                // Translators: %1$s - <strong>, :%2$s - </strong>
                'warning' => __('%1$sWARNING:%2$s If you\'re connected to an external comment system like Disqus via native comment support (for example, through the official Disqus plugin), this will also remove/disable that connection.', 'bloatoff-utils'),
                'setting_id' => 'comments',
                'label' => __('Disable built-in WordPress comment system?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Widgets setting
            bu_render_settings_block(array(
                'title' => __('Widgets removal', 'bloatoff-utils'),
                'description' => __('This will remove the native widget system (from the Appearance admin menu).', 'bloatoff-utils'),
                'setting_id' => 'widgets',
                'readmore' => 'https://wordpress.org/documentation/article/manage-wordpress-widgets/',
                'label' => __('Remove widget support?', 'bloatoff-utils'),
                'options' => $options
            ));

            // oEmbed setting
            bu_render_settings_block(array(
                'title' => __('oEmbed restriction', 'bloatoff-utils'),
                'description' => __('It will disable oEmbed on site, while keeping it enabled for external platforms/apps/websites.', 'bloatoff-utils'),
                'setting_id' => 'oembed',
                'readmore' => 'https://developer.wordpress.org/advanced-administration/wordpress/oembed/',
                'label' => __('Restrict oEmbed?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Self-pingbacks setting
            bu_render_settings_block(array(
                'title' => __('Self-pingbacks', 'bloatoff-utils'),
                'description' => __('Disables self-pingbacks after new post creation or internal linking.', 'bloatoff-utils'),
                'setting_id' => 'selfping',
                'readmore' => 'https://en.wikipedia.org/wiki/Pingback',
                'label' => __('Disable self-pingbacks?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Image processing engine
            bu_render_settings_block(array(
                'title' => __('Image Processing engine', 'bloatoff-utils'),
                'description' => __('WordPress uses Imagick by default if available. This option forces the use of GD, which is generally faster. The downside is that GD supports far fewer image formats, and image quality may drop', 'bloatoff-utils'),
                // Translators: %1$s - <strong>, :%2$s - </strong>
                'warning' => __('%1$sWARNING:%2$s Since the GD PHP extension requires additional configuration for WebP/AVIF formats, those may not be available for plugins like CompressX or even for native processing in the media library.', 'bloatoff-utils'),
                'setting_id' => 'ipe',
                'readmore' => 'https://github.com/WordPress/WordPress/blob/master/wp-includes/media.php#L4292',
                'label' => __('Force GD Image Processing engine?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Tags taxonomy - default posts
            bu_render_settings_block(array(
                'title' => __('Tags taxonomy removal', 'bloatoff-utils'),
                'description' => __('This will remove the native tags taxonomy from the default post type (Posts → Tags in the admin menu). Many non-blog websites don\'t need tags at all.', 'bloatoff-utils'),
                // Translators: %1$s - <strong>, :%2$s - </strong>
                'warning' => __('%1$sWARNING:%2$s If you have any tags indexed and at least some traffic comes through them — this option can affect your position on search engines like Google.', 'bloatoff-utils'),
                'setting_id' => 'tagstax',
                'readmore' => 'https://developer.wordpress.org/themes/classic-themes/basics/categories-tags-custom-taxonomies/#default-taxonomies',
                'label' => __('Unregister default tags taxonomy?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Author archives
            bu_render_settings_block(array(
                'title' => __('Author archives', 'bloatoff-utils'),
                // Translators: %3$s3 - <br>
                'description' => __('Author archive pages can be considered redundant on installations where posts are not categorized by WP users (as authors). %3$s Since author archives are part of WP Core and can\'t be "removed" per se, this function is limited to:%3$s 1. redirection of any author archive page queries to the homepage (301 redirect); %3$s 2. removal of author links from functions like author_link/the_author_posts_link; %3$s 3. removal of authors from native sitemaps (if actively used). %3$s Note: Most of the time, author archive indexation can be configured in the settings of most popular SEO plugins.', 'bloatoff-utils'),
                // Translators: %1$s - <strong>, :%2$s - </strong>
                'warning' => __('%1$sWARNING:%2$s If you have author pages indexed and they are vital for your website\'s blog categorization — this option can affect your position on search engines like Google.', 'bloatoff-utils'),
                'setting_id' => 'authorarchives',
                'readmore' => 'https://codex.wordpress.org/Author_Templates',
                'label' => __('Disable author archives?', 'bloatoff-utils'),
                'options' => $options
            ));

            // Heartbeat
            bu_render_number_block(array(
                'title' => __('WordPress Heartbeat API', 'bloatoff-utils'),
                'description' => __('The Heartbeat API is used for autosaving, post locking, and other real-time features. Increasing the interval reduces server load but may cause issues with functionality that heavily relies on the Heartbeat API.', 'bloatoff-utils'),
                'savings' => __('This reduces server requests and CPU usage on both the frontend and backend.', 'bloatoff-utils'),
                'setting_id' => 'heartbeat',
                'checkbox_label' => __('Modify WordPress Heartbeat interval?', 'bloatoff-utils'),
                'number_label' => __('Interval (seconds):', 'bloatoff-utils'),
                'number_min' => 1,
                'number_max' => 3600,
                'number_default' => 15,
                'readmore' => 'https://developer.wordpress.org/plugins/javascript/heartbeat-api/',
                'number_description' => __('Default: 15 seconds. Range: 1-3600 seconds (1 hour).', 'bloatoff-utils'),
                // Translators: %1$s - <strong>, :%2$s - </strong>
                'warning' => __('%1$sWARNING:%2$s Be very careful when changing this interval — it could break some essential functionality on your website.', 'bloatoff-utils'),
                'options' => $options
            ));

            // Global revisions
            bu_render_number_block(array(
                'title' => __('Revisions', 'bloatoff-utils'),
                // Translators: %1$s - <strong>, :%2$s - </strong>, %3$s3 - <br>
                'description' => __('This option allows you to change the global number of revisions (including all post types that support revisions) per post/page. By default, WordPress does not limit the number of revisions, which usually makes the database much bigger than it should be — especially on content-heavy websites like blogs. This leads to worse website load times.%3$s How it works:%3$s %1$s-1 / Off%2$s - Default, no limit on revisions.%3$s %1$s0%2$s - Revisions are disabled. %3$s %1$s1-999%2$s - Revisions for all post types are limited to this number.%3$s Note: Revisions won\'t be removed right away once this option is enabled — you need to update each post/page to have its revisions removed. If you want to clear your installation of revisions globally, try using plugins like "WP-Sweep" or "Optimize Database after Deleting Revisions."', 'bloatoff-utils'),
                'savings' => __('Reduces load on the database and its size in the long run.', 'bloatoff-utils'),
                'setting_id' => 'revisions',
                'checkbox_label' => __('Modify global revisions number?', 'bloatoff-utils'),
                'number_label' => __('Revisions:', 'bloatoff-utils'),
                'number_min' => 0,
                'number_max' => 99,
                'number_default' => -1,
                'readmore' => 'https://wordpress.org/documentation/article/revisions/',
                'number_description' => __('Default: -1 (unlimited). Range: 1-99.', 'bloatoff-utils'),
                // Translators: %1$s - <strong>, :%2$s - </strong>
                'warning' => __('%1$sWARNING:%2$s This option is not designed to override specific post type capabilities — if a post type doesn\'t support revisions, this option won\'t change that.', 'bloatoff-utils'),
                'options' => $options
            ));

            ?>

        </div>

    </div>

    

    <?php submit_button(__('Save Settings', 'bloatoff-utils')); ?>
</form>

<?php 
// Nonce verification is handled by the Settings API via settings_fields().
// phpcs:ignore WordPress.Security.NonceVerification.Recommended
if ( isset( $_GET['settings-updated'] ) && sanitize_key( $_GET['settings-updated'] ) ) { 
    echo '<div class="bou-settings-notices">'; 
        settings_errors( 'bloatoff_messages' ); 
    echo '</div>'; } 
?>