<?php
/**
 * Template Name: Singlar Product
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.8
 */

get_header();
?>

<main tmpl="singular-product" id="site-content" role="main">

	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content-product', get_post_type() );
		}
	}
	?>

</main><!-- #site-content -->

<?php get_footer(); ?>
