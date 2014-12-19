<?php

if ( !class_exists( 'Timber' ) ) {
  add_action( 'admin_notices', function() {
      echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . admin_url( 'plugins.php#timber' ) . '">' . admin_url( 'plugins.php' ) . '</a></p></div>';
    } );
  return;
}

Timber::$dirname = array( 'templates', 'views' );

require_once('wp/acf-hacks.php');
require_once('wp/hechinger-post.php');
require_once('wp/hechinger-term.php');
require_once('wp/hechinger-image.php');
require_once('wp/hechinger-user.php');
require_once('wp/hechinger-home.php');
require_once('wp/pull-quote-admin.php');
require_once('wp/aside-admin.php');
require_once('wp/hechinger-admin-related.php');

new PullQuoteAdmin();
new AsideAdmin();
new HechingerAdminRelated();

ACFHacks::map_page_rule_to_slug(18113, 'home');
ACFHacks::map_page_rule_to_slug(17996, 'about');

if (class_exists('Jigsaw')) {
  Jigsaw::add_css('static/css/hechinger-admin.css');
}

class HechingerSite extends TimberSite {

  function __construct() {

    add_theme_support( 'post-formats', array( 'article', 'column', 'opinion' ) );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    add_action( 'init', array( $this, 'add_reports' ) );
    add_action( 'init', array( $this, 'register_menus' ) );
    add_filter( 'acf/load_field/key=field_5492eb43d3984', array($this, 'set_primary_special_report'), 2, 2 );
    add_filter( 'coauthors_edit_author_cap', function(){ return 'read'; } );

    $this->set_shortcodes();
    $this->set_routes();
    parent::__construct();
    $this->bootstap_content();
    $this->fix_custom_field_conflict();
  }

  function fix_custom_field_conflict() {
    global $wpdb;
    $wpdb->query("DELETE FROM wp_postmeta WHERE meta_key = '_wp_page_template'");
  }

  function bootstap_content() {
    if ( class_exists( 'Mesh' ) ) {
      //$article = new Mesh\Post( 'special-report', 'page' );
      //$article = new Mesh\Post( 'special-reports-landing', 'page' );
      //$article = new Mesh\Post( 'author', 'page' );
      //$article = new Mesh\Post( 'snippets', 'page' );
      //$article = new Mesh\Post( 'home', 'page' );
      //$streamm = new Mesh\Post( 'homepage', 'sm_stream' );
    }
  }

  protected function set_routes(){

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
            'description'=> $report['name'] . ' is the place you want to be.',
            'slug' => $report['slug'],
            'parent'=> $parent_term_id
          )
        );
      }
    }
  }

  function set_shortcodes() {
    // This actually runs the shortcode. It is good
    add_filter( 'img_caption_shortcode', array($this, 'handle_img_in_editor'), 10, 3);
    add_filter( 'image_send_to_editor', function($html, $id, $caption, $title, $align, $url, $size, $alt ) {
      if (!$caption) {
        $caption = '<span class="placeholder-caption" style="display:none;"> &nbsp; </span>';
        preg_match( '/width=["\']([0-9]+)/', $html, $matches );
        $width = $matches[1];
        $shcode = '[caption id="' . $id . '" align="align' . $align . '" width="' . $width . '"]' . $html . ' ' . $caption . '[/caption]';
        return $shcode;
      }
      return $html;
    }, 10, 8);
  }

  function handle_img_in_editor($output, $attr, $content) {
    if ( isset($attr['id']) && $attr['id'] ) {
      $iid = str_replace( 'attachment_', '', $attr['id'] );
      if (isset($iid) && strlen($iid)) {
        $image = new HechingerImage( $iid );
      }
      if (!isset($attr['align'])){
        $attr['align'] = 'aligncenter';
      }
      $class = $attr['align'] . ' inline-core-image';
      $width = $attr['width'];
      if ( $attr['align'] == 'alignnone' || $attr['align'] == 'aligncenter') {
        $attr['full_width'] = true;
      }
      $image_string = Timber::compile( 'templates/components/article-core-img.twig', array( 'image' => $image, 'class' => $class, 'width' => $width, 'attr' => $attr ) );
      return preg_replace('/\s+/', ' ', $image_string);
    }
    return $output;
  }

  public static function render_related_tease($id, $headline = null) {
    $link = $id;
    if (is_numeric($id)) {
      $post = new HechingerPost($id);
      $link = $post->link();
    }
    if ($headline == null && isset($post)) {
      $headline = $post->title();
    }
    $data = array('link' => $link, 'headline' => $headline);
    return Timber::compile('templates/components/article-text-related.twig', $data);

  }

  static function render_pull_quote($content, $style, $author, $desc) {
    $args = array(
      'style_class' => $style,
      'author' => $author,
      'description' => $desc,
      'pull_quote' => $content
    );
    return Timber::compile('templates/components/article-pull-quote.twig', $args);
  }

  static function render_aside($notes, $id, $aside) {
    $args = array(
      'notes' => $notes,
      'id' => $id,
      'aside' => $aside
    );
    return Timber::compile('templates/components/article-aside.twig', $args);
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

new HechingerSite();
