<?php
  Class AsideAdmin {
    function __construct() {
      add_action('init', array($this, 'add_mce_button'));
      add_shortcode('aside', array($this, 'shortcode_aside'));
    }

    function shortcode_aside($atts, $content) {
      $id = '';
      $notes = '';
      $aside = null;

      if ( isset($atts['num']) ) {
        $id = $atts['num'];
        $aside = $this->get_aside($id);
      }

      if ( isset($atts['notes']) ) {
        $id = $atts['notes'];
      }

      return $aside ? HechingerSite::render_aside($notes, $id, $aside) : null;
    }

    function get_aside($id) {
      global $post;
      $aside_to_return = null;
      $asides = $post->post_asides();

      if (isset($asides) && count($asides)) {
        foreach ($asides as $aside) {
          if ($aside['id'] == $id) {
            $aside['taken'] = true;
            $aside_to_return = $aside;
            break;
          }
        }
      }
      return $aside_to_return;
    }

    function add_mce_button(){
      if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
        add_filter('mce_external_plugins', array($this, 'add_plugin'));
        add_filter('mce_buttons', array($this, 'register_buttons'));
      }
    }

    function add_plugin($plugin_array){
      $plugin_array['aside'] = get_template_directory_uri().'/static/js/aside.js';
      return $plugin_array;
    }

    function register_buttons($buttons) {
      array_push($buttons, '|', 'aside');
      return $buttons;
    }
  }
