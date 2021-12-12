<?php
namespace DROIT_ELEMENTOR_PRO\Widgets;

use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Countdown_Pro extends Widget_Base{

    public function get_name()
    {
        return 'dladdons-countdown-pro';
    }

    public function get_title()
    {
        return esc_html__( 'Countdown Pro', 'droit-elementor-addons-pro' );
    }

    public function get_icon()
    {
        return 'eicon-image-before-after addons-icon';
    }

    public function get_categories()
    {
        return ['droit_addons_pro'];
    }

    public function get_keywords()
    {
        return [ 'countdown', 'timer' ];
    }

    protected function _register_controls()
    {
        do_action('dl_widgets/countdown/register_control/start', $this);

        // add content 
        $this->_content_control();
        
        //style section
        $this->_styles_control();
        
        do_action('dl_widgets/countdown/register_control/end', $this);

        // by default
        do_action('dl_widget/section/style/custom_css', $this);
        
    }

    public function _content_control(){
        //start subscribe layout
        $this->start_controls_section(
            '_dl_pro_countdown_layout_section',
            [
                'label' => __('Layout', 'droit-elementor-addons-pro'),
            ]
        );

        $this->end_controls_section();
        //start subscribe layout end

    }

    public function _styles_control(){

        $this->start_controls_section(
            '_dl_pro_countdown_style_section',
            [
                'label' => esc_html__('Style', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->end_controls_section();
    }

    //Html render
    protected function render()
    {   
        $settings = $this->get_settings_for_display();
        extract($settings);

        // render
    }

    protected function content_template()
    {}
}