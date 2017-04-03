<?php

class HechingerPost extends TimberPost {

  function overline( $context = '' ) {
    $article_type = $this->article_type();
    if( $context !== 'tease' && is_array( $article_type ) && count( $article_type ) ) {
      foreach( $article_type as $type ) {
        if ( $type !== 'Feature' ) {
          return new HechingerTerm( $type );
        }
      }
    }
    $primary = $this->get_field('primary_special_report');
    if ($primary) {
      $term = new HechingerTerm($primary);
      if( property_exists( $term, 'name' ) && $term->name ) {
        return $term;
      }
    }
    $st = $this->get_terms('special-report');
    if (is_array($st) && count($st) ) { 
      return $st[0];
    }
    return $this->category()->name !== 'Uncategorized' ? $this->category() : null;
  }

  function getBanner($shape = 'yellow_banner') {
    $st = $this->overline();
    if ( isset( $st->$shape ) && $st->$shape ) {
      $banner = new HechingerImage( $st->$shape );
      if( $banner->ID ) {
        return $banner;
      }
    }
  }

  function tease_excerpt( $length = 30 ) {
    if ($this->subhead) {
      $excerpt = $this->subhead;
    } elseif ($this->excerpt) {
      $excerpt = strip_tags($this->excerpt);
    } else {
      $excerpt = strip_tags(TimberHelper::trim_words( $this->content, $length ));
    }
    return $excerpt;
  }

  function special_topics() {
    $st = $this->get_terms('special-report');
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

  function article_type() {
    $terms = wp_get_post_terms( $this->ID, 'article-type', array( 'fields' => 'names' ) );
    return is_wp_error( $terms ) ? array() : $terms;
  }

  function is_column() {
    return has_term( 'column', 'article-type', $this );
  }

  function is_opinion() {
    return has_term( 'opinion', 'article-type', $this );
  }

  function is_feature() {
    return has_term( 'feature', 'article-type', $this );
  }
  
  function is_clean() {
    return has_term( 'clean', 'article-type', $this );
  }
  
   function partners() {
    $part = $this->get_terms('partner');
    if (is_array($part) && count($part) ) {
      return $part;
    }
    return false;
  }

  function post_asides() {
    $asides = $this->get_field('aside_group');
    if (is_array($asides)) {
      foreach($asides as &$aside_row) {
        $aside_row['heading'] = $aside_row['aside_heading'];
        $aside_row['content'] = $aside_row['aside_content'];
        $aside_row['id'] = $aside_row['aside_num'];
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

  function column_image() {
    $image = new HechingerImage($this->author->columnist_image);
    return isset($image) ? $image : null;
  }

  function link_to_page() {
    $links = $this->get_field('link_to_page');
    if (isset($links) && is_array($links)) {
      $link = new HechingerPost($links[0]->ID);
      return $link->link();
    }
  }

  function fred_photo() {
    $image = new HechingerImage($this->fred_photo);
    return isset($image) ? $image : null;
  }

  function thumbnail() {
    if (function_exists('get_post_thumbnail_id')) {
      $tid = get_post_thumbnail_id($this->ID);
      if ($tid) {
        return new HechingerImage($tid);
      }
    }
    return null;
  }

  function coauthors() {
    $authors = null;
    if (function_exists('get_coauthors')) {
      $coauthors = get_coauthors($this->id);

      if (isset($coauthors) && count($coauthors)) {
        foreach ($coauthors as $author) {
          $authors[] = new HechingerUser($author);
        }
        return $authors;
      }
    }
    // fallback if coauthors disabled or fails
    return array(new HechingerUser($this->author));
  }

  function share_title() {
    $title = preg_replace('/[^a-zA-Z0-9\/_.;&!?:|+ -]/', '', strip_tags($this->title));
    return $title;
  }

  function partner_names() {
    if (is_array($this->partners()) && count($this->partners)) {
      $count = count($this->partners()) - 1;
      $string = '';
      foreach ($this->partners as $index=>$partner) {
        if ($count > 1 ) {
          if ($index !== $count) {
            $string .= $partner->name . ',&nbsp;';
          } else if ($index == $count) {
            $string .= 'and&nbsp;' . $partner->name;
          }
        } else if ($count == 1) {
          if ($index !== $count) {
            $string .= $partner->name . '&nbsp;';
          } else {
            $string .= 'and&nbsp;' . $partner->name;
          }
        } else {
          $string .= $partner->name;
        }
      }
      return $string;
    }
  }
}
