<?php
namespace DROIT_ELEMENTOR_PRO\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \ELEMENTOR\Group_Control_Typography;
use \DROIT_ELEMENTOR_PRO\Content_Typography;
use \DROIT_ELEMENTOR_PRO\Position;
use \DROIT_ELEMENTOR_PRO\Image;
use WP_Query;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Service_Slider extends Widget_Base{

    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    public function get_pro_services_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }

    public function get_name()
    {
        return 'droit-service-slider';
    }

    public function get_title()
    {
        return esc_html__( 'Service Slider', 'droit-elementor-addons-pro' );
    }

    public function get_icon()
    {
        return ' eicon-services-carousel addons-icon';
    }

    public function get_categories()
    {
        return ['droit_addons_pro'];
    }

    public function get_keywords()
    {
        return [ 'service','service slider','dl services slider'];
    }

    protected function register_controls()
    {
        do_action('dl_widgets/test/register_control/start', $this);

        // add content 
        $this->_content_control();
        
        //style section
        $this->_styles_control();
        
        do_action('dl_widgets/test/register_control/end', $this);

        // by default
        do_action('dl_widget/section/style/custom_css', $this);
        
    }

    public function _content_control(){
        //start subscribe layout

        $this->start_controls_section(
            '_dl_services_Content_section', [
                'label' => __( 'Service Settings', 'carspa-core' ),
            ]
        );
        $this->add_control(
            'all_label', [
                'label' => esc_html__( 'All filter label', 'carspa-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'See All'
            ]
        );
        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show count', 'carspa-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 4
            ]
        );
        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'carspa-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );
        $this->add_control(
			'service_button',
			[
				'label' => esc_html__( 'Service Button', 'carspa-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
            'service_button_text', [
                'label' => esc_html__( 'Button Text', 'carspa-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Learn More'
            ]
        );
        $this->add_control(
            'services_button_icon',
            [
                'label' => __( 'Button Icon', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'eicon-arrow-right',
                    'library' => 'solid',
                ],
            ]
        );
        $this->end_controls_section();

        //start subscribe layout end

        $this->_dl_pro_services_slider_option_controls();

    }

    // Slider Option
    public function _dl_pro_services_slider_option_controls()
    {
        $this->start_controls_section(
            '_dl_pro_services_options_section',
            [
                'label' => esc_html__('Settings', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'dl_services_perpage',
            [
                'label' => __( 'Perpage', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 2,
            ]
        );
        $this->add_control(
            'dl_services_speed',
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
            'dl_services_autoplay',
            [
                'label' => __('Autoplay', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'true',
                'return_value' => 'true',
            ]
        );

        $this->add_control(
            'dl_services_auto_delay',
            [
                'label' => __( 'Delay [autoplay]', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000000,
                'step' => 1,
                'default' => 500,
                'condition' => [ 'dl_services_autoplay' => 'true']
            ]
        );
        $this->add_control(
            'dl_services_direction',
            [
                'label' => __('Enable Vertical', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'dl_services_loop',
            [
                'label' => __('Enable Loop', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        
        $this->add_control(
            'dl_services_centered',
            [
                'label' => __('Centered', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dl_services_pagination',
            [
                'label' => __('Enable Pagination', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dl_services_pagination_type',
            [
                'label' => __( 'Pagi Type', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'bullets' => 'Bullets',
                    'fraction' => 'Fraction',
                    'progressbar' => 'Progressbar',
                ],
                'default' => 'bullets',
                'condition' => [ 'dl_services_pagination' => 'yes']
            ]
        );

        $this->add_control(
            'dl_services_space',
            [
                'label' => __( 'Space Between', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000000,
                'step' => 1,
                'default' => 30,
            ]
        );
        $this->add_control(
            'dl_services_effect',
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
            'dl_services_enable_slide_control',
            [
                'label' => __('Enable Slide Control', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dl_services_nav_left_icon',
            [
                'label' => __( 'Left Icon', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'solid',
                ],
                'condition' => [ 'dl_services_enable_slide_control' => 'yes']
            ]
        );

        $this->add_control(
            'dl_services_nav_right_icon',
            [
                'label' => __( 'Right Icon', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'solid',
                ],
                'condition' => [ 'dl_services_enable_slide_control' => 'yes']
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
                'default' => 'label_off',
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
            'dl_services_mouseover',
            [
                'label' => __( 'MouseOver Settings', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'dl_services_mouseover_enable',
            [
                'label' => esc_html__('Enable', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-elementor-addons-pro'),
                'label_off' => esc_html__('No', 'droit-elementor-addons-pro'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
    }



    // Ordering Repeater
    
    public function _styles_control(){
        $this->_dl_pro_services_general_style_controls();
        $this->_dl_pro_services_content_style_controls();
        // $this->_dl_pro_services_icon();
        $this->_dl_pro_services_slider_navigation_controls();
    }
    public function _dl_pro_services_general_style_controls()
    {
        $this->start_controls_section(
            '_dl_pro_services_general_style_section',
            [
                'label' => __('General', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_dl_pro_services_bg',
                'label' => __('Background', 'droit-elementor-addons-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .dl_pro_services_slider_wrapper',
                'fields_options' => [
                    'background' => [
                        'label' => __('Background Color', 'droit-elementor-addons-pro'),
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '',
                    ],
                ],
            ]
        );
        
        $this->add_responsive_control(
            '_dl_pro_services_box_padding',
            [
                'label' => __('Padding', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => '40',
                    'right' => '40',
                    'bottom' => '40',
                    'left' => '40',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_services_slider_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => '_dl_pro_services_border',
                'label' => __('Box Border', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl_pro_services_slider_wrapper',
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_services_box_border_radius',
            [
                'label' => __('Border Radius', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_services_slider_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_pro_services_box_shadow',
                'label' => __('Box Shadow', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl_pro_services_slider_wrapper',
            ]
        );

        $this->add_responsive_control(
            '_dl_pro_services_align',
            [
                'label' => __('Alignment', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_services_slider_wrapper' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        do_action('dl_pro_services_general', $this);
        $this->end_controls_section();
    }
    public function _dl_pro_services_content_style_controls()
    {

        $this->start_controls_section(
            '_dl_pro_services__content_style_section',
            [
                'label' => __('Content', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => '_dl_pro_services_title_typography',
				'label' => __( 'Title Typography', 'droit-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_pro_services_slider_item .service_slider_content h3',
			]
		);

        $this->add_control(
			'_dl_pro_services_title_color',
			[
				'label' => __( 'Color', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_services_slider_item .service_slider_content h3' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => '_dl_pro_services_content_typography',
				'label' => __( 'Paragraph Typography', 'droit-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_pro_services_slider_item .service_slider_content p',
			]
		);

        $this->add_control(
			'_dl_pro_services_content_color',
			[
				'label' => __( 'Color', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_services_slider_item .service_slider_content p' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => '_dl_pro_services_button_typography',
				'label' => __( 'Paragraph Typography', 'droit-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_pro_services_slider_item .service_slider_content .service_btn',
			]
		);

        $this->add_control(
			'_dl_pro_services_button_color',
			[
				'label' => __( 'Color', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_services_slider_item .service_slider_content .service_btn' => 'color: {{VALUE}}',
				],
			]
		);
    
        $this->end_controls_section();
    }



    public function _dl_pro_services_slider_navigation_controls()
    {
        $this->start_controls_section(
            'services_btn_navigation_style_content',
            [
                'label' => __( 'Navigation', 'droit-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'dl_services_enable_slide_control' => 'yes']
            ]
        );
        $this->add_responsive_control(
            'swiper_services_nav_button_icon_alignment',
            [
                'label' => __( 'Position', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'relative' => __( 'Normal', 'droit-elementor-addons-pro' ),
                    'absolute' => __( 'Fixed', 'droit-elementor-addons-pro' ),
                ],
                'default' => 'relative',
                'selectors' => [
                    '{{wrapper}} .swiper_services_nav_button' => 'position: {{VALUE}}'
                ],
                
            ]
        );

        $this->add_control(
            'swiper_services_next_nav_button_inner',
            [
                'label' => __( 'Next', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'swiper_services_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );
        $this->add_control(
            'swiper_services_next_nav_button_align',
            [
                'label' => __( 'Alignment', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'droit-elementor-addons-pro' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'droit-elementor-addons-pro' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'condition' => [
                    'swiper_services_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_services_nav_button_top_spacing',
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
                    '{{WRAPPER}} .dl_services_swiper_navigation .dl-slider-next ' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_services_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_services_nav_button_left_spacing',
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
                    '{{WRAPPER}} .dl_services_swiper_navigation .dl-slider-next ' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_services_next_nav_button_align' => ['left'],
                    'swiper_services_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_services_nav_button_right_spacing',
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
                    '{{WRAPPER}} .dl_services_swiper_navigation .dl-slider-next ' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_services_nav_button_icon_alignment' => ['absolute'],
                    'swiper_services_next_nav_button_align' => ['right'],
                ],
            ]
        );
        
        $this->add_control(
            'swiper_services_prev_nav_button_section',
            [
                'label' => __( 'Previous', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'swiper_services_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );
        $this->add_control(
            'swiper_services_prev_nav_button_align',
            [
                'label' => __( 'Alignment', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'droit-elementor-addons-pro' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'droit-elementor-addons-pro' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'condition' => [
                    'swiper_services_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_services_prev_nav_button_top_spacing',
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
                    '{{WRAPPER}} .dl_services_swiper_navigation .dl-slider-prev' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_services_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_services_prev_nav_button_left_spacing',
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
                    '{{WRAPPER}} .dl_services_swiper_navigation .dl-slider-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_services_prev_nav_button_align' => ['left'],
                    'swiper_services_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_services_prev_nav_button_right_spacing',
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
                    '{{WRAPPER}} .dl_services_swiper_navigation .dl-slider-prev' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_services_nav_button_icon_alignment' => ['absolute'],
                    'swiper_services_prev_nav_button_align' => ['right'],
                ],
            ]
        );	

        $this->add_control(
            '_dl_services_navigation_section',
            [
                'label' => __( 'Button', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'services_btn_navigation_height',
            [
                'label' => __( 'Height', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 50,
                'selectors' => [
                    '{{WRAPPER}} .dl_services_swiper_navigation .swiper_services_nav_button' => 'height: {{VALUE}}px',
                ],
            ]
        );
        $this->add_responsive_control(
            'services_btn_navigation_width',
            [
                'label' => __( 'Width', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 50,
                'selectors' => [
                    '{{WRAPPER}} .dl_services_swiper_navigation .swiper_services_nav_button' => 'width: {{VALUE}}px',
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_services_navigation_button_Horizontal_spacing',
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
                    '{{WRAPPER}} .dl_services_swiper_navigation' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_services_nav_button_icon_alignment' => ['relative'],
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_services_navigation_button_Vartical_spacing',
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
                    '{{WRAPPER}} .dl_services_swiper_navigation' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_services_nav_button_icon_alignment' => ['relative'],
                ],
            ]
        );

        $this->add_control(
            'services_btn_navigation_Typography_border_radius',
            [
                'label' => __( 'Border Radius', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .dl_services_swiper_navigation .swiper_services_nav_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'services_btn_navigation_Typography',
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
                    '{{WRAPPER}} .dl_services_swiper_navigation .swiper_services_nav_button ' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'services_btn_navigation_Box_Shadow',
                'label' => __( 'Box Shadow', 'droit-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_services_swiper_navigation .swiper_services_nav_button',
            ]
        );
        

        $this->start_controls_tabs(
            'services_btn_navigation_style_tabs'
        );

        $this->start_controls_tab(
            'services_btn_navigation_style_normal_tab',
            [
                'label' => __( 'Normal', 'droit-elementor-addons-pro' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'services_btn_navigation_background',
                'label' => __( 'Background', 'droit-elementor-addons-pro' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_services_swiper_navigation .swiper_services_nav_button',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'services_btn_navigation_border',
                'label' => __( 'Border', 'droit-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_services_swiper_navigation .swiper_services_nav_button',
            ]
        );
        $this->add_control(
            'services_btn_navigation_icon_color',
            [
                'label' => __( 'Icon Color', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .dl_services_swiper_navigation .swiper_services_nav_button' => 'color: {{VALUE}}'],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'services_btn_navigation_style_hover_tab',
            [
                'label' => __( 'Hover', 'droit-elementor-addons-pro' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'services_btn_navigation_hover_background',
                'label' => __( 'Background', 'droit-elementor-addons-pro' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_services_swiper_navigation .swiper_services_nav_button:hover',
            ]
        );
        $this->add_control(
            'services_btn_navigation_hover_icon_color',
            [
                'label' => __( 'Icon Color', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .dl_services_swiper_navigation .swiper_services_nav_button:hover' => 'color: {{VALUE}}'],
            ]
        );
        $this->add_control(
            'services_btn_navigation_hover_border',
            [
                'label' => __( 'Border Color', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .dl_services_swiper_navigation .swiper_services_nav_button:hover' => 'border-color: {{VALUE}}'],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'services_btn_navigation_hover_Box_Shadow',
                'label' => __( 'Box Shadow', 'droit-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_services_swiper_navigation .swiper_services_nav_button:hover',
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'services_tab_pagination_style_section',
            [
                'label' => __( 'Pagination', 'droit-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'dl_services_pagination' => 'yes']
            ]
        );

        $this->add_responsive_control(
            'swiper_services_pagination_button_alignment_Position',
            [
                'label' => __( 'Position', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'relative'  => __( 'Normal', 'droit-elementor-addons-pro' ),
                    'absolute' => __( 'Fixed', 'droit-elementor-addons-pro' ),
                ],
                'default' => 'relative',
                'selectors' => [
                    '{{wrapper}} .dl_swiper_services_pagination' => 'position: {{VALUE}}'
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_services_pagination_top_position',
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
                    '{{WRAPPER}} .dl_swiper_services_pagination' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_services_pagination_button_alignment_Position' => ['absolute'],
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_services_pagination_left_position',
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
                    '{{WRAPPER}} .dl_swiper_services_pagination' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_services_pagination_button_alignment_Position' => ['absolute'],
                ],
            ]
        );

        $this->add_control(
            '_dl_services_slider_pagination_title',
            [
                'label' => __( 'Pagination', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                
            ]
        );
        $this->add_responsive_control(
            'swiper_services_pagination_dot_alignment',
            [
                'label' => __( 'Alignment', 'droit-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'flex-start'  => __( 'Top', 'droit-elementor-addons-pro' ),
                    'center' => __( 'Center', 'droit-elementor-addons-pro' ),
                    'flex-end' => __( 'Bottom', 'droit-elementor-addons-pro' ),
                ],
                'default' => 'center',
                'selectors' => [
                    '{{wrapper}} .dl_swiper_services_pagination' => 'align-items: {{swiper_services_pagination_dot_alignment}}'
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_services_pagination_button_Horizontal_spacing',
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
            'swiper_services_pagination_button_Vartical_spacing',
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
                    '{{WRAPPER}} .dl_swiper_services_pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'services_btn_pagination_border_radius',
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
            'services_tab_pagination_style_tabs'
        );

        $this->start_controls_tab(
            'services_tab_pagination_style_normal_tab',
            [
                'label' => __( 'Normal', 'droit-elementor-addons-pro' ),
            ]
        );
        
        $this->add_responsive_control(
            'services_btn_pagination_height',
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
            'services_btn_pagination_width',
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
                'name' => 'services_btn_pagination_background',
                'label' => __( 'Background', 'droit-elementor-addons-pro' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'services_btn_pagination_border',
                'label' => __( 'Border', 'droit-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'services_tab_pagination_style_active_tab',
            [
                'label' => __( 'Active', 'droit-elementor-addons-pro' ),
            ]
        );

        $this->add_responsive_control(
            'services_btn_active_pagination_height',
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
            'services_btn_active_pagination_width',
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
                'name' => 'services_btn_active_pagination_background',
                'label' => __( 'Background', 'droit-elementor-addons-pro' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'services_btn_active_pagination_border',
                'label' => __( 'Border', 'droit-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        do_action('dl_pro_services_navigation', $this);
    }

    /**
	 * @since 2.3.0
	 * @access protected
	 */
	protected function get_rating( $ratting ) {
		$settings = $this->get_settings_for_display();
		$dl_rating_scale = (int) $settings['droit_rating_scale'];
		$rating = (float)  $ratting > $dl_rating_scale ? $dl_rating_scale :  $ratting;
		return [ $rating, $dl_rating_scale ];
	}

	/**
	 * Print the actual stars and calculate their filling.
	 *
	 * Rating type is float to allow stars-count to be a fraction.
	 * Floored-rating type is int, to represent the rounded-down stars count.
	 * In the `for` loop, the index type is float to allow comparing with the rating value.
	 *
	 * @since 2.3.0
	 * @access protected
	 */


    //Html render
    protected function render()
    {   
        $settings = $this->get_settings_for_display();
        extract($settings);
       
        $service_post = new WP_Query(array(
            'post_type'     => 'service',
            'posts_per_page' => $settings['show_count'],
		    'order'          => $settings['order'],
        ));
        
        $services_id = $this->get_id();

        $services_settings = [];
        $services_settings['slidesPerView'] = $dl_services_perpage;
        $services_settings['loop'] = ($dl_services_loop == 'yes') ? true : false;
        $services_settings['speed'] = $dl_services_speed;
		if( $dl_services_autoplay == true){
            $services_settings['autoplay']['delay'] = $dl_services_auto_delay;
        } 
        
        $services_settings['effect'] = $dl_services_effect;
        $services_settings['spaceBetween'] = $dl_services_space;
        $services_settings['slidesPerColumnFill'] = 'column';
        $services_settings['centeredSlides'] = ($dl_services_centered == 'no') ? false : true;
        $services_settings['centeredSlides'] = ($dl_services_centered == 'yes') ? true : false;
        $services_settings['direction'] = ($dl_services_direction == 'yes') ? 'vertical' : 'horizontal';
        if( $dl_services_enable_slide_control == 'yes'){
            $services_settings['navigation']['nextEl'] = '.dl-slider-next'.$services_id;
            $services_settings['navigation']['prevEl'] = '.dl-slider-prev'.$services_id;
        }
        if( $dl_services_pagination == 'yes'){
            $services_settings['pagination']['el'] = '.dl_services_pag'.$services_id;
            $services_settings['pagination']['type'] = $dl_services_pagination_type;
            $services_settings['pagination']['clickable'] = '!0';
        }
        if( $dl_breakpoints_enable == 'yes'){
            foreach($dl_breakpoints as $k=>$v){
                $width = $v['dl_breakpoints_width'];
                $services_settings['breakpoints'][$width]['slidesPerView'] = $v['dl_breakpoints_perpage'];
                $services_settings['breakpoints'][$width]['spaceBetween'] = $v['dl_breakpoints_space'];
                $services_settings['breakpoints'][$width]['centeredSlides'] = $v['dl_breakpoints_center'];
            }
        }
        $services_settings['dl_mouseover'] = ($dl_services_mouseover_enable == 'yes') ? true : false;
        $services_settings['dl_autoplay'] = $dl_services_autoplay
       
        ?>
    
        <div class="dl_pro_services_wrapper dl-slider-<?php echo esc_attr($services_id);?>">  
            <div class="dl_pro_services_slider swiper-container" data-settings='<?php echo json_encode($services_settings, true);?>'>
                <div class="swiper-wrapper">
                <?php while ($service_post->have_posts()) : $service_post->the_post();
                    ?>
                    <div class="swiper-slide">
                        <div class="dl_pro_services_slider_item">
                            <a href="<?php echo esc_url( get_the_permalink()); ?>" class="service_img">
                                <?php the_post_thumbnail(); ?>
                            </a>
                            <div class="service_slider_content">
                                <a href="<?php echo esc_url( get_the_permalink()); ?>"><h3><?php the_title();?></h3></a>
                                <p><?php echo wp_trim_words(get_the_content(), '13'); ?></p>
                                <a href="<?php echo esc_url( get_the_permalink()); ?>" class="service_btn"><span><?php echo esc_html($settings['service_button_text'])?><?php \Elementor\Icons_Manager::render_icon( $settings['services_button_icon'], [ 'aria-hidden' => 'true' ] ); ?></span></a>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata();?>
                </div>
            </div>
            <?php if( $dl_services_enable_slide_control == 'yes'){?>
            <div class="dl_services_swiper_navigation">
                <div class="swiper_services_nav_button dl-slider-prev dl-slider-prev<?php echo esc_attr($services_id) ?>">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['dl_services_nav_left_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <div class="swiper_services_nav_button dl-slider-next dl-slider-next<?php echo esc_attr($services_id) ?>">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['dl_services_nav_right_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
            </div>
            <?php }
            
            if( $dl_services_pagination == 'yes'){?>
            <div class="dl_swiper_services_pagination dl_services_pag<?php echo esc_attr($services_id) ?>"></div>
            <?php } ?>
        </div>

        <?php
    }

    protected function content_template()
    {}
}