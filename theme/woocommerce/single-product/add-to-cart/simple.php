<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" data-product_id="<?php echo absint( $product->get_id() ); ?>" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );
		?>
<!-- 
		<div class="quantity-wrap">
			<label> Quantity: </label>
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
			<span class="qty-controls qty-up"></span>
			<span class="qty-controls qty-down"></span>
		</div> -->
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
				<span class="qty-controls qty-up"></span>
				<span class="qty-controls qty-down"></span>
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

		<!-- <button type="submit" name="add-to-cart add-to-cart-btn single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo "Add Selection to Cart" ?> <span class="product-price"></span></button> -->
		<div class="add-to-cart-btn-wrap">			
			<div class="sku-wrap product-meta-description-box">
				<div class="top row">
					<div class="sku-inner">
						<div class="label"><strong>SKU:&nbsp;</strong><?php woocommerce_template_single_meta();?></div>
					</div>
					<div class="product-each">
						<div class="label"><strong>EACH:&nbsp;</strong></div>
						<div class="each-price">
							<span class="currency-symbol">$</span>
							<span class="value"></span>
						</div>
					</div>
				</div>
			</div>
			<button type="submit" class="add-to-cart-btn single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo "Add Selection to Cart" ?> <span class="product-price"></span></button>
		</div>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
