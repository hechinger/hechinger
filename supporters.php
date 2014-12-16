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
$context['post'] = new HechingerPost($post);
// $staff_users = new WP_User_Query( array( 'meta_key' => 'hech_role', 'meta_value' => 'staff' ) );
// if ( isset($staff_users->results) && is_array($staff_users->results) ) {
//   foreach ($staff_users->results as $user) {
//     $context['users'][] = new HechingerUser($user);
//   }
// }
Timber::render('pages/supporters.twig', $context);
