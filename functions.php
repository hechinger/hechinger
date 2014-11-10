<?php

if ( !class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . admin_url( 'plugins.php#timber' ) . '">' . admin_url( 'plugins.php' ) . '</a></p></div>';
		} );
	return;
}

Timber::$dirname = array( 'templates', 'views' );

class HechingerSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
		$this->bootstap_content();
	}

	function bootstap_content() {
		if ( class_exists( 'Mesh' ) ) {
			$article = new Mesh\Post( 'article', 'page' );
			$article = new Mesh\Post( 'Special Reports', 'page' );
			$article = new Mesh\Post( 'About Fred Hechinger', 'page' );
		}
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		$labels = array(
			'name'                       => _x( 'Special Topics', 'taxonomy general name' ),
			'singular_name'              => _x( 'Special Topic', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Special Topics' ),
			'popular_items'              => __( 'Popular Special Topics' ),
			'all_items'                  => __( 'All Special Topics' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Special Topic' ),
			'update_item'                => __( 'Update Special Topic' ),
			'add_new_item'               => __( 'Add New Special Topic' ),
			'new_item_name'              => __( 'New Special Topic Name' ),
			'separate_items_with_commas' => __( 'Separate Special Topics with commas' ),
			'add_or_remove_items'        => __( 'Add or remove Special Topics' ),
			'choose_from_most_used'      => __( 'Choose from the most used Special Topics' ),
			'not_found'                  => __( 'No Special Topics found.' ),
			'menu_name'                  => __( 'Special Topics' ),
		);

		$args = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'speical-topics' ),
		);
		register_taxonomy( 'special-topic', 'post', $args );
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$context['foo'] = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['menu'] = new TimberMenu();
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

}

new HechingerSite();
