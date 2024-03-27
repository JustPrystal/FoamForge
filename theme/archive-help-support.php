<?php 
    global $post;
    get_header(); 
    $general_help_icon = get_field("general_help_icon", "options"); 
    $legal_help_icon = get_field("legal_help_icon", "options"); 
?>
<section class="archive help-and-support">
    <div class="inner">
        <div class="main">
            <div class="links-wrap">
                <?php
                    $arg = array(
                        'post_type' => 'help-support',
                        'post_status' => 'publish',
                        'post_parent' => 0
                    );
                    $posts = new WP_Query($arg);
                    foreach($posts->posts as $parent_post){?>
                        <a href="<?php echo get_the_permalink($parent_post->ID); ?>" class="question-category">
                            <img src="<?php if($parent_post->post_name === "legal"){ echo $legal_help_icon["url"];}else{ echo $general_help_icon["url"];}?>" alt="">
                            <p>
                                <?php echo($parent_post->post_title);?>
                            </p>
                        </a>
                        <?php 
                    }
                ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>