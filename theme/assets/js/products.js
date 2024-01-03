jQuery(document).ready(function(){
    jQuery('.input-text.qty').change(function(){
        var that = jQuery('.add-to-cart-btn .product-price');
        
        // if(jQuery('.woocommerce-variation.single_variation').css('display') != 'none' || !jQuery('.woocommerce-variation.single_variation').is(':empty') || (!!jQuery(".woocommerce-variation"))){
        // added this on the first day for idk what reason, keeping it here in case of future debugging

        //changing tier display
        setTimeout(() => {
            let currentTier = jQuery(".pricing-table-wrapper .tiered-pricing--active td:first-child>span").text().trim();
            jQuery(".display-price-tier .tier").text("Current Quantity Discount Tier: " + currentTier);
        }, 100);
        
        if(jQuery('.woocommerce-variation.single_variation').css('display') != 'none' || !jQuery('.woocommerce-variation.single_variation').is(':empty') ){
            var qty = jQuery(this).val();
            if( qty < 0 ){
                qty = 1;
            }
            setTimeout(() => {
                var price;
                if (jQuery(".tiered-pricing-dynamic-price-wrapper").find("ins").length != 0){
                    price = jQuery(".price ins .woocommerce-Price-amount").text().replace("$","");
                }else{
                    price = jQuery(".price .woocommerce-Price-amount").text().replace("$","");
                }
                var newPrice = parseFloat(qty) * parseFloat(price);
                jQuery(".add-to-cart-btn-wrap .sku-wrap .top .product-each .each-price").addClass("show")
                jQuery(".add-to-cart-btn-wrap .sku-wrap .top .product-each .each-price .value").text("")
                jQuery(".add-to-cart-btn-wrap .sku-wrap .top .product-each .each-price .value").text(parseFloat(price))
                that.html('$'+ newPrice.toFixed(2));
            }, 100);
        }
        if($(".product").hasClass("product-type-simple")){
            $('button.add-to-cart-btn').addClass('active');
        }
    })

    function isOneVariantSelected(){
        var isSelected = false;
        jQuery('form.variations_form .variations select').each(function(){
            if(jQuery(this).val() != ''){
                return isSelected = true;
            }
        })

        return isSelected;
    }
    function checkAllVariations(){
        var isEmpty = false;
        jQuery('form.variations_form .variations select').each(function(){
            if(jQuery(this).val() == ''){
                isEmpty = true;
            }
        })

        return isEmpty;
    }
    jQuery(".view-all-tiers").click(function(){
        jQuery(".pricing-table-wrapper").addClass("open")
    })
    jQuery(".pricing-table-wrapper .cross").click(function(){
        jQuery(".pricing-table-wrapper").removeClass("open")
    })
    jQuery('form.variations_form .variations select:not(.magnet_size_dropdown)').select2({
        width: '100%',
        minimumResultsForSearch: Infinity,
    });
    jQuery('form.variations_form .reset_variations').click(function(){
        jQuery(this).attr('style', '');
    })
    jQuery('form.variations_form .variations select').change(function(){
        var isEmpty = checkAllVariations();
        var isOneSelected = isOneVariantSelected();

        if(isOneSelected){
            jQuery('.reset_variation').addClass('show');
        }
        else{
            jQuery('.reset_variation').removeClass('show');
        }

        if(isEmpty){
            jQuery('.add-to-cart-btn .product-price').html('');
        }else{
            jQuery('button.add-to-cart-btn').addClass('active');
            // let fire = setInterval(() => {
            //     if ($('.tpt__tiered-pricing').children().length > 0){
            //         let currentTier = jQuery(".pricing-table-wrapper .tiered-pricing--active td:first-child>span").text().trim();
            //         jQuery(".display-price-tier .tier").text("Current Quantity Discount Tier: " + currentTier);
            //         jQuery(".display-price-tier").addClass("show")
            //         clearInterval(fire);
            //     }else{
            //         console.log("table loading...")
            //     }
            // }, 100);
        }
    })
    
    jQuery('.accordions-wrap .accordion-header').click(function(){
        console.log('clicked');
        if(jQuery(this).parent().hasClass('active')){
            jQuery(this).parent().removeClass('active')
            jQuery(this).parent().find('.accordion-body').slideUp();
        }else{
            jQuery('.accordions-wrap .accordion-body').slideUp();
            jQuery('.accordions-wrap .accordion-item').removeClass('active');
            jQuery(this).parent().addClass('active')
            jQuery(this).parent().find('.accordion-body').slideDown();
        }
    })
    
    jQuery(document.body).on('click', '.variation-item .custom-switches .switch-item', function(){
        var val = jQuery(this).data('val');
        jQuery(this).parents('.value').find('select').val(val).change();
    
        if(jQuery(this).parents('.value').find('select').val() == val){
            jQuery(this).parent().find('.switch-item').removeClass('active');
            jQuery(this).addClass('active');
        }
        else{
            jQuery(this).parent().find('.switch-item').removeClass('active');
            alert('This variation is out of stock');
        }
    })

    function convert_metric_size_to_imperial(state){

        if(!state.id){
            return jQuery('<span class="metric_value"> Metric Scale</span>  <span class="imperial_value"> Imperial Scale </span>');
        }
        
        var metric_value = state.text;
        
        var imperial_value = get_imperial_values_from_metric(metric_value);

        var $html = jQuery('<span class="metric_value">'+ metric_value +'</span>  <span class="imperial_value"> '+ imperial_value +' </span>');

        return $html;

    }

    function get_imperial_values_from_metric(metric_value){
        var stripped_value = metric_value.replaceAll(" ", "").replace("(D)", "").replace("(T)", "");
        var values = stripped_value.split('x');

        // convert to imperial
        var convertedValues = [];

        for(i = 0 ; i < values.length ; i++){
            if(values[i].includes('mm')){
                convertedValues[i] = i == 0 ? (parseInt(values[i].replace('mm')) / 25.4).toFixed(3) + "\" (D)" : (parseInt(values[i].replace('mm')) / 25.4).toFixed(3) + "\" (T)";
            }
            else if(values[i].includes('cm')){
                convertedValues[i] = i == 0 ? (parseInt(values[i].replace('cm')) / 2.54).toFixed(2) + "\" (D)" : (parseInt(values[i].replace('cm')) / 2.54).toFixed(2) + "\" (T)";
            }
        }
        
        var imperial_value = convertedValues.toString().replace(',', " x ");

        return imperial_value;
    }
    jQuery('form.variations_form .variations select.magnet_size_dropdown').select2({
        width: '100%',
        minimumResultsForSearch: 10,
        templateResult: convert_metric_size_to_imperial,
    });
    jQuery('form.variations_form .variations select.magnet_size_dropdown').change(function(){
        jQuery('.variation-conversion-imperial').html('Imperial Conversion: ' + get_imperial_values_from_metric(jQuery(this).val())); 
    })

    jQuery('.cart .quantity-wrap .qty-controls').click(function(){
        var current_value = jQuery(this).parent().find('input').val()
        if(current_value == ""){
            current_value = 0;
        }
        if(jQuery(this).hasClass('qty-up')){
            jQuery(this).parent().find('input').val(parseInt(current_value) + 1).change()    
        }
        else if( jQuery(this).hasClass('qty-down')){
            if(current_value == 1){
                return;
            }
            jQuery(this).parent().find('input').val(parseInt(current_value) - 1).change()  
        }
    })
    jQuery(".cart .quantity-wrap .quantity input").change(function(){
        if(jQuery(this).val() < 0){
            jQuery(this).val(1)
        }
    })
    jQuery(".hide-filters, .hide-filters-mobile").click(function(){
        if(!$(".filters").hasClass("close")){
            $(".hide-filters .text").text("show filters")
            $(".filters").addClass("close")
            $(".hide-filters-mobile").addClass("cross")
        }else{
            $(".hide-filters .text").text("hide filters")
            $(".filters").removeClass("close")
            $(".hide-filters-mobile").removeClass("cross")
        }
    })
    jQuery(window).resize(function(){
        if(jQuery(window).innerWidth() <= 767){
            $(".filters").removeClass("close")
            $(".hide-filters-mobile").removeClass("cross")
            $(".hide-filters .text").text("hide filters")
        }
    })

    jQuery(".faq-question").click(function(){
        if($(this).parent().find(".faq-answer").css("display") == "none"){
            $(this).parent().find(".faq-answer").slideDown()
        }else{
            $(this).parent().find(".faq-answer").slideUp()
        }
    })

    //searchbar
    jQuery(document).ready(function($) {
        $('#searchform input').on('input', function() {
            var searchTerm = $(this).val();
    
            // Perform AJAX request to get search results
            $.ajax({
                type: 'POST',
                url: ajaxurl, // WordPress AJAX endpoint
                data: {
                    action: 'custom_search_action',
                    searchTerm: searchTerm,
                },
                success: function(response) {
                    // Update the container with the search results
                    $('#search-results-container').html(response);
                },
                error: function(error) {
                    console.error('AJAX error:', error);
                }
            });
        });
    });
    $('.input-text.qty').keydown(function(e){
        let allowedKeys = ["ArrowUp", "Backspace", "ArrowDown", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0"]
        if (navigator.userAgent.indexOf("Firefox") > 0){
            if (!allowedKeys.includes(e.key)){
                e.preventDefault();
            }
        }
        if(e.key === 'Enter'){
            $('.input-text.qty').blur()
        }
    })
    $(".aws-wrapper input[type='search']").keydown(function(e){
        if(e.key === 'Enter'){
            e.preventDefault()
        }
    })
    $(".search-icon").click(function(){
        $(".search-modal").stop().fadeToggle()
        // $("body").toggleClass("noscroll")
    })
    $(".cross").click(function(){
        $(".search-modal").stop().fadeOut()
        // $("body").removeClass("noscroll")
    })




    $( ".single_variation_wrap" ).on( "show_variation", function ( event, variation ) { 
        var variation_id = variation.variation_id; 
        jQuery(".product-meta-description-box").addClass('loading')
        jQuery.ajax({
            url: window.ajaxUrl,
            type:"POST",
            data:{
                action: "ff_load_product_meta_box",
                id: variation_id,
            },
            success: function(response){
                jQuery('.product-meta-description-box').replaceWith( response.data["html"] );
                jQuery(".product-meta-description-box").removeClass('loading');
            },
            error: function(response){
                //ERROR Handing;
                console.log(response);
                jQuery(".product-meta-description-box").removeClass('loading');
            }
        })
    });
    $('form.cart').on('submit', function(e) {
        e.preventDefault();

        let products = {};

        let qty = parseInt(jQuery('.input-text.qty').val());
        products["product_quantity"] = qty;

        let productID = parseInt($(this).attr("data-product_id"));
        products["product"] = productID;
        
        let variationID = parseInt($(this).find(".variation_id").attr("value"));
        if(variationID){
            products["product"] = variationID;
        }

        if($("input[name=addon_checkbox]").prop('checked')){
            let addonID = parseInt(jQuery(".addons-available").attr("data-addon_id"))
            products["addon"] = addonID;

            let addonQty = parseInt(jQuery(".addons-available").attr("data-addon_qty")) * qty;
            products["addon_quantity"] = addonQty;
        }

        $.ajax({
            type: 'POST',
            url: window.ajaxUrl, // The AJAX handler URL
            data: {
                action: 'add_products_to_cart', // The server-side function to handle the request
                products: products,
            },
            success: function (response) {
                // Redirect to the cart page after adding products
                // window.location.href = response.redirect_url;
            },
        });
   
       })
});
