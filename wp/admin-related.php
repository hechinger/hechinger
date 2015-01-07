<?php

class RelatedAdmin extends EditorTool_Core implements EditorTool_Interface {

  var $slug = 'related';

  function shortcode($atts, $content) {
    $atts['headline'] = null;
    if (isset($atts['id']) && $atts['id']) {
      if (isset($atts['headline']) && $atts['headline'] && trim($atts['headline']) != 'auto') {
        $headline = $atts['headline'];
      }
      return $this->render('templates/components/article-text-related.twig', $atts);
    }
  }

  /**
    $atts['id'] = post ID you want to link;
    $args['headline'] = 'Your changed headline goes here';
    $args['link'] = link to the post;
  */
  function render($template, $atts) {
    $link = $atts['id'];
    if (is_numeric($link)) {
      $post = new HechingerPost($link);
      $link = $post->link();
    }
    if ($atts['headline'] == null && isset($post)) {
      $headline = $post->title();
    }
    $args = array('link' => $link, 'headline' => $headline);
    return parent::render($template, $args);
  }
}
