<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Widgets;

use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Advance_Slider\Advance_Slider_Module as Module;
use \ELEMENTOR\Icons_Manager;
use \ELEMENTOR\Controls_Manager;
use \ELEMENTOR\Group_Control_Background;
use \ELEMENTOR\Group_Control_Border;
use \ELEMENTOR\Group_Control_Typography;
use \ELEMENTOR\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Advance_Slider extends \ELEMENTOR\Widget_Base
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
        do_action('dl_widgets/adslider/register_control/start', $this);

        // add content 
        $this->_content_control();
        
        //style
        $this->_styles_control();

        do_action('dl_widgets/adslider/register_control/end', $this);

        // custom css hook
        do_action('dl_widget/section/style/custom_css', $this);
    }

    public function _content_control(){
        //start adslider layout
        $this->start_controls_section(
            '_dl_pr_adslider_layout_section',
            [
                'label' => __('Layout', 'droit-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_adslider_skin',
            [
                'label' => esc_html__('Preset', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/add_slider/control_presets', [
                    '' => 'Default',
                ]),
                'default' => '',
            ]
        );


        do_action('dl_widgets/adslider/layout/content', $this);

        $this->end_controls_section();
        //start adslider layout end

        //start adslider fields render
        $this->start_controls_section(
            '_dl_pr_adslider_fields_section',
            [
                'label' => __('Items', 'droit-elementor-addons-pro'),
            ]
        );

        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            '_dl_field_title',
            [
                'label' => __('Title', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            '_dl_field_default',
            [
                'label' => __('Require', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        $repeater->add_control(
            '_dl_pro_adslider_content_id', [
                'label' => esc_html__('Content', 'droit-elementor-addons-pro'),
                'type' => \DROIT_ELEMENTOR_PRO\DL_Controls_Manager::DLEDITOR,
                'label_block' => true,
                'default' => '',
            ]
        );

        $this->add_control(
            '_dl_pro_adslider_switch',
            [
                'label' => __('Setup Slider', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                   
                    [
                        '_dl_field_default' => 'yes',
                        '_dl_field_title' => 'Slider 1',
                    ],
                    [
                        '_dl_field_default' => 'no',
                        '_dl_field_title' => 'Slider 2',
                    ],
                    
                ],
                'title_field' => '{{{ _dl_field_title }}}',
            ]
        );

        $this->end_controls_section();
        //start adslider layout end

        $this->start_controls_section(
            '_dl_pr_adslider_settings_section',
            [
                'label' => __('Settings', 'droit-elementor-addons-pro'),
            ]
        );

        $this->add_control(
			'dl_perpage',
			[
				'label' => __( 'Perpage', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
                'max' => 100,
                'step' => 1,
				'default' => 1,
			]
		);
        $this->add_control(
			'dl_speed',
			[
				'label' => __( 'Speed', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'min' => 1,
                'max' => 1000000,
                'step' => 100,
				'default' => 1000,
			]
		);
        
        $this->add_control(
            'dl_autoplay',
            [
                'label' => __('Autoplay', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'true',
                'return_value' => 'true',
            ]
        );

        $this->add_control(
			'dl_auto_delay',
			[
				'label' => __( 'Delay [autoplay]', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
                'max' => 1000000,
                'step' => 1,
				'default' => 500,
                'condition' => [ 'dl_autoplay' => 'true']
			]
		);
        $this->add_control(
            'dl_direction',
            [
                'label' => __('Enable Vertical', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'dl_loop',
            [
                'label' => __('Enable Loop', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        
        $this->add_control(
            'dl_centered',
            [
                'label' => __('Centered', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dl_pagination',
            [
                'label' => __('Enable Pagination', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
			'dl_pagination_type',
			[
				'label' => __( 'Pagi Type', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    'bullets' => 'Bullets',
                    'fraction' => 'Fraction',
                    'progressbar' => 'Progressbar',
                ],
				'default' => 'bullets',
                'condition' => [ 'dl_pagination' => 'yes']
			]
		);

        $this->add_control(
			'dl_space',
			[
				'label' => __( 'Space Between', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
                'max' => 1000000,
                'step' => 1,
				'default' => 0,
			]
		);
        $this->add_control(
			'dl_effect',
			[
				'label' => __( 'Effect', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    'slide' => 'Slide',
                    'fade' => 'Fade',
                    'cube' => 'Cube',
                    'coverflow' => 'Coverflow',
                    'flip' => 'Flip',
                ],
				'default' => 'slide',
			]
		);

        $this->add_control(
            'dl_enable_slide_control',
            [
                'label' => __('Enable Slide Control', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
			'adv_slider_nav_left_icon',
			[
				'label' => __( 'Left Icon', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-left',
					'library' => 'solid',
				],
                'condition' => [ 'dl_enable_slide_control' => 'yes']
			]
		);

        $this->add_control(
			'adv_slider_nav_right_icon',
			[
				'label' => __( 'Right Icon', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'solid',
				],
                'condition' => [ 'dl_enable_slide_control' => 'yes']
			]
		);
       
        $this->add_control(
            'dl_breakpoints_enable',
            [
                'label' => esc_html__('Responsive', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-elementor-addons-pro'),
                'label_off' => esc_html__('No', 'droit-elementor-addons-pro'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before'
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'dl_breakpoints_width',
            [
                'label' => __('Max Width', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 3000,
                'step' => 1,
                'default' => '',
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_perpage',
            [
                'label' => __('Slides Per View', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1,
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_space',
            [
                'label' => __('Space Between', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 30,
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_center',
            [
                'label' => esc_html__('Center', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-elementor-addons-pro'),
                'label_off' => esc_html__('No', 'droit-elementor-addons-pro'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
		$repeater->add_control(
            'dl_breakpoints_slide_control',
            [
                'label' => __('Enable Slide Control', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
		$repeater->add_control(
            'dl_breakpoints_pagination',
            [
                'label' => __('Enable Pagination', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        do_action('dl_widgets/adslider/settings/repeater', $repeater);
        
        $this->add_control(
            'dl_breakpoints',
            [
                'label' => __('Content', 'droit-elementor-addons-pro'),
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'dl_breakpoints_width' => 1440,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],
                    [
                        'dl_breakpoints_width' => 1024,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],
                    [
                        'dl_breakpoints_width' => 768,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],
                    [
                        'dl_breakpoints_width' => 576,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],

                ],
                'title_field' => 'Max Width: {{{ dl_breakpoints_width }}}',
                'condition' => [
                    'dl_breakpoints_enable' => ['yes'],
                ],
            ]
        );


        $this->add_control(
			'dl_mouseover',
			[
				'label' => __( 'MouseOver Settings', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'dl_mouseover_enable',
            [
                'label' => esc_html__('Enable', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-elementor-addons-pro'),
                'label_off' => esc_html__('No', 'droit-elementor-addons-pro'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

       

        do_action('dl_widgets/adslider/settings/content', $this);

        $this->end_controls_section();
        //start adslider layout end

    }

    
    public function _styles_control(){

        //adv slider genaral control end
        $this->start_controls_section(
			'adv_btn_navigation_style_content',
			[
				'label' => __( 'Navigation', 'droit-elementor-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [ 'dl_enable_slide_control' => 'yes']
			]
		);

		$this->add_responsive_control(
			'swiper_adv_nav_button_icon_alignment',
			[
				'label' => __( 'Position', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
					'relative' => __( 'Normal', 'droit-elementor-addons-pro' ),
					'absolute' => __( 'Fixed', 'droit-elementor-addons-pro' ),
				],
				'default' => 'relative',
                'selectors' => [
                    '{{wrapper}} .swiper_adv_nav_button' => 'position: {{VALUE}}'
                ],
			]
		);

		$this->add_control(
			'swiper_adv_next_nav_button_inner',
			[
				'label' => __( 'Next', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'swiper_adv_nav_button_icon_alignment' => ['absolute'],
				],
			]
		);
		$this->add_control(
			'swiper_adv_next_nav_button_align',
			[
				'label' => __( 'Alignment', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'plugin-domain' ),
						'icon' => 'fa fa-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'plugin-domain' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'condition' => [
					'swiper_adv_nav_button_icon_alignment' => ['absolute'],
				],
			]
		);
        $this->add_responsive_control(
			'swiper_adv_nav_button_top_spacing',
			[
				'label' => __( 'Top', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_button_next ' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'swiper_adv_nav_button_icon_alignment' => ['absolute'],
				],
			]
		);

        $this->add_responsive_control(
			'swiper_adv_nav_button_left_spacing',
			[
				'label' => __( 'Left', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_button_next ' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'swiper_adv_next_nav_button_align' => ['left'],
					'swiper_adv_nav_button_icon_alignment' => ['absolute'],
				],
			]
		);
        $this->add_responsive_control(
			'swiper_adv_nav_button_right_spacing',
			[
				'label' => __( 'Right', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_button_next ' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'swiper_adv_nav_button_icon_alignment' => ['absolute'],
					'swiper_adv_next_nav_button_align' => ['right'],
				],
			]
		);
		
		$this->add_control(
			'swiper_adv_prev_nav_button_section',
			[
				'label' => __( 'Previous', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'swiper_adv_nav_button_icon_alignment' => ['absolute'],
				],
			]
		);
		$this->add_control(
			'swiper_adv_prev_nav_button_align',
			[
				'label' => __( 'Alignment', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'plugin-domain' ),
						'icon' => 'fa fa-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'plugin-domain' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'condition' => [
					'swiper_adv_nav_button_icon_alignment' => ['absolute'],
				],
			]
		);
        $this->add_responsive_control(
			'swiper_adv_prev_nav_button_top_spacing',
			[
				'label' => __( 'Top', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_button_prev ' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'swiper_adv_nav_button_icon_alignment' => ['absolute'],
				],
			]
		);
        $this->add_responsive_control(
			'swiper_adv_prev_nav_button_left_spacing',
			[
				'label' => __( 'Left', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_button_prev ' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'swiper_adv_prev_nav_button_align' => ['left'],
					'swiper_adv_nav_button_icon_alignment' => ['absolute'],
				],
			]
		);
        $this->add_responsive_control(
			'swiper_adv_prev_nav_button_right_spacing',
			[
				'label' => __( 'Right', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_button_prev ' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'swiper_adv_nav_button_icon_alignment' => ['absolute'],
					'swiper_adv_prev_nav_button_align' => ['right'],
				],
			]
		);	

		$this->add_control(
			'_dl_adv_navigation_section',
			[
				'label' => __( 'Button', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'adv_btn_navigation_height',
			[
				'label' => __( 'Height', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'default' => 50,
                'selectors' => [
                    '{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_nav_button' => 'height: {{VALUE}}px',
                ],
			]
		);
		$this->add_responsive_control(
			'adv_btn_navigation_width',
			[
				'label' => __( 'Width', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'default' => 50,
                'selectors' => [
                    '{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_nav_button' => 'width: {{VALUE}}px',
                ],
			]
		);

		$this->add_responsive_control(
			'swiper_adv_navigation_button_Horizontal_spacing',
			[
				'label' => __( 'Horizontal Position', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 6,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_adv_swiper_navigation' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'swiper_adv_nav_button_icon_alignment' => ['relative'],
				],
			]
		);
		$this->add_responsive_control(
			'swiper_adv_navigation_button_Vartical_spacing',
			[
				'label' => __( 'Vartical Position', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 6,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_adv_swiper_navigation' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'swiper_adv_nav_button_icon_alignment' => ['relative'],
				],
			]
		);

		$this->add_control(
			'adv_btn_navigation_Typography_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_nav_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'adv_btn_navigation_Typography',
			[
				'label' => __( 'Font Size', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_nav_button ' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'adv_btn_navigation_Box_Shadow',
				'label' => __( 'Box Shadow', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_nav_button',
			]
		);
		

        $this->start_controls_tabs(
			'adv_btn_navigation_style_tabs'
		);

		$this->start_controls_tab(
			'adv_btn_navigation_style_normal_tab',
			[
				'label' => __( 'Normal', 'droit-elementor-addons-pro' ),
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'adv_btn_navigation_background',
				'label' => __( 'Background', 'droit-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_nav_button',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'adv_btn_navigation_border',
				'label' => __( 'Border', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_nav_button',
			]
		);
        $this->add_control(
			'adv_btn_navigation_icon_color',
			[
				'label' => __( 'Icon Color', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => ['{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_nav_button' => 'color: {{VALUE}}'],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'adv_btn_navigation_style_hover_tab',
			[
				'label' => __( 'Hover', 'droit-elementor-addons-pro' ),
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'adv_btn_navigation_hover_background',
				'label' => __( 'Background', 'droit-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_nav_button:hover',
			]
		);
		$this->add_control(
			'adv_btn_navigation_hover_icon_color',
			[
				'label' => __( 'Icon Color', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => ['{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_nav_button:hover' => 'color: {{VALUE}}'],
			]
		);
		$this->add_control(
			'adv_btn_navigation_hover_border',
			[
				'label' => __( 'Border Color', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => ['{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_nav_button:hover' => 'border-color: {{VALUE}}'],
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'adv_btn_navigation_hover_Box_Shadow',
				'label' => __( 'Box Shadow', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_adv_swiper_navigation .swiper_adv_nav_button:hover',
			]
		);


		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

        $this->start_controls_section(
			'adv_tab_pagination_style_section',
			[
				'label' => __( 'Pagination', 'droit-elementor-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'dl_pagination' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'swiper_adv_pagination_button_alignment_Position',
			[
				'label' => __( 'Position', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
					'relative'  => __( 'Normal', 'droit-elementor-addons-pro' ),
					'absolute' => __( 'Fixed', 'droit-elementor-addons-pro' ),
				],
				'default' => 'relative',
                'selectors' => [
                    '{{wrapper}} .dl_swiper_adv_pagination' => 'position: {{VALUE}}'
                ],
			]
		);

        $this->add_responsive_control(
			'swiper_adv_pagination_top_position',
			[
				'label' => __( 'Top', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 120,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_swiper_adv_pagination' => 'top: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'swiper_adv_pagination_button_alignment_Position' => ['absolute'],
                ],
			]
		);
        $this->add_responsive_control(
			'swiper_adv_pagination_left_position',
			[
				'label' => __( 'Left', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_swiper_adv_pagination' => 'left: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'swiper_adv_pagination_button_alignment_Position' => ['absolute'],
                ],
			]
		);
		$this->add_control(
			'_dl_adv_slider_pagination_title',
			[
				'label' => __( 'Pagination', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'swiper_adv_pagination_dot_alignment',
			[
				'label' => __( 'Alignment', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
					'flex-start'  => __( 'Top', 'droit-elementor-addons-pro' ),
					'center' => __( 'Center', 'droit-elementor-addons-pro' ),
					'flex-end' => __( 'Dotted', 'droit-elementor-addons-pro' ),
				],
				'default' => 'center',
                'selectors' => [
                    '{{wrapper}} .dl_swiper_adv_pagination' => 'align-items: {{swiper_adv_pagination_dot_alignment}}'
                ],
			]
		);
		$this->add_responsive_control(
			'swiper_adv_pagination_button_Horizontal_spacing',
			[
				'label' => __( 'Horizontal Spacing', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 6,
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet:not(:first-child)' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'swiper_adv_pagination_button_Vartical_spacing',
			[
				'label' => __( 'Vartical Spacing', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 6,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_swiper_adv_pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'adv_btn_pagination_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		

		$this->start_controls_tabs(
			'adv_tab_pagination_style_tabs'
		);

		$this->start_controls_tab(
			'adv_tab_pagination_style_normal_tab',
			[
				'label' => __( 'Normal', 'droit-elementor-addons-pro' ),
			]
		);
        
        $this->add_responsive_control(
			'adv_btn_pagination_height',
			[
				'label' => __( 'Height', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'default' => 10,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{VALUE}}px',
                ],
			]
		);

		$this->add_responsive_control(
			'adv_btn_pagination_width',
			[
				'label' => __( 'Width', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'default' => 10,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{VALUE}}px',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'adv_btn_pagination_background',
				'label' => __( 'Background', 'droit-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'adv_btn_pagination_border',
				'label' => __( 'Border', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'adv_tab_pagination_style_active_tab',
			[
				'label' => __( 'Active', 'droit-elementor-addons-pro' ),
			]
		);

        $this->add_responsive_control(
			'adv_btn_active_pagination_height',
			[
				'label' => __( 'Height', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'default' => 10,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'height: {{VALUE}}px',
                ],
			]
		);

		$this->add_responsive_control(
			'adv_btn_active_pagination_width',
			[
				'label' => __( 'Width', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'default' => 10,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'width: {{VALUE}}px',
                ],
            ]
        );
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'adv_btn_active_pagination_background',
				'label' => __( 'Background', 'droit-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'adv_btn_active_pagination_border',
				'label' => __( 'Border', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active',
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
        
    }

    //Html render
    protected function render()
    {   
        $settings = $this->get_settings_for_display();
        extract($settings);
        
        $id = $this->get_id();

        $settings_slider = [];
        $settings_slider['slidesPerView'] = $dl_perpage;
        $settings_slider['loop'] = ($dl_loop == 'yes') ? true : false;
        $settings_slider['speed'] = $dl_speed;
		if( $dl_autoplay == true){
            $settings_slider['autoplay']['delay'] = $dl_auto_delay;
        } 
        
        $settings_slider['effect'] = $dl_effect;
        $settings_slider['spaceBetween'] = $dl_space;
        $settings_slider['slidesPerColumnFill'] = 'column';
        $settings_slider['centeredSlides'] = ($dl_centered == 'yes') ? true : false;
        $settings_slider['direction'] = ($dl_direction == 'yes') ? 'vertical' : 'horizontal';
        if( $dl_enable_slide_control == 'yes'){
            $settings_slider['navigation']['nextEl'] = '.dl-slider-'.$id.' .swiper_adv_button_next';
            $settings_slider['navigation']['prevEl'] = '.dl-slider-'.$id.' .swiper_adv_button_prev';
        }
        

        if( $dl_pagination == 'yes'){
            $settings_slider['pagination']['el'] = '.dl-slider-'.$id.' .dl_swiper_adv_pagination';
            $settings_slider['pagination']['type'] = $dl_pagination_type;
            $settings_slider['pagination']['clickable'] = '!0';
        }
        
        if( $dl_breakpoints_enable == 'yes'){
            foreach($dl_breakpoints as $k=>$v){
                $width = $v['dl_breakpoints_width'];
                $settings_slider['breakpoints'][$width]['slidesPerView'] = $v['dl_breakpoints_perpage'];
                $settings_slider['breakpoints'][$width]['spaceBetween'] = $v['dl_breakpoints_space'];
                $settings_slider['breakpoints'][$width]['centeredSlides'] = $v['dl_breakpoints_center'];
            }
        }

        $settings_slider['dl_mouseover'] = ($dl_mouseover_enable == 'yes') ? true : false;
        $settings_slider['dl_autoplay'] = $dl_autoplay
       
        ?>
        <?php
            if ( in_array( $_dl_pro_adslider_skin, array( '' ), true ) ) {
                include 'style/default.php'; 	
            }
        ?>
        
    <?php 
	}

    protected function content_template()
    {}
}