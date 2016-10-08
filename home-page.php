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

	<div id="primary" class="content-area">
		<div class="home-banner">



		</div>



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

<?php
get_footer();
