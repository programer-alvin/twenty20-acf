<?php
/**
 * Template for displaying product detailed content
 *
 * Used for singular-product.php
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.8
 * 
 * REQUIRED PLUGIN: Advanced Custom Fields (ACF)
 * @link https://www.advancedcustomfields.com/resources/#functions
 */

$page_lang	= substr( get_bloginfo ( 'language' ), 0, 2 );
if ($page_lang === 'fr') {
	$page_lang_fr = true;
} else {
	$page_lang_fr = false;
}

// Advanced Custom Fields : Returns an array of field values (name => value)
$acf_fields_data 	= get_fields();
$acf_winetype_key	= 'field_616dbe3f760b4';

// ACF containers
$css_productPrice_class = 'acf product-price';
$css_productSpecs_class = 'acf product-specs';
$css_tastetag_id		= 'wine-taste-tag';

if ( $acf_fields_data ) {

	// Product Price and Availability
	$acf_priceDollars 	= get_field_object('price');
	$acf_priceCents 	= get_field_object('pricecents');
	$acf_qty_visibility	= get_field_object('visibility');
	$acf_qty_digit		= get_field_object('qty');
	// Taste tag
	$acf_tastetag_fieldKey	= 'field_616f2911f6b51';
	$acf_tastetag_object 	= get_field_object('tastetag');
	$acf_tastetag_subObject	= get_sub_field_object('tastetag');
	// Wine type
	$acf_winetype_fieldKey	= 'field_616dbe3f760b4';
	$acf_winetype_object 	= get_field_object('winetype');
	$acf_winetype_value 	= $acf_winetype_object['value'];
	// Cepages
	$acf_cepages_fieldKey	= 'field_616dc5bd760b5';
	$acf_cepages_object		= get_field_object('cepages');
	// Bottle cap
	$acf_bottlecap_fieldKey	= 'field_6181b01918764';
	$acf_bottlecap_object	= get_field_object('bottlecap');
}
?>

<article tmpl="template-parts" <?php post_class('twenty20 product-content ' . $acf_winetype_value); ?> id="post-<?php the_ID(); ?>">


	<?php
	get_template_part( 'template-parts/entry-header' );

	/**
	 * Product Price and Availability
	 * AdvancedCustomFields
	 */
	if ( $acf_fields_data ) {

		echo('<section class="twenty20 acf-container entry-header">
				<p class="section-inner small '. $css_productPrice_class .'">');

			// Price
			if ( !empty( $acf_priceDollars['value'] )) {

				// French
				if ( $page_lang_fr === true ) {

					if ( !empty( $acf_priceCents['value'] )) {
						echo('<strong class="value">
								<span class="price dollars">'. $acf_priceDollars['value'] .'</span>
								<span class="price cents">,'. $acf_priceCents['value'] .'</span>
								<span class="currency">$</span> 
							</strong>');
					} else {
						echo('<strong class="value">
								<span class="price dollars">'. $acf_priceDollars['value'] .'</span>
								<span class="currency">$</span> 
							</strong>');
					}
					echo ('<span class="txinc">Taxes incluses</span>');

				} else {
					// English

					if ( !empty( $acf_priceCents['value'] )) {
						echo('<strong class="value">
								<span class="currency">$</span>
								<span class="price dollars">'. $acf_priceDollars['value'] .'</span>
								<span class="price cents">,'. $acf_priceCents['value'] .'</span>
							</strong>');
					} else {
						echo('<strong class="value">
								<span class="currency">$</span>
								<span class="price dollars">'. $acf_priceDollars['value'] .'</span>
							</strong>');
					}
					echo ('<span class="txinc">Taxes included</span>');

				}
				echo('</p><!-- .section-inner -->');
			}

			// Availability
			if ( !empty( $acf_qty_visibility['value'] )) {
				if ( $acf_qty_digit['value'] <= 30 ) {
					echo ( '<p class="section-inner small acf inventory backorder">'. __( 'Plus que', 'Only', 'twenty20 inventory' ) .' <strong>'. $acf_qty_digit['value'] .'</strong> '. __('bouteilles en inventaire !', 'bottles left in inventory!', 'twenty20 inventory' ) .'</p>' );
				} elseif ( $acf_qty_digit['value'] <= 350 ) {
					echo ( '<p class="section-inner small acf inventory low">'. __('Faites vite, plus que quelques bouteilles en inventaire!', 'Hurry up, only a few bottles left in stock!', 'twenty20 inventory' ) .'</p>' );
				} else {
					echo ( '<p class="section-inner small acf inventory ok">'. __( 'Millésime en inventaire', 'Vintage in inventory', 'twenty20 inventory' ) );
				}
			}

		echo('</section><!-- .twenty20 -->');

	}

	get_template_part( 'template-parts/featured-image' );


	/**
	 * Taste Tags
	 * AdvancedCustomFields
	 */
	if ( $acf_fields_data ) {

		if ( $acf_tastetag_object['value'] != false ) {
			echo ( '<p id="'. $css_tastetag_id .'">
						<span class="tastetag wine '. $acf_tastetag_object['value'] .'" title="'. $acf_tastetag_object['label'] .'">
							<em>'. $acf_tastetag_object['value'] . $acf_tastetag_subObject['label'] .'</em>
						</span>
					</p>' );
		}
	}
	?>

		<div class="entry-content">

			<?php
			if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
				the_excerpt();
			} else {
				the_content( __( 'Continue reading', 'theme parts' ) );
			}
			/**
			 * Product Specifications
			 * AdvancedCustomFields
			 */
			if( $acf_fields_data ) {

				/**
				 * dev_note:
				 * TODO: $acf_productSpecs_groupTitle to print 'title' string
				 */
				$acf_productSpecs_groupTitle 	= get_field_object('title');

				echo ('<section class="twenty20 acf-container">
						<hr>
						<h2 class="'. $css_productSpecs_class .' title heading-size-3"><span>Détails du produit</span></h2>'.
						'<dl class="inline-grid '. $css_productSpecs_class .'">');

				foreach ( $acf_fields_data as $name => $value ) {

					$object_name 	= get_field_object( $name );

					/**
					 * dev_note:
					 * This is ugly but gets the job done until I found 
					 * how to limite the loop to only the `productSpecs` group.
					 */
					if ($name === 'price' || $name === 'pricecents' || $name === 'visibility' || $name === 'qty' || $name === 'tastetag') {
						continue;
					}
					elseif ($value != false) {
					?>
						<dt class="name <?php echo $name; ?>">
							<strong class="label"><?php echo $object_name['label'] ?></strong>
						</dt>
						<dd class="value <?php echo $name; ?>">
						<?php
							// display an array of checked checkboxes
							if ($name === 'cepages') {

								$field_choices 	= get_field( $name );

								echo ('<ul class="inline-values">');
								foreach( $field_choices as $choice ) {

									echo ( '<li class="'. $choice .'"><span>'. $choice['label'] .'</span></li>');

								}
								echo ('</ul>');
							}
							// Debug TODO: Display $value['label'] string instead of $value
							else {
								echo ('<span>'. $value .'</span>');
							}
							?>
						</dd>
					<?php
					}
				}

				echo ('</dl><!-- .'. 
					$acf_container_class
					.' --></section>');

			}
		?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twenty20 parts' ) . '"><span class="label">' . __( 'Pages:', 'twenty20 parts' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		edit_post_link();

		// Single bottom post meta.
		twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

		if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>

	</div><!-- .section-inner -->

	<?php

	if ( is_single() ) {

		get_template_part( 'template-parts/navigation' );

	}

	/*
	 * Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->
