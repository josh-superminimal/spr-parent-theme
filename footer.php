<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Superminimal
 */

?>


			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
	
	</footer><!-- #colophon -->
	<div class="site-info socket">
		&copy; <?= date('Y') ?> <a href="<?= get_site_url() ?>"><?php bloginfo( 'name' ); ?></a> <span class="sep">/</span>  Site by <a href="https://superminimal.com.au" target="_blank" rel="noopener norefferrer">Super Minimal</a>
	</div><!-- .site-info -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
