<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package BB_Niche
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Wow No! That page can&rsquo;t be found.', 'bb-niche' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">

					<div class="error-area-content">
					<p><?php esc_html_e( 'Searching May help you ti find your desire content', 'bb-niche' ); ?></p>

						<?php get_search_form(); ?>

						<p><a href="<?php echo esc_url(home_url()); ?>">Go back to Home page</a></p>

					</div>




				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
