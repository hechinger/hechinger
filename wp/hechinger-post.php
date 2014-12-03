<?php

class HechingerPost extends TimberPost {

  function overline() {
    $st = $this->get_terms('special-topic');
    if (is_array($st) && count($st) ) {
      return $st[0];
    }
    return $this->category();
  }

  function tease_excerpt() {

    if ($this->subhead) {
      $excerpt = $this->subhead;
    } elseif ($this->excerpt) {
      $excerpt = strip_tags($this->excerpt);
    } else {
      $excerpt = strip_tags(TimberHelper::trim_words( $this->content, 40 ));
    }
    return $excerpt;
  }

  function special_topics() {
    $st = $this->get_terms('special-topic');
    if (is_array($st) && count($st) ) {
      return $st;
    }
    return null;
  }

  function story_tags() {
    $tags = array();

    if (is_array($this->special_topics) && count($this->special_topics)) {
      foreach ($this->special_topics as $topic) {
        $tags[]= $topic;
      }
    }
    if (is_array($this->categories) && count($this->categories)) {
      foreach ($this->categories as $cat) {
        $tags[]= $cat;
      }
    }
    if (is_array($this->tags) && count($this->tags)) {
      foreach ($this->tags as $tag) {
        $tags[]= $tag;
      }
    }

    return $tags;
  }

  function is_column() {
    if (isset($this->article_type) && is_array($this->article_type) && count($this->article_type)) {
      return in_array('Column', $this->article_type);
    }
  }

  function is_feature() {
    if (isset($this->article_type) && is_array($this->article_type) && count($this->article_type)) {
      return in_array('Feature', $this->article_type);
    }
  }

  function partner() {
    $part = $this->get_terms('partner');
    if (is_array($part) && count($part) ) {
      return $part[0];
    }
    return false;
  }

  function post_asides() {
    $asides = $this->get_field('aside_group');
    if (is_array($asides)) {
      foreach($asides as &$aside_row) {
        $aside_row['heading'] = $aside_row['aside_heading'];
        $aside_row['content'] = $aside_row['aside_content'];
      }
    }
    return $asides;
  }

  function post_related_aside() {
    $related = array();
    $links = $this->get_field('relationship_link');
    if (is_array($links)) {
      foreach ($links as &$link) {
        $link = new HechingerPost($link->ID);
      }
    }
    return $links;
  }

  function lead_image() {
    $image = new TimberImage($this->get_field('lead_image'));
    if ( isset($image)) {
      return $image;
    }
  }
}
