<?php
namespace REACT_PLUGIN_STRUCTURE;

/**
 * public Pages Handler
 */
class REACT_PLUGIN_STRUCTURE_Public {

    public function __construct() {
        $this->render_public();
    }

    /**
     * Render public app
     *
     * @param  array $atts
     * @param  string $content
     *
     * @return string
     */
    public function render_public() {
        wp_enqueue_script('react-plugin-structure',REACT_PLUGIN_STRUCTURE_ASSETS.'/utilities/react-plugin-structure.min.js', array('jquery',"tinymce"), '1.0', true);
    }
}
