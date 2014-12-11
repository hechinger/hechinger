<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/views/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$context = Timber::get_context();
$context['advisors'] = array(
  [0] => array(
    "name" => "John",
    "image" => "/static/mug_placeholder-200x200-c-default.jpg",
    "description" => "Words go here"
  ),
  [1] => array(
    "name" => "Jane",
    "image" => "/static/mug_placeholder-200x200-c-default.jpg",
    "description" => "Words go here"
  )
);
$context['post'] = new HechingerPost($post);

// $staff_users = new WP_User_Query( array( 'meta_key' => 'hech_role', 'meta_value' => 'staff' ) );

// if ( isset($staff_users->results) && is_array($staff_users->results) ) {
//   foreach ($staff_users->results as $user) {
//     $context['users'][] = new HechingerUser($user);
//   }
// }

Timber::render('pages/staff.twig', $context);
