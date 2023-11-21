<section class="two-column">
    <div class="inner <?php if($block["block_orientation"]){ echo "inverted ";} ?>">
        <div class="left">
            <div class="heading"><?php echo $block["heading"];?></div>
            <div class="description"><?php echo $block["description"];?></div>
        </div>
        <div class="right">
            <img src="<?php echo $block["image"];?>" alt="" class="image">
        </div>
    </div>
</section>
