<?php

class HechingerPost extends TimberPost {

  function overline() {
    $st = $this->get_terms('special-topic');
    if (is_array($st) && count($st) ) {
      return $st[0];
    }
    return $this->category();
  }

  function post_asides() {
    $asides = array();
    if( have_rows('aside_group') ) {
          // loop through the rows of data
      while ( have_rows('aside_group') ) : the_row();
        $aside['heading'] = get_sub_field('aside_heading');
        $aside['content'] = get_sub_field('aside_content');
        $asides[] = $aside;
      endwhile;

      return $asides;
    }
    return null;
  }

  function post_related_aside() {
    $related = array();
    $links = get_field('relationship_link');
    if ($links) {
      foreach ($links as $link) {
        $l['url'] = get_permalink($link->ID);
        $l['heading'] = get_the_title($link->ID);
        $related[] = $l;
      }
      return $related;
    }
    return null;
  }
}
