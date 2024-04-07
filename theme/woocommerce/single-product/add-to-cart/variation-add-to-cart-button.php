<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );

	?>
	<div class="quantity-wrap">
		<label> Quantity: </label>
		<div class="value-wrap">
			<div class="value">
				<?php 
					woocommerce_quantity_input(
						array(
							'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
							'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
							'input_value' => "", // WPCS: CSRF ok, input var ok.
							'placeholder'  => apply_filters( 'woocommerce_quantity_input_placeholder', 'Choose a Quantity', $product ),
						)
					);
				?>
				<div class="control-wrap up">
					<span class="qty-controls qty-up"></span>
				</div>
				<div class="control-wrap down">
					<span class="qty-controls qty-down"></span>
				</div>
			</div>
			<div class="display-price-tier">
				<span class="tier"></span>
				<div class='view-all-tiers'>View All Tiers</div>
			</div>
		</div>
	</div>
	<?php

	do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>
	<div class="add-to-cart-btn-wrap">			
		<div class="sku-wrap product-meta-description-box">
		</div>
		<button type="submit" class="add-to-cart-btn single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo "Add Selection to Cart" ?> <span class="product-price"></span></button>
	</div>
	<div class="ff_notices">
		<div class="ff_notices-wrap"></div>
		<a href="" class="redirect-cart"></a>
	</div>



	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
