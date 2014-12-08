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
$context['post'] = Timber::get_post('about', 'HechingerPost');
$staff_users = new WP_User_Query( array( 'meta_key' => 'hech_role', 'meta_value' => 'staff' ) );

if ( isset($staff_users->results) && is_array($staff_users->results) ) {
  foreach ($staff_users->results as $user) {
    $context['users'][] = new HechingerUser($user);
  }
}

Timber::render('pages/about.twig', $context);
