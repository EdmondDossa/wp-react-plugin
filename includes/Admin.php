<?php
namespace REACT_PLUGIN_STRUCTURE;

/**
 * Admin Pages Handler
 */
class Admin {

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }

    /**
     * Register our menu page
     *
     * @return void
     */
    public function admin_menu() {
        global $submenu;

        $capability = 'manage_options';
        $slug       = 'react-plugin-structure';

        $hook = add_menu_page( __( 'React Plugin Structure', 'react-plugin-structure' ), __( 'React Plugin Structure', 'react-plugin-structure' ), $capability, $slug, [ $this, 'plugin_page' ], 'dashicons-layout' );

        if ( current_user_can( $capability ) ) {
            $submenu[ $slug ][] = array( __( 'App', 'react-plugin-structure' ), $capability, 'admin.php?page=' . $slug . '#/' );
            $submenu[ $slug ][] = array( __( 'Options', 'react-plugin-structure' ), $capability, 'admin.php?page=' . $slug . '#/options' );
        }

        add_action( 'load-' . $hook, [ $this, 'init_hooks'] );
    }

    /**
     * Initialize our hooks for the admin page
     *
     * @return void
     */
    public function init_hooks() {
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    /**
     * Load scripts and styles for the app
     *
     * @return void
     */
    public function enqueue_scripts() {
        wp_enqueue_style( 'react-plugin-structure-admin' );
        wp_enqueue_style( 'react-plugin-structure-style' );
        wp_enqueue_script( 'react-plugin-structure-admin' );
    }

    /**
     * Render our admin page
     *
     * @return void
     */
    public function plugin_page() {
        echo '<div id="react-plugin-structure-admin-app"></div>';
    }
}
