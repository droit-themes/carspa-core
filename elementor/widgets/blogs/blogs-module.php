<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Blogs;

if (!defined('ABSPATH')) {exit;}

class Blogs_Module{
    
    public static function get_name() {
        return 'droit-blogs_masonry';
    }
    
    public static function get_title() {
        return esc_html__( 'Masonry Post', 'droit-elementor-addons-pro' );
    }

    public static function get_icon() {
        return 'eicon-posts-masonry';
    }

    public static function get_keywords() {
        return [
            'blog',
            'blogs',
            'masnory',
            'masnory post',
            'post',
            'posts',
            'droit blog',
            'droit post',
            'dl blog',
            'dl post',
            'droit',
            'dl',
            'addons',
            'addon',
            'pro' 
        ];
    }
    
    public static function get_categories() {
        return ['droit_addons_pro'];
    }
 
}