jQuery(window).on('load', function(){   

    var sliderArgs = {
        slidesToShow:1,
        slidesToScroll:1,
        arrows:true,
        dots:false,
        infinite:true,
        prevArrow: ".product-slider-arrow.left",
        nextArrow: ".product-slider-arrow.right",
    }
    $('.product-slider.slider-active').on('init', function(event, slick){
        $(this).css("overflow", "visible")
    });
    if(jQuery('.product-slider .slide-item:not(.slick-cloned)').length >= 4){
        sliderArgs.asNavFor = '.product-slider-thumbs';
    }
    jQuery('.product-slider.slider-active').slick(sliderArgs);
    
    
    let slideLength = jQuery('.product-slider-thumbs.slider-active .slide-item').length <= 3 ? jQuery('.product-slider-thumbs.slider-active .slide-item').length : 3
    jQuery('.product-slider-thumbs.slider-active').slick({
        slidesToShow: slideLength ,
        slidesToScroll:1,
        arrows:false,
        centerPadding:0,
        draggable: true,
        infinite:true,
        centerMode:true,
        asNavFor:'.product-slider',
    })
    jQuery('.product-slider-thumbs .slide-item').click(function(){
        var slideno = jQuery(this).data('slick-index');
        jQuery('.product-slider.slider-active').slick('slickGoTo', parseInt(slideno));
        if(!jQuery(this).hasClass('slick-current')){
            jQuery('.product-slider-thumbs .slide-item').removeClass('slick-current');
            jQuery(this).addClass('slick-current');
        }
    })
    
    

})