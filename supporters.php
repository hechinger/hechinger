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
    "name" => "The Eli and Edythe Broad Foundation",
    "image" => "supporter-broad.png",
    "link" => "http://www.broadfoundation.org"
  ),
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
    "name" => "The Ford Foundation",
    "image" => "supporter-ford-foundation.png",
    "link" => "http://www.fordfoundation.org/"
  ),
  array(
    "name" => "The Leona M. and Harry B. Helmsley Charitable Trust",
    "image" => "supporter-helmsley.png",
    "link" => "http://helmsleytrust.org"
  ),
  array(
    "name" => "The Joyce Foundation",
    "image" => "supporter-joyce.png",
    "link" => "http://www.joycefdn.org"
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
    "name" => "The Spencer Foundation",
    "image" => "supporter-spencer.png",
    "link" => "http://www.spencer.org"
  ),
  array(
    "name" => "The Wasserman Foundation",
    "image" => "supporter-wasserman.png",
    "link" => "http://www.wassermanfoundation.org"
  ),
  array(
    "name" => "American Institutes for Research",
    "image" => "supporter-american-institutes.png",
    "link" => "http://www.air.org"
  )


);

Timber::render('pages/supporters.twig', $context);
