<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$context = Timber::get_context();
$post = Timber::query_post('HechingerPost');
$homepage = Timber::get_post('home', 'HechingerPost');
$context['post'] = $post;
$context['wp_title'] .= ' - ' . $post->title();
$context['comment_form'] = TimberHelper::get_comment_form();
$query_args = array('post__not_in' => array( $post->ID ) );

if (class_exists('TimberStream')) {
  $stream = new TimberStream('homepage');
  $context['recirc_posts'] = $stream->get_posts($query_args, 'HechingerPost');
}

$query_args['post__not_in'] = array_merge( $query_args['post__not_in'], wp_list_pluck($context['recirc_posts'],'ID') );
$context['latest_posts'] = Timber::get_posts($query_args, 'HechingerPost');

$context['zquote'] = get_quote('z2_quote', $homepage);

// TODO: refactor to make this part of HechingerSite API
function get_quote( $qt_str, $homepage ) {
  $zquote = array();
  $zquote_link = $homepage->get_field($qt_str . '_link');
  $zquote_text = $homepage->get_field($qt_str . '_text');
  $zquote_subhead = $homepage->get_field($qt_str . '_subhead');
  $zquote_number = $homepage->get_field($qt_str . '_number');

  if ( isset($zquote_link) && is_array($zquote_link) ) {
    $zquote['post'] = new HechingerPost($zquote_link[0]->ID);
    $zquote['subhead'] = new HechingerPost($zquote_link[0]->ID);

    if ( isset($zquote_text) && strlen($zquote_text) ) {
      $zquote['text'] = $zquote_text;
    } else {
      $zquote['text'] = $zquote['post']->title;
    }

    if ( isset($zquote_subhead) && strlen($zquote_subhead) ) {
      $zquote['subhead'] = $zquote_subhead;
    } else {
      $zquote['subhead'] = $zquote['post']->tease_excerpt(10);
    }

    if ( isset($zquote_number) && strlen($zquote_number) ) {
      if ( strpos($zquote_number, '%') !== false) {
        $zquote['number'] = substr($zquote_number, 0, -1) . '<span class="tz-special-precent">%</span>';
      } else {
        $zquote['number'] = $zquote_number;
      }
      $zquote['show_stat'] = true;
    } else {
      $zquote['show_stat'] = false;
    }
  }
  return $zquote;
}

if (post_password_required($post->ID)){
	Timber::render('single-password.twig', $context);
} else {
	Timber::render(array('single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'pages/article.twig'), $context);
}
