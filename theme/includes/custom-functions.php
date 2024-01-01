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

    // add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
    // function woo_custom_breadrumb_home_url() {
    //     return get_permalink( wc_get_page_id( 'shop' ) );
    // }

    // add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text' );
    // function wcc_change_breadcrumb_home_text( $defaults ) {
    //     // Change the breadcrumb home text from 'Home' to 'Apartment'
    //     $defaults['home'] = 'Shop';
    //     return $defaults;
    // }

    remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
    
    //shop edits
    remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

    add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby' );
    
    function custom_woocommerce_catalog_orderby( $options ) {
        $options['new'] = 'New';
        $options['alpha'] = 'Alphabetical';
        $options['b-sell'] = 'Best Sellers';
        $options['featured'] = 'Featured';
        $options['price-asc'] = 'Price: Low to High';
        $options['price-desc'] = 'Price: High to Low';
        // repositionArrayElement($options, "new", 1);
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
    add_action('update_product_sales_data', 'update_sales_data');

    function custom_woocommerce_get_catalog_ordering_args($args) {
        if (isset($_GET['orderby'])) {
            switch ($_GET['orderby']) {
                case 'alpha':
                    $args['orderby'] = 'title';
                    $args['order'] = 'asc';
                    break;
                case 'b-sell':
                    $args['orderby'] = 'meta_value_num';
                    $args['order'] = 'DESC';
                    $args['meta_key'] = '_sales_count';
                    break;
                case 'featured':
                    $args['meta_key'] = 'featured_product';
                    $args['meta_value'] = '1';
                    $args['meta_compare'] = "=";
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




//addon
// Display fields in the product variation settings
function display_variation_addons_fields($loop, $variation_data, $variation) {
    echo '<div class="options_group">';
    $qty_of_addons = get_post_meta($variation->ID, "quantity_of_addons", true) ? get_post_meta($variation->ID, "quantity_of_addons", true) : 0;
    $selected_product_value = get_post_meta($variation->ID, "addon_product", true) ? get_post_meta($variation->ID, "addon_product", true) : 0;

    $select_args =         array(
        'id'      => 'addon_product_' . $loop,
        'label'   => __('Addon Product', 'woocommerce'),
        'options' => get_products_as_options(),
    );

    if($selected_product_value !== 0){
        $select_args['value'] = $selected_product_value;
    }

    woocommerce_wp_select($select_args);

    woocommerce_wp_text_input(
        array(
            'id'          => 'quantity_of_addons_' . $loop,
            'label'       => __('Quantity of Addons', 'woocommerce'),
            'desc_tip'    => 'true',
            'value'       => $qty_of_addons,
            'description' => __('Enter the quantity of addons for this variation.', 'woocommerce'),
            'type'        => 'number',
            'custom_attributes' => array(
                'step' => '1',
                'min'  => '0',
            ),
        )
    );

    echo '</div>';
}
add_action('woocommerce_product_after_variable_attributes', 'display_variation_addons_fields', 10, 3);

// Save custom fields for each variation
function save_variation_addons_fields($variation_id, $loop) {
    $addon_product = $_POST['addon_product_' . $loop];
    $quantity_of_addons = $_POST['quantity_of_addons_' . $loop];

    var_dump($variation_id, $addon_product, $quantity_of_addons);

    // if (!empty($addon_product)) {
        update_post_meta($variation_id, 'addon_product', esc_attr($addon_product));
    // }

    // if (!empty($quantity_of_addons)) {
        update_post_meta($variation_id, 'quantity_of_addons', esc_attr($quantity_of_addons));
    // }
    var_dump(get_post_meta( $variation_id ));
}
add_action('woocommerce_save_product_variation', 'save_variation_addons_fields', 10, 2);

// Helper function to get products as options
function get_products_as_options() {
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
    );

    $products = get_posts($args);
    $options = array();

    foreach ($products as $product) {
        $options[$product->ID] = $product->post_title;
    }

    return $options;
}
?>