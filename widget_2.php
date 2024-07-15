<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class My_Custom_Widget_2 extends \Elementor\Widget_Base {

    // Your widget's name, title, icon, and category
    public function get_name() {
        return 'my_custom_widget_2';
    }

    public function get_title() {
        return __( 'Widget-hello-world', 'my-custom-widget-2' );
    }

    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    // Your widget's sidebar settings
    protected function _register_controls() {
        // Define your widget controls here for the second widget
    }

    // What your widget displays on the front-end
    protected function render() {
        $settings = $this->get_settings_for_display();

        echo 'Hello World 2';
    }
}
