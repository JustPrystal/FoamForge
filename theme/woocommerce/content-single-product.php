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

				$left_icon = get_field("left", "options");
				$right_icon = get_field("right", "options");
				
			?>
			<?php if(count($images) > 1) {?>
				<img src="<?php echo $left_icon?>" alt="" class="product-slider-arrow left">
				<img src="<?php echo $right_icon?>" alt="" class="product-slider-arrow right">
			<?php } ?>
			<div class="product-slider <?php if(count($images) > 1){echo 'slider-active';}?>">
				<?php foreach($images as $image){
					?>
					<div class="slide-item">
						<img src="<?php echo wp_get_attachment_image_url($image , 'large')?>" alt="">
					</div>
					<?php
				}?>
			</div>
			<?php if(count($images) > 1) {?>
			<div class="product-slider-thumbs <?php if(count($images) > 3){ echo 'slider-active'; }?>">
					<?php
						$i = 0;
						foreach($images as $image){?>
						<div class="slide-item" data-slick-index="<?php echo $i;?>">
							<img src="<?php echo wp_get_attachment_image_url($image , 'large')?>" alt="">
						</div>
						<?php $i++;} ?>
				</div>
			<?php } ?>
			<?php if(get_field('content_after_image')){?>
				<div class="product-image-notice">
					<?php echo get_field('content_after_image');?>
				</div>
			<?php }?>
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
			<img src="<?php echo get_field('cross', 'option');?>" alt="">
 		</div>
		<?php echo do_shortcode('[tiered-pricing-table]')?>
	</div>
	<?php get_blocks($product->id); ?>
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

<script>

	$(".products-wrap").slick({
		slidesToShow: 4,
		slidesToScroll: 4,
		arrows: true, 
		dots: true,
		prevArrow: `<svg class="tab-arrow left-arrow" width="64px" height="64px" viewBox="0 0 20.00 20.00" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" transform="rotate(180)" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>arrow_right [#000000]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke-width="0.0002" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-305.000000, -6679.000000)" fill="#000000"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M249.365851,6538.70769 L249.365851,6538.70769 C249.770764,6539.09744 250.426289,6539.09744 250.830166,6538.70769 L259.393407,6530.44413 C260.202198,6529.66364 260.202198,6528.39747 259.393407,6527.61699 L250.768031,6519.29246 C250.367261,6518.90671 249.720021,6518.90172 249.314072,6519.28247 L249.314072,6519.28247 C248.899839,6519.67121 248.894661,6520.31179 249.302681,6520.70653 L257.196934,6528.32352 C257.601847,6528.71426 257.601847,6529.34685 257.196934,6529.73759 L249.365851,6537.29462 C248.960938,6537.68437 248.960938,6538.31795 249.365851,6538.70769" id="arrow_right-[#000000]"> </path> </g> </g> </g> </g></svg>`,
		nextArrow: `<svg class="tab-arrow right-arrow" width="64px" height="64px" viewBox="0 0 20.00 20.00" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" transform="rotate(0)" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>arrow_right [#000000]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke-width="0.0002" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-305.000000, -6679.000000)" fill="#000000"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M249.365851,6538.70769 L249.365851,6538.70769 C249.770764,6539.09744 250.426289,6539.09744 250.830166,6538.70769 L259.393407,6530.44413 C260.202198,6529.66364 260.202198,6528.39747 259.393407,6527.61699 L250.768031,6519.29246 C250.367261,6518.90671 249.720021,6518.90172 249.314072,6519.28247 L249.314072,6519.28247 C248.899839,6519.67121 248.894661,6520.31179 249.302681,6520.70653 L257.196934,6528.32352 C257.601847,6528.71426 257.601847,6529.34685 257.196934,6529.73759 L249.365851,6537.29462 C248.960938,6537.68437 248.960938,6538.31795 249.365851,6538.70769" id="arrow_right-[#000000]"> </path> </g> </g> </g> </g></svg>`,
		responsive: [
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
				},
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
				},
			},
			{
				breakpoint: 568,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				},
			},
		],
	});

</script>

<?php do_action( 'woocommerce_after_single_product' ); ?>
