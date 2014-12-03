<?php

class HechingerImage extends TimberImage {

  function caption() {
    $cred = $this->get_field('credit');
    if ( isset($cred) ) {
      return $cred;
    }
    return false;
  }

}
