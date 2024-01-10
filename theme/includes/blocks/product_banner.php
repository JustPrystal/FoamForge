<?php
    $desktop_img = $block["settings"]["desktop"]["background_image"];
    $tablet_img = $block["settings"]["tablet"]["background_image"];
    $mobile_img = $block["settings"]["mobile"]["background_image"];

    $desktop_text_color = $block["settings"]["desktop"]["text_color"];
    $tablet_text_color = $block["settings"]["tablet"]["text_color"];
    $mobile_text_color = $block["settings"]["mobile"]["text_color"];
    
    $desktop_alignment = $block["settings"]["desktop"]["alignment"];
    $tablet_alignment = $block["settings"]["tablet"]["alignment"];
    
    if ($block["enable_custom_heights"]){
        $desktop_section_height = $block["settings"]["desktop"]["section_height"];
        $tablet_section_height = $block["settings"]["tablet"]["section_height"];
        $mobile_section_height = $block["settings"]["mobile"]["section_height"];
    }
?>

<style>
    .product-banner{
        width: 100%;
        <?php if ($desktop_img){ ?>
                background-image: url('<?php echo $desktop_img ?>');
        <?php } ?>
        <?php if ($desktop_section_height){ ?>
                height: <?php echo $desktop_section_height ?>px;
        <?php } else { ?>
            height: 800px;            
        <?php } ?>
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        display: flex;
        align-items: center;
        margin: 30px 0;
    }
    .product-banner .inner{
        max-width: 1200px;
        width: 100%;
        padding: 100px 20px;
        margin: 0 auto;
    }
    .product-banner .inner .content{
        color: <?php echo $desktop_text_color ?>;
        display: flex;
        flex-direction: column; 
        max-width: 550px;
        <?php if ($desktop_alignment == "left"){ ?>
            margin-right: auto;
        <?php } else if ($desktop_alignment == "center"){?>
            margin: 0 auto;
        <?php } else if ($desktop_alignment == "right"){?>
            margin-left: auto;
        <?php } ?>
    }
    .product-banner .inner .content .heading{
        text-align: center;
        text-transform: uppercase;
        font-weight: 600;
        font-size: 66px;
        line-height: 85%;
        margin-bottom: 15px;
    }
    .product-banner .inner .content .description{
        text-align: center;
        font-size: 22px;
        margin-bottom: 20px;
    }
    @media (max-width: 991px){
        .product-banner{
            <?php if ($tablet_img){ ?>
                    background-image: url('<?php echo $tablet_img ?>');
            <?php } ?>
            <?php if ($tablet_section_height){ ?>
                    height: <?php echo $tablet_section_height ?>px;
            <?php } else { ?>
                height: 600px;            
            <?php } ?>
            display: flex;
            align-items: flex-end;
        }
        .product-banner .inner{
            padding: 60px 20px;
        }
        .product-banner .inner .content{
            color: <?php echo $tablet_text_color ?>;
            max-width: 550px;
            <?php if ($tablet_alignment == "left"){ ?>
                margin-right: auto;
            <?php } else if ($tablet_alignment == "center"){?>
                margin: 0 auto;
            <?php } else if ($tablet_alignment == "right"){?>
                margin-left: auto;
            <?php } ?>
        }
    }
    @media (max-width: 576px){
        .product-banner{
            <?php if ($mobile_img){ ?>
                    background-image: url('<?php echo $mobile_img ?>');
            <?php } ?>
            <?php if ($mobile_section_height){ ?>
                    height: <?php echo $mobile_section_height ?>px;
            <?php }  else { ?>
                height: 500px;            
            <?php } ?>
            display: flex;
            align-items: flex-end;
        }
        .product-banner .inner{
            padding: 22px 0;
        }
        .product-banner .inner .content{
            color: <?php echo $mobile_text_color ?>;
            max-width: 100%;
        }
        .product-banner .inner .content .heading{
            margin-bottom: 20px;
            line-height: 85%;
            font-size: 56px;
        }
        .product-banner .inner .content .description{
            font-size: 20px;
        }
    }
</style>

<div class="product-banner">
    <div class="inner">
        <div class="content">
            <?php if ($block["heading"]) {?>
                <div class="heading"><?php echo $block["heading"]?></div>
            <?php } ?>
            <?php if ($block["description"]) {?>
                <div class="description"><?php echo $block["description"]?></div>
            <?php } ?>
        </div>
    </div>
</div>