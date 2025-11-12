<?php 

/*** Admin Settings Page ***/

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die;
}

// Register settings
function bu_register_settings() {
    register_setting(
        'bloatoff_options_group',
        'bloatoff_settings',
        array(
            'type' => 'array',
            'sanitize_callback' => 'bu_sanitize_settings',
            'default' => array()
        )
    );
}
add_action('admin_init', 'bu_register_settings');

// Sanitize settings
function bu_sanitize_settings($input) {
    $sanitized = array();
    
    if (isset($input['gutenberg'])) {
        $sanitized['gutenberg'] = (bool) $input['gutenberg'];
    }
    
    if (isset($input['emojis'])) {
        $sanitized['emojis'] = (bool) $input['emojis'];
    }
    
    if (isset($input['rss'])) {
        $sanitized['rss'] = (bool) $input['rss'];
    }
    
    return $sanitized;
}

// Suppress native Wordpress admin notice box
function bu_suppress_default_notice() {
    if (isset($_GET['page']) && $_GET['page'] === 'bloatoff-utils') {
        
        // Remove the action
        remove_action('admin_notices', 'settings_errors');
        
        // Also remove any settings transients
        global $wp_settings_errors;
        $wp_settings_errors = array();
        
        // Delete the settings_errors transient
        delete_transient('settings_errors');
    }
}
add_action('admin_init', 'bu_suppress_default_notice', 99);

// Load settings page
function bu_settingspage_html() {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    // Get saved settings - this variable will be available in the included file
    $options = get_option('bloatoff_settings', array());

    // Add custom success message
    if (isset($_GET['settings-updated'])) {
        add_settings_error(
            'bloatoff_messages', 
            'bloatoff_message', 
            __('Settings Saved Successfully!', 'bloatoff-utils'), 
            'success'
        );
    }
    
    // Load the HTML template
    require_once BLOATOFF_PLUGIN_DIR . 'admin/settings-page-output.php';
}

// Register settings page
function bu_settingspage() {
    global $bou_settings_hook;
    
    $bou_settings_hook = add_submenu_page(
        'options-general.php',
        'Bloat-off - bloat removal and utilities',
        'Bloat-off - bloat removal and utilities',
        'manage_options',
        'bloatoff-utils',
        'bu_settingspage_html'
    );
}
add_action('admin_menu', 'bu_settingspage');

// Enqueue admin styles
function bu_enqueue_admin_styles($hook_suffix) {
    global $bou_settings_hook;
    
    if ($hook_suffix !== $bou_settings_hook) {
        return;
    }
    
    wp_enqueue_style(
        'bou-styles',
        BLOATOFF_PLUGIN_URL . 'admin/css/admin-style.css',
        array(),
        BLOATOFF_VERSION
    );
}
add_action('admin_enqueue_scripts', 'bu_enqueue_admin_styles');