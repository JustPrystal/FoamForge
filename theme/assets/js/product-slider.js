jQuery(window).on('load', function(){   

    var sliderArgs = {
        slidesToShow:1,
        slidesToScroll:1,
        arrows:false,
        dots:false,
        infinite:true,
    }
    if(jQuery('.product-slider .slide-item:not(.slick-cloned)').length >= 4){
        sliderArgs.asNavFor = '.product-slider-thumbs';
    }
    jQuery('.product-slider.slider-active').slick(sliderArgs);
    
    jQuery('.product-slider-thumbs.slider-active').slick({
        slidesToShow:3,
        slidesToScroll:1,
        arrows:false,
        dots:false,
        centerPadding:0,
        infinite:true,
        centerMode:true,
        infinite:true,
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