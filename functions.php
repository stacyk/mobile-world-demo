<?php
/**
 * wpdemo functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wpdemo
 */

if ( ! function_exists( 'wpdemo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wpdemo_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wpdemo, use a find and replace
	 * to change 'wpdemo' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wpdemo', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary Menu', 'wpdemo' ),
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
	add_theme_support( 'custom-background', apply_filters( 'wpdemo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add styles to the post editor
	add_editor_style( array( 'editor-style.css', wpdemo_font_url() ) );

	/**
	 * Enable support and set configuration options for
	 * WDS Simple Page Builder.
	 */
	if ( class_exists( 'WDS_Simple_Page_Builder' ) && version_compare( WDS_Simple_Page_Builder::VERSION, '1.6', '>=' ) ) {

		// Add theme support
		add_theme_support( 'wds-simple-page-builder' );

		// Define options
		wds_page_builder_theme_support( array(
			'hide_options'    => 'disabled', // set to true to hide them completely
			'parts_dir'       => 'pagebuilder',
			'parts_prefix'    => 'part',
			'use_wrap'        => 'on', // on is TRUE
			'container'       => 'section',
			'container_class' => 'pagebuilder-part', // can use multiple classes, separated by a space
			'post_types'      => array( 'page', ), // Add any other supported post types here
		) );

		// Define areas
		$page_builder_areas = array(
			'hero'           => array( 'name' => esc_html__( 'Hero Area', 'wpdemo' ), ),
			'before_content' => array( 'name' => esc_html__( 'Before Content Area', 'wpdemo' ), ),
			'after_content'  => array( 'name' => esc_html__( 'After Content Area', 'wpdemo' ), ),
		);

		// Loop through and register each area
		foreach ( $page_builder_areas as $page_builder_area_slug => $page_builder_area ) {
			register_page_builder_area( $page_builder_area_slug, $page_builder_area );
		}
	}
}
endif; // wpdemo_setup
add_action( 'after_setup_theme', 'wpdemo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wpdemo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wpdemo_content_width', 640 );
}
add_action( 'after_setup_theme', 'wpdemo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wpdemo_widgets_init() {

	// Define sidebars
	$sidebars = array(
		'sidebar-1'  => esc_html__( 'Sidebar 1', 'wpdemo' ),
	//	'sidebar-2'  => esc_html__( 'Sidebar 2', 'wpdemo' ),
	//	'sidebar-3'  => esc_html__( 'Sidebar 3', 'wpdemo' ),
	);

	// Loop through each sidebar and register
	foreach ( $sidebars as $sidebar_id => $sidebar_name ) {
		register_sidebar( array(
			'name'          => $sidebar_name,
			'id'            => $sidebar_id,
			'description'   => sprintf ( esc_html__( 'Widget area for %s', 'wpdemo' ), $sidebar_name ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

}
add_action( 'widgets_init', 'wpdemo_widgets_init' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load styles and scripts
 */
require get_template_directory() . '/inc/scripts.php';
