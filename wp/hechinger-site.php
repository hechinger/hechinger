<?php
class HechingerSite extends TimberSite {

  const VERSION = '1.0';

  function __construct() {
    add_theme_support( 'post-formats', array( 'article', 'column', 'opinion' ) );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    ImageShortcodes::set_shortcodes($this);
    HechingerRoutes::set_routes();
    $this->addFilters();
    $this->addActions();
    $this->fix_custom_field_conflict();
    parent::__construct();
  }

  function bootstrap_content() {
    $bootstrap = get_option('hechinger_bootstrap');
    if( $bootstrap != $this::VERSION ) {
      $this->do_bootstrap_content();
      update_option( 'hechinger_bootstrap', $this::VERSION );
    }
  }

  function do_bootstrap_content() {
    $this->do_bootstrap_taxonomies();
  }

  function do_bootstrap_taxonomies() {
    $taxonomies = array(
        'article-type' => array(
            'feature',
            'column',
            'opinion'
          )
    );
    foreach( $taxonomies as $taxonomy => $terms ) {
      foreach( $terms as $term ) {
        if( !term_exists( $term, $taxonomy ) ) {
          wp_insert_term(
              ucwords($term),
              $taxonomy,
              array(
                  'slug' => $term
              )
          );
        }
      }
    }
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
    add_action( 'admin_init', array( $this, 'bootstrap_content' ) );
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

    $labels = array(
        'name'                       => _x( 'Article Types', 'taxonomy general name' ),
        'singular_name'              => _x( 'Article Type', 'taxonomy singular name' ),
        'search_items'               => __( 'Search Article Types' ),
        'popular_items'              => __( 'Popular Article Types' ),
        'all_items'                  => __( 'All Article Types' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Article Type' ),
        'update_item'                => __( 'Update Article Type' ),
        'add_new_item'               => __( 'Add New Article Type' ),
        'new_item_name'              => __( 'New Article Type Name' ),
        'separate_items_with_commas' => __( 'Separate Article Types with commas' ),
        'add_or_remove_items'        => __( 'Add or remove Article Types' ),
        'choose_from_most_used'      => __( 'Choose from the most used Article Types' ),
        'not_found'                  => __( 'No Article Types found.' ),
        'menu_name'                  => __( 'Article Types' ),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'article-type' ),
    );
    register_taxonomy( 'article-type', 'post', $args );
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

  public static function sync_categories( $to = 'special-report', $from = 'category' ) {

    if( !taxonomy_exists( $to ) ) {
      echo 'Whoops! You specified a taxonomy that doesn\'t exist in the database.' . "\n<br />";
      echo 'Please create the taxonomy you want to convert to and rerun this script.';
      return;
    }

    if( !file_exists( __DIR__ . "/content-import/$to.txt" ) ) {
      echo 'Import File is missing!';
      return;
    }

    $import_file = file_get_contents( __DIR__ . "/content-import/$to.txt" );

    //put it in an array - new line = new term
    $from_names = explode("\n", $import_file);

    if( !$from_names || !is_array($from_names) ) {
      echo 'Whoops! The file import failed :(. Please ensure that  ' . __DIR__;
      echo '/content-import/' . $to . '.txt exists and try again';
      return;
    }

    $file_terms_count = count($from_names);
    echo "Found $file_terms_count $from terms in the imported file ($to.txt).\n<br />";

    $from_terms = $errors = array();
    foreach( $from_names as $from_name ) {
      $from_term = get_term_by( 'name', $from_name, 'category' );
      if( $from_term && isset( $from_term->term_id ) ) {
        //insert/check the term in the "$to" taxonomy
        $to_term = term_exists( $from_term->slug, $to );
        if( !$to_term ) {
          $term_args = array(
            'description' => $from_term->description,
            'slug' => $from_term->slug
          );
          $to_term = wp_insert_term( $from_term->name, $to, $term_args );
          echo "Inserted {$from_term->name} into the $to taxonomy.\n<br />";
        }
        $from_term->matching_term_id = (int)$to_term['term_id'];
        $from_terms[(int)$from_term->term_id] = $from_term;
      }else{
        $errors[] = "Couldn't associate $from_term with a $from from the database.";
      }
    }

    $db_terms_count = count($from_terms);
    echo "Associated $db_terms_count $from terms from the imported file to $from terms in the database.\n<br />";

    if( $errors ) {
      echo implode("\n<br />", $errors);
      $errors = array();
    }

    $args = array(
        'post_type' => 'post',
        'category__in' => array_keys( $from_terms )
    );

    $matching_posts = get_posts( $args );
    $posts_count = count($matching_posts);
    echo "Retrieved $posts_count posts with terms from the imported $from file.\n<br />";

    $added_terms = array();
    //loop over the terms
    foreach( $from_terms as $from_term ){
      //loop over all posts
      foreach($matching_posts as $post ) {
        //check if the current post has the "from" term, but NOT the "to" term
        if( has_term( $from_term->term_id, $from, $post->ID ) && !has_term( $from_term->slug, $to, $post->ID ) ) {
          //if it does, migrate it to the new taxonomy
          //make sure to append the term to existing terms, not replace
          $added_term = wp_set_post_terms( $post->ID, array( $from_term->matching_term_id ), $to, $append = true);
          if( $added_term && !is_wp_error( $added_term ) ) {
            $added_terms[] = $added_term;
          }else{
            $errors[] = "Failed to add {$from_term->name} to {$post->post_title}.";
          }
        }
      }
    }
    $added_terms_count = count($added_terms);
    echo "Synced $added_terms_count terms from $posts_count posts";

    if( $errors ) {
      echo implode("\n<br />", $errors);
      $errors = array();
    }

    //todo: complete and think about how to avoid db transactions from here on out

  }

}