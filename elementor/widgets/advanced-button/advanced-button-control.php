<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Advanced_Button;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \DROIT_ELEMENTOR_PRO\Content_Typography;
use \DROIT_ELEMENTOR_PRO\Button;
use \DROIT_ELEMENTOR_PRO\Button_Size;
use \DROIT_ELEMENTOR_PRO\Button_Hover;
use \DROIT_ELEMENTOR_PRO\Image;
use \DROIT_ELEMENTOR_PRO\Icon;
use \DROIT_ELEMENTOR_PRO\Icon_SVG;
use \DROIT_ELEMENTOR_PRO\Position;
use \DROIT_ELEMENTOR_PRO\Button_Hover_Advanced as Hover_Advanced;
use \DROIT_ELEMENTOR_PRO\Button_Hover_Advanced_Second as Hover_Advanced_Second;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {exit;}

abstract class Advanced_Button_Control extends Widget_Base
{

    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    public function get_pro_button_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }
   
    //Preset
    public function _dl_pro_button_preset_controls()
    {
        $this->start_controls_section(
            '_dl_pr_buttons_layout_section',
            [
                'label' => __('Layout', 'droit-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_button_skin',
            [
                'label' => esc_html__('Preset', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/button/control_presets', [
                    '' => 'Default',
                ]),
                'default' => '',
            ]
        );

        $this->end_controls_section();
    }
    // Button Content
    public function _dl_pro_button_content_controls()
    {
        $this->start_controls_section(
            '_dl_pro_button_content_section',
            [
                'label' => __('Content', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_button_skin') => [''],
                ],
            ]
        );
        $this->_dl_pro_buttons_data_controls();
        $this->end_controls_section();
    }
    // Button data
    protected function _dl_pro_buttons_data_controls()
    {
        $this->add_control(
            '_dl_pro_button_text', [
                'label' => __('Text', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Text', 'droit-elementor-addons-pro'),
                'default' => __('Click Here', 'droit-elementor-addons-pro'),
                'label_block' => true,
                'description' => __('This text display in button section. NB: Keep empty for hide.', 'droit-elementor-addons-pro'),
            ]
        );
        $this->add_control(
            '_dl_pro_button_link',
            [
                'label' => __('Link', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'droit-elementor-addons-pro'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_button_text!') => [''],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_button_text_align',
            [
                'label' => __( 'Alignment', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'plugin-domain' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'plugin-domain' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'plugin-domain' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );

        $this->add_control(
            '_dl_pro_button_icon_type',
            [   
                'label' => esc_html__('Media Type', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'none' => [
                        'title' => esc_html__('None', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-ban',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-gear',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-picture-o',
                    ],
                ],
                'default' => 'none',
            ]
        );
        $this->add_control(
            '_dl_pro_button_adv_icon_reverse',
            [
                'label' => esc_html__('Position', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => '',
                'options' => [
                    '' => [
                        'title' => esc_html__('Left', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'top' => [
                        'title' => esc_html__('Top', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'condition' => [
                    $this->get_control_id( '_dl_pro_button_icon_type' ) => [ 'icon', 'image' ],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_button_selected_icon',
            [
                'label' => __( 'Icon', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    $this->get_control_id( '_dl_pro_button_icon_type' ) => [ 'icon' ],
                ],
            ]
        );
        
        
            $this->add_control(
                '_dl_pro_button_icon_image',
                [   
                    'label' => esc_html__('Image', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => '',
                    ],
                    'condition' => [
                    $this->get_control_id( '_dl_pro_button_icon_type' ) => [ 'image' ],
                ],
                ]
            );

        do_action('dl_widgets/button/pro/content', $this);
    }

    //Button Style
    public function _dl_pro_button_style_controls()
    {
        do_action('dl_widgets/button/pro/section/style/before', $this);
        $this->start_controls_section(
            '_dl_pro_buttons_style_section',
            [
                'label' => esc_html__('Button', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,

            ]
        );
        $this->add_group_control(
            Button_Size::get_type(),
            [
                'name' => 'button_sizes',
                'label' => __('Size', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-button-wrapper-pro .droit-button',
                'fields_options' => [
                    'button_size' => [
                        'default' => '',
                    ],
                    'button_sizes' => 'custom',
                    'button_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                    'button_height' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pro_buttom_content_typography',
                'label' => __( 'Typography', 'droit-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl-button-wrapper-pro .droit-button',
            ]
        );
        $this->add_group_control(
            Position::get_type(),
            [
                'name' => 'position',
                'label' => __('Position', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-button-wrapper-pro',
                'fields_options' => [
                    'box_position_type' => [
                        'default' => '',
                    ],
                    'box_horizontal' => [
                        'default' => [
                            'size' => '0',
                            'unit' => 'px',
                        ],
                    ],
                    'box_vertical' => [
                        'default' => [
                            'size' => '0',
                            'unit' => 'px',
                        ],
                    ],
                ],
            ]
        );

        $this->start_controls_tabs('_dl_pro_buttons_tabs');

        $this->start_controls_tab('_dl_pro_buttons_normal_tab',
            [
                'label' => esc_html__('Normal', 'droit-elementor-addons-pro'),
            ]
        );
        $this->_dl_pro_buttons_normal_controls();
        
        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_buttons_hover',
            [
                'label' => esc_html__('Hover', 'droit-elementor-addons-pro'),
            ]
        );
        $this->_dl_pro_button_hover_controls();
        $this->end_controls_tab();

        $this->end_controls_tabs();
        do_action('dl_widgets/button/pro/section/style/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/button/pro/section/style/after', $this);
    }
    //Button Style Normal
    protected function _dl_pro_buttons_normal_controls()
    {
        $this->add_control(
            'pro_buttom_content_typography_color',
            [
                'label' => __( 'Color', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-button-wrapper-pro .droit-button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Button::get_type(),
            [
                'name' => 'button_style_bg',
                'label' => __('Button Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-button-wrapper-pro .droit-button',
            ]
        );
        $this->add_group_control(
            Image::get_type(),
            [
                'name' => 'button_image_setting',
                'label' => __('Image Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-button-wrapper-pro .droit-button .droit-button-media img',
                'fields_options' => [
                    'image_setting' => [
                        'default' => '',
                    ],
                    'button_image_setting' => 'custom',
                    'image_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_button_icon_type') => ['image'],
                ],
            ]
        );
        $this->add_group_control(
            Icon::get_type(),
            [
                'name' => 'button_icon_setting',
                'label' => __('Icon Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-button-wrapper-pro .droit-button .droit-button-media i',
                'exclude' => [
                    'background', 'color', 'color_stop', 'color_b',
                    'color_b_stop', 'gradient_type', 'gradient_angle',
                    'gradient_position', 'image', 'position', 'xpos', 'ypos',
                    'attachment', 'attachment_alert', 'repeat', 'size', 'bg_width'
                ],
                'fields_options' => [
                    'icon_setting' => [
                        'default' => '',
                    ],
                    'button_icon_setting' => 'custom',
                    'icon_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_button_icon_type') => ['icon'],
                    $this->get_control_id('_dl_pro_button_selected_icon[library]!') => 'svg',
                ],
            ]
        );

        do_action('dl_widgets/button/pro/section/style/normal', $this);
        $this->add_group_control(
            Icon_SVG::get_type(),
            [
                'name' => 'button_icon_svg_setting',
                'label' => __('Icon Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-button-wrapper-pro .droit-button .droit-button-media svg',
                'exclude' => [
                    'background', 'color', 'color_stop', 'color_b',
                    'color_b_stop', 'gradient_type', 'gradient_angle',
                    'gradient_position', 'image', 'position', 'xpos', 'ypos',
                    'attachment', 'attachment_alert', 'repeat', 'size', 'bg_width'
                ],
                'fields_options' => [
                    'icon_svg_setting' => [
                        'default' => '',
                    ],
                    'button_icon_svg_setting' => 'custom',
                    'icon_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_button_icon_type') => ['icon'],
                    $this->get_control_id('_dl_pro_button_selected_icon[library]') => 'svg',
                ],
            ]
        );

        
        
        do_action('dl_widgets/button/pro/section/style/normal/gaping', $this);
        $this->end_popover();
        do_action('dl_widgets/button/pro/section/style/normal/bottom', $this);
    }
    //Button Style Hover
    protected function _dl_pro_button_hover_controls()
    {
        $this->add_control(
            'button_hover__svg_color',
            [
                'label' => esc_html__('SVG Color', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl-button-wrapper-pro .droit-button:hover svg path' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_button_icon_type') => ['icon'],
                    $this->get_control_id('_dl_pro_button_selected_icon[library]') => 'svg',
                ],
            ]
        );
        $this->add_group_control(
            Button_Hover::get_type(),
            [
                'name' => 'button_hover_style',
                'label' => __('Hover Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-button-wrapper-pro .droit-button:hover',
            ]
        );
        $this->add_control(
            '_dl_pro_button_adv_hover_enable',
            [
                'label' => esc_html__('Advanced Hover', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'return_value' => 'yes',
            ]
        );
        $this->add_group_control(
            Hover_Advanced::get_type(),
            [
                'name' => 'button_hover_style_adv',
                'label' => __('After Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-button-wrapper-pro .droit-button.droit-button---adv-hover:after',
                'condition' => [
                    $this->get_control_id( '_dl_pro_button_adv_hover_enable' ) => [ 'yes' ],
                ],
            ]
        );
        $this->add_group_control(
            Hover_Advanced_Second::get_type(),
            [
                'name' => 'button_hover_style_adv_second',
                'label' => __('After Hover', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-button-wrapper-pro .droit-button.droit-button---adv-hover:hover:after',
                'condition' => [
                    $this->get_control_id( '_dl_pro_button_adv_hover_enable' ) => [ 'yes' ],
                ],
            ]
        );
        do_action('dl_widgets/button/pro/section/style/hover', $this);
    }
}
