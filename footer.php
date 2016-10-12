<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BB_Niche
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="footer-content">

			<div class="footer-nav">

				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'footer-nav' ) ); ?>
			</div>


		<div class="site-info">

			<?php if( get_theme_mod( 'footer_text_block') != "" ): ?>

				<?php echo get_theme_mod( 'footer_text_block'); ?>


			<?php else : ?>

				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bb-niche' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'bb-niche' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php $authorbb ="" ; printf( esc_html__( 'Theme: %1$s by %2$s.', 'bb-niche' ), 'bb-niche', '<a href="" rel="designer">bulbul bigboss</a>' ); ?>
			<?php endif ?>



		</div><!-- .site-info -->




		</div>





	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
