<?php
/**
 * The template for displaying About page
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$context['post'] = Timber::get_post('about', 'HechingerPost');
$partners = $context['post']->get_field('partner_list');
$users = $context['post']->get_field('staff');

if (isset($partners) && is_array($partners) && count($partners)) {
  foreach ($partners as $partner) {
    $context['partners'][] = new HechingerTerm($partner);
  }
}

if ( isset($users) && is_array($users) ) {
  foreach ($users as $user) {
    $context['users'][] = new HechingerUser($user);
  }
}

$awards = $context['post']->get_field('awards');

if ( isset($awards) && is_array($awards)) {
  $context['awards'] = $awards;
}

Timber::render('pages/about.twig', $context);
