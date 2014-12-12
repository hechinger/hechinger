<?php

/**
 * The template for displaying search pages
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

  global $wp_query;
  $context = Timber::get_context();
  $context['query'] = get_search_query();
  $context['count'] = $wp_query->found_posts;
  $context['posts'] = Timber::get_posts( 'HechingerPost' );
  $context['is_search'] = true;
  $context['pagination'] = Timber::get_pagination();
  Timber::render(array('pages/search.twig'), $context);
