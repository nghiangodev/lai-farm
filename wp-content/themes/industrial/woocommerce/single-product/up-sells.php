<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( boldthemes_woocommerce_is_new_version() ) {
	$upsells = $product->get_upsell_ids();
}else{
	$upsells = $product->get_upsells();
}

if ( sizeof( $upsells ) == 0 ) {
	return;
}

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->get_id() ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="upsells products">


		<?php 
		
			echo '<div class="btClear btSeparator topSmallSpaced noBorder"><hr></div>';
			echo boldthemes_get_heading_html( '', esc_html__( 'You may also like&hellip;', 'industrial' ), '', 'small', '', '', '' ) ; 
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
