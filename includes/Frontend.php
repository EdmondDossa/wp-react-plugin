<?php
namespace REACT_PLUGIN_STRUCTURE;

/**
 * Frontend Pages Handler
 */
class Frontend {

    public function __construct() {
        add_shortcode( 'RPS-Frontend', [ $this, 'render_frontend' ] );
    }

    /**
     * Render frontend app
     *
     * @param  array $atts
     * @param  string $content
     *
     * @return string
     */
    public function render_frontend( $atts, $content = '' ) {
        wp_enqueue_style( 'react-plugin-structure-frontend' );
        wp_enqueue_style( 'react-plugin-structure-style' );
        wp_enqueue_script( 'react-plugin-structure-frontend' );

        $content .= '<div id="react-plugin-structure-frontend-app"></div>';

        return $content;
    }
}
