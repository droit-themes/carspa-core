<?php
    $id_int = substr( $this->get_id_int(), 0, 4 );
    $this->add_render_attribute( 'card_pro_wrap', [
        'id' => 'cards-'.$id_int,
        'class' => [ 
            'dl_portfolio_item',
            'droit__pro_card',
            'style_01',
            '_skin_one',
            'droit-card-wrap-pro' 
        ],
    ]);

    $card_pro_wrap =  $this->get_render_attribute_string( 'card_pro_wrap' );

    $image = wp_get_attachment_image_url( $this->get_pro_cards_settings('_dl_pro_card_image_one')['id'], $this->get_pro_cards_settings('thumbnail_one_size') );
    if ( ! $image ) {
        $image = $this->get_pro_cards_settings('_dl_pro_card_image_one')['url'];
    }
?>

<div class="dl-pro-card-content <?php echo 'dl_flex dl_card_content_'. $_dl_pro_card_content_image_align ?>">
    <?php
    if ( ! empty($_dl_pro_card_content_image['url'])) : ?>
        <div class="dl_pro_card_img dl_flex">
            <img src="<?php echo esc_url( $this->get_pro_cards_settings('_dl_pro_card_content_image','thumbnail_one')['url']); ?>" alt="#" class="dl_card_img">
        </div>
    <?php endif; 
    ?>
    <div class="dl_pro_card_content_wrapper">
        <?php
            $_card_ordering = $_dl_pro_card_ordering_data;
            foreach( $_card_ordering as $order ) :
            if('yes' !== $order['_dl_pro_card_order_enable'] ){
                continue;
            }
            switch( $order['_dl_pro_card_order_id'] ):
                case 'card_title':
                    if ( ! empty($_dl_pro_card_content_heading)) : ?>
                        <div class="dl_pro_card_title">  
                            <h2 class="dl_title"> <?php echo $_dl_pro_card_content_heading; ?> </h2>
                        </div>
                    <?php endif;
                    break;
                case 'card_description':
                    if ( ! empty($_dl_pro_card_content_desc )) : ?>
                        <div class="dl_pro_card_desc">
                            <p class="dl-desc"><?php echo esc_html($_dl_pro_card_content_desc); ?></p>
                        </div>
                    <?php endif;
                    break;
                case 'card_btn':
                        if ( ! empty ($_dl_pro_card_content_link)) : 
                            $target = $_dl_pro_card_content_link['is_external'] ? ' target="_blank"' : '';
                            $nofollow = $_dl_pro_card_content_link['nofollow'] ? ' rel="nofollow"' : '';
                        ?>
                        <div class="dl_pro_card_btn">
                            <a class="dl_btn btn_1 dl_card_btn" href="<?php echo esc_url($_dl_pro_card_content_link['url']);?>" <?php echo esc_attr($target) . '' .esc_attr($nofollow);?>> <?php echo $_dl_pro_card_btn_content; ?></a>
                        </div>
                    <?php endif;
                    break;
            endswitch;
        endforeach;
        ?>
    </div>
</div>

