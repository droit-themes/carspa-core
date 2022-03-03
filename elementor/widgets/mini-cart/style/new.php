<?php 
use Elementor\Icons_Manager; ?>

<div class="dl-mini-cart-wrapper">
    <div class="dl-mini-cart-inner <?php echo $dl_mini_cart_control; ?>">
        <div class="dl-mini-cart-button">
            <div class="dl-mini-cart-count-area">
                <span class="dl-mini-cart-icon">
                    <?php
                        if ( isset($dl_mini_cart_icons) && ($dl_mini_cart_icons['value']) ) {
                            Icons_Manager::render_icon( $dl_mini_cart_icons, [ 'aria-hidden' => 'true' ] );
                        } else { ?>
                            <i class="fas fa-shopping-basket" aria-hidden="true"></i>
                            <?php
                        }
                    ?>
                </span>
                <span class="dl-mini-cart-count num menu-cart">
                    <?php echo ( WC()->cart != '' ) ? WC()->cart->get_cart_contents_count() : ''; ?>
                </span>
            </div>

            <?php if( $dl_mini_cart_subtotal_show == 'yes' ){ ?>
                <div class="dl-mini-cart-total">
                    <?php echo ( WC()->cart != '' ) ? WC()->cart->get_cart_total() : ''; ?>
                </div>
            <?php } ?>

        </div>

        <?php if( $dl_mini_cart_show !== 'none' ){ ?>
            <div class="dl-mini-cart-popup">
                <div class="dl-mini-cart-popup-header">
                        <div class="dl-mini-cart-popup-count-text-area">
                            <span class="dl-mini-cart-popup-count"><?php echo ( WC()->cart != '' ) ?  WC()->cart->get_cart_contents_count() : '' ; ?></span>
                            <span class="dl-mini-cart-popup-count-text"><?php esc_html_e( 'items', 'droit-addons-pro' ); ?></span>
                        </div>
                </div>
                <div class="dl-mini-cart-popup-body">
                    <div class="widget_shopping_cart_content">
                        <?php ( WC()->cart != '' ) ? woocommerce_mini_cart() : ''; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>