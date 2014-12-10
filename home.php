<?php
/**
 * The template for displaying the Home page
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$homepage = Timber::get_post('home', 'HechingerPost');
$second_feature = $homepage->get_field('second_feature');

if ( isset($second_feature) && is_array($second_feature) ) {
  $context['second_feature'] = new HechingerPost($second_feature[0]->ID);
}

if (class_exists('TimberStream')) {
  $stream = new HechingerHome();
  $context['home'] = $stream;
  $context['posts'] = $stream->get_posts(array(), 'HechingerPost');
}

//TODO: filter out posts in homepage stream
$context['latest_posts'] = Timber::get_posts('HechingerPost');
$context['z2_quote'] = get_quote('z2_quote', $homepage);
$context['z3_quote'] = get_quote('z3_quote', $homepage);

function get_quote( $qt_str, $homepage ) {
  $zquote = array();
  $zquote_link = $homepage->get_field($qt_str . '_link');
  $zquote_text = $homepage->get_field($qt_str . '_text');
  $zquote_subhead = $homepage->get_field($qt_str . '_subhead');
  $zquote_number = $homepage->get_field($qt_str . '_number');

  if ( isset($zquote_link) && is_array($zquote_link) ) {
    $post = new HechingerPost($zquote_link[0]->ID);
    $zquote['post'] = $post;

    if ( isset($zquote_text) && strlen($zquote_text) ) {
      $zquote['text'] = $zquote_text;
    } else {
      $zquote['text'] = $zquote['post']->title();
    }

    if ( isset($zquote_subhead) && strlen($zquote_subhead) ) {
      $zquote['subhead'] = $zquote_subhead;
    } else {
      $zquote['subhead'] = $zquote['post']->subhead;
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

$context['special_reports'] = Timber::get_terms('special-report', 'HechingerTerm');

Timber::render('pages/home.twig', $context);
