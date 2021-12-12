<?php 
$this->add_render_attribute(
    '_dl_pro_dual_button_wrapper',
    [
        'id' => "dual-button-{$this->get_id()}",
        'class' => ['dl-dual-button-wrapper-pro', 'dl_flex', 'dl_justify_content_center', $skin],
    ]
);

$this->add_render_attribute(
    '_dl_pro_dual_button_style',
    [
        'class' => ['dl_dual_button', ],
    ]
);
if ( 'rounded' === $this->get_pro_dual_button_settings('_dl_pro_dual_button_style') ) {
    $this->add_render_attribute( '_dl_pro_dual_button_style', 'class', 'dl_dual_rounded_style' );
}
if ( 'skew' === $this->get_pro_dual_button_settings('_dl_pro_dual_button_style') ) {
    $this->add_render_attribute( '_dl_pro_dual_button_style', 'class', 'dl_dual_skew_style' );
}

$this->add_render_attribute( 'button', 'class', 'dl_addon_dual_btn dl_dual_btn_one dl_text_uppercase' );
if ( 'yes' === $this->get_pro_dual_button_settings('_dl_pro_dual_button_adv_hover_enable') ) {
    $this->add_render_attribute( 'button', 'class', 'droit-dual-button---adv-hover' );
}
if ( !empty($this->get_pro_dual_button_settings('_dl_pro_dual_button_adv_icon_reverse'))  ) {
    $this->add_render_attribute( 'button', 'class', 'reverse-' . $this->get_pro_dual_button_settings('_dl_pro_dual_button_adv_icon_reverse') );
}
if ( ! empty( $this->get_pro_dual_button_settings('_dl_pro_dual_button_link')['url'] ) ) {
    $this->add_link_attributes( 'button', $this->get_pro_dual_button_settings('_dl_pro_dual_button_link') );
    $this->add_render_attribute( 'button', 'class', 'droit-dual-button--link' );
}
if ( ! empty( $this->get_pro_dual_button_settings('_dl_pro_dual_button_icon_type') ) && 'none' != $this->get_pro_dual_button_settings('_dl_pro_dual_button_icon_type') ) {
    $migrated = isset( $this->get_pro_dual_button_settings('__fa4_migrated')['_dl_pro_dual_button_selected_icon'] );

    if (  !empty( $this->get_pro_dual_button_settings('icon') ) && ! \Elementor\Icons_Manager::is_migration_allowed() ) {
        
        $settings['icon'] = 'fas fa-download';
    }
    $is_new = empty( $this->get_pro_dual_button_settings('icon') ) && \Elementor\Icons_Manager::is_migration_allowed();
    $has_icon = ( ! $is_new || ! empty( $this->get_pro_dual_button_settings('_dl_pro_dual_button_selected_icon')['value'] ) );
}
// Second Button

$this->add_render_attribute( 'button_second', 'class', 'dl_addon_dual_btn dl_dual_btn_two dl_text_uppercase' );
if ( 'yes' === $this->get_pro_dual_button_settings('_dl_pro_dual_button_adv_hover_enable_second') ) {
    $this->add_render_attribute( 'button_second', 'class', 'droit-dual-button---adv-hover' );
}
if ( !empty($this->get_pro_dual_button_settings('_dl_pro_dual_button_adv_icon_reverse_second'))  ) {
    $this->add_render_attribute( 'button_second', 'class', 'reverse-' . $this->get_pro_dual_button_settings('_dl_pro_dual_button_adv_icon_reverse_second') );
}
if ( ! empty( $this->get_pro_dual_button_settings('_dl_pro_dual_button_link_second')['url'] ) ) {
    $this->add_link_attributes( 'button_second', $this->get_pro_dual_button_settings('_dl_pro_dual_button_link_second') );
    $this->add_render_attribute( 'button_second', 'class', 'droit-dual-button--link' );
}
if ( ! empty( $this->get_pro_dual_button_settings('_dl_pro_dual_button_icon_type_second') ) && 'none' != $this->get_pro_dual_button_settings('_dl_pro_dual_button_icon_type_second') ) {
    $migrated = isset( $this->get_pro_dual_button_settings('__fa4_migrated')['_dl_pro_dual_button_selected_icon_second'] );

    if (  !empty( $this->get_pro_dual_button_settings('icon') ) && ! \Elementor\Icons_Manager::is_migration_allowed() ) {
        
        $settings['icon'] = 'fas fa-download';
    }
    $is_new = empty( $this->get_pro_dual_button_settings('icon') ) && \Elementor\Icons_Manager::is_migration_allowed();
    $has_icon = ( ! $is_new || ! empty( $this->get_pro_dual_button_settings('_dl_pro_dual_button_selected_icon_second')['value'] ) );
} 
// Divider
if ( ! empty( $this->get_pro_dual_button_settings('_dl_pro_dual_button_divider_type') ) && 'icon' == $this->get_pro_dual_button_settings('_dl_pro_dual_button_divider_type') ) {
    $divider_migrated = isset( $this->get_pro_dual_button_settings('__fa4_migrated')['_dl_pro_dual_button_divider_selected_icon'] );

    if (  !empty( $this->get_pro_dual_button_settings('icon') ) && ! \Elementor\Icons_Manager::is_migration_allowed() ) {
        
        $settings['icon'] = 'fas fa-divide';
    }
    $is_divider_new = empty( $this->get_pro_dual_button_settings('icon') ) && \Elementor\Icons_Manager::is_migration_allowed();
    $has_divider_icon = ( ! $is_divider_new || ! empty( $this->get_pro_dual_button_settings('_dl_pro_dual_button_divider_selected_icon')['value'] ) );
} 
?>
<div <?php echo $this->get_render_attribute_string( '_dl_pro_dual_button_wrapper' ); ?>>
    <div <?php echo $this->get_render_attribute_string( '_dl_pro_dual_button_style' ); ?> >
    <?php if ( ! empty($this->get_pro_dual_button_settings('_dl_pro_dual_button_text') ) ) { ?>    
        <a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
            <?php 
                if ($this->get_pro_dual_button_settings('_dl_pro_dual_button_icon_type') != 'none' ) {
                    if($this->get_pro_dual_button_settings('_dl_pro_dual_button_icon_type') == 'icon'){
                        if ( $is_new || $migrated ) { ?>
                            <span class="droit-dual-button-media droit-dual-button_icon" aria-hidden="true">
                                <?php \Elementor\Icons_Manager::render_icon( $this->get_pro_dual_button_settings('_dl_pro_dual_button_selected_icon') ); ?>
                            </span>
                        <?php }
                    }elseif( $this->get_pro_dual_button_settings('_dl_pro_dual_button_icon_type') == 'image' && !empty($this->get_pro_dual_button_settings('_dl_pro_dual_button_icon_image')['url']) ){ 
                        ?>
                        <span class="droit-dual-button-media droit-dual-button_image" aria-hidden="true">
                            <img src="<?php echo esc_url($this->get_pro_dual_button_settings('_dl_pro_dual_button_icon_image')['url']); ?>" alt="Button Icon">
                        </span>

                    <?php }
                }
            ?>
            <span class="dl-dual-button-text dual_first_button">
                <?php echo $this->get_pro_dual_button_settings('_dl_pro_dual_button_text') ?>
            </span>
        </a>
        <?php } ?>
        <?php if(!empty($this->get_pro_dual_button_settings('_dl_pro_dual_button_divider_show'))) : ?>
            <span class="dl_middle_text dl_text_uppercase dl-middle-divider">
            <?php 
                if ($this->get_pro_dual_button_settings('_dl_pro_dual_button_divider_type') != 'none' ) {
                    if($this->get_pro_dual_button_settings('_dl_pro_dual_button_divider_type') == 'icon'){
                        if ( $is_divider_new || $divider_migrated ) { ?>
                            <span class="droit-dual-divider-media droit-dual-divider_icon" aria-hidden="true">
                                <?php \Elementor\Icons_Manager::render_icon( $this->get_pro_dual_button_settings('_dl_pro_dual_button_divider_selected_icon') ); ?>
                            </span>
                        <?php }
                    }elseif( $this->get_pro_dual_button_settings('_dl_pro_dual_button_divider_type') == 'image' && !empty($this->get_pro_dual_button_settings('_dl_pro_dual_button_divider_image')['url']) ){ 
                        ?>
                        <span class="droit-dual-divider-media droit-dual-divider_image" aria-hidden="true">
                            <img src="<?php echo esc_url($this->get_pro_dual_button_settings('_dl_pro_dual_button_divider_image')['url']); ?>" alt="divider Icon">
                        </span>
                    <?php }elseif($this->get_pro_dual_button_settings('_dl_pro_dual_button_divider_type') == 'text' && !empty($this->get_pro_dual_button_settings('_dl_pro_dual_divider_text'))){ ?>
                        <span><?php echo $this->get_pro_dual_button_settings('_dl_pro_dual_divider_text'); ?></span>
                    <?php }
                }
            ?>
            </span>
        <?php endif; ?>
        <?php if ( ! empty($this->get_pro_dual_button_settings('_dl_pro_dual_button_text_second') ) ) { ?>    
            <a <?php echo $this->get_render_attribute_string( 'button_second' ); ?>>
            <?php 
                if ($this->get_pro_dual_button_settings('_dl_pro_dual_button_icon_type_second') != 'none' ) {
                    if($this->get_pro_dual_button_settings('_dl_pro_dual_button_icon_type_second') == 'icon'){
                        if ( $is_new || $migrated ) { ?>
                            <span class="droit-dual-button-media droit-dual-button_icon" aria-hidden="true">
                                <?php \Elementor\Icons_Manager::render_icon( $this->get_pro_dual_button_settings('_dl_pro_dual_button_selected_icon_second') ); ?>
                            </span>
                        <?php }
                    }elseif( $this->get_pro_dual_button_settings('_dl_pro_dual_button_icon_type_second') == 'image' && !empty($this->get_pro_dual_button_settings('_dl_pro_dual_button_icon_image_second')['url']) ){ 
                        ?>
                        <span class="droit-dual-button-media droit-dual-button_image" aria-hidden="true">
                            <img src="<?php echo esc_url($this->get_pro_dual_button_settings('_dl_pro_dual_button_icon_image_second')['url']); ?>" alt="Button Icon">
                        </span>

                    <?php }
                }
            ?>
            <span class="dl-dual-button-text dual_second_button">
                <?php echo $this->get_pro_dual_button_settings('_dl_pro_dual_button_text_second') ?>
            </span>
        </a>
        <?php } ?>
        </div>
</div>