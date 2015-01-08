<?php

class AsideAdmin extends EditorTool_Core implements EditorTool_Interface {

  var $slug = 'aside';

  function shortcode($atts, $content) {
    $aside = null;

    if ( isset($atts['num']) ) {
      $atts['aside'] = $this->get_aside($atts['num']);
    }
    return $atts['aside'] ? $this->render('templates/components/article-aside.twig', $atts) : null;
  }

  function get_aside($id) {
    global $post;
    $hechPost = new HechingerPost($post);
    $aside_to_return = null;

    if (method_exists($hechPost, 'post_asides')) {
      $asides = $hechPost->post_asides();
    }

    if (isset($asides) && is_array($asides) && count($asides)) {
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
}
