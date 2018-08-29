<?php

/**
 * The template for displaying a single Special Report page.
 *
 * @package 	WordPress
 * @subpackage 	Timber
 * @since 		Timber 0.2
 */

global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}

$context = Timber::get_context();
$args = array(
  'slug' => $params['name']
);

$term = Timber::get_terms('special-report', $args, 'HechingerTerm');

if ( isset($term[0]) && get_class($term[0]) == 'HechingerTerm' ) {
  $context['banner'] = $term[0]->get_image('yellow_pano');
  $context['posts'] = $term[0]->get_posts(array('paged' => $paged), 'HechingerPost');
  $context['term'] = $term[0];
  $context['pagination'] = Timber::get_pagination();
} else {
  wp_redirect( '/index.php?s='. $params['name'], 301 );
  exit;
}

$context['promos'] = HechingerSite::get_promos($context['term']->name);

Timber::render('pages/special-report.twig', $context);
