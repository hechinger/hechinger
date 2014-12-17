<?php
  class HechingerAdminRelated {
    function __construct() {
      add_action('init', array($this, 'add_mce_button'));
      add_shortcode('related', array($this, 'shortcode'));
    }

    function shortcode($atts, $content) {
      $headline = null;
      if (isset($atts['id']) && $atts['id']) {
        if (isset($atts['headline']) && $atts['headline'] && trim($atts['headline']) != 'auto') {
          $headline = $atts['headline'];
        }
        return HechingerSite::render_related_tease($atts['id'], $headline);
      }
    }

    function add_mce_button(){
      if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
        add_filter('mce_external_plugins', array($this, 'add_plugin'));
        add_filter('mce_buttons', array($this, 'register_buttons'));
      }
    }

    function add_plugin($plugin_array){
      $plugin_array['related'] = get_template_directory_uri().'/static/js/related.js';
      return $plugin_array;
    }

    function register_buttons($buttons) {
      array_push($buttons, '|', 'related');
      return $buttons;
    }
  }
