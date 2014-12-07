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

if (class_exists('TimberStream')) {
  $stream = new HechingerHome();
  $context['home'] = $stream;
  $context['posts'] = $stream->get_posts(array(), 'HechingerPost');
}

//TODO: filter out posts in homepage stream
$context['latest_posts'] = Timber::get_posts('HechingerPost');

if ( isset($second_feature) && is_array($second_feature) ) {
  $context['second_feature'] = new HechingerPost($second_feature[0]->ID);
}

$context['special_reports'] = Timber::get_terms('special-topic', 'HechingerTerm');

Timber::render('pages/home.twig', $context);
