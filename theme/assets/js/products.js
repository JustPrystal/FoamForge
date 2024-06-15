jQuery(document).ready(function(){
    jQuery('.input-text.qty').change(function(){
        var that = jQuery('.add-to-cart-btn .product-price');

        setTimeout(() => {
            let currentTier = jQuery(".pricing-table-wrapper .tiered-pricing--active td:first-child>span").text().trim();
            jQuery(".display-price-tier .tier").text("Quantity Discount Tier: " + currentTier);
        }, 100);
        
        if(!$(".product-type-variable").length > 0){
            var qty = jQuery(this).val();
            if( qty < 0 ){
                qty = 1;
            }
            setTimeout(() => {
                var price = jQuery(".tiered-pricing-dynamic-price-wrapper ins").length !== 0 ? jQuery(".price ins .woocommerce-Price-amount").text().replace("$", "") : jQuery(".price .woocommerce-Price-amount").text().replace("$", "");

                if ($('.tpt__tiered-pricing').children().length > 0){
                    let currentTier = jQuery(".pricing-table-wrapper .tiered-pricing--active td:first-child>span").text().trim();
                    jQuery(".display-price-tier .tier").text("Quantity Discount Tier: " + currentTier);
                    jQuery(".display-price-tier").addClass("show")
                }

                var newPrice = parseFloat(qty) * parseFloat(price);
                jQuery(".add-to-cart-btn-wrap .sku-wrap .row .product-each .each-price").addClass("show")
                jQuery(".add-to-cart-btn-wrap .sku-wrap .row .product-each .each-price .value").text("")
                jQuery(".add-to-cart-btn-wrap .sku-wrap .row .product-each .each-price .value").text(parseFloat(price))
                that.html('$'+ newPrice.toFixed(2));
            }, 100);
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
        // placeholder : ''
    });
    jQuery('form.variations_form .variations select:not(.magnet_size_dropdown)').each(function() {
        var element = $(this);
        element.select2({
            width: '100%',
            minimumResultsForSearch: Infinity,
            placeholder : element.find("option").eq(0).text()
        })
    })
    jQuery('form.variations_form .reset_variations').click(function(){
        jQuery(this).attr('style', '');
        jQuery(".display-price-tier").removeClass("show")
        jQuery(".switch-item").removeClass("active")
        jQuery(".variation-conversion-imperial").html("")
        jQuery(".product-meta-description-box").html("")
        jQuery('button.add-to-cart-btn').removeClass('active');
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
    jQuery(".variation-item select").change(function(){
        for (let i = 1; i < ($(".variation-item").length - $(this).parents(".variation-item").index() ); i++) {
            var indexOfVariationThatNeedsToBeReset = $(this).parents(".variation-item").index() + i;
            $(".variation-item").eq(indexOfVariationThatNeedsToBeReset).find("select").val("").change()
            $(".variation-item").eq(indexOfVariationThatNeedsToBeReset).find(".switch-item").removeClass("active")
            jQuery(".variation-conversion-imperial").html("")
            jQuery(".product-meta-description-box").html("")
            jQuery('button.add-to-cart-btn').removeClass('active');
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

    jQuery('.cart .quantity-wrap .control-wrap').click(function(){
        var current_value = jQuery(this).parent().find('input').val()
        if(current_value == ""){
            current_value = 0;
        }
        if(jQuery(this).hasClass('up')){
            jQuery(this).parent().find('input').val(parseInt(current_value) + 1).change()    
        }
        else if( jQuery(this).hasClass('down')){
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
    jQuery(document.body).on('click', '.hide-filters', function(){
        if(!jQuery(".filters").hasClass("close")){
            jQuery(".hide-filters .text").text("show filters")
            jQuery(".filters").addClass("close")
            jQuery(".hide-filters-mobile").addClass("cross")
        }else{
            jQuery(".hide-filters .text").text("hide filters")
            jQuery(".filters").removeClass("close")
            jQuery(".hide-filters-mobile").removeClass("cross")
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
    })
    $(".cross").click(function(){
        $(".search-modal").stop().fadeOut()
    })




    $( ".single_variation_wrap" ).on( "show_variation", function ( event, variation ) { 
        var variation_id = variation.variation_id; 
        jQuery(".product-meta-description-box").addClass('loading')
        jQuery("button.add-to-cart-btn").attr("disabled", true).addClass("disabled").removeClass('active').text("Loading...");
        jQuery(".product-slider").addClass("loading");
        jQuery.ajax({
            url: window.ajaxUrl,
            type:"POST",
            data:{
                action: "ff_load_product_meta_box",
                id: variation_id,
            },
            success: function(response){
                if(response.data.fragments){
                    jQuery.each(response.data.fragments, function(key, value){
                        jQuery(key).replaceWith(value)
                    })
                }
                jQuery(".product-meta-description-box").removeClass('loading');
                jQuery("button.add-to-cart-btn").attr("disabled", false).removeClass('disabled');
                jQuery(".product-slider").removeClass("loading");
                setTimeout(() => {
                    if ($('.tpt__tiered-pricing').children().length > 0){
                        let currentTier = jQuery(".pricing-table-wrapper .tiered-pricing--active td:first-child>span").text().trim();
                        jQuery(".display-price-tier .tier").text("Quantity Discount Tier: " + currentTier);
                        jQuery(".display-price-tier").addClass("show")
                    }
                }, 100);
                let updatePrice = function(){
                    let qty = parseInt(jQuery('.input-text.qty').val());
                    var price = jQuery(".tiered-pricing-dynamic-price-wrapper ins").length !== 0 ? jQuery(".price ins .woocommerce-Price-amount").text().replace("$", "") : jQuery(".price .woocommerce-Price-amount").text().replace("$", "");

                    if($("input[name=addon_checkbox]").prop('checked')){
                        var newPrice =  parseFloat(qty) * ( response.data["addon_price"] + parseFloat(price) );
                    } else{
                        var newPrice =  parseFloat(qty) * parseFloat(price);
                    }   
                    jQuery(".product-meta-description-box .row.product .item-price").html("")
                    jQuery(".product-meta-description-box .row.product .item-price").html("<strong>EACH: </strong>$" + parseFloat(price))
                    jQuery('.add-to-cart-btn .product-price').html('$'+ newPrice.toFixed(2));
                }

                $("input[name=addon_checkbox]").change(updatePrice)
                $('.input-text.qty').change(updatePrice)

            },
            error: function(response){
                //ERROR Handing;
                jQuery(".product-meta-description-box").removeClass('loading');
                console.log(response)
            }
        })
    });
    $('form.cart').on('submit', function(e) {
        e.preventDefault();

        let products = {};
        products["product"] = {
            "ID" : parseInt($(this).attr("data-product_id")),
            "quantity" : parseInt(jQuery('.input-text.qty').val()),
        };

        //check if button is disabled
        if(jQuery('.add-to-cart-btn').hasClass('disabled')){
            return;
        }

        if(jQuery(".product-type-variable").length > 0){
            products["product"]["ID"] = parseInt($(this).find(".variation_id").attr("value"));
        }

        if($("input[name=addon_checkbox]").prop('checked')){
            products["addon"] = {
                "ID": parseInt(jQuery(".addons-available").attr("data-addon_id")),
                "quantity": parseInt(jQuery(".addons-available").attr("data-addon_qty")) * products["product"]["quantity"],
            };        
        }

        $.ajax({
            type: 'POST',
            url: window.ajaxUrl,
            data: {
                action: 'add_products_to_cart',
                products: products,
            },
            success: function (response) {
                $('.ff_notices .ff_notices-wrap').html("")
                response.forEach(item => {
                    var div = $('<div class="ff_notice">');
                    if (item["message"]) {
                        div.addClass("success");
                        div.text(item["message"]);
                        $(".redirect-cart").attr("href", item["redirect_to"]);
                        $(".redirect-cart").text("View Cart");
                    } else if (item["error"]) {
                        div.addClass("error");
                        div.text(item["error"]);
                    }
                    $('.ff_notices .ff_notices-wrap').append(div);
                });
            },
        });
   
       })


       //variation media gallery script

       var mediaFrame;

       // Add gallery images
       jQuery('.woocommerce_variation').on('click', '.add_variation_gallery_images', function(e){
            console.log("add")
           e.preventDefault();

           var button = $(this);
           var loop = button.data('loop');

           // If the media frame already exists, reopen it.
           if (mediaFrame) {
               mediaFrame.open();
               return;
           }

           // Create a new media frame
           mediaFrame = wp.media({
               title: '<?php _e("Add Gallery Images", "woocommerce"); ?>',
               button: {
                   text: '<?php _e("Add to gallery", "woocommerce"); ?>'
               },
               multiple: true
           });

           // When an image is selected, run a callback
           mediaFrame.on('select', function(){
               var attachments = mediaFrame.state().get('selection').toJSON();
               var attachment_ids = [];
               var image_html = '';

               attachments.forEach(function(attachment){
                   attachment_ids.push(attachment.id);
                   image_html += '<div class="variation-gallery-image" data-attachment_id="' + attachment.id + '">';
                   image_html += '<img src="' + attachment.sizes.thumbnail.url + '" />';
                   image_html += '<button type="button" class="button remove_variation_gallery_image">&times;</button>';
                   image_html += '</div>';
               });

               $('#_variation_gallery_images' + loop).val(attachment_ids.join(','));
               button.siblings('.variation-gallery-images').html(image_html);
           });

           // Finally, open the modal
           mediaFrame.open();
       });
        // Remove gallery images
        jQuery('body').on('click', '.remove_variation_gallery_image', function(e){
        e.preventDefault();

        var button = $(this);
        var container = button.closest('.variation-gallery-image');
        var attachment_id = container.data('attachment_id');
        var hidden_field = container.closest('.options_group').find('input.variation-gallery-field');

        var attachment_ids = hidden_field.val().split(',');
        attachment_ids = attachment_ids.filter(function(id) {
            return id != attachment_id;
        });

        hidden_field.val(attachment_ids.join(','));
        container.remove();
    });
});
