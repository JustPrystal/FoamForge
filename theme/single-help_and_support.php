<?php 
    global $post;
    get_header(); 
    $links = get_field("help_&_support_links", "options");
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
                <?php if($links) {?>
                <div class="links">
                    <?php foreach($links as $link) { ?>
                        <a href="<?php echo $link["link"]["url"];?>"><?php echo $link["link"]["title"];?></a>
                    <?php } ?>
                </div>
                <?php }?>
            </div>
        </div>
        <div class="main">
            <div class="sidebar">
                <?php
                    $arg = array(
                        'post_type' => 'help_and_support',
                        'post_status' => 'publish'
                    );
                    $posts = new WP_Query($arg);
                    foreach($posts->posts as $parent_post){
                        if($parent_post->post_parent == 0){ ?>
                            <h3 class="question-category">
                                <?php echo($parent_post->post_title);?>
                            </h3>
                            <div class="questions">
                                <?php
                                    foreach($posts->posts as $child){ 
                                        if ($child->post_parent == $parent_post->ID){ ?>
                                            <a class="question-item">
                                                <?php
                                                    echo $child->post_title;
                                                ?>
                                            </a>
                                        <?php }
                                    }
                                ?>
                            </div>
                        <?php }
                    }
                ?>
            </div>
            <div class="main-content">
                <div class="description">
                    <?php echo the_content();?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>