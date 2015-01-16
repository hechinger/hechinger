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
        $srcset_attr .= TimberImageHelper::resize($this->src, floor($width/$divisor), floor($height/$divisor), $crop);
        $srcset_attr .= ' '. strval(floor($width/$divisor)) . 'w';
        if ($divisor !== end($sizes)) {
          $srcset_attr .= ', ';
        }
      }
      return $srcset_attr;
  }
}

add_filter('get_twig', function($twig) {
  $twig->addFilter( 'max_width', new Twig_Filter_Function( function( $src, $max = 1000) {
    $ti = new HechingerImage($src);
    if ($ti->width() > $max) {
      $src = TimberImageHelper::resize($src, $max);
    }
    return $src;
  } ) );
  return $twig;
});
