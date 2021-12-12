<div class="dl_advance_slider_wrapper dl-slider-<?php echo esc_attr($id);?>">
    <div class="dl_advance_slider swiper-container" data-settings='<?php echo json_encode($settings_slider, true);?>'>
        <div class="swiper-wrapper">
        <?php
            $checking = false;
            if( !empty($_dl_pro_adslider_switch) ){
                foreach($_dl_pro_adslider_switch as $k){
                    $default = isset($k['_dl_field_default']) ? $k['_dl_field_default'] : '';
                    
                    $_dlContent = isset($k['_dl_pro_adslider_content_id']) ? $k['_dl_pro_adslider_content_id'] : '';

                    $uniqueId = 0;
                    $widgetsid = $id;
                    $repeaterid = esc_attr($k['_id']);
                    
                    if( !empty($_dlContent) ){
                        $exp = explode('___', $_dlContent);
                        if( isset($exp[1])){
                            $uniqueId = !empty($exp[0]) ? $exp[0] : $uniqueId;
                        }
                    }
                    ?>
                    <div class="swiper-slide dl-popup-editor" data-toggle="<?php esc_attr_e($uniqueId);?>">
                        <?php echo \DROIT_ELEMENTOR_PRO\Dl_Editor::instance()->render($uniqueId, $widgetsid, $repeaterid);?> 
                    </div>
                    <?php
                }
            }
        ?>
        </div>
    </div>
    <?php if( $dl_enable_slide_control == 'yes'){?>
    <div class="dl_adv_swiper_navigation">
        <div class="swiper_adv_button_prev swiper_adv_nav_button">
            <?php \Elementor\Icons_Manager::render_icon( $settings['adv_slider_nav_left_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
        <div class="swiper_adv_button_next swiper_adv_nav_button">
            <?php \Elementor\Icons_Manager::render_icon( $settings['adv_slider_nav_right_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
    </div>
    <?php }
    
    if( $dl_pagination == 'yes'){?>
        <div class="dl_swiper_adv_pagination"></div>
    <?php } ?>
</div>
