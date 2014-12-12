<?php

class HechingerTerm extends TimberTerm {

  function get_image($shape = 'bw_rect') {
    $image = new HechingerImage($this->$shape);
    if ( isset($image)) {
      return $image;
    }
  }
}
