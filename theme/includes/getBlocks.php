<?php
  function get_blocks($post_id = false) {
    global $post;

    $fields = get_fields($post_id ? $post_id : $post->ID);
    loop_blocks($fields);
  }

  function loop_blocks($blocks) {
    if (isset($blocks['blocks'])){
      if ($blocks['blocks']){
        foreach ($blocks['blocks'] as $key => $block) {
          switch ($block['acf_fc_layout']) {
            case 'global_block':
              if ($block['global_block']){
                $blocks = get_fields($block['global_block'][0]);
                loop_blocks($blocks);
              }
              break;
            case 'fullwidth_text':
              include 'blocks/fullwidth_text.php';
              break;
            case 'two_column':
              include 'blocks/two_column.php';
              break;
            case 'fullwidth':
              include 'blocks/fullwidth.php';
              break;
            case 'fullwidth_image':
              include 'blocks/fullwidth_image.php';
              break;
            case 'left_block':
              include 'blocks/left_block.php';
              break;
            case 'faq':
              include 'blocks/faq.php';
              break;
          }
        }
      }
    }
  }

?>