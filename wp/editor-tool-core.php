<?php

class EditorTool_Core {

  public function __construct() {
    add_action( 'init', array( $this, 'add_mce_button' ) );
    add_shortcode( $this->slug, array( $this, 'shortcode' ) );
  }

  public function render( $template, $args ) {
    // any universal pre-preprocessing happens here
    return Timber::compile( $template, $args );
  }

  function add_mce_button() {
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
      add_filter( 'mce_external_plugins', array( $this, 'add_plugin' ) );
      add_filter( 'mce_buttons', array( $this, 'register_buttons' ) );
    }
  }

  function add_plugin( $plugin_array ) {
    $plugin_array[$this->slug] = get_template_directory_uri().'/static/js/editor-tool-factory.js';
    return $plugin_array;
  }

  function register_buttons( $buttons ) {
    array_push( $buttons, '|', $this->slug );
    return $buttons;
  }
}
