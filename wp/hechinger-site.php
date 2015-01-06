<?php
	class HechingerSite extends TimberSite {

  function __construct() {
    add_theme_support( 'post-formats', array( 'article', 'column', 'opinion' ) );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    ImageShortcodes::set_shortcodes($this);
    HechingerRoutes::set_routes();
    $this->addFilters();
    $this->addActions();
    $this->bootstap_content();
    $this->fix_custom_field_conflict();
    parent::__construct();
  }

  function addFilters() {
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
    add_filter( 'acf/load_field/key=field_5492eb43d3984', array($this, 'set_primary_special_report'), 2, 2 );
    add_filter( 'coauthors_edit_author_cap', function(){ return 'read'; } );
  }

  function addActions() {
    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    add_action( 'init', array( $this, 'add_reports' ) );
    add_action( 'init', array( $this, 'register_menus' ) );
  }

  function fix_custom_field_conflict() {
    global $wpdb;
    $wpdb->query("DELETE FROM wp_postmeta WHERE meta_key = '_wp_page_template'");
  }

  public function get_current_url() {
    return TimberHelper::get_current_url();
  }

  function register_post_types() {
    // this is where you can register custom post types
  }

  function register_menus() {
    $menu_exists = wp_get_nav_menu_object( 'nav-bar' );
    if( !$menu_exists){
      $menu_id = wp_create_nav_menu('nav-bar');
    }

    $menu_exists = wp_get_nav_menu_object( 'footer-nav' );
    if( !$menu_exists){
      $menu_id = wp_create_nav_menu('footer-nav');
    }
  }

  public static function get_promos($exclude = '') {
    $return = array();
    $promos = Timber::get_terms('special-report', 'HechingerTerm');
    if (isset($promos) && is_array($promos) && count($promos)) {
      foreach ($promos as $promo) {
        if ($promo->is_promoted && $promo->name !== $exclude) {
          $return[] = $promo;
        }
      }
    }
    return $return;
  }

  function register_taxonomies() {
    $labels = array(
      'name'                       => _x( 'Special Reports', 'taxonomy general name' ),
      'singular_name'              => _x( 'Special Report', 'taxonomy singular name' ),
      'search_items'               => __( 'Search Special Reports' ),
      'popular_items'              => __( 'Popular Special Reports' ),
      'all_items'                  => __( 'All Special Reports' ),
      'parent_item'                => null,
      'parent_item_colon'          => null,
      'edit_item'                  => __( 'Edit Special Report' ),
      'update_item'                => __( 'Update Special Report' ),
      'add_new_item'               => __( 'Add New Special Report' ),
      'new_item_name'              => __( 'New Special Report Name' ),
      'separate_items_with_commas' => __( 'Separate Special Reports with commas' ),
      'add_or_remove_items'        => __( 'Add or remove Special Reports' ),
      'choose_from_most_used'      => __( 'Choose from the most used Special Reports' ),
      'not_found'                  => __( 'No Special Reports found.' ),
      'menu_name'                  => __( 'Special Reports' ),
    );

    $args = array(
      'hierarchical'          => true,
      'labels'                => $labels,
      'show_ui'               => true,
      'show_admin_column'     => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var'             => true,
      'rewrite'               => array( 'slug' => 'special-reports' ),
    );
    register_taxonomy( 'special-report', 'post', $args );

    $labels = array(
      'name'                       => _x( 'Partners', 'taxonomy general name' ),
      'singular_name'              => _x( 'Partner', 'taxonomy singular name' ),
      'search_items'               => __( 'Search Partners' ),
      'popular_items'              => __( 'Popular Partners' ),
      'all_items'                  => __( 'All Partners' ),
      'parent_item'                => null,
      'parent_item_colon'          => null,
      'edit_item'                  => __( 'Edit Partner' ),
      'update_item'                => __( 'Update Partner' ),
      'add_new_item'               => __( 'Add New Partner' ),
      'new_item_name'              => __( 'New Partner Name' ),
      'separate_items_with_commas' => __( 'Separate Partners with commas' ),
      'add_or_remove_items'        => __( 'Add or remove Partners' ),
      'choose_from_most_used'      => __( 'Choose from the most used Partners' ),
      'not_found'                  => __( 'No Partners found.' ),
      'menu_name'                  => __( 'Partners' ),
    );

    $args = array(
      'hierarchical'          => true,
      'labels'                => $labels,
      'show_ui'               => true,
      'show_admin_column'     => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var'             => true,
      'rewrite'               => array( 'slug' => 'partners' ),
    );
    register_taxonomy( 'partner', 'post', $args );
  }

  function add_to_context( $context ) {
    $context['nav_menu'] = new TimberMenu('nav-bar');
    $context['footer_menu'] = new TimberMenu('footer-nav');
    $context['site'] = $this;
    return $context;
  }

  function add_to_twig( $twig ) {
    /* this is where you can add your own fuctions to twig */
    $twig->addExtension( new Twig_Extension_StringLoader() );
    $twig->addFilter( 'myfoo', new Twig_Filter_Function( function( $text ) {
        $text .= ' bar!';
        return $text;
      } ) );
    return $twig;
  }

  function add_reports( $reports ) {

    $reports = array (
      array(
        'name' => 'California',
        'slug' => 'california'
      ),
      array(
        'name' => 'Mississippi Learning',
        'slug' => 'mississippi-learning'
      ),
      array(
        'name' => 'Higher Education',
        'slug' => 'higher-education'
      ),
      array(
        'name' => 'Common Core',
        'slug' => 'common-core'
      )
    );

    foreach ($reports as $report) {
      if ( !term_exists( $report['name'], 'special-report') ) {
        $parent_term = term_exists( $report['name'], 'special-report' );
        $parent_term_id = $parent_term['term_id'];

        wp_insert_term(
          $report['name'],
          'special-report',
          array(
            'description'=> $report['name'] . ' is one of The Hechinger Report\'s featured Special Reports.',
            'slug' => $report['slug'],
            'parent'=> $parent_term_id
          )
        );
      }
    }
  }

  static function set_primary_special_report( $field ) {
    global $post;
    if ( !$post ) {
      return $field;
    }
    $post = new HechingerPost();
    $terms = $post->special_topics();
    if ( is_array( $terms ) ) {
      foreach ( $terms as $term ) {
        $field['choices'][$term->id] = $term->name;
      }
    }
    return $field;
  }
}
