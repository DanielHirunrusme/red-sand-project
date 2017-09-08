<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
	
	<!-- inner-cart-container -->
	<div class="inner-cart-container">
		
		<!-- cart-table -->
		<div class="cart-table">
			<h1>Cart</h1>
			
			<!-- cart-headers-->
			<div class="cart-headers">
				<h6 class="product-span"><?php _e( 'Product', 'woocommerce' ); ?></h6>
				<h6 class="price-span"><?php _e( 'Price', 'woocommerce' ); ?></h6>
				<h6 class="quantity-span"><?php _e( 'Quantity', 'woocommerce' ); ?></h6>
				<h6 class="total-span"><?php _e( 'Total', 'woocommerce' ); ?></h6>
			</div>
			<!-- /cart-headers-->
			
			<!-- cart-items-->
			<div class="cart-items">
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>
			
			
			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<!-- cart-item -->
					<div class="cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						
						<!-- product-name -->
						<div class="product-span product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
							
							<?php
								if ( ! $product_permalink ) {
									echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
								} else {
									echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
								}

								// Meta data
								echo WC()->cart->get_item_data( $cart_item );

								// Backorder notification
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
									echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
								}
							?>
						
						</div>
						<!-- /product-name -->
						
						<!-- product-price -->
						<div class="price-span product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</div>
						<!-- /product-price -->
						
						<!-- product-quantity -->
						<div class="quantity-span product-quantity"  data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
							<div class="qty-container">
								<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = woocommerce_quantity_input( array(
											'input_name'  => "cart[{$cart_item_key}][qty]",
											'input_value' => $cart_item['quantity'],
											'max_value'   => $_product->get_max_purchase_quantity(),
											'min_value'   => '0',
										), $_product, false );
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
								?>
							</div>
						</div>
						<!-- /product-quantity -->
						
						<!-- product-subtotal-->
						<div class="total-span">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</div>
						<!-- /product-subtotal -->
						
						
					</div>
					<!-- /cart-item -->
					
					<?php
					/*
						<td class="product-remove">
							
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
									esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
									__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
							?>
						</td>
						<td class="product-thumbnail">
							<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $product_permalink ) {
									echo $thumbnail;
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
								}
							?>
						</td>
					*/
					?>

					<?php
				}
			}
			?>	
				
			</div>
			<!-- /cart-items-->
			
			<!-- cart-shipping
			<div class="cart-shipping">
				
				<h6>Shipping</h6>
				<div class="shipping-options">
					<div>
						<input id="free-shipping" type="radio" name="shipping[]" />
						<label for="free-shipping">Free Shipping (pending approval)</label>
					</div>
					<div>
						<input id="us-shipping" type="radio" name="shipping[]" />
						<label for="us-shipping">US Shipping cost</label>
					</div>
				</div>
				
			</div>
				-->
			<!-- /cart-shipping-->
			
			
			<?php do_action( 'woocommerce_cart_contents' ); ?>



					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code"><?php _e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>" />
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			
			<!-- cart-actions-->
			<div class="cart-actions">
				<?php
					/**
					 * woocommerce_cart_collaterals hook.
					 *
					 * @hooked woocommerce_cross_sell_display
					 * @hooked woocommerce_cart_totals - 10
					 */
				 	do_action( 'woocommerce_cart_collaterals' );
				?>
				
				<input type="submit" class="button global-btn update-cart" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />
				
				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php //wp_nonce_field( 'woocommerce-cart' ); ?>
				<?php wp_nonce_field( 'woocommerce-cart', '_wpnonce', false, true ); ?>
			</div>
			<!-- /cart-actions-->
			
		</div>
		<!-- /cart-table-->
		
	</div>
	<!-- /inner-cart-container-->

	
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_after_cart' ); ?>
