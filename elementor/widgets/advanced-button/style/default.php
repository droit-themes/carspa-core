<?php 
$this->add_render_attribute(
    '_dl_pro_button_wrapper',
    [
        'id' => "button-{$this->get_id()}",
        'class' => ['dl-button-wrapper-pro', 'dl-button-wrapper', $skin],
    ]
);

if ( ! $this->get_pro_button_settings('_dl_pro_button_text') ) {
    return;
}
$this->add_render_attribute( 'button', 'class', 'droit-button' );
if ( 'yes' === $this->get_pro_button_settings('_dl_pro_button_adv_hover_enable') ) {
    $this->add_render_attribute( 'button', 'class', 'droit-button---adv-hover' );
}
if ( !empty($this->get_pro_button_settings('_dl_pro_button_adv_icon_reverse'))  ) {
    $this->add_render_attribute( 'button', 'class', 'reverse-' . $this->get_pro_button_settings('_dl_pro_button_adv_icon_reverse') );
}

if ( ! empty( $this->get_pro_button_settings('_dl_pro_button_link')['url'] ) ) {
    $this->add_link_attributes( 'button', $this->get_pro_button_settings('_dl_pro_button_link') );
    $this->add_render_attribute( 'button', 'class', 'droit-button--link' );
}
if ( ! empty( $this->get_pro_button_settings('_dl_pro_button_icon_type') ) && 'none' != $this->get_pro_button_settings('_dl_pro_button_icon_type') ) {
    $migrated = isset( $this->get_pro_button_settings('__fa4_migrated')['_dl_pro_button_selected_icon'] );

    if (  !empty( $this->get_pro_button_settings('icon') ) && ! \Elementor\Icons_Manager::is_migration_allowed() ) {
        
        $settings['icon'] = 'fab fa-facebook-f';
    }


    $is_new = empty( $this->get_pro_button_settings('icon') ) && \Elementor\Icons_Manager::is_migration_allowed();
    $has_icon = ( ! $is_new || ! empty( $this->get_pro_button_settings('_dl_pro_button_selected_icon')['value'] ) );
}
?>
<div <?php echo $this->get_render_attribute_string( '_dl_pro_button_wrapper' ); ?>>
    <div class="<?php echo 'dl_text_' . $this->get_pro_button_settings('_dl_pro_button_text_align') ?>">
        <a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
            <?php 
                if ($this->get_pro_button_settings('_dl_pro_button_icon_type') != 'none' ) {
                    if($this->get_pro_button_settings('_dl_pro_button_icon_type') == 'icon'){
                        if ( $is_new || $migrated ) { ?>
                            <span class="droit-button-media droit-button_icon" aria-hidden="true">
                                <?php \Elementor\Icons_Manager::render_icon( $this->get_pro_button_settings('_dl_pro_button_selected_icon') ); ?>
                            </span>
                        <?php }
                    }elseif( $this->get_pro_button_settings('_dl_pro_button_icon_type') == 'image' && !empty($this->get_pro_button_settings('_dl_pro_button_icon_image')['url']) ){ 
                        ?>
                        <span class="droit-button-media droit-button_image" aria-hidden="true">
                            <img src="<?php echo esc_url($this->get_pro_button_settings('_dl_pro_button_icon_image')['url']); ?>" alt="Button Icon">
                        </span>
                    <?php }
                }
            ?>
            <span class="dl-button-text">
                <?php echo $this->get_pro_button_settings('_dl_pro_button_text') ?>
            </span>
        </a>
    </div>
</div>