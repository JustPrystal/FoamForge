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






//addons
// Add this code to your theme's functions.php file or use a custom plugin.

function display_variation_addons_fields($loop, $variation_data, $variation) {
    // ACF field keys
    $type_of_screws_key = 'field_type_of_screws'; // Replace with your ACF field key for type_of_screws
    $number_of_screws_key = 'field_number_of_screws'; // Replace with your ACF field key for number_of_screws

    // Retrieve values for each variation
    $type_of_screws_value = get_post_meta($variation->ID, $type_of_screws_key, true);
    $number_of_screws_value = get_post_meta($variation->ID, $number_of_screws_key, true);

    // Get a list of products for the dropdown
    $products = get_posts(array(
        'post_type' => 'product',
        'numberposts' => -1,
    ));

    // Display fields
    echo '<div class="options_group form-row form-row-full">';
    woocommerce_wp_checkbox(
        array(
            'id' => 'add_addons_' . $loop,
            'class' => 'checkbox',
            'label' => __('Add Addons', 'woocommerce'),
            'value' => get_post_meta($variation->ID, '_add_addons', true),
        )
    );

    echo '<p class="form-row form-row-full">';
    echo '<label for="type_of_screws_' . $loop . '">' . __('Type of Screws', 'woocommerce') . '</label>';
    echo '<select id="type_of_screws_' . $loop . '" name="type_of_screws_' . $loop . '">';
    echo '<option value="">' . __('Select Type of Screws', 'woocommerce') . '</option>';

    foreach ($products as $product) {
        echo '<option value="' . $product->ID . '" ' . selected($type_of_screws_value, $product->ID, false) . '>' . $product->post_title . '</option>';
    }

    echo '</select>';
    echo '</p>';

    echo '<p class="form-row form-row-full">';
    echo '<label for="number_of_screws_' . $loop . '">' . __('Number of Screws', 'woocommerce') . '</label>';
    woocommerce_wp_text_input(
        array(
            'id' => 'number_of_screws_' . $loop,
            'class' => 'short',
            'value' => $number_of_screws_value,
            'custom_attributes' => array('step' => 'any', 'min' => '0'),
            'placeholder' => __('Enter number of screws', 'woocommerce'),
        )
    );
    echo '</p>';

    echo '</div>';
}

add_action('woocommerce_product_after_variable_attributes', 'display_variation_addons_fields', 10, 3);

?>