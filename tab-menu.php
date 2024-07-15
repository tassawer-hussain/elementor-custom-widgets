<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class My_Custom_Widget extends \Elementor\Widget_Base {

    // Your widget's name, title, icon and category
    public function get_name() {
        return 'tab-menu';
    }

    public function get_title() {
        return __( 'Widget-tab-menu', 'tab menu' );
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
                'label' => __( 'Menu Settings', 'my-custom-widget' ),
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
                'label' => __( 'Select Menu', 'my-custom-widget' ),
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

 // Embed CSS styles directly
    echo '<style>
       

/* styles for default link */

  .menu-link_title {
    color: #04305C !important;
    border-bottom: 1px solid #ddd;
    justify-content: space-between;
    align-items: center;
    font-size: 17px;
    font-weight: 600;
    line-height: 1.3;
    text-decoration: none;
    display: flex;
    padding: 5px 0px 10px 0px;
	margin-bottom:7px;
  }

a.menu-link_title.active-link {
    color: #F6BB3D !important;
}
 .menu-link_svg-card{
     transition: all 0.3s ease-out;
 }
 
.menu-link_svg {
  width: 15px;
  height: 15px; 
}


  .menu-link_title:hover {
      color:#F6BB3D!important;
  }
  
    .menu-link_card :hover .menu-link_svg-card {
  transform: translate3d(0px, -3px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
}


    </style>';

        // Render the menu
        if ( ! empty( $menu_items ) ) {
            echo '<div class="menu-link_card">';
            foreach ( $menu_items as $menu_item ) {
                echo '<a href="' . esc_url( $menu_item->url ) . '" class="menu-link_title">';
                echo '<div class="u-d-inline-block">' . esc_html( $menu_item->title ) . '</div>';
                echo '<div class="menu-link_svg-card">';
                echo '<svg class="menu-link_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" fill="currentColor">';
                echo '<polygon points="4.5 0 4.5 1 10.29 1 0 11.29 0.71 12 11 1.71 11 7.5 12 7.5 12 0 4.5 0"></polygon>';
                echo '</svg>';
                echo '</div>';
                echo '</a>';
            }
            echo '</div>';
			
			
    // JavaScript zum Hinzufügen der Farbe zum aktiven Link
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var links = document.querySelectorAll(".menu-link_title");
            links.forEach(function(link) {
                if (link.href === window.location.href) {
                    link.classList.add("active-link");
                }
            });
        });
    </script>';
			
			
        }
    }
}
