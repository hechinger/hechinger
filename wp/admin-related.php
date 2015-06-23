<?php

class RelatedAdmin extends EditorTool_Core implements EditorTool_Interface {

  var $slug = 'related';

  function shortcode($atts, $content) {
    if (isset($atts['id']) && $atts['id']) {
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
    } else {
      return;
    }
    if ($atts['headline'] && $atts['headline'] !== 'auto') {
      $headline = $atts['headline'];
    } else {
      $headline = $post->title();
    }
    $args = array('link' => $link, 'headline' => $headline);
    return parent::render($template, $args);
  }
}




