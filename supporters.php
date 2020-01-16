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
    "name" => "American Student Assistance",
    "image" => "supporter-asa.png",
    "link" => "https://www.asa.org/"
  ),
  array(
    "name" => "Arnold Ventures",
    "image" => "supporter-arnold.png",
    "link" => "http://arnoldventures.org"
  ),
    array(
    "name" => "Carnegie Corporation of New York",
    "image" => "supporter-carnegie.png",
    "link" => "http://www.carnegie.org"
  ),
  array(
    "name" => "Chan Zuckerberg Initiative",
    "image" => "supporter-chanzuckerberg.png",
    "link" => "http://chanzuckerberg.com"
  ),
  array(
    "name" => "The Jack Kent Cooke Foundation",
    "image" => "supporter-cooke.png",
    "link" => "http://www.jkcf.org"
  ),
    array(
    "name" => "ECMC Foundation",
    "image" => "supporter-ecmc.png",
    "link" => "https://www.ecmcfoundation.org"
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
    "name" => "The William and Flora Hewlett Foundation",
    "image" => "supporter-hewlett.png",
    "link" => "https://hewlett.org"
  ),
    array(
    "name" => "Jaquelin Hume Foundation",
    "image" => "supporter-hume.png",
    "link" => ""
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
    "name" => "The Nellie Mae Education Foundation",
    "image" => "supporter-nelliemae.png",
    "link" => "http://www.nmefoundation.org/"
      ),
  	array(
    "name" => "The Omidyar Network",
    "image" => "supporter-omidyar.png",
    "link" => "https://www.omidyar.com/"
  ),
  	array(
    "name" => "The Pinkerton Foundation",
    "image" => "supporter-pinkerton.png",
    "link" => "http://www.thepinkertonfoundation.org/"
  ),
    	array(
    "name" => "The PowHERful Foundation",
    "image" => "supporter-powherful.png",
    "link" => "https://powherful.org/"
  ),
    array(
    "name" => "Charles and Lynn Schusterman Family Foundation",
    "image" => "supporter-schusterman.png",
    "link" => "https://www.schusterman.org"
  ),
    array(
    "name" => "The Spencer Foundation",
    "image" => "supporter-spencer.png",
    "link" => "https://www.spencer.org"
  ),
  array(
    "name" => "The Wallace Foundation",
    "image" => "supporter-wallace.png",
    "link" => "http://www.wallacefoundation.org/"
  ),



);

Timber::render('pages/supporters.twig', $context);
