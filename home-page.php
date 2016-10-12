<?php
/**
 * Template name: Home page template
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BB_Niche
 */

get_header(); ?>

	<div class="home-page-banner">
		<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />


	</div>


<div class="home-page-main-content-area">

	<div id="primary" class="content-area">




		<main id="main" class="home-page-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/home-content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->





	</div><!-- #primary -->

	<div class="home-sidebar-area">
			<div class="home-sidebar-content-area">

				<div class="widget-home-box-one">



					<?php dynamic_sidebar('home-sidebar-1');?>

				</div>

				<div class="widget-home-box-two">



					<?php  dynamic_sidebar('homepage-side-2');?>

				</div>






			</div>

	</div><!-- home page sidebar area end -->

</div><!-- end home page content area here -->

<?php
get_footer();
