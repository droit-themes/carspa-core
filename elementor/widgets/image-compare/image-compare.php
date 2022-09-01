<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Widgets;

use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Image_Compare\Image_Compare_Control as Control;
use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Image_Compare\Image_Compare_Module as Module;
use \ELEMENTOR\Icons_Manager;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Image_Compare extends Control
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

    protected function register_controls()
    {
        $this->_dl_pro_image_compare_preset_controls();
        $this->_dl_pro_image_compare_content_controls();
        $this->_dl_pro_image_compare_setting_controls();
        $this->_dl_pro_image_compare_style_handler_controls();
        $this->_dl_pro_image_compare_style_button_controls();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    //Html render
    protected function render()
    {   
        $settings = $this->get_settings_for_display();
        extract($settings);
        
        $skin = $this->get_pro_image_compare_settings('_dl_pro_image_compare_skin');
        
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