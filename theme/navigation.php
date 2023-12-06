<?php
    $logo = get_field('logo', 'option');
    $menu = get_field('menu', 'option');
    $controls = get_field('header_controls', 'option');
 ?>
<div class="header header-main">
    <div class="inner">
        <div class="hamburger-icon">
            <div class="hamburger">
                <svg  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 7L4 7" stroke="#000" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M20 12L4 12" stroke="#000" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M20 17L4 17" stroke="#000" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="close">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.7457 3.32851C20.3552 2.93798 19.722 2.93798 19.3315 3.32851L12.0371 10.6229L4.74275 3.32851C4.35223 2.93798 3.71906 2.93798 3.32854 3.32851C2.93801 3.71903 2.93801 4.3522 3.32854 4.74272L10.6229 12.0371L3.32856 19.3314C2.93803 19.722 2.93803 20.3551 3.32856 20.7457C3.71908 21.1362 4.35225 21.1362 4.74277 20.7457L12.0371 13.4513L19.3315 20.7457C19.722 21.1362 20.3552 21.1362 20.7457 20.7457C21.1362 20.3551 21.1362 19.722 20.7457 19.3315L13.4513 12.0371L20.7457 4.74272C21.1362 4.3522 21.1362 3.71903 20.7457 3.32851Z" fill="#000"/>
                </svg>
            </div>
            
        </div>
        <div class="logo-wrap">
          <a href="<?php echo get_site_url();?>">
            <img src="<?php echo $logo['url'] ?>" alt="">
          </a>
        </div>
        <div class="menu-wrap">
            <?php foreach($menu as $menu_item){
                ?>
                    <div class="menu-item <?php if($menu_item['link_type'] == "dropdown"){ echo "dropdown"; }?>">
                        <a href="<?php echo $menu_item['link']['url'] ?>" target="<?php echo $menu_item['link']['target']; ?>"><?php echo htmlspecialchars_decode($menu_item['link']['title']) ; ?></a>
                        <?php if($menu_item['link_type'] == 'dropdown'){?>
                            <div class="mega-menu">
                                <div class="mega-menu-inner">
                                    <?php foreach($menu_item['menu'] as $sub_item){?>
                                        <div class="menu-col">
                                            <div class="submenu-item">
                                                <a href="<?php echo $sub_item['link']['url']; ?>" target="<?php echo $sub_item['link']['target']; ?>"><?php echo htmlspecialchars_decode($sub_item['link']['title']); ?></a>
                                                <?php if($sub_item['menu']){
                                                   ?>
                                                    <div class="child-menu">
                                                        <?php  foreach($sub_item['menu'] as $child_item){?>
                                                            <div class="child-item">
                                                                <a href="<?php echo $child_item['link']['url']; ?>" target="<?php echo $child_item['link']['target']; ?>"><?php echo htmlspecialchars_decode($child_item['link']['title']); ?></a>
                                                            </div>
                                                        <?php }?>
                                                    </div>
                                                   <?php
                                                }?>
                                            </div>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                <?php 
            }?>
        </div>
        <div class="header-controls">
            <?php foreach($controls as $control){
                switch ($control['value']) {
                    case 'search':
                        ?>
                        <div class="control-item search-icon">
                            <a>
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.7955 14.8111L20 20M17 9.5C17 13.6421 13.6421 17 9.5 17C5.35786 17 2 13.6421 2 9.5C2 5.35786 5.35786 2 9.5 2C13.6421 2 17 5.35786 17 9.5Z" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                        <?php
                        break;
                    case 'account':
                        ?>
                        <div class="control-item">
                            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                                <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 22C2 17.7044 5.58173 14.2222 10 14.2222C14.4183 14.2222 18 17.7044 18 22M14.5714 6.44444C14.5714 8.89904 12.5247 10.8889 10 10.8889C7.47527 10.8889 5.42857 8.89904 5.42857 6.44444C5.42857 3.98984 7.47527 2 10 2C12.5247 2 14.5714 3.98984 14.5714 6.44444Z" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                        <?php
                        break;
                    case 'cart':
                        ?>
                        <div class="control-item">
                            <a href="<?php echo wc_get_cart_url();?>">
                                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.98384 15.1448L6.98391 15.1452C7.0977 15.6394 7.37853 16.079 7.77889 16.3897C8.1789 16.7002 8.67369 16.8628 9.17963 16.8502H18.0061C18.5007 16.8576 18.9833 16.6978 19.3758 16.3965C19.7686 16.095 20.0482 15.6696 20.1694 15.1892L20.1694 15.1889L22.0673 7.57666L22.0675 7.57578C22.1404 7.27156 22.0896 6.95079 21.9263 6.68402C21.7631 6.41725 21.5006 6.22632 21.1967 6.15328C20.8928 6.08024 20.5724 6.1311 20.3059 6.29463C20.0396 6.45809 19.849 6.72075 19.776 7.02481C19.776 7.02493 19.776 7.02506 19.776 7.02518L17.9284 14.5502H9.25825L6.54978 2.60602L6.54971 2.6057C6.43592 2.1115 6.1551 1.67182 5.75473 1.36111C5.35471 1.05067 4.85992 0.888028 4.35397 0.900687H2.04851C1.74386 0.900687 1.45172 1.02188 1.23634 1.23755C1.02097 1.45322 0.9 1.74571 0.9 2.05065C0.9 2.3556 1.02097 2.64808 1.23634 2.86375C1.45172 3.07943 1.74386 3.20062 2.04851 3.20062H4.27537L6.98384 15.1448ZM16.2034 18.7501C15.8725 18.7501 15.5491 18.8484 15.274 19.0324C14.9989 19.2165 14.7845 19.4781 14.658 19.7841C14.5314 20.0902 14.4982 20.4269 14.5628 20.7518C14.6273 21.0767 14.7866 21.3751 15.0205 21.6094C15.2545 21.8436 15.5525 22.0032 15.877 22.0678C16.2016 22.1324 16.5379 22.0993 16.8436 21.9725C17.1493 21.8457 17.4105 21.631 17.5943 21.3555C17.7781 21.0801 17.8762 20.7563 17.8762 20.4251C17.8762 19.9809 17.7 19.5549 17.3863 19.2407C17.0726 18.9266 16.6471 18.7501 16.2034 18.7501ZM10.9609 18.7501C10.63 18.7501 10.3066 18.8484 10.0315 19.0324C9.75638 19.2165 9.54199 19.4781 9.4154 19.7841C9.28881 20.0902 9.25569 20.4269 9.32022 20.7518C9.38476 21.0767 9.54405 21.3751 9.77798 21.6094C10.0119 21.8436 10.31 22.0032 10.6345 22.0678C10.959 22.1324 11.2954 22.0993 11.601 21.9725C11.9067 21.8457 12.168 21.631 12.3517 21.3555C12.5355 21.0801 12.6336 20.7563 12.6336 20.4251C12.6336 19.9809 12.4574 19.5549 12.1437 19.2407C11.83 18.9266 11.4045 18.7501 10.9609 18.7501Z" fill="black" stroke="black" stroke-width="0.2"/>
                                </svg>
                            </a>
                        </div>
                        <?php
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }?>
        </div>
    </div>
</div>
<div class="search-modal">
    <div class="cross">x</div>
    <div class="search-box">
        <?php 
            echo do_shortcode("[aws_search_form]");
        ?>
    </div>
</div>

<script>
    let timeout;
    jQuery(document).ready(function(){
        jQuery('.header .hamburger-icon').click(function(){ 
            jQuery(this).toggleClass('active'); 
            jQuery('.header .menu-wrap').toggleClass('active'); 
        }) 
        jQuery(".menu-item.dropdown").mouseover(function(){
            jQuery(this).find('a:eq(0)').addClass('active');
            jQuery(this).find('.mega-menu').stop().fadeIn();
        })
        jQuery(".menu-item.dropdown").mouseleave(function(){
            jQuery(this).find('a:eq(0)').removeClass('active');
            jQuery(this).find('.mega-menu').stop().fadeOut();
        })
    })
   
</script>