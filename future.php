<?php 

/**
 * The template for Join Us page.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 **/

$context = Timber::get_context();
$context['post'] = new HechingerPost();
//Timber::render(array('pages/' . $context['post']->slug . '.twig', 'pages/page.twig'), $context);
Timber::render( 'pages/newsletter.twig', $context );