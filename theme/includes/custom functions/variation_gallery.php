<?php

//Product Variations Upload Custom Image Field

function variation_settings_fields( $loop, $variation_data, $variation ) {
    $closeup_image_field = $variation_data['closeup_image_field'][0] ?? null;
    ?>
    <hr>
    <p style="margin-bottom: 4px; margin-top: 20px;">
        Close-up Image
    </p>
    <p class="form-row form-row-first upload_closeup_field" style="margin-top: 0; width: 100%;">
        <a
            href="#"
            class="upload_closeup_field_button tips <?php echo $closeup_image_field ? 'remove' : ''; ?>"
             data-tip="<?php echo $closeup_image_field ? esc_attr__( 'Remove this image', 'woocommerce' ) : esc_attr__( 'Upload an image', 'woocommerce' ); ?>"
            rel="<?php echo esc_attr( $variation->ID ); ?>">
            <img style="max-width: 200px;" src="<?php echo $closeup_image_field ? esc_url( wp_get_attachment_thumb_url( $closeup_image_field ) ) : esc_url( wc_placeholder_img_src() ); ?>" />
            <input
                type="hidden"
                id="upload_closeup_image_field<?php echo esc_attr( $loop ); ?>"
                name="upload_closeup_image_field[<?php echo esc_attr( $loop ); ?>]"
                class="upload_closeup_image_field" value="<?php echo esc_attr( $closeup_image_field ); ?>" />
        </a>
    </p>
    <?php
    
    woocommerce_wp_text_input( 
        array( 
            'id'          => 'extra_information_' . $variation->ID, 
            'label'       => __( 'Extra Information', 'woocommerce' ), 
            'desc_tip'    => 'true',
            'description' => __( 'Enter extra information for this variation.', 'woocommerce' ),
            'value'       => get_post_meta( $variation->ID, 'extra_information', true )
        )
    );
    
    ?>
    <?php
}
add_action( 'woocommerce_product_after_variable_attributes', 'variation_settings_fields', 10, 3 );


function save_variation_settings_fields( $variation_id, $loop ) {
    $value = wc_clean( wp_unslash( $_POST['upload_closeup_image_field'][ $loop ] ) );
    $custom_image_field = $_POST['extra_information_' . $variation_id];

    update_post_meta( $variation_id, 'closeup_image_field', esc_attr( $value ));
    update_post_meta( $variation_id, 'extra_information', esc_html( $custom_image_field ) );
}
add_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );

function product_variation_img_script() {
$screen = get_current_screen();
    if ($screen->post_type === 'product') :
        ?>
        <style>
            .upload_closeup_field_button:focus {
                outline: none !important;
                box-shadow: none !important;
            }
        </style>
        <script>
           (function($) {
        var settings = {
            setting_variation_image: null,
            setting_variation_image_id: null
        }
        function add_closeup_field(event) {
            var $button = $( this ),
                post_id = $button.attr( 'rel' ),
                $parent = $button.closest( '.upload_closeup_field' );

            settings.setting_variation_image    = $parent;
            settings.setting_variation_image_id = post_id;

            event.preventDefault();
            
            if ( $button.hasClass('remove')) {
                console.log("remove");
                $( '.upload_closeup_image_field', settings.setting_variation_image ).val( '' ).trigger( 'change' );
                settings.setting_variation_image.find( 'img' ).eq( 0 )
                    .attr( 'src', woocommerce_admin_meta_boxes_variations.woocommerce_placeholder_img_src );
                settings.setting_variation_image.find( '.upload_closeup_field_button' ).removeClass( 'remove' );

            } else {
                
                // If the media frame already exists, reopen it.
                if ( settings.variable_image_frame ) {
                    settings.variable_image_frame.uploader.uploader
                        .param( 'post_id', settings.setting_variation_image_id );
                    settings.variable_image_frame.open();
                    return;
                } else {
                    wp.media.model.settings.post.id = settings.setting_variation_image_id;
                }

                // Create the media frame.
                settings.variable_image_frame = wp.media.frames.variable_image = wp.media({
                    // Set the title of the modal.
                    title: woocommerce_admin_meta_boxes_variations.i18n_choose_image,
                    button: {
                        text: woocommerce_admin_meta_boxes_variations.i18n_set_image
                    },
                    states: [
                        new wp.media.controller.Library({
                            title: woocommerce_admin_meta_boxes_variations.i18n_choose_image,
                            filterable: 'all'
                        })
                    ]
                });

                // When an image is selected, run a callback.
                settings.variable_image_frame.on( 'select', function () {

                    var attachment = settings.variable_image_frame.state()
                        .get( 'selection' ).first().toJSON(),
                        url = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

                    $( '.upload_closeup_image_field', settings.setting_variation_image ).val( attachment.id )
                        .trigger( 'change' );
                    settings.setting_variation_image.find( '.upload_closeup_field_button' ).addClass( 'remove' );
                    settings.setting_variation_image.find( 'img' ).eq( 0 ).attr( 'src', url );

                    wp.media.model.settings.post.id = settings.wp_media_post_id;
                });

                // Finally, open the modal.
                settings.variable_image_frame.open();
            }
        }

        $(document).on('click', '.upload_closeup_field_button', add_closeup_field);
        })(jQuery)
        </script>
<?php
    endif;
}
add_action('admin_footer', 'product_variation_img_script');

?>