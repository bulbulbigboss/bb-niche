<?php
/**
 * BB Niche functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BB_Niche
 */

if ( ! function_exists( 'bb_niche_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bb_niche_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on BB Niche, use a find and replace
	 * to change 'bb-niche' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'bb-niche',  get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'bb-niche' ),
		'footer' => esc_html__( 'footer', 'bb-niche' ),
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
	add_theme_support( 'custom-background', apply_filters( 'bb_niche_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'bb_niche_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bb_niche_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bb_niche_content_width', 640 );
}
add_action( 'after_setup_theme', 'bb_niche_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bb_niche_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'bb-niche' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bb-niche' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


	register_sidebar( array(
		'name'          => esc_html__( 'Home page sidebar one ', 'bb-niche' ),
		'id'            => 'home-sidebar-1',
		'description'   => esc_html__( 'Sidebar after home page content area. ', 'bb-niche' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


	register_sidebar( array(
		'name'          => esc_html__( 'Home page sidebar Two ', 'bb-niche' ),
		'id'            => 'homepage-side-2',
		'description'   => esc_html__( 'Sidebar after home page content area. ', 'bb-niche' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'bb_niche_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bb_niche_scripts() {
	wp_enqueue_style( 'bb-niche-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bb-niche-responsive', get_template_directory_uri().'/layouts/css/responsive.css' );


	wp_enqueue_script( 'bb-niche-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'bb-niche-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bb_niche_scripts' );

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

function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'bb-niche') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

// Breadcrumbs
function custom_breadcrumbs() {

	// Settings
	$separator          = '&gt;';
	$breadcrums_id      = 'breadcrumbs';
	$breadcrums_class   = 'breadcrumbs';
	$home_title         = 'Homepage';

	// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
	$custom_taxonomy    = 'product_cat';

	// Get the query & post information
	global $post,$wp_query;

	// Do not display on the homepage
	if ( !is_front_page() ) {

		// Build the breadcrums
		echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

		// Home page
		echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
		echo '<li class="separator separator-home"> ' . $separator . ' </li>';

		if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {

			echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix , false) . '</strong></li>';

		} else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

			// If post is a custom post type
			$post_type = get_post_type();

			// If it is a custom post type display name and link
			if($post_type != 'post') {

				$post_type_object = get_post_type_object($post_type);
				$post_type_archive = get_post_type_archive_link($post_type);

				echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
				echo '<li class="separator"> ' . $separator . ' </li>';

			}

			$custom_tax_name = get_queried_object()->name;
			echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';

		} else if ( is_single() ) {

			// If post is a custom post type
			$post_type = get_post_type();

			// If it is a custom post type display name and link
			if($post_type != 'post') {

				$post_type_object = get_post_type_object($post_type);
				$post_type_archive = get_post_type_archive_link($post_type);

				echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
				echo '<li class="separator"> ' . $separator . ' </li>';

			}

			// Get post category info
			$category = get_the_category();

			if(!empty($category)) {

				// Get last category post is in
				$last_category = end(array_values($category));

				// Get parent any categories and create array
				$get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
				$cat_parents = explode(',',$get_cat_parents);

				// Loop through parent categories and store in variable $cat_display
				$cat_display = '';
				foreach($cat_parents as $parents) {
					$cat_display .= '<li class="item-cat">'.$parents.'</li>';
					$cat_display .= '<li class="separator"> ' . $separator . ' </li>';
				}

			}

			// If it's a custom post type within a custom taxonomy
			$taxonomy_exists = taxonomy_exists($custom_taxonomy);
			if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

				$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
				$cat_id         = $taxonomy_terms[0]->term_id;
				$cat_nicename   = $taxonomy_terms[0]->slug;
				$cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
				$cat_name       = $taxonomy_terms[0]->name;

			}

			// Check if the post is in a category
			if(!empty($last_category)) {
				echo $cat_display;
				echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

				// Else if post is in a custom taxonomy
			} else if(!empty($cat_id)) {

				echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
				echo '<li class="separator"> ' . $separator . ' </li>';
				echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

			} else {

				echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

			}

		} else if ( is_category() ) {

			// Category page
			echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';

		} else if ( is_page() ) {

			// Standard page
			if( $post->post_parent ){

				// If child page, get parents
				$anc = get_post_ancestors( $post->ID );

				// Get parents in the right order
				$anc = array_reverse($anc);

				// Parent page loop
				if ( !isset( $parents ) ) $parents = null;
				foreach ( $anc as $ancestor ) {
					$parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
					$parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
				}

				// Display parent pages
				echo $parents;

				// Current page
				echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';

			} else {

				// Just display current page if not parents
				echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';

			}

		} else if ( is_tag() ) {

			// Tag page

			// Get tag information
			$term_id        = get_query_var('tag_id');
			$taxonomy       = 'post_tag';
			$args           = 'include=' . $term_id;
			$terms          = get_terms( $taxonomy, $args );
			$get_term_id    = $terms[0]->term_id;
			$get_term_slug  = $terms[0]->slug;
			$get_term_name  = $terms[0]->name;

			// Display the tag name
			echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';

		} elseif ( is_day() ) {

			// Day archive

			// Year link
			echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
			echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

			// Month link
			echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
			echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';

			// Day display
			echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';

		} else if ( is_month() ) {

			// Month Archive

			// Year link
			echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
			echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

			// Month display
			echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';

		} else if ( is_year() ) {

			// Display year archive
			echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';

		} else if ( is_author() ) {

			// Auhor archive

			// Get the author information
			global $author;
			$userdata = get_userdata( $author );

			// Display author name
			echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';

		} else if ( get_query_var('paged','bb-niche') ) {

			// Paginated archives
			echo '<li class="item-current item-current-' . get_query_var('paged','bb-niche') . '"><strong class="bread-current bread-current-' . get_query_var('paged','bb-niche') . '" title="Page ' . get_query_var('paged','bb-niche') . '">'.__('Page','bb-niche') . ' ' . get_query_var('paged','bb-niche') . '</strong></li>';

		} else if ( is_search() ) {

			// Search results page
			echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';

		} elseif ( is_404() ) {

			// 404 page
			echo '<li>' . 'Error 404' . '</li>';
		}

		echo '</ul>';

	}

}

get_template_part('widget');

add_editor_style();











