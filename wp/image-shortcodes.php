<?php

class ImageShortcodes {

  public static function set_shortcodes($site) {
    // This actually runs the shortcode. It is good
    add_filter( 'img_caption_shortcode', array('ImageShortcodes', 'handle_img_in_editor'), 10, 3);
    add_filter( 'image_send_to_editor', function($html, $id, $caption, $title, $align, $url, $size, $alt ) {
      if (!$caption) {
        $caption = '<span class="placeholder-caption" style="display:none;"> &nbsp; </span>';
        preg_match( '/width=["\']([0-9]+)/', $html, $matches );
        $width = $matches[1];
        $shcode = '[caption id="' . $id . '" align="align' . $align . '" width="' . $width . '"]' . $html . ' ' . $caption . '[/caption]';
        return $shcode;
      }
      return $html;
    }, 10, 8);
  }

  static function handle_img_in_editor($output, $attr, $content) {
    if ( isset($attr['id']) && $attr['id'] ) {
      $iid = str_replace( 'attachment_', '', $attr['id'] );
      if (isset($iid) && strlen($iid)) {
        $image = new HechingerImage( $iid );
      }
      if (!isset($attr['align'])){
        $attr['align'] = 'aligncenter';
      }
      $class = $attr['align'] . ' inline-core-image';
      $width = $attr['width'];
      if ( $attr['align'] == 'alignnone' || $attr['align'] == 'aligncenter') {
        $attr['full_width'] = true;
      }
      $image_string = Timber::compile( 'templates/components/article-core-img.twig', array( 'image' => $image, 'class' => $class, 'width' => $width, 'attr' => $attr ) );
      return preg_replace('/\s+/', ' ', $image_string);
    }
    return $output;
  }
}
