<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Widgets;

use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Advanced_Button\Advanced_Button_Control as Control;
use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Advanced_Button\Advanced_Button_Module as Module;
use \ELEMENTOR\Icons_Manager;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Advanced_Button extends Control
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
        $this->_dl_pro_button_preset_controls();
        $this->_dl_pro_button_content_controls();
        $this->_dl_pro_button_style_controls();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    //Html render
    protected function render()
    {   
        $settings = $this->get_settings_for_display();
        extract($settings);
        $skin = $this->get_pro_button_settings('_dl_pro_button_skin');
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