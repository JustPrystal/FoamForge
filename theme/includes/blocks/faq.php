<section class="faq">
    <div class="inner">
        <div class="heading"><?php echo $block["heading"] ?></div>
        <div class="faqs">
            <?php foreach($block["faqs"] as $faq){?>
                <div class="faq-item">
                    <div class="faq-question">
                        <?php echo $faq["question"] ?>
                    </div>
                    <div class="faq-answer closed">
                        <?php echo $faq["answer"] ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>