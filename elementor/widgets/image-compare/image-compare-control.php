<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Image_Compare;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
use \DROIT_ELEMENTOR_PRO\Position;
use \DROIT_ELEMENTOR_PRO\Button;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {exit;}

abstract class Image_Compare_Control extends Widget_Base
{

    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    public function get_pro_image_compare_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }
   
    //Preset
    public function _dl_pro_image_compare_preset_controls()
    {
        $this->start_controls_section(
            '_dl_pr_image_compare_layout_section',
            [
                'label' => __('Layout', 'droit-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_image_compare_skin',
            [
                'label' => esc_html__('Preset', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/image_compare/control_presets', [
                    '' => 'Default',
                ]),
                'default' => '',
            ]
        );
        
        $this->add_control(
            '_dl_pro_image_alignment',
            [   
                'label' => esc_html__('Image Alignment', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/image_compare/control_presets',[
                    'flex-start' => [
                        'title' => esc_html__('Left', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ]),
                'selectors' => [
                    '{{WRAPPER}} .dl-compare' => 'justify-content: {{VALUE}}',
                ],
                'default' => '',
            ]
        );
        
        $this->end_controls_section();
    }
    
    // Image Content
    public function _dl_pro_image_compare_content_controls()
    {
        do_action('dl_widgets/image_compare/pro/section/before', $this);
        $this->start_controls_section(
            '_dl_pro_image_compare_content_section',
            [
                'label' => __('Content', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_image_compare_skin') => [''],
                ],
            ]
        );
        $this->_dl_pro_image_compare_data_controls();
        do_action('dl_widgets/image_compare/pro/section/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/image_compare/pro/section/after', $this);
    }
    // Image Data
    protected function _dl_pro_image_compare_data_controls()
    {
        $this->start_controls_tabs('_dl_pro_image_compare_tabs');

        $this->start_controls_tab('_dl_pro_image_compare_before_tab',
            [
                'label' => esc_html__('Before', 'droit-elementor-addons-pro'),
            ]
        );
        $this->_dl_pro_image_compare_before_controls();
        $this->end_controls_tab();

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_image_compare_after_tab',
            [
                'label' => esc_html__('After', 'droit-elementor-addons-pro'),
            ]
        );
        $this->_dl_pro_image_compare_after_controls();
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'condition' => [
                    $this->get_control_id('_dl_pro_image_compare_before[url]!') => [''],
                    $this->get_control_id('_dl_pro_image_compare_after[url]!') => [''],
                ],
                'separator' => 'before',
            ]
        );
        do_action('dl_widgets/image_compare/pro/content_bottom', $this);
    }

    protected function _dl_pro_image_compare_before_controls(){
        $this->add_control(
            '_dl_pro_image_compare_before', [
                'label' => __('Image', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'show_label' => false,
            ]
        );
        
        $this->add_control(
            '_dl_pro_image_compare_before_type',
            [   
                'label' => esc_html__('Icon Type', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'none' => [
                        'title' => esc_html__('Default', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-ban',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-gear',
                    ],
                ],
                'default' => 'default',
            ]
        );
        $this->add_control(
            '_dl_pro_image_compare_before_selected_icon',
            [
                'label' => __( 'Icon', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'condition' => [
                    $this->get_control_id( '_dl_pro_image_compare_before_type' ) => [ 'icon' ],
                ],
            ]
        );
        
            $this->add_control(
            '_dl_pro_image_compare_before_btn', [
                'label' => __('Button Text', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Text', 'droit-elementor-addons-pro'),
                'default' => __('Before', 'droit-elementor-addons-pro'),
                'label_block' => true,
                'seperator' => 'before',
                'condition' => [
                    $this->get_control_id('_dl_pro_image_compare_overlay') => ['yes'],
                    $this->get_control_id('_dl_pro_image_compare_before[url]!') => [''],
                    $this->get_control_id('_dl_pro_image_compare_after[url]!') => [''],
                ],
                'description' => __('Do not show label if overlay hide. (keep empty for hide label)', 'droit-elementor-addons-pro'),
                ]
        );
        do_action('dl_widgets/image_compare/pro/content/before', $this);
    }
    protected function _dl_pro_image_compare_after_controls(){
        $this->add_control(
            '_dl_pro_image_compare_after', [
                'label' => __('Image', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'show_label' => false,
            ]
        );
        
        $this->add_control(
            '_dl_pro_image_compare_after_selected_icon',
            [
                'label' => __( 'Icon', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'condition' => [
                    $this->get_control_id( '_dl_pro_image_compare_before_type' ) => [ 'icon' ],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_image_compare_after_btn', [
                'label' => __('Button Text', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Text', 'droit-elementor-addons-pro'),
                'default' => __('After', 'droit-elementor-addons-pro'),
                'label_block' => true,
                'condition' => [
                    $this->get_control_id('_dl_pro_image_compare_overlay') => ['yes'],
                    $this->get_control_id('_dl_pro_image_compare_before[url]!') => [''],
                    $this->get_control_id('_dl_pro_image_compare_after[url]!') => [''],
                ],
                'description' => __('Do not show label if overlay hide. (keep empty for hide label)', 'droit-elementor-addons-pro'),
            ]
        );
        do_action('dl_widgets/image_compare/pro/content/before', $this);
    }

    // Image Setting
    public function _dl_pro_image_compare_setting_controls()
    {
        do_action('dl_widgets/image_compare/pro/section/setting/before', $this);
        $this->start_controls_section(
            '_dl_pro_image_compare_setting_section',
            [
                'label' => __('Settings', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_image_compare_skin') => [''],
                    $this->get_control_id('_dl_pro_image_compare_before[url]!') => [''],
                    $this->get_control_id('_dl_pro_image_compare_after[url]!') => [''],
                ],
            ]
        );
        
        $this->add_control(
            '_dl_pro_image_compare_orientation',
            [
                'label' => __( 'Orientation', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal'  => __( 'Horizontal', 'droit-elementor-addons-pro' ),
                    'vertical' => __( 'Vertical', 'droit-elementor-addons-pro' ),
                ],
            ]
        );
        
        $this->add_control(
            '_dl_pro_image_compare_move',
            [
                'label' => esc_html__('Move', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'droit-elementor-addons-pro' ),
                'label_off' => __( 'No', 'droit-elementor-addons-pro' ),
                'return_value' => 'yes',
                'default' => '',
                'description' => __('Move slider on mouse hover', 'droit-elementor-addons-pro')
            ]
        );
        $this->add_control(
            '_dl_pro_image_compare_overlay',
            [
                'label' => esc_html__('Overlay', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'droit-elementor-addons-pro' ),
                'label_off' => __( 'No', 'droit-elementor-addons-pro' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    $this->get_control_id('_dl_pro_image_compare_move!') => ['yes'],
                ],
            ]
        );
        do_action('dl_widgets/image_compare/pro/section/setting/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/image_compare/pro/section/setting/after', $this);
    }
    // Image style
    public function _dl_pro_image_compare_style_button_controls()
    {
        do_action('dl_widgets/image_compare/pro/section/style/button/before', $this);
        $this->start_controls_section(
            '_dl_pro_image_compare_style_button_section',
            [
                'label' => __('Button', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_image_compare_skin') => [''],
                ],
            ]
        );
        $this->_dl_pro_image_compare_style_tab_controls();
        $this->add_group_control(
            Button::get_type(),
            [
                'name' => 'button_setting',
                'label' => __('Button Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .after-before-button:before',
                'condition' => [
                    $this->get_control_id('_dl_pro_image_compare_overlay') => ['yes'],
                    $this->get_control_id('_dl_pro_image_compare_before[url]!') => [''],
                    $this->get_control_id('_dl_pro_image_compare_after[url]!') => [''],
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_image_compare_button_opacity',
            [
                'label' => __('Opacity', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .twentytwenty-overlay:hover .after-before-button' => 'opacity: {{size}}',
                ],
                'seperator' => 'after'
            ]
        );
        do_action('dl_widgets/image_compare/pro/section/style/button/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/image_compare/pro/section/style/button/after', $this);
    }
    // Image Style
    protected function _dl_pro_image_compare_style_tab_controls()
    {
        $this->start_controls_tabs('_dl_pro_image_compare_tabs_style');

        $this->start_controls_tab('_dl_pro_image_compare_before_tab_style',
            [
                'label' => esc_html__('Before', 'droit-elementor-addons-pro'),
            ]
        );
            $this->add_group_control(
            Position::get_type(),
            [
                'name' => 'position_before',
                'label' => __('Position', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-before-label',
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
        $this->end_controls_tab();

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_image_compare_after_tab_style',
            [
                'label' => esc_html__('After', 'droit-elementor-addons-pro'),
            ]
        );
        $this->add_group_control(
            Position::get_type(),
            [
                'name' => 'position_after',
                'label' => __('Position', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-after-label',
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
        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        do_action('dl_widgets/image_compare/pro/style_bottom', $this);
    }
    // Handler
    public function _dl_pro_image_compare_style_handler_controls()
    {
        do_action('dl_widgets/image_compare/pro/section/style/handler/before', $this);
        $this->start_controls_section(
            '_dl_pro_image_compare_style_handler_section',
            [
                'label' => __('Handler', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_image_compare_skin') => [''],
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_image_compare_handle_offset',
            [
                'label' => __('Offset', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '0.5',
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
            ]
        );
        // $this->add_control(
        //     '_dl_pro_content_alignment',
        //     [
        //         // 'label' => __( 'Checkbox Alignment', 'droit-elementor-addons-pro' ),
        //         'label' => esc_html__('Checkbox Alignment, 'droit-elementor-addons-pro'),
        //         'type' => Controls_Manager::CHOOSE,
        //         'label_block' => false,
        //         'options' => apply_filters('dl_widgets/pro/subscriber/control_presets',[
        //             '0' => [
        //                 'title' => esc_html__('Left', 'droit-elementor-addons-pro'),
        //                 'icon' => 'eicon-text-align-left',
        //             ],
        //             'auto' => [
        //                 'title' => esc_html__('Center', 'droit-elementor-addons-pro'),
        //                 'icon' => 'eicon-text-align-center',
        //             ],
        //             '0' => [
        //                 'title' => esc_html__('Right', 'droit-elementor-addons-pro'),
        //                 'icon' => 'eicon-text-align-right',
        //             ],
        //         ]),
        //         'selectors' => [
        //             '{{WRAPPER}} .dl_product_compaire' => 'margin-left: {{VALUE}}',
        //         ],
        //     ]
            
          
        // );
        
       
        $this->add_control(
            '_dl_pro_image_compare_handler_color_overlay',
            [
                'label' => esc_html__('Overlay Color', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-overlay:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .inverted-overlay:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_image_compare_handle_opacity',
            [
                'label' => __('Opacity', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-overlay:hover' => 'opacity: {{size}}',
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .inverted-overlay:hover' => 'opacity: {{size}}',
                ],
                'seperator' => 'after'
            ]
        );
        
        $this->add_control(
            '_dl_pro_image_compare_handler_color',
            [
                'label' => esc_html__('Border Color', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-handle' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-handle:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-handle:after' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_image_compare_handler_bg',
            [
                'label' => esc_html__('Circle Background', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-handle' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_image_compare_handle_width',
            [
                'label' => __('Circle Width', 'droit-elementor-addons-pro'),
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
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-handle' => 'width: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_image_compare_handle_height',
            [
                'label' => __('Circle Height', 'droit-elementor-addons-pro'),
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
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-handle' =>'height: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_control(
            '_dl_pro_image_compare_handler_icon_color',
            [
                'label' => esc_html__('Icon Color', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-handle .h-arrow i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_image_compare_before_type') => ['icon'],
                    $this->get_control_id('_dl_pro_image_compare_before_selected_icon[library]!') => 'svg',
                    $this->get_control_id('_dl_pro_image_compare_after_type') => ['icon'],
                    $this->get_control_id('_dl_pro_image_compare_after_selected_icon[library]!') => 'svg',
                ],
            ]
        );
        
        $this->add_responsive_control(
            '_dl_pro_image_compare_handle_icon_size',
            [
                'label' => __('Icon Size', 'droit-elementor-addons-pro'),
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
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-handle .left-arrow:before,.twentytwenty-handle .right-arrow:before' => 'font-size: {{SIZE}}{{UNIT}}!important;',
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_image_compare_before_type') => ['icon'],
                    $this->get_control_id('_dl_pro_image_compare_before_selected_icon[library]!') => 'svg',
                    $this->get_control_id('_dl_pro_image_compare_after_type') => ['icon'],
                    $this->get_control_id('_dl_pro_image_compare_after_selected_icon[library]!') => 'svg',
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_image_compare_handle_icon_width',
            [
                'label' => __('Icon Width', 'droit-elementor-addons-pro'),
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
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-handle .h-arrow img' => 'width: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_image_compare_handle_icon_gap',
            [
                'label' => __( 'Margin', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-handle .h-arrow img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_image_compare_handle_icon_height',
            [
                'label' => __('Icon Height', 'droit-elementor-addons-pro'),
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
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-handle .h-arrow img' => 'height: {{SIZE}}{{UNIT}}!important;',
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_image_compare_before_type') => ['icon'],
                    $this->get_control_id('_dl_pro_image_compare_before_selected_icon[library]') => 'svg',
                    $this->get_control_id('_dl_pro_image_compare_after_type') => ['icon'],
                    $this->get_control_id('_dl_pro_image_compare_after_selected_icon[library]') => 'svg',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_pro_image_compare_handle_icon_position',
            [
                'label' => __('Icon Horizontal', 'droit-elementor-addons-pro'),
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
                'condition' => [
                    $this->get_control_id('_dl_pro_image_compare_handle_width[size]!') => [''],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-handle .h-arrow' => 'left: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_image_compare_handle_icon_position_verticle',
            [
                'label' => __('Icon Verticle', 'droit-elementor-addons-pro'),
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
                'condition' => [
                    $this->get_control_id('_dl_pro_image_compare_handle_width[size]!') => [''],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-handle .h-arrow' => 'top: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        );
        
        $this->add_responsive_control(
            '_dl_pro_image_compare_handle_thinkness',
            [
                'label' => __('Thinkness', 'droit-elementor-addons-pro'),
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
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-handle' => 'border-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-horizontal .twentytwenty-handle:before' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-horizontal .twentytwenty-handle:after' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-vertical .twentytwenty-handle:before' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-vertical .twentytwenty-handle:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_image_compare_handle_thinkness_position',
            [
                'label' => __('Thinkness Position', 'droit-elementor-addons-pro'),
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
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-horizontal .twentytwenty-handle:before' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-horizontal .twentytwenty-handle:after' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-vertical .twentytwenty-handle:before' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dl-image-compare-wrapper-pro .twentytwenty-vertical .twentytwenty-handle:after' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        do_action('dl_widgets/image_compare/pro/section/style/handler/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/image_compare/pro/section/style/handler/after', $this);
    }
}
