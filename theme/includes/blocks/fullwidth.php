<section class="fullwidth" style="background-image: url('<?php echo $block["background_image"];?>');">
    <div class="inner">
        <div class="content">
            <div class="heading"><?php echo $block["heading"];?></div>
            <div class="description"><?php echo $block["description"];?></div>
        </div>
        <div class="boxes">
            <?php 
            if($block["boxes"]){
                foreach($block["boxes"] as $box){?>
                    <div class="box">
                        <img class="icon" src="<?php echo $box["icon"]?>" alt="">
                        <div class="text"><?php echo $box["text"];?></div>
                    </div>
                <?php } 
            } ?>
        </div>
    </div>
</section>
