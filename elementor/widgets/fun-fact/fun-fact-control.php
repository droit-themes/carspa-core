<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Fun_Fact;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
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

abstract class Fun_Fact_Control extends Widget_Base
{

    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    public function get_pro_fun_fact_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }
   
    //Preset
    public function _dl_pro_fun_fact_preset_controls()
    {
        $this->start_controls_section(
            '_dl_pr_fun_fact_layout_section',
            [
                'label' => __('Layout', 'droit-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_fun_fact_skin',
            [
                'label' => esc_html__('Preset', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/fun_fact/control_presets', [
                    '' => 'Default',
                ]),
                'default' => '',
            ]
        );

        $this->end_controls_section();
    }


    // Fun Fact Content
    public function _dl_pro_fun_fact_content_controls()
    {
        $this->start_controls_section(
            '_dl_pro_fun_fact_content_section',
            [
                'label' => __('Content', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_fun_fact_skin') => [''],
                ],
            ]
        );
        $this->_dl_pro_fun_fact_data_controls();
        $this->end_controls_section();
    }
        // Fun Fact Data
        protected function _dl_pro_fun_fact_data_controls()
        {
            $this->add_control(
                '_dl_pro_fun_fact_heading', [
                    'label' => __('Heading', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __('Heading', 'droit-elementor-addons-pro'),
                    'default' => __('Download', 'droit-elementor-addons-pro'),
                    'label_block' => true,
                    'description' => __('The heading will be display as fun fact heading. NB: Keep empty for hide.', 'droit-elementor-addons-pro'),
                ]
            );
            
            $this->add_control(
                '_dl_pro_fun_fact_text', [
                    'label' => __('Number', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __('Number', 'droit-elementor-addons-pro'),
                    'default' => __('72933', 'droit-elementor-addons-pro'),
                    'label_block' => true,
                    'description' => __('The prefix will be display as fun fact number. NB: Keep empty for hide.', 'droit-elementor-addons-pro'),
                ]
            );

            $this->add_control(
                '_dl_pro_fun_fact_prefix', [
                    'label' => __('Prefix', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __('$', 'droit-elementor-addons-pro'),
                    'default' => __('$', 'droit-elementor-addons-pro'),
                    'label_block' => true,
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_text!') => [''],
                    ],
                    'description' => __('The prefix will be display before number. NB: Keep empty for hide.', 'droit-elementor-addons-pro'),
                ]
            );

            $this->add_control(
                '_dl_pro_fun_fact_suffix', [
                    'label' => __('Suffix', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __('B', 'droit-elementor-addons-pro'),
                    'default' => __('B', 'droit-elementor-addons-pro'),
                    'label_block' => true,
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_text!') => [''],
                    ],
                    'description' => __('The prefix will be display after number. NB: Keep empty for hide.', 'droit-elementor-addons-pro'),
                ]
            );
            
            $this->add_control(
                '_dl_pro_fun_fact_link',
                [
                    'label' => __('Link', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => __('https://your-link.com', 'droit-elementor-addons-pro'),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_text!') => [''],
                    ],
                    'description' => __('The link will be linked the box. NB: Keep empty for nothing to use.', 'droit-elementor-addons-pro'),
                ]
            );
            $this->add_control(
                '_dl_pro_fun_fact_icon_type',
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
                    'default' => 'Icon',
                    'seperator' => 'before',
                ]
            );
            
            $this->add_control(
                '_dl_pro_fun_fact_selected_icon',
                [
                    'label' => __( 'Icon', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'fas fa-atom',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        $this->get_control_id( '_dl_pro_fun_fact_icon_type' ) => [ 'icon' ],
                    ],
                ]
            );
            
             $this->add_control(
                 '_dl_pro_fun_fact_icon_image',
                 [   
                     'label' => esc_html__('Image', 'droit-elementor-addons-pro'),
                     'type' => Controls_Manager::MEDIA,
                     'default' => [
                         'url' => '',
                     ],
                     'condition' => [
                        $this->get_control_id( '_dl_pro_fun_fact_icon_type' ) => [ 'image' ],
                    ],
                 ]
             );

             $this->add_control(
                '_dl_pro_fun_fact_icon_position',
                [
                    'label' => __( 'Position', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'fun_fact_icon_top' => [
                            'title' => __( 'TOP', 'plugin-domain' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'fun_fact_icon_left' => [
                            'title' => __( 'left', 'plugin-domain' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'fun_fact_icon_right' => [
                            'title' => __( 'Right', 'plugin-domain' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => 'fun_fact_icon_top',
                    'toggle' => true,
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_icon_type') => ['icon', 'image'],
                    ],
                ]
            );
    
            do_action('dl_pro_fun_fact_content', $this);
        }
        // Fun Fact Setting
        public function _dl_pro_fun_fact_setting_controls()
        {
            $this->start_controls_section(
                '_dl_pro_fun_fact_setting_section',
                [
                    'label' => __('Setting', 'droit-elementor-addons-pro'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_skin') => [''],
                    ],
                ]
            );
            $this->add_control(
                '_dl_pro_fun_fact_delay', [
                    'label' => __('Delay', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 5,
                    'max' => 10000,
                    'step' => 1,
                    'placeholder' => __(10, 'droit-elementor-addons-pro'),
                    'default' => __(10, 'droit-elementor-addons-pro'),
                ]
            );
            $this->add_control(
                '_dl_pro_fun_fact_timer', [
                    'label' => __('Timer', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 5,
                    'max' => 10000,
                    'step' => 1,
                    'placeholder' => __(1000, 'droit-elementor-addons-pro'),
                    'default' => __(1000, 'droit-elementor-addons-pro'),
                ]
            );
            $this->end_controls_section();
        }
        // Fun Fact Style
        public function _dl_pro_fun_fact_style_controls()
        {
            do_action('dl_widgets/fun_fact/pro/section/style/before', $this);
            $this->start_controls_section(
                '_dl_pro_fun_fact_style_section',
                [
                    'label' => esc_html__('Style', 'droit-elementor-addons-pro'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,

                ]
            );

            $this->add_control(
                'text_align',
                [
                    'label'       => __('Alignment', 'droit-elementor-addons-pro'),
                    'type'        => Controls_Manager::CHOOSE,
                    'options'     => [
                        'left'   => [
                            'title' => __('Left', 'droit-elementor-addons-pro'),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', 'droit-elementor-addons-pro'),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'right'  => [
                            'title' => __('Right', 'droit-elementor-addons-pro'),
                            'icon'  => 'eicon-text-align-right',
                        ],
                        'justify'  => [
                            'title' => __('Justify', 'droit-elementor-addons-pro'),
                            'icon'  => 'eicon-text-align-justify',
                        ],
                    ],
                    'toggle'      => true,
                    'selectors'   => [
                        '{{WRAPPER}} .dl--wrapper' => 'text-align: {{VALUE}};',
                    ],
                    'default'     => 'center',
                    'render_type' => 'template',
                ]
            );

            $this->add_group_control(
                Position::get_type(),
                [
                    'name' => 'position',
                    'label' => __('Position', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl--wrapper',
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

            $this->start_controls_tabs('_dl_pro_fun_fact_tabs');

            $this->start_controls_tab('_dl_pro_fun_fact_normal_tab',
                [
                    'label' => esc_html__('Normal', 'droit-elementor-addons-pro'),
                ]
            );
            $this->_dl_pro_fun_fact_normal_controls();
            $this->end_controls_tab();

            $this->end_controls_tab();

            $this->start_controls_tab('_dl_pro_fun_fact_hover',
                [
                    'label' => esc_html__('Hover', 'droit-elementor-addons-pro'),
                ]
            );
            $this->_dl_pro_fun_fact_hover_controls();
            $this->end_controls_tab();

            $this->end_controls_tabs();
            $this->add_control(
                'fun_fact_icon_style_wrapper',
                [
                    'label' => __( 'Icon', 'elementor' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_icon_type') => ['icon', 'image'],
                    ],
                ]
            );
            $this->add_control(
                'icon_text_align',
                [
                    'label'       => __('Alignment', 'droit-elementor-addons-pro'),
                    'type'        => Controls_Manager::CHOOSE,
                    'options'     => [
                        'flex-start'   => [
                            'title' => __('Left', 'droit-elementor-addons-pro'),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', 'droit-elementor-addons-pro'),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'flex-end'  => [
                            'title' => __('Right', 'droit-elementor-addons-pro'),
                            'icon'  => 'eicon-text-align-right',
                        ],
                    ],
                    'toggle'      => true,
                    'selectors'   => [
                        '{{WRAPPER}} .droit-fun-fact-media-wrapper' => 'justify-content: {{VALUE}};',
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_icon_type') => ['icon', 'image'],
                        $this->get_control_id('_dl_pro_fun_fact_icon_position') => ['fun_fact_icon_top'],
                    ],
                    'default'     => 'center',
                ]
            );
            $this->add_responsive_control(
                'fun_fact_icon_wrapper_size',
                [
                    'label' => __( 'Size', 'plugin-domain' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 300,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 300,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 80,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .droit-fun-fact-media' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_icon_type') => ['icon', 'image'],
                    ],
                ]
            );
            $this->add_responsive_control(
                'fun_fact_icon_wrapper_icon_size',
                [
                    'label' => __( 'Icon Size', 'plugin-domain' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 16,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .droit-fun-fact-media i, .droit-fun-fact-media span, .droit-fun-fact-media svg, .droit-fun-fact-media img' => 'width: {{SIZE}}{{UNIT}};font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_icon_type') => ['icon', 'image'],
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'fun_fact_icon_background',
                    'label' => __( 'Background', 'plugin-domain' ),
                    'types' => [ 'classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .droit-fun-fact-media',
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_icon_type') => ['icon', 'image'],
                    ],
                ]
            );
            $this->add_control(
                'fun_fact_icon_border_radius',
                [
                    'label' => __( 'Border Radius', 'plugin-domain' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .droit-fun-fact-media' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_icon_type') => ['icon', 'image'],
                    ],
                ]
            );
    
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'fun_fact_icon_border',
                    'label' => __( 'Border', 'plugin-domain' ),
                    'selector' => '{{WRAPPER}} .droit-fun-fact-media',
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_icon_type') => ['icon', 'image'],
                    ],
                ]
            );
            do_action('dl_widgets/fun_fact/pro/section/style/inner', $this);
            $this->end_controls_section();
            do_action('dl_widgets/fun_fact/pro/section/style/after', $this);
        }
        // Fun Fact Style Normal
        protected function _dl_pro_fun_fact_normal_controls()
        {
            
            $this->add_group_control(
                Content_Typography::get_type(),
                [
                    'name' => 'fun_fact_style_heading',
                    'label' => __('Heading Typography', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl--wrapper .dl-fun-fact-heading .dl_pro_fun_fact_title',
                    'fields_options' => [
                        'typography' => [
                            'default' => '',
                        ],
                        'fun_fact_style' => 'custom',
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
                Content_Typography::get_type(),
                [
                    'name' => 'fun_fact_style_number',
                    'label' => __('Number Typography', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl--wrapper .dl-fun-fact-number',
                    'fields_options' => [
                        'typography' => [
                            'default' => '',
                        ],
                        'fun_fact_style' => 'custom',
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
                Content_Typography::get_type(),
                [
                    'name' => 'fun_fact_style_prefix',
                    'label' => __('Prefix Typography', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl--wrapper .dl-fun-fact-prefix',
                    'fields_options' => [
                        'typography' => [
                            'default' => '',
                        ],
                        'fun_fact_style' => 'custom',
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
                Content_Typography::get_type(),
                [
                    'name' => 'fun_fact_style_suffix',
                    'label' => __('Suffix Typography', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl--wrapper .dl-fun-fact-suffix',
                    'fields_options' => [
                        'typography' => [
                            'default' => '',
                        ],
                        'fun_fact_style' => 'custom',
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
                    'name' => 'fun_fact_style_bg',
                    'label' => __('Background Setting', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl--wrapper',
                ]
            );
            $this->add_group_control(
                Image::get_type(),
                [
                    'name' => 'fun_fact_image_setting',
                    'label' => __('Image Setting', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl--wrapper .droit-fun-fact-media img',
                    'fields_options' => [
                        'image_setting' => [
                            'default' => '',
                        ],
                        'fun_fact_image_setting' => 'custom',
                        'image_width' => [
                            'default' => [
                                'size' => '',
                                'unit' => 'px',
                            ],
                        ],
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_icon_type') => ['image'],
                    ],
                ]
            );
            $this->add_group_control(
                Icon::get_type(),
                [
                    'name' => 'fun_fact_icon_setting',
                    'label' => __('Icon Setting', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl--wrapper .droit-fun-fact-media i',
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
                        'fun_fact_icon_setting' => 'custom',
                        'icon_width' => [
                            'default' => [
                                'size' => '',
                                'unit' => 'px',
                            ],
                        ],
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_icon_type') => ['icon'],
                        $this->get_control_id('_dl_pro_fun_fact_selected_icon[library]!') => 'svg',
                    ],
                ]
            );

            $this->add_group_control(
                Icon_SVG::get_type(),
                [
                    'name' => 'fun_fact_icon_svg_setting',
                    'label' => __('Icon Setting', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl--wrapper .droit-fun-fact-media svg',
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
                        'fun_fact_icon_svg_setting' => 'custom',
                        'icon_width' => [
                            'default' => [
                                'size' => '',
                                'unit' => 'px',
                            ],
                        ],
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_icon_type') => ['icon'],
                        $this->get_control_id('_dl_pro_fun_fact_selected_icon[library]') => 'svg',
                    ],
                ]
            );
            do_action('dl_widgets/fun_fact/pro/section/style/normal', $this);

            do_action('dl_widgets/fun_fact/pro/section/style/normal/gaping', $this);
            $this->end_popover();
            do_action('dl_widgets/fun_fact/pro/section/style/normal/bottom', $this);
        }
        //Fun Fact Style Hover
        protected function _dl_pro_fun_fact_hover_controls()
        {
            $this->add_control(
                'dl_fun_fact_hover_background',
                [
                    'label' => __( 'Background', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .dl-fun-fact-wrapper:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'dl_fun_fact_hover_color',
                [
                    'label' => __( 'Color', 'droit-elementor-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .dl-fun-fact-wrapper:hover .dl_pro_fun_fact_title, .dl-fun-fact-wrapper:hover .dl-fun-fact-prefix, .dl-fun-fact-wrapper:hover .dl-fun-fact-number, .dl-fun-fact-wrapper:hover .dl-fun-fact-suffix' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'dl_fun_fact_hover_icon_background',
                [
                    'label' => __( 'Icon Background', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .dl-fun-fact-wrapper:hover .droit-fun-fact-media' => 'background-color: {{VALUE}}',
                    ],
    
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_icon_type') => ['icon', 'image'],
                    ],
                ]
            );
            $this->add_control(
                'fun_fact_hover__svg_color',
                [
                    'label' => esc_html__('SVG Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl--wrapper:hover svg path' => 'fill: {{VALUE}};',
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_selected_icon[library]') => 'svg',
                    ],
                ]
            );
            $this->add_control(
                'fun_fact_hover_icon_color',
                [
                    'label' => esc_html__('Icon Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl--wrapper:hover .droit-fun_fact_icon' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_icon_type') => ['icon'],
                    ],
                ]
            );
            $this->add_control(
                'fun_fact_hover_border_color',
                [
                    'label' => esc_html__('Border Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl--wrapper:hover .droit-fun-fact-media' => 'border-color: {{VALUE}};',
                    ],
                    'condition' => [
                        $this->get_control_id('_dl_pro_fun_fact_icon_type') => ['icon', 'image'],
                    ],
                ]
            );
            do_action('dl_widgets/fun_fact/pro/section/style/hover', $this);
        }
        // Ordering Repeater
        public function _dl_pro_fun_fact_ordering_controls(){
            $this->start_controls_section(
                '_dl_pro_fun_fact_repeater_order_section',
                [
                    'label' => esc_html__('Content Ordering', 'droit-elementor-addons-pro'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
            $repeater = new \Elementor\Repeater();
            $repeater->add_control(
                '_dl_pro_fun_fact_order_enable',
                [
                    'label' => __('Enable', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'return_value' => 'yes',
                ]
            );
            $repeater->add_control(
                '_dl_pro_fun_fact_order_label',
                [
                    'label' => __('Label', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::HIDDEN,
                ]
            );
            $repeater->add_control(
                '_dl_pro_fun_fact_order_id',
                [
                    'label' => __('Id', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::HIDDEN,
                ]
            );
            
            $this->add_control(
                '_dl_pro_fun_fact_ordering_data',
                [
                    'label' => __('Re-order', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'item_actions' =>[
                        'duplicate' => false,
                        'add' => false,
                        'remove' => false
                    ],
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            '_dl_pro_fun_fact_order_enable' => 'yes',
                            '_dl_pro_fun_fact_order_label' => 'Prefix',
                            '_dl_pro_fun_fact_order_id' => 'fun_prefix',
                        ],
                        [
                            '_dl_pro_fun_fact_order_enable' => 'yes',
                            '_dl_pro_fun_fact_order_label' => 'Number',
                            '_dl_pro_fun_fact_order_id' => 'fun_number',
                        ],
                        [
                            '_dl_pro_fun_fact_order_enable' => 'yes',
                            '_dl_pro_fun_fact_order_label' => 'Suffix',
                            '_dl_pro_fun_fact_order_id' => 'fun_suffix',
                        ],
                        [
                            '_dl_pro_fun_fact_order_enable' => 'yes',
                            '_dl_pro_fun_fact_order_label' => 'Heading',
                            '_dl_pro_fun_fact_order_id' => 'fun_heading',
                        ],
                    ],
                    'title_field' => '<i class="eicon-editor-list-ul"></i>{{{ _dl_pro_fun_fact_order_label }}}',
                ]
            );
            $this->end_controls_section();
        }
    
}
