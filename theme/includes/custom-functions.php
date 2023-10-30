<?php 
    add_theme_support('woocommerce');
    
    add_filter('woocommerce_resize_images', static function() {
        return false;
    });
?>