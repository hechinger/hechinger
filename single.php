<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$context = Timber::get_context();
$post = Timber::query_post('HechingerPost');
$context['post'] = $post;
$context['wp_title'] .= ' - ' . $post->title();
$context['comment_form'] = TimberHelper::get_comment_form();
// TODO: refactor to allow any arbitrary article type to load a template of that type
if (post_password_required($post->ID)){
	Timber::render('single-password.twig', $context);
} elseif ( $post->is_feature() ) {
	Timber::render(array('single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'pages/article-feature.twig'), $context);
} else {
	Timber::render(array('single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'pages/article.twig'), $context);
}
