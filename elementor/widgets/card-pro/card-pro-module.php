<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Card_Pro;

if (!defined('ABSPATH')) {exit;}

class Card_Pro_Module{
    
    public static function get_name() {
        return 'droit-cards';
    }
    
    public static function get_title() {
        return esc_html__( 'Card Pro', 'droit-elementor-addons-pro' );
    }

    public static function get_icon() {
        return 'dlicons-card addons-icon';
    }

    public static function get_keywords() {
        return [ 
            'cards', 
            'pro cards', 
            'card', 
            'dl cards', 
            'dl card', 
            'droit', 
            'dl', 
            'addons', 
            'addon' 
        ];
    }
    
    public static function get_categories() {
        return ['droit_addons_pro'];
    }
 
}