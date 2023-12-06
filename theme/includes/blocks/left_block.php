<section class="left-block" >
    <img src="<?php echo $block["background_image"];?>" alt="" class="bg">
    <img src="<?php echo $block["mobile_background_image"];?>" alt="" class="bg-m">
    <div class="inner">
        <div class="content">
            <div class="heading"><?php echo $block["heading"]?></div>
            <div class="description"><?php echo $block["description"]?></div>
            <?php if ($block["button"]){?>
                <a href="<?php echo $block["button"]["url"]?>" class="button"><?php echo $block["button"]["title"]?></a>
            <?php } ?>
        </div>
    </div>
</section>