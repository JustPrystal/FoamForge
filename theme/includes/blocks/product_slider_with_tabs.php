<?php
    $dot = get_field('dot','options');
    $left = get_field('left','options');
    $right = get_field('right','options');
?>
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
            <?php $i = 0 ?>
            <?php foreach ($block["tabs"] as $tab) { ?>
                <div class="tab-products <?php if ($i != 0) {
                    echo "hidden";
                } ?> <?php echo strtolower(str_replace(' ', '-', $tab["tab_name"])); ?>"
                    data-index="<?php echo $i; ?>">
                   
                    <?php foreach ($tab["products"] as $product_id) { ?>
                        <?php $_product = wc_get_product($product_id); ?>
                        <div class="product-item">
                            <a href="<?php echo get_the_permalink($product_id); ?>">
                                <div class="image-wrap">
                                    <img src="<?php echo wp_get_attachment_url($_product->get_image_id()); ?>" alt="">
                                </div>
                                <div class="text-col">
                                    <div class="sub-title"><?php echo get_field('subtitle', $product_id); ?></div>
                                    <div class="product-name"><?php echo $_product->get_name(); ?></div>
                                </div>
                                <div class="short_description">
                                    <?php echo $_product->short_description; ?>
                                </div>
                                <div class="price">
                                    $<?php echo $_product->price; ?>
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
        customPaging : function(slider,i) {
            return `<img src="<?php echo $dot;?>" alt="">`;
        },
        prevArrow: `<img src="<?php echo $left;?>" alt="">`,
        nextArrow: `<img src="<?php echo $right;?>" alt="">`,
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
    });

    $(".tab").click(function () {
        $(".tab").removeClass("active")
        $(this).addClass("active")
        let tabNo = parseInt($(`.tab-products${$(this).attr("data-target")}`).attr("data-index"))
        $(".tab-products").css("transform",`translateX(calc(${tabNo * -100}% )`);
        $(".tab-products").addClass("hidden")
        $(`.tab-products[data-index=${tabNo}]`).removeClass("hidden")
    })
</script>