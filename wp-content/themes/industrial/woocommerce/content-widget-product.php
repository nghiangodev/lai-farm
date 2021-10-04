<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.8.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; 
?>
<li>
	<div class="ppImage">
		<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo wp_kses_post( $product->get_image() ); ?>
		</a>
	</div>
	<div class="ppTxt">
		<?php
		
		$title = '<a href="' . esc_url( get_permalink( $product->get_id() ) ) . '" title="' . esc_attr( $product->get_title() ) . '">' . wp_kses_post( $product->get_title() ) . '</a>';

		$subtitle = '';
		if ( ! empty( $show_rating ) ) {
			
			if ( boldthemes_woocommerce_is_new_version() ) {
				$subtitle = wc_get_rating_html( $product->get_average_rating() );
			}else{
				$subtitle = $product->get_rating_html();
			}
		}

		echo boldthemes_get_heading_html( '', $title, $subtitle, 'small', '', '', '' ) ;
		
		?>
		<p class="posted"><?php echo wp_kses_post( $product->get_price_html() ); ?></p>
	</div> 
</li>