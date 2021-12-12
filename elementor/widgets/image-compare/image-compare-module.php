<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Image_Compare;

if (!defined('ABSPATH')) {exit;}

class Image_Compare_Module{
    
    public static function get_name() {
        return 'droit-image_compare';
    }
    
    public static function get_title() {
        return esc_html__( 'Image Comparison', 'droit-elementor-addons-pro' );
    }

    public static function get_icon() {
        return 'eicon-image-before-after addons-icon';
    }

    public static function get_keywords() {
       return [ 
        'comparison',
        'image comparison',
        'image compare',
        'compare',
        'image',
        'droit',
        'droit elementor addons',
        'pro',
       ];
    }
    
    public static function get_categories() {
        return ['droit_addons_pro'];
    }
 
}