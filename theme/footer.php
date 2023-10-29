<?php 
    $footer_menu = get_field('footer_menu', 'option');
    $socials = get_field('socials', 'option');
    $newsletter = get_field('enable_newsletter', 'option');
    $copyright = get_field('copyright_text', 'option');
    $bottom_links = get_field('bottom_links', 'option');
?>
  
       
    <div class="footer">
        <div class="inner">
            <div class="footer-row top-row">
                <?php foreach($footer_menu as $menu){
                    ?>
                    <div class="footer-col">
                        <div class="group-name"><?php echo $menu['link_group']; ?></div>
                        <div class="menu">
                            <?php foreach($menu['menu'] as $menu_item){?>
                                <div class="menu-item">
                                    <a href="<?php echo $menu_item['link']['url']?>" target="<?php echo $menu_item['link']['target']?>"><?php echo $menu_item['link']['title']; ?></a>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                    <?php
                }?>
            </div>
            <div class="footer-row socials-row">
                <div class="socials-wrap">
                    <?php foreach($socials as $social_item){?>
                        <div class="social-item">
                            <a href="<?php echo $social_item['url']?>">
                                <img src="<?php echo $social_item['icon']['url']?>" alt="">
                            </a>
                        </div>
                    <?php }?>
                </div>
                <?php if($newsletter){?>
                <div class="newsletter-wrap">
                    <form action="">
                        <input type="email" name="" id="" class='email-input' placeholder="EMAIL ADDRESS">
                        <input type="submit" class='submit' value="SUBSCRIBE">
                    </form>
                </div>
                <?php }?>
            </div>
            <div class="footer-row bottom-row">
                <div class="copyright">
                    Copyright &copy; <?php echo Date('Y');?> <?php echo $copyright; ?>
                </div>
                <div class="bottom-menu">
                    <?php foreach($bottom_links as $menu_item){?>
                        <div class="menu-item">
                            <a href="<?php echo $menu_item['link']['url']?>" target="<?php echo $menu_item['link']['target']?>"><?php echo $menu_item['link']['title']; ?></a>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    </div><!-- closing all div -->
    <?php wp_footer(); ?>
	</body>
</html>
