<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Advanced_Accordion;

if (!defined('ABSPATH')) {exit;}

class Advanced_Accordion_Module{
    
    public static function get_name() {
        return 'droit-advance-accordions';
    }
    
    public static function get_title() {
        return esc_html__( 'Advanced Accordion', 'droit-elementor-addons-pro' );
    }

    public static function get_icon() {
        return 'eicon-accordion';
    }

    public static function get_keywords() {
       return [ 
            'Accordions', 
            'pro accordion', 
            'accordion', 
            'adv accordion', 
            'toggle', 
            'droit Accordion', 
            'dl Accordions', 
            'dl advanced Accordions', 
            'product Accordions', 
            'addons', 
            'addon'
        ];
    }
    
    public static function get_categories() {
        return ['droit_addons_pro'];
    }
 
}