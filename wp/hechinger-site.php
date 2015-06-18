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
    add_filter( 'acf/fields/relationship/query', array( $this, 'acf_relationship_sort' ), 10, 3 );
  }

  function addActions() {
    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    add_action( 'init', array( $this, 'register_menus' ) );
    add_action( 'init', array( $this, 'register_sidebar' ) );
    add_action( 'admin_init', array( $this, 'bootstrap_content' ) );
    add_action( 'admin_notices', array( $this, 'bootstrap_sync' ) );

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

  function register_sidebar() {
    register_sidebar( array (
      'name'      => 'Ad sidebar',
      'id'      => 'ad_sidebar',
      'before_widget' => '<div class="article-ad-content"><p class="aside-ad-hdr">Advertisement</p>',
      'after_widget'  => '</div>'
    ));

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

  function acf_relationship_sort( $args, $field, $post_id ) {
    $args['orderby'] = 'date';
    $args['order'] = 'DESC';
    return $args;
  }

  public static function bootstrap_sync() {
    $message = '';
    if( isset( $_GET['hech_sync_to'] ) ) {
      $message .= '<br />';
      $from = isset( $_GET['hech_sync_from'] ) ? sanitize_text_field( $_GET['hech_sync_from'] ) : 'category';
      $to = sanitize_text_field( $_GET['hech_sync_to'] );
      $message .= self::sync_categories( $to, $from );

    }
    if( isset( $_GET['hech_sync_partners'] ) ) {
      $message .= '<br />';
      $message .= self::sync_partners();

    }
    if( $message ) {
      ?>
      <div class="updated">
        <p><?= $message; ?></p>
      </div>
    <?php
    }
  }

  /* sync partners in a safe way
  * such that no "relationships" or links are deleted
   * we can delete these at a later date by looking at the
   * hech_bookmarks_to_delete option, as well as deleting all
   * `logo` post meta
   */
  public static function sync_partners() {
    $message = '';
    $args = array(
        'meta_key'=>'logo',
        'posts_per_page' => -1,
        'nopaging' => true
    );
    $posts = get_posts( $args );
    $posts_count = count( $posts );
    $message .= "$posts_count posts were found with the `logo` meta key\n<br />";
    $taxonomy_slug = 'partner';
    $sync_count = 0;
    $bookmarks_to_delete = $not_found = array();
    if( $posts ) {
      foreach( $posts as $post ) {
        $bookmark_id = (int)$post->logo;
        if( $bookmark_id ) {
          $partner_bookmark = get_bookmark( $bookmark_id );
          if( $partner_bookmark ) {
            $bookmarks_to_delete[] = $bookmark_id;
            $partner_term_id_arr = term_exists( $partner_bookmark->link_name, $taxonomy_slug );
            if( !$partner_term_id_arr ) {
              $partner_term_id_arr = wp_insert_term( $partner_bookmark->link_name, $taxonomy_slug );
            }
            if( !isset( $partner_term_id_arr['term_id'] ) )
              continue;
            $partner_term_id = (int)$partner_term_id_arr['term_id'];
            //be sure to append and not replace terms for each post
            wp_set_object_terms( $post->ID, array( $partner_term_id ), $taxonomy_slug, true );
            //delete_post_meta( $post->ID, 'logo' );
            $sync_count++;
            if( function_exists( 'update_field' ) ) {
              update_field( 'field_54735ab1383f6', $partner_bookmark->link_url, "{$taxonomy_slug}_{$partner_term_id}" );
            }
          }else{
            $not_found[] = $bookmark_id;
          }
        }
      }
      if($not_found) {
        $not_found_count = count( $not_found );
        $message .= "We tried to process not-found links {$not_found_count} times\n<br />";
        $not_found = array_unique($not_found);
        foreach( $not_found as $not_found_id ) {
          $message .= "No link found with ID ${not_found_id}\n<br />";
        }
      }
      $cur = get_option( 'hech_bookmarks_to_delete' );
      if( is_array( $cur ) ) {
        $bookmarks_to_delete = array_merge( $cur, $bookmarks_to_delete );
      }
      update_option( 'hech_bookmarks_to_delete', $bookmarks_to_delete );
      //must run this after the above loop or bookmarks will get prematurely deleted
      /*foreach( $bookmarks_to_delete as $bookmark_id ) {
        wp_delete_link( $bookmark_id );
      }*/
    }
    $message .= "Migrated $sync_count bookmarks to the $taxonomy_slug taxonomy";
    return $message;
  }

  //you can call this directly, or just hit any admin page
  //like /wp-admin/?hech_sync_to=special-report&hech_sync_from=category
  public static function sync_categories( $to = 'special-report', $from = 'category' ) {
    $message = '';
    if( !taxonomy_exists( $to ) ) {
      $message .= 'Whoops! You specified a taxonomy that doesn\'t exist in the database.' . "\n<br />";
      $message .= 'Please create the taxonomy you want to convert to and rerun this script.';
      return $message;
    }
    if( !taxonomy_exists( $from ) ) {
      $message .= 'Whoops! You specified a taxonomy that doesn\'t exist in the database.' . "\n<br />";
      $message .= 'Please create the taxonomy you want to convert from and rerun this script.';
      return $message;
    }

    if( !file_exists( __DIR__ . "/content-import/$to.txt" ) ) {
      $message .= 'Import File is missing!';
      return $message;
    }

    $import_file = file_get_contents( __DIR__ . "/content-import/$to.txt" );

    //put it in an array - new line = new term
    $from_names = explode("\n", $import_file);

    if( !$from_names || !is_array($from_names) ) {
      $message .= 'Whoops! The file import failed :(. Please ensure that  ' . __DIR__;
      $message .= '/content-import/' . $to . '.txt exists and try again';
      return $message;
    }

    $file_terms_count = count($from_names);
    $message .= "Found $file_terms_count $from terms in the imported file ($to.txt).\n<br />";

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
          $message .= "Inserted {$from_term->name} into the $to taxonomy.\n<br />";
        }
        $from_term->matching_term_id = (int)$to_term['term_id'];
        $from_terms[(int)$from_term->term_id] = $from_term;
      }else{
        $errors[] = "Couldn't associate $from_name with a $from from the database.\n<br />";
        wp_insert_term( $from_name, $to );
      }
    }

    $db_terms_count = count($from_terms);
    $message .= "Associated $db_terms_count $from terms from the imported file to $from terms in the database.\n<br />";

    if( $errors ) {
      $message .= implode("\n<br />", $errors);
      $errors = array();
    }

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'nopaging' => true,
        'category__in' => array_keys( $from_terms )
    );

    $matching_posts = get_posts( $args );
    $posts_count = count($matching_posts);
    $message .= "Retrieved $posts_count posts with terms from the imported $from file.\n<br />";

    $added_terms = array();
    //loop over the terms
    //built this way (terms -> posts) because has_term is cached
    //if we looped over posts then terms, we'd forgo the benefit of that caching
    //since we'd only hit each post once
    foreach( $from_terms as $from_term ){
      //loop over all posts
      foreach($matching_posts as $post ) {
        //check if the current post has the "from" term, but NOT the "to" term
        if( has_term( $from_term->term_id, $from, $post->ID ) && !has_term( $from_term->slug, $to, $post->ID ) ) {
          //if it does, migrate it to the new taxonomy
          //make sure to append the term to existing terms, not replace
          $added_term = wp_set_post_terms( $post->ID, array( $from_term->matching_term_id ), $to, $append = true);
          if( $added_term && !is_wp_error( $added_term ) ) {
            //harmless logger
            $added_terms[] = array( 'post' => $post->ID, 'from' => $from_term->term_id, 'to' => $from_term->matching_term_id );
            //remove the term from the "from" taxonomy
            wp_remove_object_terms( $post->ID, $from_term->term_id, $from );
          }else{
            $errors[] = "Failed to add {$from_term->name} to {$post->post_title}.";
          }
        }
      }
      wp_delete_term( $from_term->term_id, $from );
    }
    $added_terms_count = count($added_terms);
    $message .= "Synced $added_terms_count terms from $posts_count posts";

    if( $errors ) {
      $message .= implode("\n<br />", $errors);
      $errors = array();
    }

    return $message;

  }

}