<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );


/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
if(is_product_category()){
	$category = get_queried_object();
	$category_id = $category->term_id;
	$heading = get_field('heading', 'product_cat_' . $category_id);
	$description = get_field('description', 'product_cat_' . $category_id);
	$button = get_field('button', 'product_cat_' . $category_id);
	$button_icon = get_field('button_icon', 'product_cat_' . $category_id);
	$background_image = get_field('background_image', 'product_cat_' . $category_id); 
	$mobile_background_image = get_field('mobile_background_image', 'product_cat_' . $category_id);
	$text_color = get_field('text_color', 'product_cat_' . $category_id);
	$content_alignment = get_field('content_alignment', 'product_cat_' . $category_id);
	$banner_height = get_field('banner_height', 'product_cat_' . $category_id);
	$banner_exists = $heading || $description || ($background_image && $mobile_background_image) || $button;
?>
	<?php if ($banner_exists){?>
		<style>
			.left-block{
				background-image: url('<?php echo $background_image;?>');
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
			}
			.left-block.banner{
				height: <?php echo $banner_height?>px;
			}
			/* alignment */

				/* center left */
				.content-alignment-center-left{
					align-items: center;
				}

				/* center right */
				.content-alignment-center-right .inner{
					display: flex;
					justify-content: flex-end;
				}
				.content-alignment-center-right .inner .content{
					margin-left: 0;
					margin-right: 50px;
				}

				/* center center */
				.content-alignment-center-center .inner{
					display: flex;
					justify-content: center;
				}
				.content-alignment-center-center .inner .content{
					margin: 0;
				}

				/* bottom left */
				.content-alignment-bottom-left{
					align-items: flex-end;
				}

				/* bottom center */
				.content-alignment-bottom-center{
					align-items: flex-end;
				}
				.content-alignment-bottom-center .inner{
					display: flex;
					justify-content: center;
				}
				.content-alignment-bottom-center .inner .content{
					margin: 0;
				}

				/* bottom right */
				
				.content-alignment-bottom-right{
					align-items: flex-end;
				}
				.content-alignment-bottom-right .inner{
					display: flex;
					justify-content: flex-end;
				}
				.content-alignment-bottom-right .inner .content{
					margin-left: 0;
					margin-right: 50px;
				}

			/* text color */
			.left-block.dark .inner .content .heading, .left-block.dark .inner .content .description, .left-block.dark .inner .content .button{
				color: black;
			}
			@media(max-width: 576px){
				.left-block{
					background-image: url('<?php echo $mobile_background_image;?>');
					height:600px;
				}
			}
		</style>
		<section class="left-block category-banner banner <?php if($text_color == "dark"){ echo "dark"; }?> content-alignment-<?php echo $content_alignment;?>" >
			<div class="inner">
				<div class="content">
					<div class="heading"><?php echo $heading?></div>
					<?php if ($description){ ?>
						<div class="description"><?php echo $description?></div>
					<?php } ?>
					<!-- <?php if ($button){?>
						<a href="<?php echo $button["url"]?>" class="button"><?php echo $button["title"]?><img class="button-icon" src="<?php echo $button_icon?>" alt=""></a>
					<?php } ?> -->
				</div>
			</div>
		</section>
		<script>
			if(jQuery(".left-block").hasClass("banner")){
				jQuery(".header").addClass("transparent")
			}
			<? if($text_color == "dark") { ?>
				jQuery(".header").addClass("dark")
			<?php } ?>
		</script>
	<?php
	}	
}
else{
	get_blocks(wc_get_page_id('shop'));
}
?>
<header class="woocommerce-products-header">
	<?php if (( apply_filters( 'woocommerce_show_page_title', true ) ) && ( !is_product_category() || is_shop() )) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	?>
	<div class="main-content">
		<div class="inner">
			<!-- <div class="hide-filters-mobile">
				<span class="rect"></span>
				<span class="square"></span>
			</div> -->
			<div class="top-bar">
				<div class="hide-filters">
					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						viewBox="0 0 23.7 15.8" style="enable-background:new 0 0 23.7 15.8;" xml:space="preserve">
					<g>
						<rect width="4.5" height="15.8"/>
						<rect x="6.8" width="16.8" height="15.8"/>
					</g>
					</svg>
					<div class="text">
						hide filters
					</div>
				</div>
				<?php echo do_shortcode("[yith_wcan_mobile_modal_opener]");?>
				<div class="sort">
					<?php echo do_shortcode('[yith_wcan_filters slug="draft-preset"]');?>
				</div>
			</div>
			<div class="products-wrapper">
				<div class="filters">
					<?php 
						echo do_shortcode('[yith_wcan_filters slug="draft-preset-2"]');
					?>
				</div>
				<?php
				do_action( 'woocommerce_before_shop_loop' );

				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					}
				}

				woocommerce_product_loop_end();
				?>
			</div>				
		</div>	
	</div>
	<div id="search-results-container">

	</div>
	<?php
	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */

// do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );


