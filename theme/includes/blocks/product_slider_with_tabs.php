<section class="product-slider-with-tabs">
    <div class="inner">
        <div class="tabs">
            <?php $i = 1?>
            <?php foreach($block["tabs"] as $tab){?>
                <div class="tab <?php if($i == 1){ echo "active"; }?>" data-target=".<?php echo strtolower(str_replace(' ', '-', $tab["tab_name"])) ;?>"><?php echo $tab["tab_name"]; ?></div>
            <?php 
                $i++;
            } ?>
        </div>
        <div class="tab-product-wrap">
            <?php $i = 0?>
            <?php foreach($block["tabs"] as $tab){?>
                <div class="tab-products <?php if ($i != 0){echo "hidden";}?> <?php echo strtolower(str_replace(' ', '-', $tab["tab_name"])) ;?>" data-index="<?php echo $i;?>">
                   
                    <?php foreach($tab["products"] as $product_id){
                            $_product = wc_get_product($product_id); ?>
                            <div class="product-item">
                                <a href="<?php echo get_the_permalink($product_id);?>">
                                    <div class="image-wrap">
                                    <img src="<?php echo wp_get_attachment_url( $_product->get_image_id() );?>" alt="">
                                    </div>
                                    <div class="text-col">
                                        <div class="sub-title"><?php echo get_field('subtitle', $product_id); ?></div>
                                        <div class="product-name"><?php echo $_product->get_name();?></div>
                                    </div>
                                    <div class="short_description">
                                        <?php echo $_product->short_description;?>
                                    </div>
                                    <div class="price">
                                        $<?php echo $_product->price;?>
                                    </div>
                               
                                </a>
                            </div>
                    <?php } ?>
                </div>
            <?php 
                $i++;
            } ?>
        </div>
    </div>
</section>
<script>
    $(".tab-products").slick({
        slidesToShow: 4,
        slidesToScroll: 4,
        arrows: true,
        dots: true,
        prevArrow : `<svg class="tab-arrow left-arrow"width="64px" height="64px" viewBox="0 0 20.00 20.00" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" transform="rotate(180)" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>arrow_right [#000000]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke-width="0.0002" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-305.000000, -6679.000000)" fill="#000000"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M249.365851,6538.70769 L249.365851,6538.70769 C249.770764,6539.09744 250.426289,6539.09744 250.830166,6538.70769 L259.393407,6530.44413 C260.202198,6529.66364 260.202198,6528.39747 259.393407,6527.61699 L250.768031,6519.29246 C250.367261,6518.90671 249.720021,6518.90172 249.314072,6519.28247 L249.314072,6519.28247 C248.899839,6519.67121 248.894661,6520.31179 249.302681,6520.70653 L257.196934,6528.32352 C257.601847,6528.71426 257.601847,6529.34685 257.196934,6529.73759 L249.365851,6537.29462 C248.960938,6537.68437 248.960938,6538.31795 249.365851,6538.70769" id="arrow_right-[#000000]"> </path> </g> </g> </g> </g></svg>`,
        nextArrow : `<svg class="tab-arrow right-arrow" width="64px" height="64px" viewBox="0 0 20.00 20.00" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" transform="rotate(0)" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>arrow_right [#000000]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke-width="0.0002" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-305.000000, -6679.000000)" fill="#000000"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M249.365851,6538.70769 L249.365851,6538.70769 C249.770764,6539.09744 250.426289,6539.09744 250.830166,6538.70769 L259.393407,6530.44413 C260.202198,6529.66364 260.202198,6528.39747 259.393407,6527.61699 L250.768031,6519.29246 C250.367261,6518.90671 249.720021,6518.90172 249.314072,6519.28247 L249.314072,6519.28247 C248.899839,6519.67121 248.894661,6520.31179 249.302681,6520.70653 L257.196934,6528.32352 C257.601847,6528.71426 257.601847,6529.34685 257.196934,6529.73759 L249.365851,6537.29462 C248.960938,6537.68437 248.960938,6538.31795 249.365851,6538.70769" id="arrow_right-[#000000]"> </path> </g> </g> </g> </g></svg>`,
        // infinite: false,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 568,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    })
    $(".tab").click(function(){
        $(".tab").removeClass("active")
        $(this).addClass("active")
        let tabNo = parseInt($(`.tab-products${$(this).attr("data-target")}`).attr("data-index"))
        $(".tab-products").css("transform",`translateX(calc(${tabNo * -100}% - ${50*(tabNo)}px)`);
        $(".tab-products").addClass("hidden")
        $(`.tab-products[data-index=${tabNo}]`).removeClass("hidden")
    })
</script>