<?php

class PullQuoteAdmin extends EditorTool_Core implements EditorTool_Interface {

  function __construct() {
    $this->slug = 'pullquote';
    parent::__construct();
  }

  function shortcode($atts, $content) {
    if(isset($content)) {
      $atts['pull_quote'] = $content;
      $atts['style_class'] = isset($atts['style']) ? $atts['style'] : null;
      return $this->render('templates/components/article-pullquote.twig', $atts);
    }
  }

  /**
    $args['pull_quote'] = 'Content of your pullquote';
    $args['autor'] = 'Mr. Rodgers';
    $args['description'] = 'Man from PBS who took off his shoes';
  */
  public function render( $template, $atts ) {
    $defaults = array(
      'possible_default' => 'new-pullquote',
    );
    $args = array_merge($defaults, $atts);
    return parent::render($template, $args);
  }
}
