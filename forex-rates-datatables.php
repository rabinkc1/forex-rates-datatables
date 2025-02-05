<?php
/*
 * Plugin Name:       Forex Rates DataTables
 * Plugin URI:        https://github.com/rabinkc1/forex-rates-datatables/
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
// Enqueue DataTables scripts and styles only when shortcode is used
function forex_rates_enqueue_scripts() {
    // Check if current post/page content contains the forex_rates shortcode
    global $post;

    // Ensure jQuery is loaded
    if (!wp_script_is('jquery', 'enqueued')) {
        wp_enqueue_script('jquery');
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'forex_rates')) {
        // Enqueue DataTables scripts and styles
        wp_enqueue_style('datatables-css', plugins_url('/assets/css/dataTables.bootstrap5.min.css', __FILE__), array(), '2.0.8');
        wp_enqueue_script('datatables-js', plugins_url('/assets/js/dataTables.min.js', __FILE__), array('jquery'), '2.0.8', true);
        wp_enqueue_script('datatables-bootstrap-js', plugins_url('/assets/js/dataTables.bootstrap5.js', __FILE__), array('jquery'), '2.0.8', true);
    }
}
add_action('wp_enqueue_scripts', 'forex_rates_enqueue_scripts');


include_once plugin_dir_path(__FILE__) . 'inc/forex.php';
include_once plugin_dir_path(__FILE__) . 'inc/shortcode.php';

// Deactivation hook.
register_deactivation_hook(__FILE__, 'forex_rates_plugin_deactivate');

function forex_rates_plugin_deactivate() {
    // Deactivation tasks if needed.

    // Example: Deleting an option upon deactivation.
    delete_option('forex_rates_plugin_activated');
}
