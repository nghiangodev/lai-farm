<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.8.0
 */ 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="btCartWidget btIconWidget">
	<span class="btCartWidgetIcon btIconWidgetIcon">
		<?php echo boldthemes_get_icon_html( 'fa_f07a', '', '', 'btIcoDefaultType btIcoDefaultColor', '' ); ?>
		<span class="cart-contents" title="<?php _e( 'View your shopping cart', 'industrial' ); ?>"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
	</span>
	<?php do_action( 'woocommerce_before_mini_cart' ); ?>
	<div class="btCartWidgetInnerContent btIconWidgetContent">
		<div class="verticalMenuCartToggler"></div>
		<ul class="cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">

			<?php if ( ! WC()->cart->is_empty() ) : ?>

				<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

							$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
							<li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
								<div class="ppRemove">
								<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s"></a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									esc_html__( 'Remove this item', 'industrial' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
								?>
								</div>
								<div class="btCartItemTable">
									<div class="ppImage">
									<?php if ( ! $_product->is_visible() ) : ?>
										<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . ''; ?>
									<?php else : ?>
										<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
											<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . ''; ?>
										</a>
									<?php endif; ?>
									</div><!-- /ppImage -->
									<div class="ppTxt">
										<?php echo boldthemes_get_heading_html( '', $product_name, apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ), 'small', '', '', '' )?>
										<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
									</div><!-- /ppText -->
								</div><!-- /btCartItemTable -->
							</li>
							<?php
						}
					}
				?>

			<?php else : ?>

				<li class="empty"><?php esc_html_e( 'No products in the cart.', 'industrial' ); ?></li>

			<?php endif; ?>

		</ul><!-- end product list -->

	<?php if ( ! WC()->cart->is_empty() ) : ?>

		<p class="total"><strong><?php esc_html_e( 'Subtotal', 'industrial' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<p class="buttons">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward"><?php _e( 'View Cart', 'industrial' ); ?></a>
			<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward"><?php _e( 'Checkout', 'industrial' ); ?></a>
		</p>

	<?php endif; ?>

	</div>
</div>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
