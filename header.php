<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Superminimal
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'spr' ); ?></a>


	<section id="top-bar" class="py-0 px-lg-4 d-flex align-items-center">
		<div class="container-fluid">
			<div class="row">
			<!-- justify-content-md-end -->
				<div class="d-flex col-5 justify-content-start align-items-center">
				<?php spr_do_link( '(08) 9485 0801', 'tel:+61 8 9485 0801', false ) ?></div>
				<div class="col-7 d-flex justify-content-end">Level 2, Trinity Arcade ( Hay Street Mall ), Perth</div>
			</div>
		</div>		
	</section>


	<header id="masthead" class="site-header bg-cream">

		<nav class="navbar navbar-expand-lg navbar-light bg-faded mx-3">
			<a class="navbar-brand pb-3" href="<?= site_url() ?>">
			<?php the_custom_logo(); ?>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs4navbar" aria-controls="bs4navbar" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php
			wp_nav_menu([
				'menu'            => 'primary',
				'theme_location'  => 'header',
				'container'       => 'div',
				'container_id'    => 'bs4navbar',
				'container_class' => 'collapse navbar-collapse',
				'menu_id'         => false,
				'menu_class'      => 'navbar-nav ml-auto',
				'depth'           => 1,
				'fallback_cb'     => 'bs4navwalker::fallback',
				'walker'          => new bs4navwalker()
			]);
			?>
		</nav>

		<hr />

	</header><!-- #masthead -->




	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">