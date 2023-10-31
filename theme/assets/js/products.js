jQuery(document).ready(function(){
    jQuery('.input-text.qty').change(function(){
        var that = jQuery('.add-to-cart-btn .product-price');
        if(jQuery('.woocommerce-variation.single_variation').css('display') != 'none' || !jQuery('.woocommerce-variation.single_variation').is(':empty')){
            var qty = jQuery(this).val();
            var price = jQuery('.woocommerce-variation.single_variation bdi').text().replace("$","");        
            var newPrice = parseFloat(qty) * parseFloat(price);

            that.html('$'+ newPrice);
        }
        else{
            that.html('pee');
        }
    })
    function checkAllVariations(){
        var isEmpty = false;
        jQuery('form.variations_form .variations select').each(function(){
            if(jQuery(this).val() == ''){
                isEmpty = true;
            }
        })

        return isEmpty;
    }
    jQuery('form.variations_form .variations select').change(function(){
        var isEmpty = checkAllVariations();
        
        if(isEmpty){
            jQuery('.add-to-cart-btn .product-price').html('');
        }
    })
});