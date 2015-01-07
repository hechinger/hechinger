<?php

class HechingerRoutes {

  static function set_routes(){
    Timber::add_route('special-reports', function($params){
      Timber::load_view('special-reports-landing.php', null, 200, $params);
    });
    Timber::add_route('special-reports-landing', function($params){
      Timber::load_view('special-reports-landing.php', null, 200, $params);
    });
    Timber::add_route('staff', function($params){
      Timber::load_view('staff.php', null, 200, $params);
    });
    Timber::add_route('special-reports/:name', function($params){
      Timber::load_view('special-report.php', null, 200, $params);
    });
    Timber::add_route('special-report/:name', function($params){
      Timber::load_view('special-report.php', null, 200, $params);
    });
    Timber::add_route('special-reports/:name/page/:number', function($params){
      Timber::load_view('special-report.php', null, 200, $params);
    });
    Timber::add_route('special-report/:name/page/:number', function($params){
      Timber::load_view('special-report.php', null, 200, $params);
    });
    Timber::add_route('about', function($params){
      Timber::load_view('about.php', null, 200, $params);
    });
    Timber::add_route('advisors', function($params){
      Timber::load_view('advisors.php', null, 200, $params);
    });
    Timber::add_route('supporters', function($params){
      Timber::load_view('supporters.php', null, 200, $params);
    });
    Timber::add_route('search', function($params){
      Timber::load_view('search.php', null, 200, $params);
    });
    Timber::add_route('advisory-committee', function($params){
      Timber::load_view('advisors.php', null, 200, $params);
    });
    Timber::add_route('use-our-stories', function($params){
      Timber::load_view('page.php', null, 200, $params);
    });
    Timber::add_route('category/special_reports', function($params){
      Timber::load_view('special-reports-landing.php', null, 200, $params);
    });
    Timber::add_route('content/:name', function($params){
      $pos = strrpos($params['name'], "_");
      $name = substr($params['name'], 0, $pos);
      $query = array(
        'name'           => $name,
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 1
      );
      Timber::load_view('single.php', $query, 200, $params);
    });
  }
}
