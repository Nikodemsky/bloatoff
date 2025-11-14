<?php
/*
 * Plugin Name:       Bloat-off - bloat removal and utilities
 * Plugin URI:        https://github.com/Nikodemsky/bloatoff
 * Description:       Plugin handles removal of most basic Wordpress bloat and gives an access to remove things like comments system completely.
 * Version:           0.9
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Wojciech Górski
 * Author URI:        https://w3wg.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://github.com/Nikodemsky/bloatoff
 * Text Domain:       bloatoff-utils
 * Domain Path:       /languages
 */

// Abort if called directly
if (!defined('ABSPATH')) {
    die;
}

// Define plugin constants
define('BLOATOFF_VERSION', '0.1');
define('BLOATOFF_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('BLOATOFF_PLUGIN_URL', plugin_dir_url(__FILE__));

// Settings page
if (is_admin()) {
    require_once BLOATOFF_PLUGIN_DIR . 'admin/settings-page.php';
}

// Optimizations file
require_once BLOATOFF_PLUGIN_DIR . 'includes/optimizations.php';

// Utilities file
require_once BLOATOFF_PLUGIN_DIR . 'includes/utilities.php';

// Add settings link on plugin page
function bu_add_settings_link($links) {
    $settings_link = '<a href="' . admin_url('options-general.php?page=bloatoff-utils') . '">' . __('Settings', 'bloatoff-utils') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'bu_add_settings_link');