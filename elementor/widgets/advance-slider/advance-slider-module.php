<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Advance_Slider;

if (!defined('ABSPATH')) {exit;}

class Advance_Slider_Module{
    
    public static function get_name() {
        return 'droit-adavnced-slider';
    }
    
    public static function get_title() {
        return esc_html__( 'Advanced Slider', 'droit-elementor-addons-pro' );
    }

    public static function get_icon() {
        return 'eicon-slider-3d';
    }

    public static function get_keywords() {
        return [
            'slider',
            'owl slider',
            'dl slider',
            'droit slider',
            'dl advanced slider',
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