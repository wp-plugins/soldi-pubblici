<?php
/*
Plugin Name: Soldi Pubblici
Plugin URI: http://wpgov.it
Description: Plugin per l'interfacciamento con il portale soldipubblici.gov.it
Author: Marco Milesi
Author URI: http://marcomilesi.ml
Version: 0.2.1
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

add_shortcode('wpgov-sp', 'wpgov_sp');
    function wpgov_sp($atts)
    {
        ob_start();
        include(plugin_dir_path(__FILE__) . 'inc/shortcode.php');
        return ob_get_clean();
    }

add_action( 'init', 'wpgov_sp_load' );

    function wpgov_sp_load()
    {
        include(plugin_dir_path(__FILE__) . 'inc/utilities.php');
        include(plugin_dir_path(__FILE__) . 'inc/bridge.php');
    }

add_action( 'admin_menu', 'register_sp_wpgov_menu_page' );

    function register_sp_wpgov_menu_page()
    {
        add_menu_page('Impostazioni soluzioni WPGOV.IT', 'WPGov.it', 'manage_options', 'impostazioni-wpgov', 'sp_wpgov_settings', 'dashicons-share-alt', 40);
        add_submenu_page( 'impostazioni-wpgov', 'Soldi Pubblici', 'Soldi Pubblici', 'manage_options', 'sp_wpgov_settings', 'sp_wpgov_settings_menu' );
    }

    function sp_wpgov_settings_menu()
    {
        echo 'Fase Beta';
    }

?>
