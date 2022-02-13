<?php
// Require widget files
require plugin_dir_path(__FILE__) . 'Carspa_WP_Widget_Recent_Post.php';


// Register Widgets
add_action( 'widgets_init', function() {
    register_widget( 'Carspa_WP_Widget_Recent_Post');
});