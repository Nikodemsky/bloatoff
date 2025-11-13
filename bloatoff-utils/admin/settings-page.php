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
function bu_sanitize_number_setting($input, $setting_id, $min, $max, $default) {
    $sanitized = array();
    
    if (isset($input[$setting_id . '_enabled']) && $input[$setting_id . '_enabled']) {
        $sanitized[$setting_id . '_enabled'] = true;
        
        // Sanitize the interval value
        if (isset($input[$setting_id . '_interval'])) {
            $value = absint($input[$setting_id . '_interval']);
            
            // Ensure it's within range
            if ($value < $min) {
                $value = $min;
            } elseif ($value > $max) {
                $value = $max;
            }
            
            $sanitized[$setting_id . '_interval'] = $value;
        } else {
            $sanitized[$setting_id . '_interval'] = $default;
        }
    } else {
        $sanitized[$setting_id . '_enabled'] = false;
    }
    
    return $sanitized;
}

function bu_sanitize_settings($input) {
    $sanitized = array();
    
    // Define settings by category
    $settings_config = array(
        
        'boolean' => array(

            // Bloat removal
            'gutenberg',
            'emojis',
            'rss',
            'rsdl',
            'shortlink',
            'jquerymigrate',
            'adminwidgets',
            'restapilink',
            'oembeddisclink',
            'nativexmlsitemap',
            'adminhelptabs',
            'wplogoty',

            // Utilities
            'comments',
            'widgets',
            'oembed',
            'xmlrpc',
            'selfping',
        ),

        'number' => array(
            'heartbeat' => array('min' => 1, 'max' => 86400, 'default' => 15),
        ),
    );
    
    // Sanitize boolean settings
    foreach ($settings_config['boolean'] as $setting) {
        $sanitized[$setting] = !empty($input[$setting]);
    }
    
    // Sanitize number settings
    foreach ($settings_config['number'] as $setting_id => $config) {
        $number_setting = bu_sanitize_number_setting(
            $input, 
            $setting_id, 
            $config['min'], 
            $config['max'], 
            $config['default']
        );
        $sanitized = array_merge($sanitized, $number_setting);
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

/**
 * Render a settings block
 * 
 * @param array $args {
 *     @type string $title       Summary title
 *     @type string $description Main description
 *     @type string $savings     Optional savings description (default: '')
 *     @type string $setting_id  Checkbox setting ID
 *     @type string $label       Checkbox label
 *     @type array  $options     Settings options array
 * }
 */
function bu_render_settings_block($args) {

    // Set defaults
    $defaults = array(
        'title' => '',
        'description' => '',
        'savings' => '',
        'warning' => '',
        'setting_id' => '',
        'label' => '',
        'readmore' => '',
        'options' => array()
    );
    
    // Merge with defaults
    $args = wp_parse_args($args, $defaults);
    
    // Extract variables for use in template
    extract($args);
    
    // Load template
    require BLOATOFF_PLUGIN_DIR . 'admin/partials/settings-block.php';
}

/**
 * Render settings block with number input (checkbox + number)
 * 
 * @param array $args {
 *     @type string $title              Summary title
 *     @type string $description        Main description
 *     @type string $savings            Optional savings description (default: '')
 *     @type string $setting_id         Setting ID (e.g., 'heartbeat', 'autosave')
 *     @type string $checkbox_label     Checkbox label text
 *     @type string $number_label       Number input label text
 *     @type int    $number_min         Minimum number value (default: 1)
 *     @type int    $number_max         Maximum number value (default: 999999)
 *     @type int    $number_default     Default number value (default: 1)
 *     @type string $number_description Description for the number input
 *     @type array  $options            Settings options array
 * }
 */
function bu_render_number_block($args) {

    // Set defaults
    $defaults = array(
        'title' => '',
        'description' => '',
        'savings' => '',
        'setting_id' => '',
        'checkbox_label' => '',
        'number_label' => '',
        'number_min' => 1,
        'number_max' => 999999,
        'number_default' => 1,
        'number_description' => '',
        'readmore' => '',
        'warning' => '',
        'options' => array()
    );
    
    // Merge with defaults
    $args = wp_parse_args($args, $defaults);
    
    // Extract variables for use in template
    extract($args);
    
    // Load template
    require BLOATOFF_PLUGIN_DIR . 'admin/partials/settings-block-number.php';
}