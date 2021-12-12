<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Team_Pro;

if (!defined('ABSPATH')) {exit;}

class Team_Pro_Module{
    
    public static function get_name() {
        return 'droit-teams';
    }
    
    public static function get_title() {
        return esc_html__( 'Team Pro', 'droit-elementor-addons-pro' );
    }

    public static function get_icon() {
        return 'dlicons-Team addons-icon';
    }

    public static function get_keywords() {
       return [ 
        'team',
        'team pro',
        'member',
        'team member',
        'dl team member',
        'dl team members',
        'droit team member',
        'droit team members',
        'our team',
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