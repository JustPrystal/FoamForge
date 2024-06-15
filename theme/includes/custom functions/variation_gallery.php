<?php

//gallery in variable products' variations
function display_variation_gallery_field($loop, $variation_data, $variation) {
    echo '<div class="options_group">';
    
    // Get existing gallery images
    $variation_gallery_images = get_post_meta($variation->ID, '_variation_gallery_images', true) ? get_post_meta($variation->ID, '_variation_gallery_images', true) : array();

    // Display the gallery field
    woocommerce_wp_text_input(
        array(
            'id'          => '_variation_gallery_images' . $loop,
            'label'       => __('Variation Gallery Images', 'woocommerce'),
            'desc_tip'    => 'true',
            'description' => __('Add gallery images for this variation.', 'woocommerce'),
            'type'        => 'hidden',
            'value'       => implode(',', $variation_gallery_images),
            'class'       => 'variation-gallery-field'
        )
    );

    // Button to add images
    echo '<button type="button" class="button add_variation_gallery_images" data-loop="' . $loop . '">' . __('Add Gallery Images', 'woocommerce') . '</button>';
    
    // Display the selected images
    echo '<div class="variation-gallery-images">';
    if (!empty($variation_gallery_images)) {
        foreach ($variation_gallery_images as $image_id) {
            echo '<div class="variation-gallery-image" data-attachment_id="' . esc_attr($image_id) . '">';
            echo wp_get_attachment_image($image_id, 'thumbnail');
            echo '<button type="button" class="button remove_variation_gallery_image">&times;</button>';
            echo '</div>';
        }
    }
    echo '</div>';

    echo '</div>';
}
add_action('woocommerce_variation_options_pricing', 'display_variation_gallery_field', 10, 3);


//Saving the Gallery Field Data

function save_variation_gallery_field($variation_id, $i) {
    if (isset($_POST['_variation_gallery_images' . $i])) {
        $gallery_images = array_filter(array_map('intval', explode(',', sanitize_text_field($_POST['_variation_gallery_images' . $i]))));
        update_post_meta($variation_id, '_variation_gallery_images', $gallery_images);
    }
}
add_action('woocommerce_save_product_variation', 'save_variation_gallery_field', 10, 2);

//JavaScript for Handling Media Library
function variation_gallery_images_scripts() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            var mediaFrame;
            let attachment_ids = [];

            // Add gallery images
            $('.woocommerce_variations').on('click', '.add_variation_gallery_images', function(e){
                e.preventDefault();

                var button = $(this);
                var loop = button.data('loop');
                var existing_ids = $('#_variation_gallery_images' + loop).val().split(',').filter(function(id) {
                    return id.trim() !== '';
                }); // Ensure no empty strings
                for (let i = 0; i < existing_ids.length; i++) {
                    const element = existing_ids[i];
                    if(!attachment_ids.includes(element)){
                        attachment_ids.push(element)
                    }else{
                        continue;
                    }
                }
                console.log("attachment_ids before gay ", attachment_ids)
                // If the media frame already exists, reopen it.
                if (mediaFrame) {
                    mediaFrame.open();
                    return;
                }
                console.log("attachment_ids between gay ", attachment_ids)

                // Create a new media frame
                mediaFrame = wp.media({
                    title: '<?php _e("Add Gallery Images", "woocommerce"); ?>',
                    button: {
                        text: '<?php _e("Add to gallery", "woocommerce"); ?>'
                    },
                    multiple: true
                });
                console.log("attachment_ids after gay ", attachment_ids)
                // When an image is selected, run a callback
                mediaFrame.on('select', function(){
                    var attachments = mediaFrame.state().get('selection').toJSON();
                    var image_html = button.siblings('.variation-gallery-images').html(); // Preserve existing images
                    attachments.forEach(function(attachment){
                        if(!attachment_ids.includes(attachment.id.toString())){
                            attachment_ids.push(attachment.id.toString());
                            image_html += '<div class="variation-gallery-image" data-attachment_id="' + attachment.id + '">';
                            image_html += '<img src="' + attachment.sizes.thumbnail.url + '" />';
                            image_html += '<button type="button" class="button remove_variation_gallery_image">&times;</button>';
                            image_html += '</div>';
                        }
                    });
                    $('#_variation_gallery_images' + loop).val(attachment_ids.join(','));
                    button.siblings('.variation-gallery-images').html(image_html);
                });

                // Finally, open the modal
                mediaFrame.open();
            });

            // Remove gallery images
            $('body').on('click', '.remove_variation_gallery_image', function(e){
                e.preventDefault();

                var button = $(this);
                var container = button.closest('.variation-gallery-image');
                var attachment_id = container.data('attachment_id');
                var hidden_field = container.closest('.options_group').find('input.variation-gallery-field');
                attachment_ids = attachment_ids.filter(function(id) {
                    return id != attachment_id.toString();
                });

                hidden_field.val(attachment_ids.join(','));
                container.remove();
            });
        });
    </script>
    <?php
}
add_action('admin_footer', 'variation_gallery_images_scripts');

function enqueue_admin_scripts() {
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'enqueue_admin_scripts');

?>