<style>
    .left-block{
        background-image: url('<?php echo $block["background_image"];?>');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .left-block.banner{
        height: <?php echo $block["banner_height"]?>px;
    }
    @media(max-width: 576px){
        .left-block{
            background-image: url('<?php echo $block["mobile_background_image"];?>');
            height:600px;
        }
    }
</style>
<section class="left-block <? if($block["banner"]){ echo " banner" ; } ?>" >
    <div class="inner">
        <div class="content">
            <div class="heading"><?php echo $block["heading"]?></div>
            <div class="description"><?php echo $block["description"]?></div>
            <?php if ($block["button"]){?>
                <a href="<?php echo $block["button"]["url"]?>" class="button"><?php echo $block["button"]["title"]?><img class="button-icon" src="<?php echo $block["button_icon"]?>" alt=""></a>
            <?php } ?>
        </div>
    </div>
</section>
<script>
    if(jQuery(".left-block").hasClass("banner")){
        jQuery(".header").addClass("transparent")
    }

</script>