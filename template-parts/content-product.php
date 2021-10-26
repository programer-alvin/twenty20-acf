<?php
/**
 * Template for displaying product content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.8
 * 
 * ----
 * Advanced Custom Fields (ACF)
 * @link https://www.advancedcustomfields.com/resources/#functions
 */

$acf_fields_data 			= get_fields();

// Field title: `Prix`
$acf_productPrice_key		= 'group_617049954de37';
$css_productPrice_container = 'acf product-price';

$bloginfo_lang				= substr( get_bloginfo ( 'language' ), 0, 2 );
if ($bloginfo_lang === 'fr') {
	$currency_lang_fr = true;
} else {
	$currency_lang_fr = false;
}

// Field title: `Détails du produit`
$acf_productSpecs_key		= 'group_616dbd35445ef';
$css_productSpecs_container = 'acf product-specs';

// Field title: `Tag SAQ`
$acf_saqTag_key				= 'group_616f283c339f1';
$acf_saqTag_containerId		= 'saq-taste-tag';

if ( $acf_fields_data ) {
	if ($name === 'winetype') {
		$acf_winetype 	= $name;
	} else {
		$acf_winetype 	= false;
	}
}
?>

<article tmpl="template-parts" <?php post_class('twenty20 product-content ' . $acf_winetype['name']); ?> id="post-<?php the_ID(); ?>">


	<?php

	get_template_part( 'template-parts/entry-header' );

	/**
	 * Advanced Custom Fields
	 */
	if ( $acf_fields_data ) {

		/**
		 * ACF: Product Price and Availability
		 */
		$acf_dollars 		= get_field_object('price');
		$acf_cents 			= get_field_object('pricecents');
		$acf_qty_visibility	= get_field_object('visibility');
		$acf_qty_digit		= get_field_object('qty');

		echo('<section class="twenty20 acf-container entry-header"><p class="section-inner small acf product-price">');

			// Price
			if ( !empty( $acf_dollars['value'] )) {

				// If French
				if ($bloginfo_lang === 'fr') {

					if ( !empty( $acf_cents['value'] )) {
						echo('<strong class="value">
								<span class="price dollars">'. $acf_dollars['value'] .'</span>
								<span class="price cents">,'. $acf_cents['value'] .'</span>
								<span class="currency">$</span> 
							</strong>');
					} else {
						echo('<strong class="value">
								<span class="price dollars">'. $acf_dollars['value'] .'</span>
								<span class="currency">$</span> 
							</strong>');
					}
					echo ('<span class="txinc">Taxes incluses</span>');

				} else {

					if ( !empty( $acf_cents['value'] )) {
						echo('<strong class="value">
								<span class="currency">$</span>
								<span class="price dollars">'. $acf_dollars['value'] .'</span>
								<span class="price cents">,'. $acf_cents['value'] .'</span>
							</strong>');
					} else {
						echo('<strong class="value">
								<span class="currency">$</span>
								<span class="price dollars">'. $acf_dollars['value'] .'</span>
							</strong>');
					}
					echo ('<span class="txinc">Taxes included</span>');

				}
				echo('</p>');
			}

			// Availability
			if ( !empty( $acf_qty_visibility['value'] )) {
				echo ( '<p class="section-inner small acf inventory">'. __( 'Plus que', 'Only', 'twenty20 inventory' ) .' <strong>'. $acf_qty_digit['value'] .'</strong> '. __('bouteilles en inventaire !', 'bottles left in inventory!', 'twenty20 inventory' ) .'</p>' );
			}

		echo('</section><!-- .twenty20 -->');

	}

	get_template_part( 'template-parts/featured-image' );


	/**
	 * Advanced Custom Fields : SAQ Taste Tags
	 */
	if ( $acf_fields_data ) {

		$acf_saqtag 		= get_field_object('saqtag');
		$acf_saqtag_item	= get_sub_field_object('saqtag');

		if ( $acf_saqtag['value'] != false ) {
			echo ( '<p id="'. $acf_saqTag_containerId .'">
						<span class="saqtag wine '. $acf_saqtag['value'] .'" title="'. $acf_saqtag['label'] .'">
							<em>'. $acf_saqtag['value'] .'</em>
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
				the_content( __( 'Continue reading', 'twenty20 parts' ) );
			}
			/**
			 * Advanced Custom Fields : Product Specifications
			 */
			if( $acf_fields_data ) {

				$acf_field_string 		= get_field_object('title');

				echo ('<section class="twenty20 acf-container">
						<hr>
						<h3 class="'. $css_productSpecs_container .' title"><span>h3'. $acf_field_string .'</span></h3>'.
						'<dl class="inline-grid '. $css_productSpecs_container .'">');

				foreach ( $acf_fields_data as $name => $value ) {

					$field_name 	= get_field_object( $name );

					if ($name === 'price' || $name === 'pricecents' || $name === 'visibility' || $name === 'qty' || $name === 'saqtag') {
						continue;
					}
					elseif ($value != false) {
					?>
						<dt class="name <?php echo $name; ?>">
							<strong class="label"><?php echo $field_name['label'] ?></strong>
						</dt>
						<dd class="value <?php echo $name; ?>">
						<?php
							// display each checkboxes type fields values as <li>
							if ($name === 'cepages') {

								$name_items = get_field( $name );

								echo ('<ul class="inline-values">');
								foreach( $name_items as $item ) {

									//TODO: echo ['label'] instead of $item
									$item_label		= $item;

									echo ( '<li class="'. $item .'"><span>'. $item_label .'</span></li>');

								}
								echo ('</ul>');
							}
							// checked values as <li>
							elseif ($name === 'bottle') {

								$collumn_items = get_field('bottle');

								echo ('<ul class="columns">');
								foreach( $collumn_items as $item => $value ) {

									//TODO: echo ['label'] instead of $value
									$value_label	= $value;

									echo ( '<li><strong class="label '. $item .'">'. $item .'</strong> <span class="value '. $item .'">'. $value_label .'</span></li>');

								}
								echo ('</ul>');
							}
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
