<?php

/**
 * The template for Partners page.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$context['post'] = new HechingerPost($post);
$context['partners'] = Timber::get_terms('partner');

Timber::render('pages/partners.twig', $context);
