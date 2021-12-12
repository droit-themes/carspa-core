<?php 
$this->add_render_attribute(
    '_dl_pro_image_compare_wrapper',
    [
        'class' => ['dl_product_compaire', 'dl-image-compare-wrapper-pro', 'dl-image-compare-wrapper', $skin],
    ]
);
$image_compare_pro_wrap =  $this->get_render_attribute_string( '_dl_pro_image_compare_wrapper' );

$_controls = [
    'before' => $this->get_pro_image_compare_settings('_dl_pro_image_compare_before_btn'),
    'after' => $this->get_pro_image_compare_settings('_dl_pro_image_compare_after_btn'),
    'orientation' => $this->get_pro_image_compare_settings('_dl_pro_image_compare_orientation'),
    'overlay' => $this->get_pro_image_compare_settings('_dl_pro_image_compare_overlay'),
    'move' => $this->get_pro_image_compare_settings('_dl_pro_image_compare_move'),
    'offset' => $this->get_pro_image_compare_settings('_dl_pro_image_compare_handle_offset')['size'],
    'icon_type' => ! empty( $this->get_pro_image_compare_settings('_dl_pro_image_compare_before_type') ) && 'none' != $this->get_pro_image_compare_settings('_dl_pro_image_compare_before_type') ? $this->get_pro_image_compare_settings('_dl_pro_image_compare_before_selected_icon')['library'] : '',
];
if ( ! empty( $this->get_pro_image_compare_settings('_dl_pro_image_compare_before_type') ) && 'none' != $this->get_pro_image_compare_settings('_dl_pro_image_compare_before_type') ) {

    if( $this->get_pro_image_compare_settings('_dl_pro_image_compare_before_selected_icon')['library'] == 'svg'){
        $left_icon = [
            'left_icon' => $this->get_pro_image_compare_settings('_dl_pro_image_compare_before_selected_icon')['value']['url'],
        ];

        $_controls = array_merge( $_controls, $left_icon );
    }

    if( $this->get_pro_image_compare_settings('_dl_pro_image_compare_before_selected_icon')['library'] != 'svg'){
        $left_icon_f = [
            'left_icon' => $this->get_pro_image_compare_settings('_dl_pro_image_compare_before_selected_icon')['value'],
        ];

        $_controls = array_merge( $_controls, $left_icon_f );
    }

}
    if ( ! empty( $this->get_pro_image_compare_settings('_dl_pro_image_compare_before_type') ) && 'none' != $this->get_pro_image_compare_settings('_dl_pro_image_compare_before_type') ) {
        if( $this->get_pro_image_compare_settings('_dl_pro_image_compare_after_selected_icon')['library'] == 'svg'){
            $right_icon = [
                'right_icon' => $this->get_pro_image_compare_settings('_dl_pro_image_compare_after_selected_icon')['value']['url'],
            ];
    
            $_controls = array_merge( $_controls, $right_icon );
        }
    
        if( $this->get_pro_image_compare_settings('_dl_pro_image_compare_after_selected_icon')['library'] != 'svg'){
            $right_icon_f = [
                'right_icon' => $this->get_pro_image_compare_settings('_dl_pro_image_compare_after_selected_icon')['value'],
            ];
    
            $_controls = array_merge( $_controls, $right_icon_f );
        }
    }

$data_controls = \json_encode($_controls);

$this->add_render_attribute(
    '_dl_image_swipe',
    [
        'id' => "compare-{$this->get_id()}",
        'data-controls' => $data_controls,
        'class' => ['dl_image_swipe'],
    ]
);

$dl_image_swipe =  $this->get_render_attribute_string( '_dl_image_swipe' );

?>

<div class="dl-compare">
    <div <?php echo $image_compare_pro_wrap; ?>>
        <div <?php echo $dl_image_swipe; ?>>
            <?php 
            if ( $this->get_pro_image_compare_settings('_dl_pro_image_compare_before')['url'] || $this->get_pro_image_compare_settings('_dl_pro_image_compare_before')['id'] ) :
            $this->add_render_attribute( '_dl_pro_image_compare_before', 'src', $this->get_pro_image_compare_settings('_dl_pro_image_compare_before')['url'] );
            $this->add_render_attribute( '_dl_pro_image_compare_before', 'alt', \Elementor\Control_Media::get_image_alt( $this->get_pro_image_compare_settings('_dl_pro_image_compare_before') ) );
            $this->add_render_attribute( '_dl_pro_image_compare_before', 'title', \Elementor\Control_Media::get_image_title( $this->get_pro_image_compare_settings('_dl_pro_image_compare_before') ) );
            echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_size', '_dl_pro_image_compare_before' );
        endif;
    
         if ( $this->get_pro_image_compare_settings('_dl_pro_image_compare_after')['url'] || $this->get_pro_image_compare_settings('_dl_pro_image_compare_after')['id'] ) :
            $this->add_render_attribute( '_dl_pro_image_compare_after', 'src', $this->get_pro_image_compare_settings('_dl_pro_image_compare_after')['url'] );
            $this->add_render_attribute( '_dl_pro_image_compare_after', 'alt', \Elementor\Control_Media::get_image_alt( $this->get_pro_image_compare_settings('_dl_pro_image_compare_after') ) );
            $this->add_render_attribute( '_dl_pro_image_compare_after', 'title', \Elementor\Control_Media::get_image_title( $this->get_pro_image_compare_settings('_dl_pro_image_compare_after') ) );
           
            echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_size', '_dl_pro_image_compare_after' );
        endif;
    
             ?>
        </div>
    </div>
</div>