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

<div id="bou-settings-wrap" class="postbox">
    
    <div class="postbox-header">
        <h1><?php esc_html_e('Bloat-off: list of available settings', 'bloatoff-utils'); ?></h1>
    </div>

    <div class="inside">
        <form method="post" action="options.php">
            <?php settings_fields('bloatoff_options_group'); ?>

            <h2 class="bou-section-header"><?php esc_html_e('#01 Bloat', 'bloatoff-utils'); ?></h2>
            
            <!-- GUTENBERG SETTING -->
            <div class="single-bou-block">
                <h3><?php esc_html_e('Gutenberg styles', 'bloatoff-utils'); ?></h3>
                <p>
                    <span class="description"><?php esc_html_e('This will remove all gutenberg-related css files from loading on the frontend.', 'bloatoff-utils'); ?></span><br>
                    <span class="description"><?php esc_html_e('About ~117kb of savings, ~162kb if WooCommerce is active.', 'bloatoff-utils'); ?></span>
                </p>
                <div class="bou-checkbox-wrap">
                    <label>
                        <input type="checkbox" 
                               class="bou-chbx" 
                               name="bloatoff_settings[gutenberg]" 
                               value="1"
                               <?php checked(!empty($options['gutenberg']), true); ?>>
                        <?php esc_html_e('Disable Gutenberg styles?', 'bloatoff-utils'); ?>
                    </label>
                </div>
            </div>

            <!-- EMOJIS SETTING -->
            <div class="single-bou-block">
                <h3><?php esc_html_e('WordPress Emojis', 'bloatoff-utils'); ?></h3>
                <p>
                    <span class="description"><?php esc_html_e('This option will remove all the styles and scripts related to native Wordpress emoji module. This includes TinyMCE.', 'bloatoff-utils'); ?></span><br>
                    <span class="description"><?php esc_html_e('About ~20kb of savings + removal of CDN calls and stylesheets.', 'bloatoff-utils'); ?></span>
                </p>
                <div class="bou-checkbox-wrap">
                    <label>
                        <input type="checkbox" 
                               class="bou-chbx" 
                               name="bloatoff_settings[emojis]" 
                               value="1"
                               <?php checked(!empty($options['emojis']), true); ?>>
                        <?php esc_html_e('Disable WordPress emojis?', 'bloatoff-utils'); ?>
                    </label>
                </div>
            </div>

            <!-- RSS SETTING -->
            <div class="single-bou-block">
                <h3><?php esc_html_e('RSS feeds', 'bloatoff-utils'); ?></h3>
                <p>
                    <span class="description"><?php esc_html_e('This will remove the native option of RSS feeds - including comments.', 'bloatoff-utils'); ?></span><br>
                </p>
                <div class="bou-checkbox-wrap">
                    <label>
                        <input type="checkbox" 
                               class="bou-chbx" 
                               name="bloatoff_settings[rss]" 
                               value="1"
                               <?php checked(!empty($options['rss']), true); ?>>
                        <?php esc_html_e('Disable RSS feeds?', 'bloatoff-utils'); ?>
                    </label>
                </div>
            </div>

            <?php submit_button(__('Save Settings', 'bloatoff-utils')); ?>
        </form>

    </div>
</div>

<?php if (isset($_GET['settings-updated'])) { 
    echo '<div class="bou-settings-notices">'; 
        settings_errors('bloatoff_messages'); 
    echo '</div>'; } 
?>