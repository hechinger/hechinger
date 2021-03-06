<?php

if (!class_exists('TimberStream')) {
  return;
}

class HechingerHome extends TimberStream {

  var $_zone_1;
  var $avail_posts = array();
  var $zone_posts = array();
  var $zone_posts_ids = array();
  var $zone2_has_image = false;

  function __construct() {
    parent::__construct('homepage');
    //setup the # of zones
    if( is_home() ){
      $zones = range(1, 5);
      //get the available posts from this stream
      $this->avail_posts = $this->get_posts(array(), 'HechingerPost');
      //loop over the zones and get their posts
      foreach($zones as $zone) {
        $this->zone_posts[$zone] = $this->build_zone_posts($zone);
      }
    }
  }

  public function get_used_post_ids(){
    return $this->zone_posts_ids;
  }

  public function build_zone_posts( $zone ){
    $func = "get_zone_{$zone}_posts";
    if (method_exists( $this, $func ) ) {
      $posts = $this->$func();
      $this->zone_posts_ids = array_merge( $this->zone_posts_ids, wp_list_pluck( $posts, 'ID' ) );
      return $posts;
    }
  }

  public function get_zone($zone = 1) {
    if( isset( $this->zone_posts[$zone] ) ) {
      return $this->zone_posts[$zone];
    }
  }

  //TODO: use some clever recursion to simplify
  public function get_zone_pointer($zone = 1) {
    if ($zone == 1) {
      return 0;
    }
    if ($zone == 2) {
      $z1 = $this->get_zone_1_posts();
      return count($z1);
    }
    if ($zone == 3) {
      $z1 = $this->get_zone_pointer(2);
      $z2 = $this->get_zone_2_posts();
      $pointer = $z1 + count($z2);
      return $pointer;
    }
    if ($zone == 4) {
      $z2 = $this->get_zone_pointer(3);
      $z3 = $this->get_zone_3_posts();
      $pointer = $z2 + count($z3);
      return $pointer;
    }
  }

  public function swap_posts(&$posts, $pos = 1) {
    // the position where the tease with image should go

    if (is_array($posts) && count($posts)) {
      for ($i = 0; $i < count($posts); $i++) {
        if ( method_exists($posts[$i], 'thumbnail') && is_object($posts[$i]->thumbnail()) && strlen($posts[$i]->thumbnail()->src) ) {
          $insert = array($posts[$i]);
          array_splice($posts, $i, 1);
          array_splice($posts, $pos, 0, $insert);
          array_pop($posts);
          break;
        }
      }
    }
    return $posts;
  }

  public function z2_has_image() {
    return $this->zone2_has_image;
  }

  protected function get_zone_1_posts() {
    $avail_posts = $this->avail_posts;
    $posts = array();
    $posts[] = $avail_posts[0];
    $posts[] = $avail_posts[1];
    if (!$posts[1]->thumbnail()) {
      $posts[] = $avail_posts[2];
    }
    return $posts;
  }

  protected function get_zone_2_posts() {
    $avail_posts = $this->avail_posts;
    $pointer = $this->get_zone_pointer(2);
    $posts = array();
    for ($i = $pointer; $i < $pointer + 3; $i++) {
      $posts[] = $avail_posts[$i];
      if ($avail_posts[$i]->thumbnail()) {
        $this->zone2_has_image = true;
      }
      if ($this->zone2_has_image && count($posts) >= 3) {
        break;
      }
    }
    // swap the post with the image for the second position
    if ($this->zone2_has_image) {
      $posts = $this->swap_posts($posts, 1);
    }
    return $posts;
  }

  protected function get_zone_3_posts() {
    $avail_posts = $this->avail_posts;
    $pointer = $this->get_zone_pointer(3);
    $posts = array();
    $found_image = false;
    for ($i = $pointer; $i < $pointer + 4; $i++) {
      $posts[] = $avail_posts[$i];
      if ($i < $pointer + 3 && $avail_posts[$i]->thumbnail()) {
        $found_image = true;
      }
      if ($found_image && count($posts) >= 4) {
        break;
      }
    }
    // swap the post with the image for the second position
    if ($found_image) {
      $posts = $this->swap_posts($posts, 1);
    }
    return $posts;
  }

  protected function get_zone_4_posts() {
    $avail_posts = $this->avail_posts;
    $pointer = $this->get_zone_pointer(4);
    $posts = array();
    $found_image = false;
    for ($i = $pointer; $i < $pointer + 7; $i++) {
      $posts[] = $avail_posts[$i];
      if ($avail_posts[$i]->thumbnail()) {
        $found_image = true;
      }
      if ($found_image && count($posts) >= 7) {
        break;
      }
    }
    // swap the post with the image for the second position
    if ($found_image) {
      $posts = $this->swap_posts($posts, 0);
    }
    return $posts;
  }
}
