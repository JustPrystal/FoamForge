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
		customPaging : function(slider,i) {
            return `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 86.77 86.38">
                <defs>
                    <style>
                    .cls-1 {
                        fill: #5e4938;
                    }

                    .cls-1, .cls-2, .cls-3, .cls-4, .cls-5, .cls-6 {
                        stroke-width: 0px;
                    }

                    .cls-2 {
                        fill: url(#linear-gradient);
                    }

                    .cls-7 {
                        isolation: isolate;
                    }

                    .cls-3 {
                        fill: url(#linear-gradient-4);
                        mix-blend-mode: luminosity;
                        opacity: .6;
                    }

                    .cls-4 {
                        fill: none;
                    }

                    .cls-5 {
                        fill: url(#linear-gradient-2);
                    }

                    .cls-6 {
                        fill: url(#linear-gradient-3);
                    }

                    .cls-8 {
                        clip-path: url(#clippath);
                    }
                    </style>
                    <linearGradient id="linear-gradient" x1="4.42" y1="43.22" x2="82.81" y2="43.22" gradientUnits="userSpaceOnUse">
                    <stop offset="0" stop-color="#b36f29"/>
                    <stop offset=".08" stop-color="#e99f2e"/>
                    <stop offset=".15" stop-color="#fee84e"/>
                    <stop offset=".2" stop-color="#f2ca40"/>
                    <stop offset=".25" stop-color="#e8b235"/>
                    <stop offset=".31" stop-color="#e2a12d"/>
                    <stop offset=".37" stop-color="#de9728"/>
                    <stop offset=".45" stop-color="#dd9427"/>
                    <stop offset=".49" stop-color="#da9127"/>
                    <stop offset=".52" stop-color="#d08b27"/>
                    <stop offset=".54" stop-color="#c17f28"/>
                    <stop offset=".56" stop-color="#ab6f28"/>
                    <stop offset=".56" stop-color="#ab6f29"/>
                    <stop offset=".73" stop-color="#c48d2c"/>
                    <stop offset=".78" stop-color="#c68f2c"/>
                    <stop offset=".81" stop-color="#cf962c"/>
                    <stop offset=".83" stop-color="#dda32d"/>
                    <stop offset=".86" stop-color="#f2b52d"/>
                    <stop offset=".86" stop-color="#f4b72e"/>
                    <stop offset=".95" stop-color="#bf8536"/>
                    <stop offset="1" stop-color="#863c1d"/>
                    </linearGradient>
                    <linearGradient id="linear-gradient-2" x1="127.57" y1="555.67" x2="202.42" y2="555.67" gradientTransform="translate(-239.27 -462.71) rotate(-12.67)" gradientUnits="userSpaceOnUse">
                    <stop offset=".07" stop-color="#fad060"/>
                    <stop offset=".15" stop-color="#f5eda3"/>
                    <stop offset=".38" stop-color="#f2cf6f"/>
                    <stop offset=".47" stop-color="#ecc45e"/>
                    <stop offset=".57" stop-color="#e3b450"/>
                    <stop offset=".65" stop-color="#ac722a"/>
                    <stop offset=".72" stop-color="#f0d56d"/>
                    <stop offset=".79" stop-color="#f6e57e"/>
                    <stop offset=".84" stop-color="#f4eea1"/>
                    <stop offset=".89" stop-color="#fff1c4"/>
                    <stop offset="1" stop-color="#f9ca4a"/>
                    </linearGradient>
                    <linearGradient id="linear-gradient-3" x1="-1217.49" y1="-1310.28" x2="-1146.59" y2="-1310.28" gradientTransform="translate(-47.06 1805.56) rotate(45)" gradientUnits="userSpaceOnUse">
                    <stop offset="0" stop-color="#fff38a"/>
                    <stop offset=".23" stop-color="#fff3b3"/>
                    <stop offset=".31" stop-color="#fbedab"/>
                    <stop offset=".43" stop-color="#f2dd96"/>
                    <stop offset=".59" stop-color="#e2c373"/>
                    <stop offset=".74" stop-color="#d0a44a"/>
                    <stop offset=".9" stop-color="#b38338"/>
                    <stop offset="1" stop-color="#9f6c2b"/>
                    </linearGradient>
                    <clipPath id="clippath">
                    <path class="cls-4" d="M43.62,77.14c-9.06,0-17.58-3.53-23.98-9.93-6.41-6.41-9.93-14.92-9.93-23.98s3.53-17.58,9.93-23.98c6.41-6.41,14.92-9.93,23.98-9.93s17.58,3.53,23.98,9.93c6.41,6.41,9.93,14.92,9.93,23.98s-3.53,17.58-9.93,23.98c-6.41,6.41-14.92,9.93-23.98,9.93Z"/>
                    </clipPath>
                    <linearGradient id="linear-gradient-4" x1="-345.22" y1="-152.88" x2="-275.34" y2="-152.88" gradientTransform="translate(186.81 303.95) rotate(37.69) scale(1 .9)" gradientUnits="userSpaceOnUse">
                    <stop offset="0" stop-color="#f8ee51"/>
                    <stop offset=".29" stop-color="#f9f280"/>
                    <stop offset=".95" stop-color="#fefef7"/>
                    <stop offset=".99" stop-color="#fff"/>
                    </linearGradient>
                </defs>
                <g class="cls-7">
                    <g id="Layer_1" data-name="Layer 1">
                    <g>
                        <path class="cls-1" d="M43.62,86.38c-11.53,0-22.36-4.49-30.52-12.64C4.95,65.59.46,54.75.46,43.22S4.95,20.86,13.1,12.71C21.25,4.56,32.09.07,43.62.07s22.36,4.49,30.52,12.64c8.15,8.15,12.64,18.99,12.64,30.52s-4.49,22.36-12.64,30.52c-8.15,8.15-18.99,12.64-30.52,12.64Z"/>
                        <path class="cls-2" d="M43.62,82.42c-10.47,0-20.31-4.08-27.72-11.48s-11.48-17.25-11.48-27.72,4.08-20.31,11.48-27.72c7.4-7.4,17.25-11.48,27.72-11.48s20.31,4.08,27.72,11.48,11.48,17.25,11.48,27.72-4.08,20.31-11.48,27.72-17.25,11.48-27.72,11.48Z"/>
                        <path class="cls-5" d="M51.83,79.73c-9.75,2.19-19.77.46-28.22-4.89s-14.31-13.66-16.5-23.41-.46-19.77,4.89-28.22,13.66-14.31,23.41-16.5c9.75-2.19,19.77-.46,28.22,4.89s14.31,13.66,16.5,23.41c2.19,9.75.46,19.77-4.89,28.22-5.35,8.45-13.66,14.31-23.41,16.5Z"/>
                        <circle class="cls-6" cx="43.62" cy="43.22" r="35.45"/>
                        <g class="cls-8">
                        <path class="cls-3" d="M-4.06,43.51c-7.38-5.71-11.25-15.05-10.88-26.32.37-11.27,4.92-23.11,12.83-33.33,7.9-10.23,18.21-17.62,29.02-20.82,10.81-3.2,20.83-1.82,28.22,3.89s11.25,15.05,10.88,26.32c-.37,11.27-4.92,23.11-12.83,33.33s-18.21,17.62-29.02,20.82c-10.81,3.2-20.83,1.82-28.22-3.89Z"/>
                        </g>
                    </g>
                    </g>
                </g>
            </svg>`;
        },
        prevArrow: `<svg version="1.1" id="Layer_1" class="tab-arrow left-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 13.7 27.5" style="enable-background:new 0 0 13.7 27.5;" xml:space="preserve"><style type="text/css">.st0{fill:#5D4837;}.st1{fill:url(#SVGID_1_);}.st2{fill:url(#SVGID_00000053503102409176004440000009816332014141470372_);}.st3{fill:url(#SVGID_00000148621593918764952280000010719075564665403526_);}.st4{opacity:0.77;fill:url(#SVGID_00000137096563831079636130000001382411344729271454_);}</style><g><polygon class="st0" points="0,13.7 13.7,0 13.7,8.4 8.4,13.7 13.7,19.1 13.7,27.5"/><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="8087.3833" y1="13.7461" x2="8100.5435" y2="13.7461" gradientTransform="matrix(-1 0 0 1 8100.8867 0)"><stop offset="0" style="stop-color:#863A14"/><stop offset="9.976499e-02" style="stop-color:#BF8437"/><stop offset="0.1817" style="stop-color:#F5B731"/><stop offset="0.3174" style="stop-color:#C48C21"/><stop offset="0.3878" style="stop-color:#C2891F"/><stop offset="0.4323" style="stop-color:#BB8119"/><stop offset="0.4695" style="stop-color:#AF7210"/><stop offset="0.4791" style="stop-color:#AB6D0C"/><stop offset="0.6728" style="stop-color:#DD9426"/><stop offset="0.7137" style="stop-color:#DE9727"/><stop offset="0.7426" style="stop-color:#E2A02B"/><stop offset="0.7678" style="stop-color:#E8B032"/><stop offset="0.7908" style="stop-color:#F1C63C"/><stop offset="0.8122" style="stop-color:#FCE249"/><stop offset="0.8169" style="stop-color:#FFE94C"/><stop offset="0.8275" style="stop-color:#F9D544"/><stop offset="0.8439" style="stop-color:#F1BD3A"/><stop offset="0.8613" style="stop-color:#ECAC33"/><stop offset="0.8802" style="stop-color:#E9A22F"/><stop offset="0.9034" style="stop-color:#E89F2E"/><stop offset="1" style="stop-color:#B36D14"/></linearGradient><polygon class="st1" points="13.5,19.2 8.1,13.7 13.5,8.3 13.5,0.6 0.3,13.7 13.5,26.9"/><linearGradient id="SVGID_00000146493046353882009630000017098704509836135569_" gradientUnits="userSpaceOnUse" x1="8087.7363" y1="13.7461" x2="8100.0439" y2="13.7461" gradientTransform="matrix(-1 0 0 1 8100.8867 0)"><stop offset="0" style="stop-color:#F9C94A"/><stop offset="7.904284e-02" style="stop-color:#FFF0C3"/><stop offset="0.2044" style="stop-color:#F5EFA2"/><stop offset="0.2753" style="stop-color:#F6E57D"/><stop offset="0.3912" style="stop-color:#F0D56C"/><stop offset="0.5048" style="stop-color:#AD7121"/><stop offset="0.629" style="stop-color:#E2B450"/><stop offset="0.7143" style="stop-color:#ECC45E"/><stop offset="0.7953" style="stop-color:#F1CF6E"/><stop offset="0.904" style="stop-color:#F5EDA4"/><stop offset="1" style="stop-color:#FAD05F"/></linearGradient><polygon style="fill:url(#SVGID_00000146493046353882009630000017098704509836135569_);" points="13.2,19.3 7.6,13.7 13.2,8.2 13.2,1.4 0.8,13.7 13.2,26.1"/><linearGradient id="SVGID_00000036955121048544998310000000628558806433228928_" gradientUnits="userSpaceOnUse" x1="8088.0898" y1="13.7461" x2="8099.5444" y2="13.7461" gradientTransform="matrix(-1 0 0 1 8100.8867 0)"><stop offset="0" style="stop-color:#D0A44A"/><stop offset="0.1337" style="stop-color:#DFBC6A"/><stop offset="0.3935" style="stop-color:#FFF3B3"/><stop offset="0.4979" style="stop-color:#FFF3AB"/><stop offset="0.6561" style="stop-color:#FFF296"/><stop offset="0.7486" style="stop-color:#FFF287"/></linearGradient><polygon style="fill:url(#SVGID_00000036955121048544998310000000628558806433228928_);" points="12.8,2.3 12.8,8 7.1,13.7 12.8,19.5 12.8,25.2 1.3,13.7"/><linearGradient id="SVGID_00000057140081043702165470000006764857935898917513_" gradientUnits="userSpaceOnUse" x1="8088.4111" y1="10.167" x2="8099.0449" y2="10.167" gradientTransform="matrix(-1 0 0 1 8100.8867 0)"><stop offset="0" style="stop-color:#FFFF4A"/><stop offset="0.2815" style="stop-color:#FFFF7A"/><stop offset="0.9194" style="stop-color:#FFFFF1"/><stop offset="0.992" style="stop-color:#FFFFFF"/></linearGradient><path style="opacity:0.77;fill:url(#SVGID_00000057140081043702165470000006764857935898917513_);" d="M1.8,13.7L12.4,3.1 c0,0,0.1,1.7,0,2.2c-0.9,2.1-1.8,3.7-3.2,5.7c-0.7,0.6-2.7,2.7-2.7,2.7s0.6,0.7,0.7,0.8c-0.6,1.1-1.2,1.8-2,2.6C4.3,16.2,1.8,13.7,1.8,13.7z"/></g></svg>`,
        nextArrow: `<svg version="1.1" id="Layer_1" class="tab-arrow right-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 13.7 27.5" style="enable-background:new 0 0 13.7 27.5;" xml:space="preserve"><style type="text/css">.st0{fill:#5D4837;}.st1{fill:url(#SVGID_1_);}.st2{fill:url(#SVGID_00000118377237173968627070000000759521859443031948_);}.st3{fill:url(#SVGID_00000009590753662765281440000013812697408493562029_);}.st4{opacity:0.6;fill:url(#SVGID_00000132773367455462325680000015481831465886372774_);}</style><g><polygon class="st0" points="0,19.1 5.3,13.7 0,8.4 0,0 13.7,13.7 0,27.5 	"/><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="0.2423" y1="13.7285" x2="13.3858" y2="13.7285"><stop  offset="0" style="stop-color:#B36D14"/><stop  offset="8.493020e-02" style="stop-color:#E89F2E"/><stop  offset="0.1493" style="stop-color:#FFE94C"/><stop  offset="0.2004" style="stop-color:#F3CA3E"/><stop  offset="0.2536" style="stop-color:#E9B234"/><stop  offset="0.31" style="stop-color:#E2A12C"/><stop  offset="0.3713" style="stop-color:#DE9727"/><stop  offset="0.4465" style="stop-color:#DD9426"/><stop  offset="0.4868" style="stop-color:#DA9225"/><stop  offset="0.5152" style="stop-color:#D18B20"/><stop  offset="0.5398" style="stop-color:#C17F18"/><stop  offset="0.5624" style="stop-color:#AC6E0C"/><stop  offset="0.5629" style="stop-color:#AB6D0C"/><stop  offset="0.7336" style="stop-color:#C48C21"/><stop  offset="0.7799" style="stop-color:#C78E22"/><stop  offset="0.8092" style="stop-color:#CF9625"/><stop  offset="0.8336" style="stop-color:#DEA329"/><stop  offset="0.8554" style="stop-color:#F2B530"/><stop  offset="0.8577" style="stop-color:#F5B731"/><stop  offset="0.9489" style="stop-color:#BF8437"/><stop  offset="1" style="stop-color:#863A14"/></linearGradient><polygon class="st1" points="0.2,19.2 5.7,13.7 0.2,8.3 0.2,0.6 13.4,13.7 0.2,26.9 	"/><linearGradient id="SVGID_00000064313108515358264260000009796618448172010422_" gradientUnits="userSpaceOnUse" x1="0.5951" y1="13.7285" x2="12.8869" y2="13.7285"><stop  offset="7.218680e-02" style="stop-color:#FAD05F"/><stop  offset="0.147" style="stop-color:#F5EDA4"/><stop  offset="0.3763" style="stop-color:#F1CF6E"/><stop  offset="0.4657" style="stop-color:#ECC45E"/><stop  offset="0.5676" style="stop-color:#E2B450"/><stop  offset="0.6528" style="stop-color:#AD7121"/><stop  offset="0.7152" style="stop-color:#F0D56C"/><stop  offset="0.7921" style="stop-color:#F6E57D"/><stop  offset="0.8441" style="stop-color:#F5EFA2"/><stop  offset="0.8919" style="stop-color:#FFF0C3"/><stop  offset="1" style="stop-color:#F9C94A"/></linearGradient><polygon style="fill:url(#SVGID_00000064313108515358264260000009796618448172010422_);" points="0.6,19.3 6.2,13.7 0.6,8.2 0.6,1.4 12.9,13.7 0.6,26 "/><linearGradient id="SVGID_00000075850994960430764760000006915483973525492867_" gradientUnits="userSpaceOnUse" x1="0.9478" y1="13.7285" x2="12.3881" y2="13.7285"><stop  offset="7.978720e-03" style="stop-color:#FFF287"/><stop  offset="0.2287" style="stop-color:#FFF3B3"/><stop  offset="0.3265" style="stop-color:#FCEDAB"/><stop  offset="0.475" style="stop-color:#F2DD96"/><stop  offset="0.6559" style="stop-color:#E3C474"/><stop  offset="0.8389" style="stop-color:#D0A44A"/><stop  offset="0.9344" style="stop-color:#B48438"/><stop  offset="1" style="stop-color:#9E6B2B"/></linearGradient><polygon style="fill:url(#SVGID_00000075850994960430764760000006915483973525492867_);" points="0.9,2.3 0.9,8 6.7,13.7 0.9,19.4 0.9,25.2 12.4,13.7 "/><linearGradient id="SVGID_00000115485479221170692600000001223794636690810029_" gradientUnits="userSpaceOnUse" x1="1.3006" y1="7.224" x2="7.0704" y2="7.224"><stop  offset="0" style="stop-color:#FFFF4A"/><stop  offset="0.2815" style="stop-color:#FFFF7A"/><stop  offset="0.9194" style="stop-color:#FFFFF1"/><stop  offset="0.992" style="stop-color:#FFFFFF"/></linearGradient><path style="opacity:0.6;fill:url(#SVGID_00000115485479221170692600000001223794636690810029_);" d="M4.6,11.2 C3.1,9.5,1.3,7.9,1.3,7.9V3.1c0,0,4.1,4.1,5.7,5.7C7.6,9.4,5.3,11.9,4.6,11.2z"/></g></svg>`,
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
