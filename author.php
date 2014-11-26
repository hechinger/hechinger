<?php
/**
 * The template for displaying Author Archive pages
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
global $wp_query;

$data = Timber::get_context();
$data['posts'] = Timber::get_posts('HechingerPost');
$data['pagination'] = Timber::get_pagination();
if (isset($wp_query->query_vars['author'])){
  $author = new TimberUser($wp_query->query_vars['author']);
  $data['author'] = $author;
}
if (isset($author->author_image) && strlen($author->author_image)) {
  $author->image = new TimberImage($author->author_image);
}
Timber::render(array('pages/author.twig', 'pages/author.twig', 'pages/archive.twig'), $data);
