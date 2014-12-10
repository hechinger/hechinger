<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
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

  $term = Timber::get_terms('special-report', $args, 'HechingerTerm')[0];
  $context['banner'] = $term->get_image('yellow_pano');

  $context['posts'] = $term->get_posts(array('paged' => $paged));
  $context['term'] = $term;
  $context['pagination'] = Timber::get_pagination();

  Timber::render('pages/special-report.twig', $context);
