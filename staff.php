<?php

/**
 * The template for displaying Staff landing page.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$context['users'] = array();
$context['post'] = new HechingerPost($post);
$staff_users = $context['post']->get_field('staff_users');

if ( is_array($staff_users) && count($staff_users) ) {
  foreach ($staff_users as $user) {
    $context['users'][] = new HechingerUser($user);
  }
}

Timber::render('pages/staff.twig', $context);
