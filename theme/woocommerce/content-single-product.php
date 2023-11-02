<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="product-template">
		<div class="column image-col">
			<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
		</div>
		<div class="column summary-col">
			<div class="title-wrap">
				<div class="subtitle"><?php echo get_field('subtitle')?></div>
				<h1 class="product-title"><?php echo $product->get_name()?></h1>
			</div>
			<div class="description">
				<p>
					<?php echo $product->description; ?>
				</p>
			</div>
			
			<div class="product-add-to-cart">
				<?php woocommerce_template_single_add_to_cart(); ?>	
			</div>
			<div class="product-information">
				<?php if(get_field('content_after_add_to_cart')){?>
					<div class="notice-after-cart">
						<?php echo get_field('content_after_add_to_cart')?>
					</div>
				<?php }?>
				<div class="accordions-wrap">
					<?php if(get_field('product_specs_content')){?>
						<div class="accordion-item">
							<div class="accordion-header">
								<div class="accordion-title">Product Specifications</div>
								<div class="accordion-icon">
									<svg  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M6 9L12 15L18 9" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</div>
							</div>
							
							<div class="accordion-body">
								<?php echo get_field('product_specs_content'); ?>
							</div>
						</div>
					<?php }?>
					<?php if(get_field('hazard_info_content')){?>
						<div class="accordion-item red">
							<div class="accordion-header">
								<div class="accordion-title">Potential Hazards</div>
								<div class="accordion-icon">
									<svg  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M6 9L12 15L18 9" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</div>
							</div>
							<div class="accordion-body">
								<?php echo get_field('hazard_info_content'); ?>
							</div>
						</div>
					<?php }?>
				</div>
			</div>
			<?php
			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			
			 //do_action( 'woocommerce_single_product_summary' );
			?>
			

			<?php
			/**
			 * Hook: woocommerce_after_single_product_summary.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			// do_action( 'woocommerce_after_single_product_summary' );
			?>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>