<?php

/**
 * The template for Supporters page.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$context['post'] = new HechingerPost($post);
$context['supporters'] = array(
  array(
    "name" => "Carnegie Corporation of New York",
    "image" => "supporter-carnegie.png",
    "link" => "http://www.carnegie.org"
  ),
  array(
    "name" => "The Jack Kent Cooke Foundation",
    "image" => "supporter-cooke.png",
    "link" => "http://www.jkcf.org"
  ),
  array(
    "name" => "The Bill & Melinda Gates Foundation",
    "image" => "supporter-gates.png",
    "link" => "http://www.gatesfoundation.org"
  ),
  array(
    "name" => "The Heising-Simons Foundation",
    "image" => "supporter-heising.png",
    "link" => "http://heisingsimons.org"
  ),
  array(
    "name" => "The W.K. Kellogg Foundation",
    "image" => "supporter-kellogg.png",
    "link" => "http://www.wkkf.org"
  ),
  array(
    "name" => "Lumina Foundation for Education",
    "image" => "supporter-lumina.png",
    "link" => "http://www.luminafoundation.org"
  ),
  array(
    "name" => "The Wallace Foundation",
    "image" => "supporter-wallace.png",
    "link" => "http://www.wallacefoundation.org/"
  ),
  array(
    "name" => "American Institutes for Research",
    "image" => "supporter-american-institutes.png",
    "link" => "http://www.air.org"
  )


);

Timber::render('pages/supporters.twig', $context);
