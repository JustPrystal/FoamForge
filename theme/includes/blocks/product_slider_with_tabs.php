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
        prevArrow: `<svg version="1.1" id="Layer_1" class="left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 13.7 27.5" style="enable-background:new 0 0 13.7 27.5;" xml:space="preserve"><style type="text/css">.st0{fill:#5D4837;}.st1{fill:url(#SVGID_1_);}.st2{fill:url(#SVGID_00000053503102409176004440000009816332014141470372_);}.st3{fill:url(#SVGID_00000148621593918764952280000010719075564665403526_);}.st4{opacity:0.77;fill:url(#SVGID_00000137096563831079636130000001382411344729271454_);}</style><g><polygon class="st0" points="0,13.7 13.7,0 13.7,8.4 8.4,13.7 13.7,19.1 13.7,27.5"/><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="8087.3833" y1="13.7461" x2="8100.5435" y2="13.7461" gradientTransform="matrix(-1 0 0 1 8100.8867 0)"><stop offset="0" style="stop-color:#863A14"/><stop offset="9.976499e-02" style="stop-color:#BF8437"/><stop offset="0.1817" style="stop-color:#F5B731"/><stop offset="0.3174" style="stop-color:#C48C21"/><stop offset="0.3878" style="stop-color:#C2891F"/><stop offset="0.4323" style="stop-color:#BB8119"/><stop offset="0.4695" style="stop-color:#AF7210"/><stop offset="0.4791" style="stop-color:#AB6D0C"/><stop offset="0.6728" style="stop-color:#DD9426"/><stop offset="0.7137" style="stop-color:#DE9727"/><stop offset="0.7426" style="stop-color:#E2A02B"/><stop offset="0.7678" style="stop-color:#E8B032"/><stop offset="0.7908" style="stop-color:#F1C63C"/><stop offset="0.8122" style="stop-color:#FCE249"/><stop offset="0.8169" style="stop-color:#FFE94C"/><stop offset="0.8275" style="stop-color:#F9D544"/><stop offset="0.8439" style="stop-color:#F1BD3A"/><stop offset="0.8613" style="stop-color:#ECAC33"/><stop offset="0.8802" style="stop-color:#E9A22F"/><stop offset="0.9034" style="stop-color:#E89F2E"/><stop offset="1" style="stop-color:#B36D14"/></linearGradient><polygon class="st1" points="13.5,19.2 8.1,13.7 13.5,8.3 13.5,0.6 0.3,13.7 13.5,26.9"/><linearGradient id="SVGID_00000146493046353882009630000017098704509836135569_" gradientUnits="userSpaceOnUse" x1="8087.7363" y1="13.7461" x2="8100.0439" y2="13.7461" gradientTransform="matrix(-1 0 0 1 8100.8867 0)"><stop offset="0" style="stop-color:#F9C94A"/><stop offset="7.904284e-02" style="stop-color:#FFF0C3"/><stop offset="0.2044" style="stop-color:#F5EFA2"/><stop offset="0.2753" style="stop-color:#F6E57D"/><stop offset="0.3912" style="stop-color:#F0D56C"/><stop offset="0.5048" style="stop-color:#AD7121"/><stop offset="0.629" style="stop-color:#E2B450"/><stop offset="0.7143" style="stop-color:#ECC45E"/><stop offset="0.7953" style="stop-color:#F1CF6E"/><stop offset="0.904" style="stop-color:#F5EDA4"/><stop offset="1" style="stop-color:#FAD05F"/></linearGradient><polygon style="fill:url(#SVGID_00000146493046353882009630000017098704509836135569_);" points="13.2,19.3 7.6,13.7 13.2,8.2 13.2,1.4 0.8,13.7 13.2,26.1"/><linearGradient id="SVGID_00000036955121048544998310000000628558806433228928_" gradientUnits="userSpaceOnUse" x1="8088.0898" y1="13.7461" x2="8099.5444" y2="13.7461" gradientTransform="matrix(-1 0 0 1 8100.8867 0)"><stop offset="0" style="stop-color:#D0A44A"/><stop offset="0.1337" style="stop-color:#DFBC6A"/><stop offset="0.3935" style="stop-color:#FFF3B3"/><stop offset="0.4979" style="stop-color:#FFF3AB"/><stop offset="0.6561" style="stop-color:#FFF296"/><stop offset="0.7486" style="stop-color:#FFF287"/></linearGradient><polygon style="fill:url(#SVGID_00000036955121048544998310000000628558806433228928_);" points="12.8,2.3 12.8,8 7.1,13.7 12.8,19.5 12.8,25.2 1.3,13.7"/><linearGradient id="SVGID_00000057140081043702165470000006764857935898917513_" gradientUnits="userSpaceOnUse" x1="8088.4111" y1="10.167" x2="8099.0449" y2="10.167" gradientTransform="matrix(-1 0 0 1 8100.8867 0)"><stop offset="0" style="stop-color:#FFFF4A"/><stop offset="0.2815" style="stop-color:#FFFF7A"/><stop offset="0.9194" style="stop-color:#FFFFF1"/><stop offset="0.992" style="stop-color:#FFFFFF"/></linearGradient><path style="opacity:0.77;fill:url(#SVGID_00000057140081043702165470000006764857935898917513_);" d="M1.8,13.7L12.4,3.1 c0,0,0.1,1.7,0,2.2c-0.9,2.1-1.8,3.7-3.2,5.7c-0.7,0.6-2.7,2.7-2.7,2.7s0.6,0.7,0.7,0.8c-0.6,1.1-1.2,1.8-2,2.6C4.3,16.2,1.8,13.7,1.8,13.7z"/></g></svg>`,
        nextArrow: `<svg version="1.1" id="Layer_1" class="right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 13.7 27.5" style="enable-background:new 0 0 13.7 27.5;" xml:space="preserve"><style type="text/css">.st0{fill:#5D4837;}.st1{fill:url(#SVGID_1_);}.st2{fill:url(#SVGID_00000118377237173968627070000000759521859443031948_);}.st3{fill:url(#SVGID_00000009590753662765281440000013812697408493562029_);}.st4{opacity:0.6;fill:url(#SVGID_00000132773367455462325680000015481831465886372774_);}</style><g><polygon class="st0" points="0,19.1 5.3,13.7 0,8.4 0,0 13.7,13.7 0,27.5 	"/><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="0.2423" y1="13.7285" x2="13.3858" y2="13.7285"><stop  offset="0" style="stop-color:#B36D14"/><stop  offset="8.493020e-02" style="stop-color:#E89F2E"/><stop  offset="0.1493" style="stop-color:#FFE94C"/><stop  offset="0.2004" style="stop-color:#F3CA3E"/><stop  offset="0.2536" style="stop-color:#E9B234"/><stop  offset="0.31" style="stop-color:#E2A12C"/><stop  offset="0.3713" style="stop-color:#DE9727"/><stop  offset="0.4465" style="stop-color:#DD9426"/><stop  offset="0.4868" style="stop-color:#DA9225"/><stop  offset="0.5152" style="stop-color:#D18B20"/><stop  offset="0.5398" style="stop-color:#C17F18"/><stop  offset="0.5624" style="stop-color:#AC6E0C"/><stop  offset="0.5629" style="stop-color:#AB6D0C"/><stop  offset="0.7336" style="stop-color:#C48C21"/><stop  offset="0.7799" style="stop-color:#C78E22"/><stop  offset="0.8092" style="stop-color:#CF9625"/><stop  offset="0.8336" style="stop-color:#DEA329"/><stop  offset="0.8554" style="stop-color:#F2B530"/><stop  offset="0.8577" style="stop-color:#F5B731"/><stop  offset="0.9489" style="stop-color:#BF8437"/><stop  offset="1" style="stop-color:#863A14"/></linearGradient><polygon class="st1" points="0.2,19.2 5.7,13.7 0.2,8.3 0.2,0.6 13.4,13.7 0.2,26.9 	"/><linearGradient id="SVGID_00000064313108515358264260000009796618448172010422_" gradientUnits="userSpaceOnUse" x1="0.5951" y1="13.7285" x2="12.8869" y2="13.7285"><stop  offset="7.218680e-02" style="stop-color:#FAD05F"/><stop  offset="0.147" style="stop-color:#F5EDA4"/><stop  offset="0.3763" style="stop-color:#F1CF6E"/><stop  offset="0.4657" style="stop-color:#ECC45E"/><stop  offset="0.5676" style="stop-color:#E2B450"/><stop  offset="0.6528" style="stop-color:#AD7121"/><stop  offset="0.7152" style="stop-color:#F0D56C"/><stop  offset="0.7921" style="stop-color:#F6E57D"/><stop  offset="0.8441" style="stop-color:#F5EFA2"/><stop  offset="0.8919" style="stop-color:#FFF0C3"/><stop  offset="1" style="stop-color:#F9C94A"/></linearGradient><polygon style="fill:url(#SVGID_00000064313108515358264260000009796618448172010422_);" points="0.6,19.3 6.2,13.7 0.6,8.2 0.6,1.4 12.9,13.7 0.6,26 "/><linearGradient id="SVGID_00000075850994960430764760000006915483973525492867_" gradientUnits="userSpaceOnUse" x1="0.9478" y1="13.7285" x2="12.3881" y2="13.7285"><stop  offset="7.978720e-03" style="stop-color:#FFF287"/><stop  offset="0.2287" style="stop-color:#FFF3B3"/><stop  offset="0.3265" style="stop-color:#FCEDAB"/><stop  offset="0.475" style="stop-color:#F2DD96"/><stop  offset="0.6559" style="stop-color:#E3C474"/><stop  offset="0.8389" style="stop-color:#D0A44A"/><stop  offset="0.9344" style="stop-color:#B48438"/><stop  offset="1" style="stop-color:#9E6B2B"/></linearGradient><polygon style="fill:url(#SVGID_00000075850994960430764760000006915483973525492867_);" points="0.9,2.3 0.9,8 6.7,13.7 0.9,19.4 0.9,25.2 12.4,13.7 "/><linearGradient id="SVGID_00000115485479221170692600000001223794636690810029_" gradientUnits="userSpaceOnUse" x1="1.3006" y1="7.224" x2="7.0704" y2="7.224"><stop  offset="0" style="stop-color:#FFFF4A"/><stop  offset="0.2815" style="stop-color:#FFFF7A"/><stop  offset="0.9194" style="stop-color:#FFFFF1"/><stop  offset="0.992" style="stop-color:#FFFFFF"/></linearGradient><path style="opacity:0.6;fill:url(#SVGID_00000115485479221170692600000001223794636690810029_);" d="M4.6,11.2 C3.1,9.5,1.3,7.9,1.3,7.9V3.1c0,0,4.1,4.1,5.7,5.7C7.6,9.4,5.3,11.9,4.6,11.2z"/></g></svg>`,
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