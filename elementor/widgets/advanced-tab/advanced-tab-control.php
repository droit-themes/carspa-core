<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Advanced_Tab;

use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \DROIT_ELEMENTOR_PRO\Icon;
use \DROIT_ELEMENTOR_PRO\Icon_SVG;
use \DROIT_ELEMENTOR_PRO\Image;
use \DROIT_ELEMENTOR_PRO\Content_Typography;
use \DROIT_ELEMENTOR_PRO\Button;
use \DROIT_ELEMENTOR_PRO\Button_Hover;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {exit;}

abstract class Advanced_Tab_Control extends Widget_Base
{

    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    public function get_pro_tabs_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }
    //Preset
    public function _dl_pro_tabs_preset_controls()
    {
        $this->start_controls_section(
            '_dl_pr_tabs_preset_section',
            [
                'label' => __('Preset', 'droit-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_tabs_skin',
            [
                'label' => esc_html__('Design Layout', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/tab/control_presets', [
                    '_skin_1' => 'skin One',
                ]),
                'default' => '_skin_1',
            ]
        );
        $this->add_control(
            '_dl_pro_tabs_format',
            [
                'label' => esc_html__('Tabs Layout', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/tab/control_presets', [
                    'dl-horizontal-tab' => 'Horizontal',
                    'dl-vertical-tab' => 'Vertical',
                ]),
                'default' => 'dl-horizontal-tab',
            ]
        );
        $this->add_control(
            '_dl_pro_tabs_direction',
            [
                'label' => esc_html__('Tabs Columns Direction', 'droit-elementor-addons-pro'), 
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'dlad-left',
                'options' => apply_filters('dl_widgets/pro/tab/control_presets',[
                    'dlad-left' => [
                        'title' => esc_html__('Left', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'dlad-right' => [
                        'title' => esc_html__('Right', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ]),
                'condition' => [
                    '_dl_pro_tabs_format' => 'dl-vertical-tab',
                ],
            ]
        );

        $this->end_controls_section();
    }
    public function _dl_pro_tabs_content__controls()
    {
        $this->start_controls_section(
            '_dl_pro_tab_content_section',
            [
                'label' => __('Tab', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_tabs_skin') => ['_skin_1'],
                ],
            ]
        );
        $this->_dl_pro_tabs_content_repeater__controls();
        
        $this->end_controls_section();
    }
    //Tab Repeater
    protected function _dl_pro_tabs_content_repeater__controls()
    {
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            '_dl_pro_tab_show_as_default',
            [
                'label' => __('Set as Default', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'dl_inactive',
                'return_value' => 'active-default',
            ]
        );
        $repeater->add_control(
            '_dl_pro_tab_title_', [
                'label' => __('Title', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Title', 'droit-elementor-addons-pro'),
                'default' => __('Droit Addons', 'droit-elementor-addons-pro'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            '_dl_pro_advance_tab_icon_type',
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
        $repeater->add_control(
            '_dl_pro_advance_tab_adv_icon_reverse',
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
                    $this->get_control_id( '_dl_pro_advance_tab_icon_type' ) => [ 'icon', 'image' ],
                ],
            ]
        );
        $repeater->add_control(
            '_dl_pro_advance_tab_selected_icon',
            [
                'label' => __( 'Icon', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fab fa-facebook-f',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    $this->get_control_id( '_dl_pro_advance_tab_icon_type' ) => [ 'icon' ],
                ],
            ]
        );

        $repeater->add_control(
            '_dl_pro_advance_tab_icon_image',
            [   
                'label' => esc_html__('Image', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                $this->get_control_id( '_dl_pro_advance_tab_icon_type' ) => [ 'image' ],
            ],
            ]
        );

        $repeater->add_group_control(
            Image::get_type(),
            [
                'name' => 'button_image_setting',
                'label' => __('Image Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .droit-tab-nav-items .droit_tab_icon_inner img',
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
                    $this->get_control_id('_dl_pro_advance_tab_icon_type') => ['image'],
                ],
            ]
        );
        $repeater->add_control(
            '_dl_pro_adv_tab_normal_icon_spacing_controls',
            [
                'label' => __( 'Tab Icon Spacing', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .droit_tab_icon_inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_control(
            '_dl_pro_tab_content_id', [
                'label' => esc_html__('Content', 'droit-elementor-addons-pro'),
                'type' => \DROIT_ELEMENTOR_PRO\DL_Controls_Manager::DLEDITOR,
                'label_block' => true,
                'default' => '',
            ]
        );
        do_action('dl_pro_tab_', $repeater);
        $this->add_control(
            '_dl_pro_tab_list_',
            [
                'label' => __('tab', 'droit-elementor-addons-pro'),
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_dl_pro_tab_title_' => __('Wordpress', 'droit-elementor-addons-pro'),
                        '_dl_pro_tab_sub_title_' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_icon_type' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_adv_icon_reverse' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_selected_icon' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_icon_image' => __('', 'droit-elementor-addons-pro'),
                    ],
                    [
                        '_dl_pro_tab_title_' => __('Laravel', 'droit-elementor-addons-pro'),
                        '_dl_pro_tab_sub_title_' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_icon_type' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_adv_icon_reverse' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_selected_icon' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_icon_image' => __('', 'droit-elementor-addons-pro'),
                    ],
                    [
                        '_dl_pro_tab_title_' => __('Joomla', 'droit-elementor-addons-pro'),
                        '_dl_pro_tab_sub_title_' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_icon_type' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_adv_icon_reverse' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_selected_icon' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_icon_image' => __('', 'droit-elementor-addons-pro'),
                    ],
                    [
                        '_dl_pro_tab_title_' => __('Drupal', 'droit-elementor-addons-pro'),
                        '_dl_pro_tab_sub_title_' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_icon_type' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_adv_icon_reverse' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_selected_icon' => __('', 'droit-elementor-addons-pro'),
                        '_dl_pro_advance_tab_icon_image' => __('', 'droit-elementor-addons-pro'),
                    ],
                ],
                'title_field' => '{{{ _dl_pro_tab_title_ }}}',
            ]
        );
        
    }

    protected function _dl_pro_adv_tab_controls()
    {
        $this->start_controls_section(
            '_dl_pro_adv_tab_content',
            [
                'label' => __( 'Tab', 'droit-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->_dl_pro_adv_tab_wrapper_style();

        $this->end_controls_section();

        $this->start_controls_section(
            '_dl_pro_adv_tab_inner_content',
            [
                'label' => __( 'Tab Content', 'droit-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->_dl_pro_adv_tab_inner_content_style();

        $this->end_controls_section();
    }
    //tab main content wrapper Style
    public function _dl_pro_adv_tab_style_controls()
    {
        do_action('dl_widgets/button/pro/section/style/before', $this);
        $this->start_controls_section(
            '_dl_pro_buttons_style_section',
            [
                'label' => esc_html__('Tab Nav', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('_dl_pro_buttons_tabs');

        $this->start_controls_tab('_dl_pro_adv_tab_normal',
            [
                'label' => esc_html__('Normal', 'droit-elementor-addons-pro'),
            ]
        );
        $this->_dl_pro_adv_tab_show_item_number_controls();
        $this->_dl_pro_adv_tab_normal_controls();
        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_adv_tab_hover',
            [
                'label' => esc_html__('Hover', 'droit-elementor-addons-pro'),
            ]
        );
        $this->_dl_pr_adv_tab_hover_controls();
        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_adv_tab_active',
            [
                'label' => esc_html__('Active', 'droit-elementor-addons-pro'),
            ]
        );
        $this->_dl_pr_adv_tab_active_controls();
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }
    //tab main content wrapper Style 

    //adv tab nav Style Normal
    protected function _dl_pro_adv_tab_show_item_number_controls()
    {
        $this->add_responsive_control(
            'adv_tab_nav_menu_item',
            [
                'label' => __( 'Tab Nav Item', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'step' => 1,
                'default' => 4,
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs-navs .droit-advance-navs' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );
        $this->add_responsive_control(
            'adv_tab_nav_menu_item_gap',
            [
				'label' => __( 'Item Horizontal Gap', 'droit-elementor-addons-pro' ),
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
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .droit-advance-tabs-navs .droit-advance-navs' => ' column-gap: {{SIZE}}{{UNIT}};',
				],
			]
        );
        $this->add_responsive_control(
            'adv_tab_nav_menu_item_bottom_gap',
            [
                'label' => __( 'Item Vertical Gap', 'droit-elementor-addons-pro' ),
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
					'size' => 30,
				],
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-tabs-navs .dl_tab_menu_item' => ' margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    }
    //adv tab nav Style Normal
    protected function _dl_pro_adv_tab_normal_controls()
    {
        $this->add_group_control(
            Content_Typography::get_type(),
            [
                'name' => 'adv_tab_style',
                'label' => __('Typography', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .droit-advance-navs .droit-tab-nav-items',
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
                'name' => 'adv_tab_style_bg',
                'label' => __('Button Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .droit-advance-navs .droit-tab-nav-items',
            ]
        );
        $this->add_control(
            '_dl_pro_adv_tab_normal_icon_color_controls',
            [
                'label' => __( 'Tab Icon Color', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit_tab_icon_inner' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .droit_tab_icon_inner svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_adv_tab_normal_after_color_controls',
            [
                'label' => __( 'Tab After Color', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-navs .droit-tab-nav-items:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_adv_tab_border_controls',
            [
                'label' => __('Tab Border', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'dlbr-left',
                'options' => apply_filters('dl_widgets/pro/tab/control_presets',[
                    'dlbr-left' => [
                        'title' => esc_html__('Left', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'dlbr-right' => [
                        'title' => esc_html__('Right', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ]),
            ]
        );
        $this->add_control(
            '_dl_pro_adv_tab_before_color_controls',
            [
                'label' => __( 'Tab Before Color', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-navs .droit-tab-nav-items:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_adv_tab_content_alignment',
            [
                'label' => __( 'Tab Content Alignment', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'flex-end',
                'options' => apply_filters('dl_widgets/pro/tab/control_presets',[
                    'flex-end' => [
                        'title' => esc_html__('Left', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-start' => [
                        'title' => esc_html__('Right', 'droit-elementor-addons-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ]),
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-navs .droit-tab-nav-items' => 'justify-content: {{VALUE}}',
                ],
            ]
        );
    }
    //adv tab nav Style Hover
    protected function _dl_pr_adv_tab_hover_controls()
    {
        $this->add_group_control(
            Button_Hover::get_type(),
            [
                'name' => 'adv_tab_hover_style_bg',
                'label' => __('Button Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .droit-advance-navs .droit-tab-nav-items:hover',
            ]
        );
        $this->add_control(
            '_dl_pro_adv_tab_icon_hover_color_controls',
            [
                'label' => __( 'Tab Icon Color', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-navs .droit-tab-nav-items:hover .droit_tab_icon_inner' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .droit-advance-navs .droit-tab-nav-items:hover .droit_tab_icon_inner svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_adv_tab_normal_after_hover_color_controls',
            [
                'label' => __( 'Tab After Color', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-tab-nav-items:hover:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_adv_tab_before_hover_color_controls',
            [
                'label' => __( 'Tab Before Color', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-navs .droit-tab-nav-items:hover:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
    }
    //adv tab nav Style active
    protected function _dl_pr_adv_tab_active_controls()
    {
        $this->add_group_control(
            Button_Hover::get_type(),
            [
                'name' => 'adv_tab_active_style_bg',
                'label' => __('Button Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .droit-advance-navs .droit-tab-nav-items.dl_active',
            ]
        );
        $this->add_control(
            '_dl_pro_adv_tab_icon_active_color_controls',
            [
                'label' => __( 'Tab Icon Color', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-navs .droit-tab-nav-items.dl_active .droit_tab_icon_inner' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .droit-advance-navs .droit-tab-nav-items:hover .droit_tab_icon_inner svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_adv_tab_normal_active_color_controls',
            [
                'label' => __( 'Tab After Color', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-navs .droit-tab-nav-items.dl_active:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_adv_tab_before_active_color_controls',
            [
                'label' => __( 'Tab Before Color', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-advance-navs .droit-tab-nav-items.dl_active:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
    }
    
    //advance tab Style
    protected function _dl_pro_adv_tab_wrapper_style()
    {
        $this->add_control(
            '_dl_pro_adv_tab_wrapper_content_padding',
            [
                'label' => __( 'Padding', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .dl_tab_container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_dl_pro_adv_tab_content_bg_controls',
                'label' => __( 'Background', 'droit-elementor-addons-pro' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .dl_tab_container',
            ]
        );
    }

    //advance tab Style
    //advance tab inner content Style
    protected function _dl_pro_adv_tab_inner_content_style()
    {
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_dl_pro_adv_tab_inner_bg_controls',
                'label' => __( 'Background', 'droit-elementor-addons-pro' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .dl_tab_content_wrapper',
            ]
        );
        $this->add_control(
            '_dl_pro_adv_tab_inner_content_padding',
            [
                'label' => __( 'Padding', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .dl_tab_content_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_adv_tab_inner_content_margin',
            [
                'label' => __( 'Margin', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .dl_tab_content_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', 'droit-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_tab_content_wrapper',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'adv_tab_inner_contyent_BoxShadow',
                'label' => __( 'Box Shadow', 'droit-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_tab_content_wrapper',
            ]
        );
        $this->add_control(
            '_dl_pro_adv_tab_inner_content_border-radius',
            [
                'label' => __( 'Border Radius', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .dl_tab_content_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }
}