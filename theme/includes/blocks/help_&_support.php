<section class="help-and-support">
    <div class="inner">
        <div class="header">
            <div class="heading-wrap">
                <h1>
                    //post title//
                </h1>
            </div>
            <div class="link-wrap">
                <?php if($block["links"]) {?>
                <div class="links">
                    <?php foreach($block["links"] as $link) { ?>
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
                    foreach($posts->posts as $post){
                        if($post->post_parent == 0){ ?>
                            <h3 class="question-category">
                                <?php echo($post->post_title);?>
                            </h3>
                            <div class="questions">
                                <?php
                                    foreach($posts->posts as $child){ 
                                        if ($child->post_parent == $post->ID){ ?>
                                            
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
            <!-- <div class="center">
                <div class="content">
                <?php foreach($block["options"] as $issue) { ?>
                    <?php foreach($issue["issue_type"] as $descriptions) { ?>
                        <?php echo($descriptions["description"]);?>
                    <?php } ?>                        
                <?php } ?>
                </div>
            </div> -->
            <div class="right"></div>
        </div>
    </div>
</section>
