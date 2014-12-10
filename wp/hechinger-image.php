<?php

class HechingerImage extends TimberImage {

  function caption() {
    $cred = $this->get_field('credit');
    if ( isset($cred) ) {
      return $cred;
    }
    return false;
  }

  function srcset($width, $height = 0, $crop = 'default' ) {
      $srcset_attr = '';
      $sizes = [1, 2, 4];

      //call timber's resize function 3 times to get sm, med, lg imgs
      foreach ($sizes as $divisor) {
        $srcset_attr .= TimberImageHelper::resize($this->src, $width/$divisor, $height/$divisor, $crop);
        $srcset_attr .= ' '. strval($width/$divisor) . 'w';
        if ($divisor !== end($sizes)) {
          $srcset_attr .= ', ';
        }
      }
      return $srcset_attr;
  }
}
