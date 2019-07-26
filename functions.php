<?php
/**
 * Superminimal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Superminimal
 */

if ( ! function_exists( 'spr_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function spr_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Superminimal, use a find and replace
		 * to change 'spr' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'spr', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'spr' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'spr_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'spr_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function spr_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'spr_content_width', 640 );
}
add_action( 'after_setup_theme', 'spr_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function spr_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'spr' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'spr' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'spr_widgets_init' );

/**
 * Enqueue Parent Theme scripts and styles.
 */
function spr_scripts() {
	wp_enqueue_style( 'spr-style', get_template_directory_uri() . '/style.min.css' );

	wp_enqueue_script( 'spr-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'spr-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Causes stripe error! 
	//	wp_enqueue_script( 'spr-jquery', get_template_directory_uri() . '/js/jquery-3.2.1.min.js', array(), '20151215', true );

	wp_enqueue_script( 'spr-bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array(), '20151215', true );
	wp_enqueue_style( 'spr-bootstrap-css', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css' );

	wp_enqueue_style('spr-fontello-icons', get_template_directory_uri() . "/assets/fontello/css/fontello.css");

	// ScrollReveal
	wp_enqueue_script( 'scrollreveal-js', get_template_directory_uri() . '/js/scrollreveal.min.js', array(), '20171013', true );	

	// ZenScroll smooth scrolling to any link on the same page
	wp_enqueue_script( 'zenscroll-js', get_template_directory_uri() . '/js/zenscroll-min.js', array(), '20170312', true );	

	// custom theme JS
	wp_enqueue_script( 'spr-custom-js', get_template_directory_uri() . '/js/superminimal.js', array(), '20180227', true );

	// Custom parent theme styles
	wp_enqueue_style( 'spr-custom-style', get_template_directory_uri() . '/custom.min.css' );	

}
// IMPORTANT: To load CHILD THEME custom styles and scripts, give priority greater than 10!! 
add_action( 'wp_enqueue_scripts', 'spr_scripts', 10);


/**
 * Register Custom Navigation Walker
 * https://github.com/dupkey/bs4navwalker
 */
require_once get_template_directory() . '/inc/bs4navwalker.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

// Our own custom template tags (not _s)
require get_template_directory() . '/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Add theme support for excerpts.
 */
add_post_type_support( 'page', 'excerpt' );


add_filter( 'body_class', 'spr_body_class_for_pages' );
/**
 * Adds a css class to the body element
 *
 * @param  array $classes the current body classes
 * @return array $classes modified classes
 */
if ( ! function_exists( 'spr_body_class_for_pages' ) ) {
	function spr_body_class_for_pages( $classes ) {
		if ( is_singular( 'page' ) ) {
			global $post;
			$classes[] = $post->post_name;
		}
		if ( class_exists( 'woocommerce' ) ) {
			global $woocommerce;
			if( WC()->cart->cart_contents_count > 0 ){
				$classes[]='items-in-cart';
			} else {
				$classes[]='cart-empty';
			}	
		}				
		return $classes;
	}
}