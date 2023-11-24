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
    
    //shop edits
    remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

    add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby' );
    
    function custom_woocommerce_catalog_orderby( $options ) {
        $options['alpha'] = 'Alphabetical';
        $options['b-sell'] = 'Best Sellers';
        $options['featured'] = 'Featured';
        $options['new'] = 'New';
        $options['price-asc'] = 'Price: Low to High';
        $options['price-desc'] = 'Price: High to Low';
        // repositionArrayElement($options, "price-desc", 5);
        // repositionArrayElement($options, "popularity", 1);
        // repositionArrayElement($options, "price", 2);
        // repositionArrayElement($options, "price-desc", 3);
        unset($options['date']);
        unset($options['price']);
        unset($options['menu_order']);
        unset($options['latest']);
        unset($options['rating']);
        unset($options['popularity']);
    
        return $options;
    }



    

    //best seller logic
    // Function to count product sales from orders
    function count_product_sales() {
        $products_count = array();

        $orders = wc_get_orders( array( 'status' => 'completed' ) );

        foreach ( $orders as $order ) {
            $items = $order->get_items();
            foreach ( $items as $item ) {
                $product_id = $item->get_product_id();

                if ( isset( $products_count[ $product_id ] ) ) {
                    $products_count[ $product_id ]++;
                } else {
                    $products_count[ $product_id ] = 1;
                }
            }
        }
        // var_dump($products_count);
        return $products_count;
    }

    // Function to update sales data
    function update_sales_data() {
        $sales_data = count_product_sales();
        foreach ( $sales_data as $product_id => $count ) {
            update_post_meta( $product_id, '_sales_count', $count );
            
        }
    }
    
    function custom_woocommerce_get_catalog_ordering_args($args) {
        if (isset($_GET['orderby'])) {
            switch ($_GET['orderby']) {
                case 'alpha':
                    $args['orderby'] = 'title';
                    $args['order'] = 'asc';
                    break;
                case 'b-sell':
                    // Implement your logic for best sellers
                    $allArgs = array( 
                        'post_type' => 'product', 
                        'posts_per_page' => -1 
                    );
                    $allProducts = wc_get_products( $allArgs ); 
                    foreach ( $allProducts as $prd){
                        update_post_meta( $prd->id, '_sales_count', "0" );
                    }
                    update_sales_data();
                    $args['orderby'] = 'meta_value_num';
                    $args['order'] = 'DESC';
                    $args['meta_key'] = '_sales_count';

                    break;
                case 'featured':
                    // Implement your logic for featured products
                    $allArgs = array( 
                        'post_type' => 'product', 
                        'posts_per_page' => -1 
                    );
                    $allProducts = wc_get_products( $allArgs ); 
                    foreach ( $allProducts as $prd){
                        if(get_field("featured_product", $prd->id)){
                            update_post_meta( $prd->id, '_featured_product', "1" );
                        }
                        $args['orderby'] = 'meta_value_num';
                        $args['order'] = 'DESC';
                        $args['meta_key'] = '_featured_product';
                    }
                    break;
                case 'new':
                    $args['orderby'] = 'date';
                    $args['order'] = 'desc';
                    break;
            }
        }
        return $args;
    }
    add_filter('woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args');
?>