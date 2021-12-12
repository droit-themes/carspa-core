<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Advanced_Button;

if (!defined('ABSPATH')) {exit;}

class Advanced_Button_Module{
    
    public static function get_name() {
        return 'droit-advanced-button';
    }
    
    public static function get_title() {
        return esc_html__( 'Advanced Button', 'droit-elementor-addons-pro' );
    }

    public static function get_icon() {
        return 'eicon-button addons-icon';
    }

    public static function get_keywords() {
       return [ 
        'button',
        'dl button',
        'dual',
        'button pro',
        'droit button',
        'droit',
        'dl',
        'pro',
       ];
    }
    
    public static function get_categories() {
        return ['droit_addons_pro'];
    }
 
}