<?php

if ( !class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . admin_url( 'plugins.php#timber' ) . '">' . admin_url( 'plugins.php' ) . '</a></p></div>';
		} );
	return;
}

Timber::$dirname = array( 'templates', 'views' );
require_once('wp/hechinger-post.php');
require_once('wp/hechinger-image.php');
require_once('wp/pull-quote-admin.php');

new PullQuoteAdmin();

add_theme_support( 'post-formats', array( 'article', 'column', 'opinion' ) );
add_filter('acf/location/rule_match/page', function($thing, $rule, $current){
	$pid = $rule['value'];
	if ($pid == 18113) {
		$post = new TimberPost($current['post_id']);
		if ($post->slug == 'home') {
			return true;
		}
	}
}, 10, 3);

class HechingerSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
        $this->set_shortcodes();
		parent::__construct();
		$this->bootstap_content();
	}

	function bootstap_content() {
		if ( class_exists( 'Mesh' ) ) {
			$article = new Mesh\Post( 'article', 'page' );
                        $article = new Mesh\Post( 'archive', 'page' );
			$article = new Mesh\Post( 'special-report', 'page' );
			$article = new Mesh\Post( 'special-reports-landing', 'page' );
			$article = new Mesh\Post( 'author', 'page' );
			$article = new Mesh\Post( 'snippets', 'page' );
			$article = new Mesh\Post( 'home', 'page' );
			$streamm = new Mesh\Post( 'homepage', 'sm_stream' );
		}
        }

        function register_post_types() {
          // this is where you can register custom post types
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
			'rewrite'               => array( 'slug' => 'special-topics' ),
		);
		register_taxonomy( 'special-topic', 'post', $args );
		//this is where you can register custom taxonomies

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

        function set_shortcodes() {
                add_filter( 'img_caption_shortcode', array($this, 'handle_img_in_editor'), 10, 3);
                add_filter( 'image_send_to_editor', function($html, $id, $caption, $title, $align, $url, $size, $alt ) {
                        $attr['id'] = 'attachment_'.$id;
                        $attr['align'] = 'align'.$align;
                        $attr['caption'] = $caption;
                        if ($id) {
                                $image = new HechingerImage($id);
                                if (isset($image->sizes[$size])) {
                                        $my_size = $image->sizes[$size];
                                } else {
                                        $my_size = array_pop($image->sizes);
                                }
                                $attr['width'] = $my_size['width'];
                                $attr['height'] = $my_size['height'];
                        }
                        return $this->handle_img_in_editor($html, $attr, '');
                }, 10, 8);
        }

        function handle_img_in_editor($output, $attr, $content) {
            if ( $attr['id'] ) {
                $iid = str_replace( 'attachment_', '', $attr['id'] );
                $image = new TimberImage( $iid );
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

    static function render_pull_quote($content, $style, $author, $desc) {
        $args = array(
            'style_class' => $style,
            'author' => $author,
            'description' => $desc,
            'pull_quote' => $content
        );
        return Timber::compile('templates/components/article-pull-quote.twig', $args);
    }
}

new HechingerSite();
