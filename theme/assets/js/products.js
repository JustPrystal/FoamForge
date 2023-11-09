jQuery(document).ready(function(){
    jQuery('.input-text.qty').change(function(){
        var that = jQuery('.add-to-cart-btn .product-price');
        if(jQuery('.woocommerce-variation.single_variation').css('display') != 'none' || !jQuery('.woocommerce-variation.single_variation').is(':empty')){
            var qty = jQuery(this).val();
            var price = jQuery('.woocommerce-variation.single_variation bdi').text().replace("$","");        
            var newPrice = parseFloat(qty) * parseFloat(price);

            that.html('$'+ newPrice);
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
    jQuery('form.variations_form .variations select').select2({
        width: '100%'
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
    
    jQuery('.product-slider.slider-active').slick({
        slidesToShow:1,
        slidesToScroll:1,
        arrows:false,
        dots:false,
        asNavFor:'.product-slider-thumbs',
    });
    jQuery('.product-slider-thumbs.slider-active').slick({
        slidesToShow:3,
        slidesToScroll:1,
        arrows:false,
        dots:false,
        centerPadding:0,
        centerMode:true,
        asNavFor:'.product-slider',
    })
});
