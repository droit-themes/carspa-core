<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Dual_Button;

if (!defined('ABSPATH')) {exit;}

class Dual_Button_Module{
    
    public static function get_name() {
        return 'droit-dual_button';
    }
    
    public static function get_title() {
        return esc_html__( 'Dual Button', 'droit-elementor-addons-pro' );
    }

    public static function get_icon() {
        return 'eicon-dual-button addons-icon';
    }

    public static function get_keywords() {
       return [ 
        'dual',
        'button',
        'dual button',
        'dual',
        'button pro',
        'member',
        'button member',
        'meet the button',
        'button builder',
        'our button',
        'droit',
        'dl',
        'droit elementor addons',
        'pro',
       ];
    }
    
    public static function get_categories() {
        return ['droit_addons_pro'];
    }
 
}