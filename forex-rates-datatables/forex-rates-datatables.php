<?php
/*
 * Plugin Name:       Forex Rates DataTables
 * Plugin URI:        https://example.com/forex-rates-datatables
 * Description:       Display foreign exchange rates using DataTables.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Rabin Kc
 * Author URI:        https://rabinkc.com.np/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       forex-rates-datatables
 * Domain Path:       /languages
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Activation hook.
register_activation_hook(__FILE__, 'forex_rates_plugin_activate');

function forex_rates_plugin_activate() {
    // Activation tasks if needed.

    // Example: Creating an option upon activation.
    add_option('forex_rates_plugin_activated', '1');
}

// Include necessary files after activation hook.
include_once plugin_dir_path(__FILE__) . 'inc/jscss.php';
include_once plugin_dir_path(__FILE__) . 'inc/forex.php';
include_once plugin_dir_path(__FILE__) . 'inc/shortcode.php';

// Deactivation hook.
register_deactivation_hook(__FILE__, 'forex_rates_plugin_deactivate');

function forex_rates_plugin_deactivate() {
    // Deactivation tasks if needed.

    // Example: Deleting an option upon deactivation.
    delete_option('forex_rates_plugin_activated');
}
