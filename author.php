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
$data['posts'] = Timber::get_posts();
if (isset($wp_query->query_vars['author'])){
  $author = new TimberUser($wp_query->query_vars['author']);
  $data['author'] = $author;
  $data['title'] = 'Author Archives: ' . $author->name();
}
if (isset($author->author_image) && strlen($author->author_image)) {
  $author->image = new TimberImage($author->author_image);
}
Timber::render(array('pages/author-test.twig', 'pages/archive.twig'), $data);
