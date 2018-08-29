<?php 

/**
 * The template for Map to the Middle Class page.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 **/

$context = Timber::get_context();
$context['post'] = new HechingerPost();
//Timber::render(array('pages/' . $context['post']->slug . '.twig', 'pages/page.twig'), $context);
Timber::render( 'pages/map-to-the-middle-class1.twig', $context );