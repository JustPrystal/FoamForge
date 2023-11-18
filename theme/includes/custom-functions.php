<?php 
    add_theme_support('woocommerce');

    add_filter('woocommerce_resize_images', static function() {
        return false;
    });
    
    function search_product_for_category($categories , $search_query){
        $match_found = false;
        foreach($categories as $category){
            $cat = get_term_by('id', $category, 'product_cat');
            if($cat->slug == $search_query){
                $match_found = $cat->slug;
                break;
            }
        }

        return $match_found;
    }

    add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
    function woo_custom_breadrumb_home_url() {
        return get_permalink( wc_get_page_id( 'shop' ) );
    }

    add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text' );
    function wcc_change_breadcrumb_home_text( $defaults ) {
        // Change the breadcrumb home text from 'Home' to 'Apartment'
        $defaults['home'] = 'Shop';
        return $defaults;
    }

    remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
?>