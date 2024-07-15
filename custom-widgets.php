<?php
/**
 * Plugin Name: Custom widgets
 * Description: custom widgets for Elementor builder
 * Version: 3.0
 * Author: tassawer
 * Author URI: https://www.tassawer.com/
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function register_custom_widgets() {
    require_once plugin_dir_path( __FILE__ ) . 'mobile-menu.php';
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Mobile_Menu() );

    require_once plugin_dir_path( __FILE__ ) . 'widget_2.php';
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new My_Custom_Widget_2() );
}
add_action( 'elementor/widgets/widgets_registered', 'register_custom_widgets' );


function enqueue_custom_styles() {
    wp_enqueue_style('dein-style-handle', plugin_dir_url(__FILE__) . 'mobile-menu.css');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

function enqueue_custom_scripts() {
    wp_enqueue_script('dein-script-handle', plugin_dir_url(__FILE__) . 'mobile-menu.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
