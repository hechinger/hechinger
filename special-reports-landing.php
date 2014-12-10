<?php
/**
 * The template for displaying Special Reports Landing.
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$context = Timber::get_context();

$context['post'] = Timber::get_post('special-reports-landing', 'HechingerPost');
$context['special_reports'] = Timber::get_terms('special-report', 'HechingerTerm', array('orderby => name'));
$context['pagination'] = Timber::get_pagination();

Timber::render('pages/special-reports-landing.twig', $context);
