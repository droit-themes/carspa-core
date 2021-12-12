<?php 

$_controls = [
    'delay' => $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_delay'),
    'timer' => $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_timer'),
];
$data_controls = \json_encode($_controls);

$this->add_render_attribute(
    '_dl_pro_fun_fact_wrapper',
    [
        'id' => "fun-fact-{$this->get_id()}",
        'class' => ['dl-fun-fact-wrapper', 'dl--wrapper', $skin],
        'data-controls' => $data_controls,
    ]
);

if ( ! $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_text') ) {
    return;
}
$this->add_render_attribute( 'fun_fact', 'class', 'droit-fun_fact' );
if ( 'yes' === $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_adv_hover_enable') ) {
    $this->add_render_attribute( 'fun_fact', 'class', 'droit-fun_fact---adv-hover' );
}

if ( ! empty( $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_link')['url'] ) ) {
    $this->add_link_attributes( 'fun_fact', $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_link') );
    $this->add_render_attribute( 'fun_fact', 'class', 'droit-fun_fact--link' );
}
if ( ! empty( $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_icon_type') ) && 'none' != $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_icon_type') ) {
    $migrated = isset( $this->get_pro_fun_fact_settings('__fa4_migrated')['_dl_pro_fun_fact_selected_icon'] );

    if (  !empty( $this->get_pro_fun_fact_settings('icon') ) && ! \Elementor\Icons_Manager::is_migration_allowed() ) {
        
        $settings['icon'] = 'fab fa-facebook-f';
    }


    $is_new = empty( $this->get_pro_fun_fact_settings('icon') ) && \Elementor\Icons_Manager::is_migration_allowed();
    $has_icon = ( ! $is_new || ! empty( $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_selected_icon')['value'] ) );
}
    
?>
<div <?php echo $this->get_render_attribute_string( '_dl_pro_fun_fact_wrapper' ); ?>>
    <div class="dl-fun-fact-inner <?php echo $settings['_dl_pro_fun_fact_icon_position'] ?> ">
    <?php if ( ! empty( $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_link')['url'] ) ) { ?>
        <a <?php echo $this->get_render_attribute_string( 'fun_fact' ); ?>>
        <?php } ?>
            <?php 
                if ($this->get_pro_fun_fact_settings('_dl_pro_fun_fact_icon_type') != 'none' ) {
                    if($this->get_pro_fun_fact_settings('_dl_pro_fun_fact_icon_type') == 'icon'){
                        if ( $is_new || $migrated ) { ?>
                            <div class="droit-fun-fact-media-wrapper">
                                <div class="droit-fun-fact-media droit-fun_fact_icon" aria-hidden="true">
                                    <?php \Elementor\Icons_Manager::render_icon( $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_selected_icon') ); ?>
                                </div>
                            </div>
                        <?php }
                    }elseif( $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_icon_type') == 'image' && !empty($this->get_pro_fun_fact_settings('_dl_pro_fun_fact_icon_image')['url']) ){ 
                        ?>
                        <div class="droit-fun-fact-media-wrapper">
                            <div class="droit-fun-fact-media droit-fun_fact_image" aria-hidden="true">
                                <img src="<?php echo esc_url($this->get_pro_fun_fact_settings('_dl_pro_fun_fact_icon_image')['url']); ?>" alt="closed Icon">
                            </div>
                        </div>
                    <?php }
                }
            ?>
            <div class="dl-fun-fact-content">
                <?php
                $_ordering = $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_ordering_data');
                foreach( $_ordering as $order ) :
                    if('yes' !== $order['_dl_pro_fun_fact_order_enable'] ){
                        continue;
                    }
                    switch( $order['_dl_pro_fun_fact_order_id'] ):
                        case 'fun_prefix':
                            if ( ! empty($this->get_pro_fun_fact_settings('_dl_pro_fun_fact_prefix') )) : ?>
                                <div class="dl-fun-fact-prefix">
                                    <span><?php echo $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_prefix'); ?></span>
                                </div>
                            <?php endif;
                            break;
                        case 'fun_number':
                            if ( ! empty($this->get_pro_fun_fact_settings('_dl_pro_fun_fact_text') )) : ?>
                                <div class="dl-fun-fact-number">
                                    <span class="fun-counter"><?php echo $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_text'); ?></span>
                                </div>
                            <?php endif;
                            break;  
                        case 'fun_suffix':
                            if ( ! empty($this->get_pro_fun_fact_settings('_dl_pro_fun_fact_suffix') )) : ?>
                                <div class="dl-fun-fact-suffix">
                                    <span><?php echo $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_suffix'); ?></span>
                                </div>
                            <?php endif; 
                            break;   
                        case 'fun_heading':
                             if ( ! empty($this->get_pro_fun_fact_settings('_dl_pro_fun_fact_heading') )) : ?>
                                <div class="dl-fun-fact-heading">
                                    <h2 class="dl_pro_fun_fact_title"><?php echo $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_heading'); ?></h2>
                                </div>
                            <?php endif;
                            break;
                    endswitch;
                endforeach;
                ?>
            </div>
            <?php if ( ! empty( $this->get_pro_fun_fact_settings('_dl_pro_fun_fact_link')['url'] ) ) { ?>
        </a>
        <?php } ?>
    </div>
</div>