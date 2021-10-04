<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

if ( boldthemes_woocommerce_is_new_version() ) {
	$related = wc_get_related_products( $product->get_id(), $posts_per_page, $product->get_upsell_ids() );
}else{
	$related = $product->get_related( $posts_per_page );
}

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->get_id() )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="related products">

		<?php 
		
			echo '<div class="btClear btSeparator topSmallSpaced noBorder"><hr></div>';
			echo boldthemes_get_heading_html( '', esc_html__( 'Related Products', 'industrial' ), '', 'small', '', '', '' ) ; 
			echo '<div class="btClear btSeparator topExtraSmallSpaced noBorder"><hr></div>';
			
		?>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
