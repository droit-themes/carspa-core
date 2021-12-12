<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Dual_Button;

use \Elementor\Controls_Manager;
use \Elementor\Utils;
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

abstract class Dual_Button_Control extends Widget_Base
{

    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    public function get_pro_dual_button_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }
   
    //Preset
    public function _dl_pro_dual_button_preset_controls()
    {
        $this->start_controls_section(
            '_dl_pr_buttons_layout_section',
            [
                'label' => __('Layout', 'droit-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_dual_button_skin',
            [
                'label' => esc_html__('Preset', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/dual_button/control_presets', [
                    '' => 'Default',
                ]),
                'default' => '',
            ]
        );

        $this->add_control(
            '_dl_pro_dual_button_style',
            [
                'label' => esc_html__('Style', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/dual_button/control_style', [
                    'rounded' => 'Rounded',
                    'skew' => 'Skew',
                ]),
                'default' => 'rounded',
            ]
        );

        $this->end_controls_section();
    }

    public function _dl_pro_button_controls()
    {
        $this->_dl_pro_dual_button_content_controls();
        $this->_dl_pro_dual_button_divider_controls();
        $this->_dl_pro_dual_button_style_controls();
        $this->_dl_pro_dual_button_divider_style_controls();
    }
    // Button Content
        public function _dl_pro_dual_button_content_controls()
        {
            $this->start_controls_section(
                '_dl_pro_dual_button_content_section',
                [
                    'label' => __('Content', 'droit-elementor-addons-pro'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_skin') => [''],
                    ],
                ]
            );
            $this->start_controls_tabs('_dl_pro_dual_button_tabs');

            $this->start_controls_tab('_dl_pro_dual_button_tab_first',
                [
                    'label' => esc_html__('First', 'droit-elementor-addons-pro'),
                ]
            );
            $this->_dl_pro_dual_buttons_data_first_controls();
            $this->end_controls_tab();

            $this->end_controls_tab();

            $this->start_controls_tab('_dl_pro_dual_button_tab_second',
                [
                    'label' => esc_html__('Second', 'droit-elementor-addons-pro'),
                ]
            );
            $this->_dl_pro_dual_buttons_data_second_controls();
            $this->end_controls_tab();
            $this->end_controls_tabs();
            $this->end_controls_section();
        }
        // Button First Data
        protected function _dl_pro_dual_buttons_data_first_controls()
        {
            $this->add_control(
                '_dl_pro_dual_button_text', [
                    'label' => __('Text', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __('Enter Text', 'droit-elementor-addons-pro'),
                    'default' => __('Click Here', 'droit-elementor-addons-pro'),
                    'label_block' => true,
                    'description' => __('This text display in button section. NB: Keep empty for hide.', 'droit-elementor-addons-pro'),
                ]
            );
            $this->add_control(
                '_dl_pro_dual_button_link',
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
                        $this->get_control_id('_dl_pro_dual_button_text!') => [''],
                    ],
                ]
            );
            $this->add_control(
                '_dl_pro_dual_button_icon_type',
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
                    ],
                    'default' => 'none',
                ]
            );
            $this->add_control(
                '_dl_pro_dual_button_adv_icon_reverse',
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
                        $this->get_control_id( '_dl_pro_dual_button_icon_type' ) => [ 'icon'],
                    ],
                ]
            );
            $this->add_control(
                '_dl_pro_dual_button_selected_icon',
                [
                    'label' => __( 'Icon', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'fas fa-download',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        $this->get_control_id( '_dl_pro_dual_button_icon_type' ) => [ 'icon' ],
                    ],
                ]
            );
    
             do_action('dl_widgets/button/dual/first/pro/section/content', $this);
        }
        // Button Divider
        public function _dl_pro_dual_button_divider_controls()
        {
            $this->start_controls_section(
                '_dl_pro_dual_button_divider_section',
                [
                    'label' => __('Divider', 'droit-elementor-addons-pro'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_skin') => [''],
                    ],
                ]
            );
            $this->add_control(
            '_dl_pro_dual_button_divider_show',
            [
                'label' => esc_html__('Enable Divider', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'return_value' => 'yes',
            ]
            );
            $this->add_control(
            '_dl_pro_dual_button_divider_type',
            [   
                'label' => esc_html__('Icon Type', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'none' => [
                        'title' => esc_html__('None', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-ban',
                    ],
                    'text' => [
                        'title' => esc_html__('Text', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-text-field',
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
                'default' => 'text',
                'condition' => [
                    $this->get_control_id( '_dl_pro_dual_button_divider_show' ) => [ 'yes' ],
                ],
            ]
        );
            $this->add_control(
                '_dl_pro_dual_divider_text', [
                    'label' => __('Text', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __('Enter Text', 'droit-elementor-addons-pro'),
                    'default' => __('vs', 'droit-elementor-addons-pro'),
                    'label_block' => true,
                    'condition' => [
                        $this->get_control_id( '_dl_pro_dual_button_divider_show' ) => [ 'yes' ],
                        $this->get_control_id( '_dl_pro_dual_button_divider_type' ) => [ 'text' ],
                    ],
                ]
            );
            $this->add_control(
                '_dl_pro_dual_button_divider_selected_icon',
                [
                    'label' => __( 'Icon', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'fas fa-divide',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        $this->get_control_id( '_dl_pro_dual_button_divider_show' ) => [ 'yes' ],
                        $this->get_control_id( '_dl_pro_dual_button_divider_type' ) => [ 'icon' ],
                    ],
                ]
            );
        
       
         $this->add_control(
             '_dl_pro_dual_button_divider_image',
             [   
                 'label' => esc_html__('Image', 'droit-elementor-addons-pro'),
                 'type' => Controls_Manager::MEDIA,
                 'default' => [
                     'url' => '',
                 ],
                 'condition' => [
                    $this->get_control_id( '_dl_pro_dual_button_divider_show' ) => [ 'yes' ],
                    $this->get_control_id( '_dl_pro_dual_button_divider_type' ) => [ 'image' ],
                ],
             ]
         );
         do_action('dl_widgets/button/dual/divider/pro/section/content', $this);
            $this->end_controls_section();
        }
        // Button Second Data
        protected function _dl_pro_dual_buttons_data_second_controls()
        {
            $this->add_control(
                '_dl_pro_dual_button_text_second', [
                    'label' => __('Text', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __('Enter Text', 'droit-elementor-addons-pro'),
                    'default' => __('Click Here', 'droit-elementor-addons-pro'),
                    'label_block' => true,
                    'description' => __('This text display in button section. NB: Keep empty for hide.', 'droit-elementor-addons-pro'),
                ]
            );
            $this->add_control(
                '_dl_pro_dual_button_link_second',
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
                        $this->get_control_id('_dl_pro_dual_button_text_second!') => [''],
                    ],
                ]
            );
            $this->add_control(
                '_dl_pro_dual_button_icon_type_second',
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
                    ],
                    'default' => 'none',
                ]
            );
            $this->add_control(
                '_dl_pro_dual_button_adv_icon_reverse_second',
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
                        $this->get_control_id( '_dl_pro_dual_button_icon_type_second' ) => [ 'icon'],
                    ],
                ]
            );
            $this->add_control(
                '_dl_pro_dual_button_selected_icon_second',
                [
                    'label' => __( 'Icon', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'fas fa-download',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        $this->get_control_id( '_dl_pro_dual_button_icon_type_second' ) => [ 'icon' ],
                    ],
                ]
            );
            
            do_action('dl_widgets/button/dual/second/pro/section/content', $this);
        }
        //Button Style
        public function _dl_pro_dual_button_style_controls()
        {
            do_action('dl_widgets/button/dual/first/pro/section/style/before', $this);
            $this->start_controls_section(
                '_dl_pro_dual_button_style_section',
                [
                    'label' => esc_html__('Button', 'droit-elementor-addons-pro'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->start_controls_tabs('_dl_pro_dual_button_style_tabs');

            $this->start_controls_tab('_dl_pro_dual_button_style_normal_tab_first',
                [
                    'label' => esc_html__('First', 'droit-elementor-addons-pro'),
                ]
                );
                $this->_dl_pro_dual_button_normal_first_controls();
                $this->end_controls_tab();

                $this->start_controls_tab('_dl_pro_dual_button_style_hover_tab_first',
                    [
                        'label' => esc_html__('Hover', 'droit-elementor-addons-pro'),
                    ]
                );
                $this->_dl_pro_dual_button_hover_first_controls();
                $this->end_controls_tab();
                $this->start_controls_tab('_dl_pro_dual_button_style_normal_tab_second',
                [
                    'label' => esc_html__('Second', 'droit-elementor-addons-pro'),
                ]
                );
                $this->_dl_pro_dual_button_normal_second_controls();
                $this->end_controls_tab();

                $this->start_controls_tab('_dl_pro_dual_button_style_hover_tab_second',
                    [
                        'label' => esc_html__('Hover', 'droit-elementor-addons-pro'),
                    ]
                );
                $this->_dl_pro_dual_button_hover_second_controls();
                $this->end_controls_tab();
                $this->end_controls_tabs();
                $this->add_control(
                    '_dl_pro_button_more_options',
                    [
                        'label' => __( 'Before Hover', 'droit-elementor-addons-pro' ),
                        'type' => \Elementor\Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
                );
                $this->add_responsive_control(
                    'button_hover_style_transition',
                    [
                        'label' => __('Transition Duration', 'droit-elementor-addons-pro'),
                        'type' => Controls_Manager::SLIDER,
                        'default' => [
                            'size' => 0.3,
                            'unit' => 'px',
                        ],
                        'size_units' => ['px'],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 200,
                                'step' => 1,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_addon_dual_btn.dl_dual_btn_one' => 'transition: {{SIZE}}s;',
                        ],
                        
                    ]
                );
            do_action('dl_widgets/button/dual/first/pro/section/style/inner', $this);
            $this->end_controls_section();
            do_action('dl_widgets/button/dual/first/pro/section/style/after', $this);
        }
        //Button Style Normal
        protected function _dl_pro_dual_button_normal_first_controls()
        {
            $this->add_group_control(
                Button_Size::get_type(),
                [
                    'name' => 'button_sizes',
                    'label' => __('Size', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_btn_one',
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
                Content_Typography::get_type(),
                [
                    'name' => 'button_style',
                    'label' => __('Typography', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_btn_one',
                    'fields_options' => [
                        'typography' => [
                            'default' => '',
                        ],
                        'button_style' => 'custom',
                        'font_family' => [
                            'default' => '',
                        ],
                        'font_color' => [
                            'default' => '',
                        ],
                        'font_size' => [
                            'desktop_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'tablet_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'mobile_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                        ],
                        'font_weight' => [
                            'default' => '',
                        ],
                        'text_transform' => [
                            'default' => '', // uppercase, lowercase, capitalize, none
                        ],
                        'font_style' => [
                            'default' => '', // normal, italic, oblique
                        ],
                        'text_decoration' => [
                            'default' => '', // underline, overline, line-through, none
                        ],
                        'line_height' => [
                            'desktop_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'tablet_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'mobile_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                        ],
                    ],
                ]
            );
            $this->add_group_control(
                Button::get_type(),
                [
                    'name' => 'button_style_bg',
                    'label' => __('Button Setting', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_btn_one',
                ]
            );
            $this->add_group_control(
                Icon::get_type(),
                [
                    'name' => 'button_icon_setting',
                    'label' => __('Icon Setting', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_btn_one .droit-dual-button-media i',
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
                        'icon_horizontal' => [
                            'default' => [
                                'size' => '0',
                                'unit' => 'px',
                            ],
                        ],
                        'icon_vertical' => [
                            'default' => [
                                'size' => '0',
                                'unit' => 'px',
                            ],
                        ],
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_icon_type') => ['icon'],
                        $this->get_control_id('_dl_pro_dual_button_selected_icon[library]!') => 'svg',
                    ],
                ]
            );
            $this->add_group_control(
                Icon_SVG::get_type(),
                [
                    'name' => 'button_icon_svg_setting',
                    'label' => __('Icon Setting', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_btn_one .droit-dual-button-media svg',
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
                        'icon_horizontal' => [
                            'default' => [
                                'size' => '0',
                                'unit' => 'px',
                            ],
                        ],
                        'icon_vertical' => [
                            'default' => [
                                'size' => '0',
                                'unit' => 'px',
                            ],
                        ],
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_icon_type') => ['icon'],
                        $this->get_control_id('_dl_pro_dual_button_selected_icon[library]') => 'svg',
                    ],
                ]
            );
            $this->add_group_control(
                Position::get_type(),
                [
                    'name' => 'position',
                    'label' => __('Position', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_btn_one',
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
            $this->add_responsive_control(
                '_dl_pro_dual_button_skew_first',
                [
                    'label' => __('Skew', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'allowed_dimensions' => ['top', 'left'],
                    'default' => [
                        'size' => '',
                        'unit' => 'px',
                    ],
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_skew_style .dl_dual_btn_one.dl_addon_dual_btn::before' => 'transform: skew({{TOP}}deg, {{LEFT}}deg);',
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_style') => ['skew'],
                    ],
                ]
            );
            do_action('dl_widgets/button/dual/first/pro/section/style/normal', $this);
        }
        //Button Style Hover
        protected function _dl_pro_dual_button_hover_first_controls()
        {
            $this->add_control(
                'button_hover__svg_color',
                [
                    'label' => esc_html__('SVG Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro:hover .dl_dual_btn_one svg path' => 'fill: {{VALUE}};',
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_icon_type') => ['icon'],
                        $this->get_control_id('_dl_pro_dual_button_selected_icon[library]') => 'svg',
                    ],
                ]
            );
            $this->add_control(
                'button_hover_style_color_hover',
                [
                    'label' => esc_html__('Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_addon_dual_btn:hover.dl_dual_btn_one span' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_addon_dual_btn:hover.dl_dual_btn_one .droit-dual-button-media i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_addon_dual_btn:hover.dl_dual_btn_one .droit-dual-button-media svg path' => 'fill: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'button_hover_style_rounded_hover',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_addon_dual_btn:hover.dl_dual_btn_one',
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_style') => ['rounded'],
                    ]
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'button_hover_style_skew_hover',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_skew_style .dl_addon_dual_btn:hover.dl_dual_btn_one:before',
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_style') => ['skew'],
                    ]
                ]
            );
            $this->add_responsive_control(
                'button_hover_style_hover_transition',
                [
                    'label' => __('Transition Duration', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0.3,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_addon_dual_btn:hover.dl_dual_btn_one' => 'transition: {{SIZE}}s;',
                    ],
                    
                ]
            );
            
            do_action('dl_widgets/button/dual/first/pro/section/style/hover', $this);
        }
        //Button Style Second Normal
        protected function _dl_pro_dual_button_normal_second_controls()
        {
            $this->add_group_control(
                Button_Size::get_type(),
                [
                    'name' => 'button_sizes_second',
                    'label' => __('Size', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_btn_two',
                    'fields_options' => [
                        'button_size' => [
                            'default' => '',
                        ],
                        'button_sizes_second' => 'custom',
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
                Content_Typography::get_type(),
                [
                    'name' => 'button_style_second',
                    'label' => __('Typography', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_btn_two',
                    'fields_options' => [
                        'typography' => [
                            'default' => '',
                        ],
                        'button_style_second' => 'custom',
                        'font_family' => [
                            'default' => '',
                        ],
                        'font_color' => [
                            'default' => '',
                        ],
                        'font_size' => [
                            'desktop_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'tablet_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'mobile_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                        ],
                        'font_weight' => [
                            'default' => '',
                        ],
                        'text_transform' => [
                            'default' => '', // uppercase, lowercase, capitalize, none
                        ],
                        'font_style' => [
                            'default' => '', // normal, italic, oblique
                        ],
                        'text_decoration' => [
                            'default' => '', // underline, overline, line-through, none
                        ],
                        'line_height' => [
                            'desktop_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'tablet_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'mobile_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                        ],
                    ],
                ]
            );
            $this->add_group_control(
                Button::get_type(),
                [
                    'name' => 'button_style_bg_second',
                    'label' => __('Button Setting', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_btn_two',
                ]
            );
            $this->add_group_control(
                Icon::get_type(),
                [
                    'name' => 'button_icon_setting_second',
                    'label' => __('Icon Setting', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_btn_two .droit-dual-button-media i',
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
                        'button_icon_setting_second' => 'custom',
                        'icon_width' => [
                            'default' => [
                                'size' => '',
                                'unit' => 'px',
                            ],
                        ],
                        'icon_horizontal' => [
                            'default' => [
                                'size' => '0',
                                'unit' => 'px',
                            ],
                        ],
                        'icon_vertical' => [
                            'default' => [
                                'size' => '0',
                                'unit' => 'px',
                            ],
                        ],
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_icon_type_second') => ['icon'],
                        $this->get_control_id('_dl_pro_dual_button_selected_icon_second[library]!') => 'svg',
                    ],
                ]
            );
            $this->add_group_control(
                Icon_SVG::get_type(),
                [
                    'name' => 'button_icon_svg_setting_second',
                    'label' => __('Icon Setting', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_btn_two .droit-dual-button-media svg',
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
                        'button_icon_svg_setting_second' => 'custom',
                        'icon_width' => [
                            'default' => [
                                'size' => '',
                                'unit' => 'px',
                            ],
                        ],
                        'icon_horizontal' => [
                            'default' => [
                                'size' => '0',
                                'unit' => 'px',
                            ],
                        ],
                        'icon_vertical' => [
                            'default' => [
                                'size' => '0',
                                'unit' => 'px',
                            ],
                        ],
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_icon_type_second') => ['icon'],
                        $this->get_control_id('_dl_pro_dual_button_selected_icon_second[library]') => 'svg',
                    ],
                ]
            );
            $this->add_group_control(
                Position::get_type(),
                [
                    'name' => 'position_second',
                    'label' => __('Position', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_btn_two',
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
            $this->add_responsive_control(
                '_dl_pro_dual_button_skew_second',
                [
                    'label' => __('Skew', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'allowed_dimensions' => ['top', 'left'],
                    'default' => [
                        'size' => '',
                        'unit' => 'px',
                    ],
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_skew_style .dl_dual_btn_two.dl_addon_dual_btn::before' => 'transform: skew({{TOP}}deg, {{LEFT}}deg);',
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_style') => ['skew'],
                    ],
                ]
            );
            do_action('dl_widgets/button/dual/first/pro/section/style/normal', $this);
        }
        protected function _dl_pro_dual_button_hover_second_controls()
        {
$this->add_control(
                'button_hover__svg_color_second',
                [
                    'label' => esc_html__('SVG Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro:hover .dl_dual_btn_two svg path' => 'fill: {{VALUE}};',
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_icon_type') => ['icon'],
                        $this->get_control_id('_dl_pro_dual_button_selected_icon[library]') => 'svg',
                    ],
                ]
            );
            $this->add_control(
                'button_hover_style_color_hover_second',
                [
                    'label' => esc_html__('Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_addon_dual_btn:hover.dl_dual_btn_two span' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_addon_dual_btn:hover.dl_dual_btn_two .droit-dual-button-media i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_addon_dual_btn:hover.dl_dual_btn_two .droit-dual-button-media svg path' => 'fill: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'button_hover_style_rounded_hover_second',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_addon_dual_btn:hover.dl_dual_btn_two',
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_style') => ['rounded'],
                    ]
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'button_hover_style_skew_hover_second',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_dual_skew_style .dl_addon_dual_btn:hover.dl_dual_btn_two:before',
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_style') => ['skew'],
                    ]
                ]
            );
            $this->add_responsive_control(
                'button_hover_style_hover_transition_second',
                [
                    'label' => __('Transition Duration', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0.3,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl_addon_dual_btn:hover.dl_dual_btn_two' => 'transition: {{SIZE}}s;',
                    ],
                    
                ]
            );
            }
        //Button Divider Style
        public function _dl_pro_dual_button_divider_style_controls()
        {
            do_action('dl_widgets/button/dual/first/pro/section/style/dual/before', $this);
            $this->start_controls_section(
                '_dl_pro_dual_button_divider_style_section',
                [
                    'label' => esc_html__('Divider', 'droit-elementor-addons-pro'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        $this->get_control_id( '_dl_pro_dual_button_divider_show' ) => [ 'yes' ],
                    ],
                ]
            );

            $this->start_controls_tabs('_dl_pro_dual_button_style_divider_tabs');

            $this->start_controls_tab('_dl_pro_dual_button_style_normal_tab_divider',
                [
                    'label' => esc_html__('Normal', 'droit-elementor-addons-pro'),
                ]
                );
                $this->_dl_pro_dual_button_normal_divider_controls();
                $this->end_controls_tab();

                $this->start_controls_tab('_dl_pro_dual_button_style_hover_tab_divider',
                    [
                        'label' => esc_html__('Hover', 'droit-elementor-addons-pro'),
                    ]
                );
                $this->_dl_pro_dual_button_hover_divider_controls();
                $this->end_controls_tab();
            $this->end_controls_tabs();
            do_action('dl_widgets/button/dual/first/pro/section/style/dual/inner', $this);
            $this->end_controls_section();
            do_action('dl_widgets/button/dual/first/pro/section/style/dual/after', $this);
        }
        protected function _dl_pro_dual_button_normal_divider_controls(){
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => '_dl_pro_dual_button_divider_bg',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl-middle-divider'
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => '_dl_pro_dual_button_divider_border',
                    'label' => esc_html__('Border', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl-middle-divider'
                ]
            );
            $this->add_responsive_control(
                '_dl_pro_dual_button_divider_radius',
                [
                    'label' => esc_html__('Border Radius', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl-middle-divider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Content_Typography::get_type(),
                [
                    'name' => 'divider_style',
                    'label' => __('Typography', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl-middle-divider span',
                    'fields_options' => [
                        'typography' => [
                            'default' => '',
                        ],
                        'divider_style' => 'custom',
                        'font_family' => [
                            'default' => '',
                        ],
                        'font_color' => [
                            'default' => '',
                        ],
                        'font_size' => [
                            'desktop_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'tablet_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'mobile_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                        ],
                        'font_weight' => [
                            'default' => '',
                        ],
                        'text_transform' => [
                            'default' => '', // uppercase, lowercase, capitalize, none
                        ],
                        'font_style' => [
                            'default' => '', // normal, italic, oblique
                        ],
                        'text_decoration' => [
                            'default' => '', // underline, overline, line-through, none
                        ],
                        'line_height' => [
                            'desktop_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'tablet_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'mobile_default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                        ],
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_divider_type') => ['text'],
                    ],
                ]
            );
            $this->add_group_control(
                Icon::get_type(),
                [
                    'name' => 'divider_icon_setting',
                    'label' => __('Icon Setting', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl-middle-divider i',
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
                        'divider_icon_setting' => 'custom',
                        'icon_width' => [
                            'default' => [
                                'size' => '',
                                'unit' => 'px',
                            ],
                        ],
                        'icon_horizontal' => [
                            'default' => [
                                'size' => '0',
                                'unit' => 'px',
                            ],
                        ],
                        'icon_vertical' => [
                            'default' => [
                                'size' => '0',
                                'unit' => 'px',
                            ],
                        ],
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_divider_type') => ['icon'],
                        $this->get_control_id('_dl_pro_dual_button_divider_selected_icon[library]!') => 'svg',
                    ],
                ]
            );
            $this->add_control(
                '_dl_pro_dual_button_divider__svg_color',
                [
                    'label' => esc_html__('Icon Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl-middle-divider svg path' => 'fill: {{VALUE}};',
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_divider_type') => ['icon'],
                        $this->get_control_id('_dl_pro_dual_button_divider_selected_icon[library]') => 'svg',
                    ],
                ]
            );
            $this->add_group_control(
                Icon_SVG::get_type(),
                [
                    'name' => 'divider_icon_svg_setting',
                    'label' => __('Icon Setting', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl-middle-divider svg',
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
                        'divider_icon_svg_setting' => 'custom',
                        'icon_width' => [
                            'default' => [
                                'size' => '',
                                'unit' => 'px',
                            ],
                        ],
                        'icon_horizontal' => [
                            'default' => [
                                'size' => '0',
                                'unit' => 'px',
                            ],
                        ],
                        'icon_vertical' => [
                            'default' => [
                                'size' => '0',
                                'unit' => 'px',
                            ],
                        ],
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_divider_type') => ['icon'],
                        $this->get_control_id('_dl_pro_dual_button_divider_selected_icon[library]') => 'svg',
                    ],
                ]
            );
            $this->add_group_control(
                Image::get_type(),
                [
                    'name' => '_dl_pro_dual_button_divider_image_setting',
                    'label' => __('Image Setting', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl-middle-divider img',
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
                        $this->get_control_id('_dl_pro_dual_button_divider_type') => ['image'],
                    ],
                ]
            );
            $this->add_group_control(
                Position::get_type(),
                [
                    'name' => 'divider_position',
                    'label' => __('Position', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl-middle-divider',
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
            $this->add_responsive_control(
                '_dl_pro_dual_button_divider__transition',
                [
                    'label' => __('Transition Duration', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '',
                        'unit' => 'px',
                    ],
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro .dl-middle-divider' => 'transition: {{SIZE}}s;',
                    ],
                    
                ]
            );
        }
        //Button Divider Hover Style
        protected function _dl_pro_dual_button_hover_divider_controls(){
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => '_dl_pro_dual_button_divider_hover_bg',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .dl-dual-button-wrapper-pro:hover .dl-middle-divider'
                ]
            );
            
            $this->add_responsive_control(
                '_dl_pro_dual_button_divider_hover_radius',
                [
                    'label' => esc_html__('Border Radius', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro:hover .dl-middle-divider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_control(
                '_dl_pro_dual_button_divider_hover__color',
                [
                    'label' => esc_html__('Icon Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro:hover .dl-middle-divider i' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_divider_type') => ['icon'],
                        $this->get_control_id('_dl_pro_dual_button_divider_selected_icon[library]!') => 'svg',
                    ],
                ]
            );
            $this->add_control(
                '_dl_pro_dual_button_divider_hover__svg_color',
                [
                    'label' => esc_html__('Icon Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro:hover .dl-middle-divider svg path' => 'fill: {{VALUE}};',
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_dual_button_divider_type') => ['icon'],
                        $this->get_control_id('_dl_pro_dual_button_divider_selected_icon[library]') => 'svg',
                    ],
                ]
            );
            $this->add_responsive_control(
                '_dl_pro_dual_button_divider_hover__transition',
                [
                    'label' => __('Transition Duration', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '',
                        'unit' => 'px',
                    ],
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .dl-dual-button-wrapper-pro:hover .dl-middle-divider' => 'transition: {{SIZE}}s;',
                    ],
                    
                ]
            );
        }
}
