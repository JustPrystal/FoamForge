<?php 
    global $post;
    get_header(); 
    $main_post_parent = $post->post_parent === 0 ? $post->ID : get_top_level_parent($post);
?>
 
<section class="help-and-support">
    <div class="inner">
        <div class="help-and-support-headers">
            <div class="heading-wrap">
                <h1>
                    <?php echo get_the_title($post->ID);?>
                </h1>
            </div>
            <div class="link-wrap">
                <div class="links">
                    <?php if(get_post($main_post_parent)->post_name == "legal"){?>
                        <a href="/help/help">Help Center</a>            
                    <?php } else {?>
                        <a href="/help/legal">Legal</a>
                    <?php }?>
                        <a href="/contact">Contact</a>
                </div>
            </div>
        </div>
        <div class="top-bar">
            <div class="hide-questions">
                <!-- Generator: Adobe Illustrator 28.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 23.7 15.8" style="enable-background:new 0 0 23.7 15.8;" xml:space="preserve">
                <g>
                    <rect width="4.5" height="15.8"/>
                    <rect x="6.8" width="16.8" height="15.8"/>
                </g>
                </svg>
            </div>
        </div>
        <div class="main">
            <div class="sidebar">
                <?php
                    
                    $args = array(
                        'post_type' => 'help-support',
                        'post_status' => 'publish',
                        'post_parent' => $main_post_parent,
                    );
                    $posts = new WP_Query($args);
                    foreach($posts->get_posts() as $parent_post){?>
                        <div class="question-wrap">
                            <h3 class="question-category">
                                <?php echo($parent_post->post_title);?>
                            </h3>
                            <div class="questions">
                                <?php
                                    $child_args = array(
                                        'post_type' => 'help-support',
                                        'post_status' => 'publish',
                                        'post_parent' => $parent_post->ID,
                                    );
                                    $child_posts = new WP_Query($child_args);
                                    foreach($child_posts->get_posts() as $child){?>
                                        <a class="question-item <?php if($post->ID == $child->ID){echo "active-post";}?>" href="<?php echo get_the_permalink($child->ID); ?>">
                                            <img src="<?php echo get_site_url() . "/wp-content/uploads/2024/03/FF-Help_Arrow.svg" ?>" alt="">
                                            <?php
                                                echo $child->post_title;
                                            ?>
                                        </a>
                                    <?php } ?>
                            </div>
                        </div>
                    <?php }
                ?>
            </div>
            <div class="main-content">
                <div class="description">
                    <?php echo get_the_content();?>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>
<script>
    $(document).ready(function(){
        $(".active-post").parent(".questions").show()
        $(".question-wrap").click(function(){
            if($(this).find(".questions").css("display") == "none"){
                $(".question-wrap .questions").slideUp("fast");
                $(this).find(".questions").slideDown("fast");
            }
        })
        $(".hide-questions").click(function(){
            $(".sidebar").toggleClass("open");
        })
    })
</script>