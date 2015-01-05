<?php

interface EditorTool_Interface {

  public function __construct();

  public function shortcode( $atts, $content );

  public function render( $template, $atts );

  function add_mce_button();

  function add_plugin( $plugin_array );

  function register_buttons( $buttons );
}
