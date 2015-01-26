<?php

if ( !class_exists( 'Timber' ) ) {
  add_action( 'admin_notices', function() {
      echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . admin_url( 'plugins.php#timber' ) . '">' . admin_url( 'plugins.php' ) . '</a></p></div>';
    } );
  return;
}

Timber::$dirname = array( 'templates', 'views' );

require_once('wp/acf-hacks.php');
require_once('wp/hechinger-post.php');
require_once('wp/hechinger-term.php');
require_once('wp/hechinger-image.php');
require_once('wp/hechinger-user.php');
require_once('wp/hechinger-home.php');
require_once('wp/image-shortcodes.php');

require_once('wp/editor-tool-core.php');
require_once('wp/editor-tool-interface.php');
require_once('wp/admin-pullquote.php');
require_once('wp/admin-aside.php');
require_once('wp/admin-related.php');

require_once('wp/routes.php');
require_once('wp/hechinger-site.php');

new PullQuoteAdmin();
new AsideAdmin();
new RelatedAdmin();
new HechingerSite();

ACFHacks::map_page_rule_to_slug(18113, 'home');
ACFHacks::map_page_rule_to_slug(17996, 'about');

if (class_exists('Jigsaw')) {
  Jigsaw::add_css('static/css/hechinger-admin.css');
}

define( 'DISALLOW_FILE_EDIT', true );
