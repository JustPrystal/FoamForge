<section class="two-column with-shortcode">
    <div class="inner <?php if($block["block_orientation"]){ echo "inverted ";} ?>">
        <div class="left">
            <div class="heading"><?php echo $block["heading"];?></div>
            <div class="description"><?php echo $block["description"];?></div>
        </div>
        <div class="right">
            <?php echo do_shortcode('[wpforms id="608" title="false"]');?>
        </div>
    </div>
</section>
