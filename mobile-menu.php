<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Mobile_menu extends \Elementor\Widget_Base {

    // Your widget's name, title, icon and category
    public function get_name() {
        return 'mobile-menu';
    }

    public function get_title() {
        return __( 'Widget-mobile-menu', 'mobile-menu' );
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return [ 'general' ];
    }



    // Your widget's sidebar settings
    protected function _register_controls() {
        $this->start_controls_section(
            'menu_section',
            [
                'label' => __( 'Menu Settings', 'mobile-menu' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $menus = wp_get_nav_menus();
        $menu_options = [];
        foreach ( $menus as $menu ) {
            $menu_options[ $menu->term_id ] = $menu->name;
        }

        $this->add_control(
            'selected_menu',
            [
                'label' => __( 'Select Menu', 'mobile-menu' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $menu_options,
            ]
        );

        $this->end_controls_section();
    }

    // What your widget displays on the front-end
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Get the selected menu
        $selected_menu_id = $settings['selected_menu'];
        $menu_items = wp_get_nav_menu_items( $selected_menu_id );

// Render the menu
if (!empty($menu_items)) {
    echo '<div class="menu-link_card">';
    foreach ($menu_items as $menu_item) {
        // Überprüfe, ob der Menüpunkt Untermenüpunkte hat
        $submenu_items = $this->get_child_menu_items($menu_items, $menu_item->ID);

        // Überprüfe, ob es sich um einen Hauptlink handelt
        if (empty($menu_item->menu_item_parent)) {
            // Wenn es Untermenüpunkte gibt, erstelle das Dropdown-Menü
            if (!empty($submenu_items)) {
                echo '<div class="menu-dropdown-wrapper">';
                echo '<div class="menu-link_title">';
                echo '<div class="u-d-inline-block">' . esc_html($menu_item->title) . '</div>';
                echo '<div class="menu-link_svg-card no-hover">';
                echo '<svg class="menu-dropdown_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 426.67 426.67">';
                echo '<path d="m405.33,192h-170.66V21.33c0-11.77-9.56-21.33-21.34-21.33s-21.33,9.56-21.33,21.33v170.67H21.33c-11.77,0-21.33,9.56-21.33,21.33s9.56,21.34,21.33,21.34h170.67v170.66c0,11.78,9.56,21.34,21.33,21.34s21.34-9.56,21.34-21.34v-170.66h170.66c11.78,0,21.34-9.56,21.34-21.34s-9.56-21.33-21.34-21.33Z"/>';
                echo '</svg>';
                echo '</div>';
                echo '</div>';
                echo '<div class="menu-dropdown-card closed">';

                foreach ($submenu_items as $submenu_item) {
                    echo '<a href="' . esc_url($submenu_item->url) . '" class="menu-link_title submenu">';
                    echo '<div class="u-d-inline-block">' . esc_html($submenu_item->title) . '</div>';
                    echo '<div class="menu-link_svg-card">';
                    echo '<svg class="menu-link_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" fill="currentColor">';
                    echo '<polygon points="4.5 0 4.5 1 10.29 1 0 11.29 0.71 12 11 1.71 11 7.5 12 7.5 12 0 4.5 0"></polygon>';
                    echo '</svg>';
                    echo '</div>';
                    echo '</a>';
                }

                echo '</div>';
                echo '</div>';
            } else {
                // Rendere den normalen Hauptlink
                echo '<a href="' . esc_url($menu_item->url) . '" class="menu-link_title">';
                echo '<div class="u-d-inline-block">' . esc_html($menu_item->title) . '</div>';
                echo '<div class="menu-link_svg-card">';
                echo '<svg class="menu-link_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" fill="currentColor">';
                echo '<polygon points="4.5 0 4.5 1 10.29 1 0 11.29 0.71 12 11 1.71 11 7.5 12 7.5 12 0 4.5 0"></polygon>';
                echo '</svg>';
                echo '</div>';
                echo '</a>';
            }
        }
    }
    echo '</div>';
}
	}			
			
// Funktion, um Untermenüpunkte eines bestimmten Menüpunktes zu erhalten
    private function get_child_menu_items($menu_items, $parent_id) {
        $submenu_items = [];

        foreach ($menu_items as $item) {
            if ($item->menu_item_parent == $parent_id) {
                $submenu_items[] = $item;
            }
        }

        return $submenu_items;
    }
}