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
				// do_action( 'woocommerce_before_single_product_summary' );

				
			?>
			<?php 
				$images = []; 
				$images[0] = $product->get_image_id();
				$gallery = $product->get_gallery_image_ids();
				$images = array_merge($images , $gallery);
			?>
			<div class="product-slider <?php if(count($images) > 1){echo 'slider-active';}?>">
				<?php foreach($images as $image){
					?>
					<div class="slide-item">
						<img src="<?php echo wp_get_attachment_image_url($image , 'large')?>" alt="">
					</div>
					<?php
				}?>
			</div>
			<?php if(get_field('content_after_image')){?>
				<div class="product-image-notice">
					<?php echo get_field('content_after_image');?>
				</div>
			<?php }?>
			<div class="product-slider-thumbs <?php if(count($images) > 3){ echo 'slider-active'; }?>">
				<?php
					$i = 0;
					foreach($images as $image){?>
					<div class="slide-item" data-slick-index="<?php echo $i;?>">
						<img src="<?php echo wp_get_attachment_image_url($image , 'large')?>" alt="">
					</div>
					<?php $i++;} ?>
			</div>
		</div>
		<div class="column summary-col">
			<div class="title-wrap">
				<div class="subtitle"><?php echo get_field('subtitle')?></div>
				<h1 class="product-title"><?php echo $product->get_name()?></h1>
			</div>
			<div class="description">
				<?php the_content();?>
			</div>
		
			<div class="product-add-to-cart">
				
				<?php woocommerce_template_single_add_to_cart(); ?>	
				<div class="woocommerce-fallback-price">
					<?php woocommerce_template_single_price(); ?>
				</div>
			</div>
			<?php woocommerce_output_all_notices()?>
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
	<div class="pricing-table-wrapper">
		<div class="cross">
			<svg viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.96967 16.4697C6.67678 16.7626 6.67678 17.2374 6.96967 17.5303C7.26256 17.8232 7.73744 17.8232 8.03033 17.5303L6.96967 16.4697ZM13.0303 12.5303C13.3232 12.2374 13.3232 11.7626 13.0303 11.4697C12.7374 11.1768 12.2626 11.1768 11.9697 11.4697L13.0303 12.5303ZM11.9697 11.4697C11.6768 11.7626 11.6768 12.2374 11.9697 12.5303C12.2626 12.8232 12.7374 12.8232 13.0303 12.5303L11.9697 11.4697ZM18.0303 7.53033C18.3232 7.23744 18.3232 6.76256 18.0303 6.46967C17.7374 6.17678 17.2626 6.17678 16.9697 6.46967L18.0303 7.53033ZM13.0303 11.4697C12.7374 11.1768 12.2626 11.1768 11.9697 11.4697C11.6768 11.7626 11.6768 12.2374 11.9697 12.5303L13.0303 11.4697ZM16.9697 17.5303C17.2626 17.8232 17.7374 17.8232 18.0303 17.5303C18.3232 17.2374 18.3232 16.7626 18.0303 16.4697L16.9697 17.5303ZM11.9697 12.5303C12.2626 12.8232 12.7374 12.8232 13.0303 12.5303C13.3232 12.2374 13.3232 11.7626 13.0303 11.4697L11.9697 12.5303ZM8.03033 6.46967C7.73744 6.17678 7.26256 6.17678 6.96967 6.46967C6.67678 6.76256 6.67678 7.23744 6.96967 7.53033L8.03033 6.46967ZM8.03033 17.5303L13.0303 12.5303L11.9697 11.4697L6.96967 16.4697L8.03033 17.5303ZM13.0303 12.5303L18.0303 7.53033L16.9697 6.46967L11.9697 11.4697L13.0303 12.5303ZM11.9697 12.5303L16.9697 17.5303L18.0303 16.4697L13.0303 11.4697L11.9697 12.5303ZM13.0303 11.4697L8.03033 6.46967L6.96967 7.53033L11.9697 12.5303L13.0303 11.4697Z" fill="#000000"></path> </g></svg>
		</div>
		<?php echo do_shortcode('[tiered-pricing-table]')?>
	</div>
	<?php get_blocks(); ?>
	<?php if($product->get_upsell_ids()){?>
	<div class="related-products">
		<div class="inner">
			<h3 class="heading">Related Products</h3>
			<div class="products-wrap">
				<?php foreach($product->get_upsell_ids() as $product_id){
					$_product = wc_get_product($product_id);
					?>
					<div class="product-item">
						<a href="<?php echo get_the_permalink($product_id);?>">
							<div class="image-wrap">
							<img src="<?php echo wp_get_attachment_url( $_product->get_image_id() );?>" alt="">
							</div>
							<div class="text-col">
								<div class="sub-title"><?php echo get_field('subtitle', $product_id); ?></div>
								<div class="product-name"><?php echo $_product->get_name();?></div>
							</div>
							<div class="short_description">
								<?php echo $_product->short_description;?>
							</div>
							<div class="price">
								$<?php echo $_product->price;?>
							</div>
							<?php
								echo apply_filters(
									'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
									sprintf(
										'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
										esc_url( $product->add_to_cart_url() ),
										esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
										esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
										isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
										esc_html( $product->add_to_cart_text() == "Add to cart" ? "Add this item to Cart" : $product->add_to_cart_text())
									),
									$product,
									$args
								);
							?>
						</a>
					</div>
					<?php 
				}?>
			</div>
		</div>
	</div>
	<?php }?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
