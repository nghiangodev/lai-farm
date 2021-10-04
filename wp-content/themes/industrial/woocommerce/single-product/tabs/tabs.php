<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

global $post, $product;

$style_html = '';
if ( ! empty( $tabs ) ) { 
	if ( count( $tabs ) == 1 ) { 
		$style_html = 'display:none;" ';
	} 
?>
	
	<div class="btClear"></div>
	<div class="btTabs tabsHorizontal">
		
		<ul class="tabsHeader" style="<?php echo  esc_attr( $style_html ) ; ?>">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab">
					<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . esc_attr( $key ) . '_tab_title', esc_html( $tab['title'] ), $key ) ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class="tabPanes tabPanesTabs">
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="tabPane" id="tab-<?php echo esc_attr( $key ); ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ); ?>
			</div>
		<?php endforeach; ?>
		</div>
	</div>

<?php } ?>

<div class="boldRow topSmallSpaced bottomSmallSpaced">
	<div class="product_meta rowItem col-sm-6 tagsRowItem <?php echo esc_attr( BoldThemesFramework::$left_alignment_class ); ?>">
		<?php do_action( 'woocommerce_product_meta_start' ); ?>
		<?php
		if ( boldthemes_woocommerce_is_new_version() ) {
			echo '<div class="btTags"><ul>' . wc_get_product_tag_list( $product->get_id(), '</li><li> ',  '<li>', '</li>' )  . '</ul></div>';
		}else{
			echo '<div class="btTags"><ul>' . wp_kses_post( $product->get_tags( '</li><li> ', '<li>', '</li>' ) ) . '</ul></div>';
		}
		?>
		

		
		<?php do_action( 'woocommerce_product_meta_end' ); ?>
	</div>
	<div class="rowItem col-sm-6 cellRight shareRowItem <?php echo esc_attr( BoldThemesFramework::$right_alignment_class ) ?>">
		<div class="socialRow"><?php echo boldthemes_wc_get_share_buttons( get_permalink() ); ?></div>
	</div>
</div>