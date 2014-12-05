<?php

class HechingerUser extends TimberUser {

  function get_image() {
    if (isset($this->author_image) && strlen($this->author_image)) {
      $image = new HechingerImage($this->author_image);
      return $image;
    }
  }
}
