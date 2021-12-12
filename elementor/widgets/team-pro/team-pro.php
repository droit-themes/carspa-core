<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Widgets;

use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Team_Pro\Team_Pro_Control as Control;
use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Team_Pro\Team_Pro_Module as Module;
use \ELEMENTOR\Icons_Manager;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Team_Pro extends Control
{

    public function get_name()
    {
        return Module::get_name();
    }

    public function get_title()
    {
        return Module::get_title();
    }

    public function get_icon()
    {
        return Module::get_icon();
    }

    public function get_categories()
    {
        return Module::get_categories();
    }

    public function get_keywords()
    {
        return Module::get_keywords();
    }

    protected function _register_controls()
    {
       
        $this->_dl_pro_teams_preset_controls();
        $this->_dl_pro_team_style_controls();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    //Html render
    protected function render()
    { 
        $settings = $this->get_settings_for_display();
        extract($settings);
        
        $skin = $this->get_pro_teams_settings('_dl_pro_teams_skin');
        $skin_mode = $this->get_pro_teams_settings('_dl_pro_teams_skin_mode');
        ?>
        <?php
            if ( in_array( $skin, array( '' ), true ) ) {
                include 'style/default.php'; 	
            }
        ?>
        
    <?php }

    protected function content_template()
    {}
}