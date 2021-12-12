<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Fun_Fact;

if (!defined('ABSPATH')) {exit;}

class Fun_Fact_Module{
    
    public static function get_name() {
        return 'droit-fun_fact';
    }
    
    public static function get_title() {
        return esc_html__( 'Fun Fact', 'droit-elementor-addons-pro' );
    }

    public static function get_icon() {
        return 'eicon-number-field addons-icon';
    }

    public static function get_keywords() {
       return [ 
        'fun',
        'fun fact',
        'counter',
        'counterdown',
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