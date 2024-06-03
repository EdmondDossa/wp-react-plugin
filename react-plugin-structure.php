<?php
/*
Plugin Name: React Plugin Structure
Plugin URI: 
Description: Wordpress Plugin Strucuture with react js
Version: 1.0.0
Author: ABOKA JR
Author URI: 
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: react-plugin-structure
Domain Path: /languages
*/


if ( !defined( 'ABSPATH' ) ) exit;

/**
 * React_Plugin_Structure class
 *
 * @class React_Plugin_Structure The class that holds the entire React_Plugin_Structure plugin
 */
final class React_Plugin_Structure {

    /**
     * Plugin version
     *
     * @var string
     */
    public $version = '1.0';

    /**
     * Holds various class instances
     *
     * @var array
     */
    private $container = array();

    /**
     * Constructor for the React_Plugin_Structure class
     *
     * Sets up all the appropriate hooks and actions
     * within our plugin.
     */
    public function __construct() {

        $this->define_constants();

        register_activation_hook( __FILE__, array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

        add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
    }

    /**
     * Initializes the React_Plugin_Structure() class
     *
     * Checks for an existing React_Plugin_Structure() instance
     * and if it doesn't find one, creates it.
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new React_Plugin_Structure();
        }

        return $instance;
    }

    /**
     * Magic getter to bypass referencing plugin.
     *
     * @param $prop
     *
     * @return mixed
     */
    public function __get( $prop ) {
        if ( array_key_exists( $prop, $this->container ) ) {
            return $this->container[ $prop ];
        }

        return $this->{$prop};
    }

    /**
     * Magic isset to bypass referencing plugin.
     *
     * @param $prop
     *
     * @return mixed
     */
    public function __isset( $prop ) {
        return isset( $this->{$prop} ) || isset( $this->container[ $prop ] );
    }

    /**
     * Define the constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'REACT_PLUGIN_STRUCTURE_VERSION', $this->version );
        define( 'REACT_PLUGIN_STRUCTURE_FILE', __FILE__ );
        define( 'REACT_PLUGIN_STRUCTURE_PATH', dirname( REACT_PLUGIN_STRUCTURE_FILE ) );
        define( 'REACT_PLUGIN_STRUCTURE_INCLUDES', REACT_PLUGIN_STRUCTURE_PATH . '/includes' );
        define( 'REACT_PLUGIN_STRUCTURE_URL', plugins_url( '', REACT_PLUGIN_STRUCTURE_FILE ) );
        define( 'REACT_PLUGIN_STRUCTURE_ASSETS', REACT_PLUGIN_STRUCTURE_URL . '/assets' );
    }

    /**
     * Load the plugin after all plugis are loaded
     *
     * @return void
     */
    public function init_plugin() {
        $this->includes();
        $this->init_hooks();
    }

    /**
     * Placeholder for activation function
     *
     * Nothing being called here yet.
     */
    public function activate() {

        $installed = get_option( 'react-plugin-structure_installed' );

        if ( ! $installed ) {
            update_option( 'react-plugin-structure_installed', time() );
        }

        update_option( 'react-plugin-structure_version', REACT_PLUGIN_STRUCTURE_VERSION );
    }

    /**
     * Placeholder for deactivation function
     *
     * Nothing being called here yet.
     */
    public function deactivate() {

    }

    /**
     * Include the required files
     *
     * @return void
     */
    public function includes() {

        require_once REACT_PLUGIN_STRUCTURE_INCLUDES . '/Assets.php';

        if ( $this->is_request( 'admin' ) ) {
            require_once REACT_PLUGIN_STRUCTURE_INCLUDES . '/Admin.php';
        }

        if ( $this->is_request( 'frontend' ) ) {
            require_once REACT_PLUGIN_STRUCTURE_INCLUDES . '/Frontend.php';
        }

        if ( $this->is_request( 'ajax' ) ) {
            // require_once REACT_PLUGIN_STRUCTURE_INCLUDES . '/class-ajax.php';
        }

        require_once REACT_PLUGIN_STRUCTURE_INCLUDES . '/Api.php';
        require_once REACT_PLUGIN_STRUCTURE_INCLUDES . '/Public.php';
    }

    /**
     * Initialize the hooks
     *
     * @return void
     */
    public function init_hooks() {

        add_action( 'init', array( $this, 'init_classes' ) );

        // Localize our plugin
        add_action( 'init', array( $this, 'localization_setup' ) );
    }

    /**
     * Instantiate the required classes
     *
     * @return void
     */
    public function init_classes() {

        if ( $this->is_request( 'admin' ) ) {
            $this->container['admin'] = new REACT_PLUGIN_STRUCTURE\Admin();
        }

        if ( $this->is_request( 'frontend' ) ) {
            $this->container['frontend'] = new REACT_PLUGIN_STRUCTURE\Frontend();
        }

        if ( $this->is_request( 'ajax' ) ) {
            // $this->container['ajax'] =  new REACT_PLUGIN_STRUCTURE\Ajax();
        }

        $this->container['api'] = new REACT_PLUGIN_STRUCTURE\Api();
        $this->container['assets'] = new REACT_PLUGIN_STRUCTURE\Assets();
    }

    /**
     * Initialize plugin for localization
     *
     * @uses load_plugin_textdomain()
     */
    public function localization_setup() {
        load_plugin_textdomain( 'react-plugin-structure', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

    /**
     * What type of request is this?
     *
     * @param  string $type admin, ajax, cron or frontend.
     *
     * @return bool
     */
    private function is_request( $type ) {
        switch ( $type ) {
            case 'admin' :
                return is_admin();

            case 'ajax' :
                return defined( 'DOING_AJAX' );

            case 'rest' :
                return defined( 'REST_REQUEST' );

            case 'cron' :
                return defined( 'DOING_CRON' );

            case 'frontend' :
                return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
        }
    }

} // React_Plugin_Structure

$ncpc = React_Plugin_Structure::init();