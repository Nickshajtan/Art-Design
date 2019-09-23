<?php
/**
 * yp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package yp
 */

if ( ! function_exists( 'yp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function yp_setup() {

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
        //Menus
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Меню в шапке' ),
			'menu-2' => esc_html__( 'Меню в подвале'),
		) );
        if (has_nav_menu('menu-1')){
            add_filter( 'nav_menu_css_class', 'nav_css_filter', 10, 4 );
            function nav_css_filter( $classes, $item, $args, $depth ){
                if( $args->theme_location === 'menu-1' ){
                   $classes[] = 'h-100 d-flex align-items-center'; 
                }
                return $classes;
            }
            add_filter( 'nav_menu_link_attributes', 'nav_link_filter', 10, 4 );
            function nav_link_filter( $atts, $item, $args, $depth ){
                if( $args->theme_location === 'menu-1' ){
                    $atts['class'] = 'h-100 d-flex justify-content-center w-100 flex-column';
                }
                return $atts;
            }
        }
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
        
        //Add custom logo
        add_theme_support( 'custom-logo', array(
            'height'      => 50,
            'width'       => 250,
            'flex-height' => false,
            'flex-width'  => false,
            'header-text' => '',
        ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );


	}
endif;
add_action( 'after_setup_theme', 'yp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function yp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'yp_content_width', 640 );
}
add_action( 'after_setup_theme', 'yp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function yp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'yp' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'yp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'yp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function include_styles() {
    /*** If CDN available ***/
    $url = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css';
    $response = wp_remote_get($url);
    $code = wp_remote_retrieve_response_code( $response );
    $b4 = carbon_get_theme_option('b4');
    if( $b4 ){
        if ( !is_wp_error( $response ) ){
            if( isset( $url ) && !empty( $url) && ( $code == '200') ){
                wp_register_style( 'bootstrap', $url, array(), ' ' );
                wp_enqueue_style( 'bootstrap' );
                wp_register_style( 'main', get_template_directory_uri() . '/app/css/main.min.css', array(), ' ' );
                wp_enqueue_style( 'main' );
            }
            else{
                wp_register_style( 'bootstrap', get_template_directory_uri() . '/app/libs/bootstrap/bootstrap.min.css', array(), ' ' );
                wp_enqueue_style( 'bootstrap' );
                wp_register_style( 'main', get_template_directory_uri() . '/app/css/mine.min.css', array(), ' ' );
                wp_enqueue_style( 'main' );
            }
        }
        /*** Else ***/
        else{
            wp_register_style( 'bootstrap', get_template_directory_uri() . '/app/libs/bootstrap/bootstrap.min.css', array(), ' ' );
            wp_enqueue_style( 'bootstrap' );
            wp_register_style( 'main', get_template_directory_uri() . '/app/css/mine.min.css', array(), ' ' );
            wp_enqueue_style( 'main' );
        }
    }
    $slick = carbon_get_theme_option('slick');
    if( ( is_home() || is_front_page() || is_single() ) && $slick ){
        wp_register_style( 'slick',  get_template_directory_uri() . '/app/libs/jquery/slick/slick.css', array(), ' ' );
        wp_enqueue_style( 'slick');
        wp_register_style( 'slick-theme',  get_template_directory_uri() . '/app/libs/jquery/slick/slick-theme.css', array(), ' ' );
        wp_enqueue_style( 'slick-theme');
    }
    wp_register_style( 'fonts',  get_template_directory_uri() . '/app/fonts/fonts.css', array(), ' ' );
    wp_enqueue_style( 'fonts');
    $fancybox = carbon_get_theme_option('fancybox');
    if( ( is_home() || is_front_page() || is_single() ) && $fancybox ){
        wp_register_style( 'fancybox',  get_template_directory_uri() . '/app/libs/jquery/fancybox/fancybox.min.css', array(), ' ' );
        wp_enqueue_style( 'fancybox');
    }
	wp_register_style( 'style', get_stylesheet_uri(), array(), ' ' );
	wp_enqueue_style( 'style');
    if( is_rtl() ){
        wp_register_style( 'mine-rtl',  get_template_directory_uri() . '/app/css/main-rtl.min.css', array(), ' ' );
        wp_enqueue_style( 'mine-rtl');
        wp_register_style( 'main-rtl',  get_template_directory_uri() . '/app/css/mine-rtl.min.css', array(), ' ' );
        wp_enqueue_style( 'main-rtl');
    }
}
add_action( 'wp_enqueue_scripts', 'include_styles' );

function include_scripts() {
    /*** If CDN available ***/
    $url = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js';
    $response = wp_remote_get( $url );
    $code = wp_remote_retrieve_response_code( $response );
    if ( !is_wp_error( $response ) ){
        if( isset( $url ) && !empty( $url) && ( $code == '200') ){
            wp_deregister_script( 'jquery-core' );
	        wp_register_script( 'jquery-core', $url ,array(), null, true);
	        wp_enqueue_script( 'jquery' );
            wp_register_script( 'scripts', get_template_directory_uri() . '/app/js/custom.min.js', array(), null, true);
	        wp_enqueue_script( 'scripts');
        }
        else{
            wp_deregister_script( 'jquery-core' );
            wp_register_script( 'scripts', get_template_directory_uri() . '/app/js/scripts.min.js', array(), null, true);
	        wp_enqueue_script( 'scripts');
        }	
    }
    else{
            wp_deregister_script( 'jquery-core' );
            wp_register_script( 'scripts', get_template_directory_uri() . '/app/js/scripts.min.js', array(), null, true);
	        wp_enqueue_script( 'scripts');
    }	
    /** Other **/
    $slick = carbon_get_theme_option('slick');
    if(( is_home() || is_front_page() || is_single() ) && $slick ){
            wp_register_script( 'slick', get_template_directory_uri() . '/app/libs/jquery/slick/slick.js', array(), null, true);
	        wp_enqueue_script( 'slick');
    }
    $masonry = carbon_get_theme_option('masonry');
    if( ( is_home() || is_front_page() ) && $masonry ){
            wp_register_script( 'my_masonry', get_template_directory_uri() . '/app/libs/jquery/masonry.min.js', array(), null, true);
	        wp_enqueue_script( 'my_masonry');
    }
    $fancybox = carbon_get_theme_option('fancybox');
    if( ( is_home() || is_front_page() || is_single() || is_page() ) && $fancybox ){
            wp_register_script( 'my_fancybox', get_template_directory_uri() . '/app/libs/jquery/fancybox/fancybox.min.js', array(), null, true);
	        wp_enqueue_script( 'my_fancybox');
    }
    $ais = carbon_get_theme_option('ais');
    if( ( is_home() || is_category() || is_archive() || is_tax() ) && $ais ){
            wp_register_script( 'ais', get_template_directory_uri() . '/app/libs/jquery/ais.js', array(), null, true);
	        wp_enqueue_script( 'ais');
    }
    else{
            wp_register_script( 'my-ajax', get_template_directory_uri() . '/app/js/ajax.js', array(), null, true);
	        wp_enqueue_script( 'my-ajax');
    }
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'include_scripts' );
    
/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/basic-functions.php';
require get_template_directory() . '/inc/template-functions.php';

/**
 * Functions for download required plugins.
 */
require get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php';

require get_template_directory() . '/inc/plugins/plugins.php';
