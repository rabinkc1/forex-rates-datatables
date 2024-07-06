<?php
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
        wp_enqueue_style('datatables-css', plugins_url('/assets/css/jquery.dataTables.min.css', __FILE__), array(), '2.0.8');
        wp_enqueue_script('datatables-js', plugins_url('/assets/js/jquery.dataTables.min.js', __FILE__), array('jquery'), '2.0.8', true);
    }
}
add_action('wp_enqueue_scripts', 'forex_rates_enqueue_scripts');
