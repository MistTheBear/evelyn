<?php
/**
 * Evelyn functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Evelyn
 */

define('ACF_EARLY_ACCESS', '5');

if ( ! function_exists( 'evelyn_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function evelyn_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Evelyn, use a find and replace
		 * to change 'evelyn' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'evelyn', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Header', 'evelyn' ),
			'footer-1' => esc_html__( 'Footer 1', 'evelyn' ),
			'footer-2' => esc_html__( 'Footer 2', 'evelyn' ),
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
		add_theme_support( 'custom-background', apply_filters( 'evelyn_custom_background_args', array(
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
			'height'      => 80,
			'width'       => 160,
			'flex-width'  => true,
			'flex-height' => false,
		) );
		
		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		/* Add support for Gutenberg wide alignments */
		add_theme_support( 'align-wide' );

		/* Add support for Gutenberg color palette */
		add_theme_support( 'editor-color-palette',
			array(
				'name' => esc_html__( 'Evelyn Red', 'evelyn' ),
				'color' => '#e54d38',
			),
			array(
				'name' => esc_html__( 'Soft Red', 'evelyn' ),
				'color' => '#f2a496',
			),
			array(
				'name' => esc_html__( 'Light Red', 'evelyn' ),
				'color' => '#fad1ca',
			),
			array(
				'name' => esc_html__( 'Dark Grey', 'evelyn' ),
				'color' => '#282729',
			),
			array(
				'name' => esc_html__( 'Evelyn Grey', 'evelyn' ),
				'color' => '#7b7a7f',
			),
			array(
				'name' => esc_html__( 'Light Grey', 'evelyn' ),
				'color' => '#ededed',
			),
			array(
				'name' => esc_html__( 'White', 'evelyn' ),
				'color' => '#ffffff',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'evelyn_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function evelyn_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'evelyn_content_width', 720 );
}
add_action( 'after_setup_theme', 'evelyn_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function evelyn_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'evelyn' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'evelyn' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'evelyn' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add up to 2 widgets here.', 'evelyn' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s col-sm-6 col-lg-3 l-grid--item">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'evelyn_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function evelyn_scripts() {
	wp_enqueue_style( 'evelyn-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:500,600,700|Nunito:400,400i,700', false );

	wp_enqueue_style( 'evelyn-material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', false );
	
	wp_enqueue_style( 'evelyn-style', get_stylesheet_uri() );

	//wp_enqueue_script( 'evelyn-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	//wp_enqueue_script( 'evelyn-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	
	// wp_enqueue_script('jquery') ;

	if ( ! file_exists( get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php' ) ) {
		// file does not exist... return an error.
		return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'evelyn' ) );
	} else {
		// file exists... require it.
		require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
	}


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'evelyn_scripts' );

/**
 * Enqueue WordPress theme styles within Gutenberg.
 */
function evelyn_gutenberg_styles() {
	// Load the theme styles within Gutenberg.
	 wp_enqueue_style( 'evelyn-gutenberg', get_theme_file_uri( '/gutenberg-editor-style.css' ), false );
}
add_action( 'enqueue_block_editor_assets', 'evelyn_gutenberg_styles' );


/**
 * Add preconnect for Google Fonts.
 *
 * @since Evelyn 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function evelyn_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'evelyn-google-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'evelyn_resource_hints', 10, 2 );



/**
 * Add custom shortcodes to load in predefined templates.
 */
function display_projects_shortcode($atts = [], $content = null)
{
    ob_start(); 
		get_template_part('template-parts/query/projects');
		$new_content = ob_get_clean();  
		if( !empty( $new_content ) )
			$content = $new_content;
		return $content;
}
add_shortcode('display-projects', 'display_projects_shortcode');

function display_support_us_shortcode($atts = [], $content = null)
{
	// normalize attribute keys, lowercase
	$atts = array_change_key_case((array)$atts, CASE_LOWER);	

	// override default attributes with user attributes
    $display_support_us_atts = shortcode_atts([
			'pagename' => 'support-us',
			'num_to_show' => -1,
			'columns' => 2,
			'more_info_page' => 0,
			'full_post' => 0,
		], $atts);
																 
		$show_n = $display_support_us_atts['num_to_show'];
		$page = get_page_by_path($display_support_us_atts['pagename']);
		$columns = $display_support_us_atts['columns'];
		$more_info_page = $display_support_us_atts['more_info_page'];
		$show_full_post = $display_support_us_atts['full_post'];
		if ($page) {
			$support_page_ID = $page->ID;
			ob_start(); 
			include(locate_template('template-parts/query/support-us.php'));
			$new_content = ob_get_clean();  
			if( !empty( $new_content ) )
				$content = $new_content;
		} else {
			return $content;
		}
		return $content;
}
add_shortcode('display-support-us', 'display_support_us_shortcode');

function display_people_shortcode($atts = [], $content = null)
{
	// normalize attribute keys, lowercase
	$atts = array_change_key_case((array)$atts, CASE_LOWER);	

	// override default attributes with user attributes
    $display_people_atts = shortcode_atts([
			'num_to_show' => -1,
			'role' => 'staff',
		], $atts);
		
		$show_n = $display_people_atts['num_to_show'];
		$people_role = $display_people_atts['role'];
		ob_start(); 
		get_template_part('template-parts/query/people.php');
		$new_content = ob_get_clean();  
		if( !empty( $new_content ) )
			$content = $new_content;
		return $content;
}
add_shortcode('display-people', 'display_people_shortcode');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

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

