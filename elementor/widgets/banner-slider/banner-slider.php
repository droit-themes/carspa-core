<?php
namespace DROIT_ELEMENTOR_PRO\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Banner_Slider extends \Elementor\Widget_Base{

    public function get_name()
    {
        return 'droit-banner-slider';
    }

    public function get_title()
    {
        return esc_html__( 'Banner Slider', 'droit-addons-pro' );
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
        return [ 'Slider' ];
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
            '_dl_banner_Content_section',
            [
                'label' => __('Content', 'droit-addons-pro'),
            ]
        );

        $this-> _dl_banner_slider_content_repeater_controls();
        $this->end_controls_section();
        //start subscribe layout end

        
        $this->_dl_banner_slider_option_controls();
        $this-> _dl_thumbnail_option_controls();
        $this-> _dl_thumbnail_content_controls();
    }

    // Testimonial Repeater
    protected function _dl_banner_slider_content_repeater_controls()
    {
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            '_dl_banner_image', [
                'label' => __('Banner Image', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'show_label' => false,
            ]
        );
        $repeater->add_control(
            '_dl_banner_title', [
                'label' => __('Title', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Name', 'droit-addons-pro'),
                'default' => __('', 'droit-addons-pro'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
			'_dl_banner_title_animation',
			[
				'label' => esc_html__( 'Title Animation', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'fadeIn',
				'options' => [
					'fadeIn'       => esc_html__( 'fadeIn', 'droit-addons-pro' ),
					'fadeInLeft'   => esc_html__( 'fadeInLeft', 'droit-addons-pro' ),
					'fadeInRight'  => esc_html__( 'fadeInRight', 'droit-addons-pro' ),
					'fadeInUp'     => esc_html__( 'fadeInUp', 'droit-addons-pro' ),
					'fadeInDown'   => esc_html__( 'fadeInDown', 'droit-addons-pro' ),
					'zoomIn'       => esc_html__( 'zoomIn', 'droit-addons-pro' ),
					'zoomOut'      => esc_html__( 'zoomOut', 'droit-addons-pro' ),
					'zoomInLeft'   => esc_html__( 'zoomInLeft', 'droit-addons-pro' ),
					'zoomInRight'  => esc_html__( 'zoomInRight', 'droit-addons-pro' ),
				],
			]
		);
        
        $repeater->add_control(
            '_dl_animation_delay', [
                'label' => __('Animation Delay', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 0.1,
            ]
        );

        $repeater->add_control(
            '_dl_banner_content', [
                'label' => __('Content', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter Content', 'droit-addons-pro'),
                'default' => __('Enter Content', 'droit-addons-pro'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
			'_dl_banner_content_animation',
			[
				'label' => esc_html__( 'Content Animation', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'fadeIn',
				'options' => [
					'fadeIn'       => esc_html__( 'fadeIn', 'droit-addons-pro' ),
					'fadeInLeft'   => esc_html__( 'fadeInLeft', 'droit-addons-pro' ),
					'fadeInRight'  => esc_html__( 'fadeInRight', 'droit-addons-pro' ),
					'fadeInUp'     => esc_html__( 'fadeInUp', 'droit-addons-pro' ),
					'fadeInDown'   => esc_html__( 'fadeInDown', 'droit-addons-pro' ),
					'zoomIn'       => esc_html__( 'zoomIn', 'droit-addons-pro' ),
					'zoomOut'      => esc_html__( 'zoomOut', 'droit-addons-pro' ),
					'zoomInLeft'   => esc_html__( 'zoomInLeft', 'droit-addons-pro' ),
					'zoomInRight'  => esc_html__( 'zoomInRight', 'droit-addons-pro' ),
				],
			]
		);
        
        $repeater->add_control(
            '_dl_content_animation_delay', [
                'label' => __('Animation Delay', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 0.1,
            ]
        );

        $repeater->add_control(
			'_dl_banner_button_icon',
			[
				'label' => __( 'Icon', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'eicon-angle-right',
					'library' => 'solid',
				],
			]
		);

        $repeater->add_control(
            'dl_banner_button_one',
            [
                'label' => __( 'Button One', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
			'show_first_button',
			[
				'label' => esc_html__( 'Enable Button One', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'yes' => esc_html__( 'Show', 'droit-addons-pro' ),
				'no' => esc_html__( 'Hide', 'droit-addons-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $repeater->add_control(
            '_dl_banner_button_link',
            [
                'label' => __('Link', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'droit-addons-pro'),
                'show_external' => true,
                'default' => [
                    'url' => 'https://your-link.com',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'condition' => [
                    'show_first_button' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            '_dl_banner_button_text', [
                'label' => __('Button One Text', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Text', 'droit-addons-pro'),
                'label_block' => true,
                'condition' => [
                    'show_first_button' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
			'_dl_banner_button_animation',
			[
				'label' => esc_html__( 'Button Animation', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'fadeIn',
				'options' => [
					'fadeIn'       => esc_html__( 'fadeIn', 'droit-addons-pro' ),
					'fadeInLeft'   => esc_html__( 'fadeInLeft', 'droit-addons-pro' ),
					'fadeInRight'  => esc_html__( 'fadeInRight', 'droit-addons-pro' ),
					'fadeInUp'     => esc_html__( 'fadeInUp', 'droit-addons-pro' ),
					'fadeInDown'   => esc_html__( 'fadeInDown', 'droit-addons-pro' ),
					'zoomIn'       => esc_html__( 'zoomIn', 'droit-addons-pro' ),
					'zoomOut'      => esc_html__( 'zoomOut', 'droit-addons-pro' ),
					'zoomInLeft'   => esc_html__( 'zoomInLeft', 'droit-addons-pro' ),
					'zoomInRight'  => esc_html__( 'zoomInRight', 'droit-addons-pro' ),
				],
                'condition' => [
                    'show_first_button' => 'yes',
                ]
			]
		);

        $repeater->add_control(
            '_dl_banner_animation_delay', [
                'label' => __('Animation Delay', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 0.1,
                'condition' => [
                    'show_first_button' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'dl_banner_button_two',
            [
                'label' => __( 'Button Two', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
			'show_second_button',
			[
				'label' => esc_html__( 'Enable Button Two', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'yes' => esc_html__( 'Show', 'droit-addons-pro' ),
				'no' => esc_html__( 'Hide', 'droit-addons-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',                
			]
		);

        $repeater->add_control(
            '_dl_banner_button_two_link',
            [
                'label' => __('Link', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'droit-addons-pro'),
                'show_external' => true,
                'default' => [
                    'url' => 'https://your-link.com',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'condition' => [
                    'show_second_button' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            '_dl_banner_button_two_text', [
                'label' => __('Button Two Text', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Text', 'droit-addons-pro'),
                'label_block' => true,
                'condition' => [
                    'show_second_button' => 'yes',
                ]
            ]
        );
        
        $repeater->add_control(
			'animation_second_button',
			[
				'label' => esc_html__( 'Button Animation', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'fadeIn',
				'options' => [
					'fadeIn'       => esc_html__( 'fadeIn', 'droit-addons-pro' ),
					'fadeInLeft'   => esc_html__( 'fadeInLeft', 'droit-addons-pro' ),
					'fadeInRight'  => esc_html__( 'fadeInRight', 'droit-addons-pro' ),
					'fadeInUp'     => esc_html__( 'fadeInUp', 'droit-addons-pro' ),
					'fadeInDown'   => esc_html__( 'fadeInDown', 'droit-addons-pro' ),
					'zoomIn'       => esc_html__( 'zoomIn', 'droit-addons-pro' ),
					'zoomOut'      => esc_html__( 'zoomOut', 'droit-addons-pro' ),
					'zoomInLeft'   => esc_html__( 'zoomInLeft', 'droit-addons-pro' ),
					'zoomInRight'  => esc_html__( 'zoomInRight', 'droit-addons-pro' ),
				],
                'condition' => [
                    'show_second_button' => 'yes',
                ]
			]
		);
        
        $repeater->add_control(
            '_dl_banner_animation_delay_second', [
                'label' => __('Animation Delay', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 0.1,
                'condition' => [
                    'show_second_button' => 'yes',
                ]
            ]
        );
        
        // do_action('Banner', $repeater);
        $this->add_control(
            '_dl_banner_item_list',
            [
                'label' => __('Banner', 'droit-addons-pro'),
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_dl_banner_title' => __('Droitthemes', 'droit-addons-pro'),
                        '_dl_banner_content' => __(' “Droitadons presents your services with flexible, convenient and multipurpose layouts. You can select your favorite.“', 'droit-addons-pro'),
                        '_dl_banner_image' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    [
                        '_dl_banner_title' => __('Droitthemes', 'droit-addons-pro'),
                        '_dl_banner_content' => __(' “Droitadons presents your services with flexible, convenient and multipurpose layouts. You can select your favorite.“', 'droit-addons-pro'),
                        '_dl_banner_image' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    [
                        '_dl_banner_title' => __('Droitthemes', 'droit-addons-pro'),
                        '_dl_banner_content' => __(' “Droitadons presents your services with flexible, convenient and multipurpose layouts. You can select your favorite.“', 'droit-addons-pro'),
                        '_dl_banner_image' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    [
                        '_dl_banner_title' => __('Droitthemes', 'droit-addons-pro'),
                        '_dl_banner_content' => __(' “Droitadons presents your services with flexible, convenient and multipurpose layouts. You can select your favorite.“', 'droit-addons-pro'),
                        '_dl_banner_image' => \Elementor\Utils::get_placeholder_image_src(),
                    ],

                ],
                'title_field' => '{{{ _dl_banner_title }}}',
            ]
        );
    }

    // Slider Option
    public function _dl_banner_slider_option_controls()
    {
        $this->start_controls_section(
            '_dl_pro_banner_slider_options_section',
            [
                'label' => esc_html__('Settings', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'dl_banner_slider_perpage',
            [
                'label' => __( 'Perpage', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 1,
            ]
        );
        $this->add_control(
            'dl_banner_slider_speed',
            [
                'label' => __( 'Speed', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::HIDDEN,
                'min' => 1,
                'max' => 1000000,
                'step' => 100,
                'default' => 1000,
            ]
        );
        
        $this->add_control(
            'dl_banner_slider_autoplay',
            [
                'label' => __('Autoplay', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'true',
                'return_value' => 'true',
            ]
        );

        $this->add_control(
            'dl_banner_slider_auto_delay',
            [
                'label' => __( 'Delay [autoplay]', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000000,
                'step' => 1,
                'default' => 500,
                'condition' => [ 'dl_banner_slider_autoplay' => 'true']
            ]
        );
        $this->add_control(
            'dl_banner_slider_direction',
            [
                'label' => __('Enable Vertical', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'dl_banner_slider_loop',
            [
                'label' => __('Enable Loop', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        
        $this->add_control(
            'dl_banner_slider_centered',
            [
                'label' => __('Centered', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dl_banner_slider_pagination',
            [
                'label' => __('Enable Pagination', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dl_banner_slider_pagination_type',
            [
                'label' => __( 'Pagi Type', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'bullets' => 'Bullets',
                    'fraction' => 'Fraction',
                    'progressbar' => 'Progressbar',
                ],
                'default' => 'bullets',
                'condition' => [ 'dl_banner_slider_pagination' => 'yes']
            ]
        );

        $this->add_control(
            'dl_banner_slider_space',
            [
                'label' => __( 'Space Between', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000000,
                'step' => 1,
                'default' => 30,
            ]
        );
        $this->add_control(
            'dl_banner_slider_effect',
            [
                'label' => __( 'Effect', 'droit-addons-pro' ),
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
            'dl_banner_slider_enable_slide_control',
            [
                'label' => __('Enable Slide Control', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dl_banner_slider_nav_left_icon',
            [
                'label' => __( 'Left Icon', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'solid',
                ],
                'condition' => [ 'dl_banner_slider_enable_slide_control' => 'yes']
            ]
        );

        $this->add_control(
            'dl_banner_slider_nav_right_icon',
            [
                'label' => __( 'Right Icon', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'solid',
                ],
                'condition' => [ 'dl_banner_slider_enable_slide_control' => 'yes']
            ]
        );
        
        $this->add_control(
            'dl_breakpoints_enable',
            [
                'label' => esc_html__('Responsive', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-addons-pro'),
                'label_off' => esc_html__('No', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default' => 'label_off',
                'separator' => 'before'
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'dl_breakpoints_width',
            [
                'label' => __('Max Width', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 3000,
                'step' => 1,
                'default' => '',
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_perpage',
            [
                'label' => __('Slides Per View', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1,
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_space',
            [
                'label' => __('Space Between', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 30,
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_center',
            [
                'label' => esc_html__('Center', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-addons-pro'),
                'label_off' => esc_html__('No', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        do_action('dl_widgets/adslider/settings/repeater', $repeater);
        
        $this->add_control(
            'dl_breakpoints',
            [
                'label' => __('Content', 'droit-addons-pro'),
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
            'dl_banner_slider_mouseover',
            [
                'label' => __( 'MouseOver Settings', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'dl_banner_slider_mouseover_enable',
            [
                'label' => esc_html__('Enable', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-addons-pro'),
                'label_off' => esc_html__('No', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'dl_banner_slider_thumb',
            [
                'label' => __( 'Thumbnail Gallery Settings', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'dl_thumbsEnable',
            [
                'label' => esc_html__('ThumbGallery', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-addons-pro'),
                'label_off' => esc_html__('No', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default' => 'label_off',
                'separator' => 'before'
            ]
        );
        $this->end_controls_section();
    }

    public function _dl_thumbnail_option_controls()
    {
        $this->start_controls_section(
            '_dl_thumbnail_slider_options_section',
            [
                'label' => esc_html__('Thumbnail Settings', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'dl_thumbsEnable' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'dl_thumnail_slider_perpage',
            [
                'label' => __( 'Perpage', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 2,
            ]
        );
        $this->add_control(
            'dl_thumnail_slider_space',
            [
                'label' => __( 'Space Between', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 10,
            ]
        );
        $this->add_control(
            'dl_thumbnail_slider_centered',
            [
                'label' => __('Centered', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dl_thumbnail_breakpoints_enable',
            [
                'label' => esc_html__('Responsive', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-addons-pro'),
                'label_off' => esc_html__('No', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default' => 'label_off',
                'separator' => 'before'
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'dl_thumbnail_breakpoints_width',
            [
                'label' => __('Max Width', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 3000,
                'step' => 1,
                'default' => '',
            ]
        );
        $repeater->add_control(
            'dl_thumbnail_breakpoints_perpage',
            [
                'label' => __('Slides Per View', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1,
            ]
        );
        $repeater->add_control(
            'dl_thumbnail_breakpoints_space',
            [
                'label' => __('Space Between', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 30,
            ]
        );
        $repeater->add_control(
            'dl_thumbnail_breakpoints_center',
            [
                'label' => esc_html__('Center', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-addons-pro'),
                'label_off' => esc_html__('No', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        do_action('dl_widgets/adslider/settings/repeater', $repeater);
        
        $this->add_control(
            'dl_thumbnail_breakpoints',
            [
                'label' => __('Content', 'droit-addons-pro'),
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'dl_thumbnail_breakpoints_width' => 1440,
                        'dl_thumbnail_breakpoints_perpage' => 1,
                        'dl_thumbnail_breakpoints_space' => 30,
                    ],
                    [
                        'dl_thumbnail_breakpoints_width' => 1024,
                        'dl_thumbnail_breakpoints_perpage' => 1,
                        'dl_thumbnail_breakpoints_space' => 30,
                    ],
                    [
                        'dl_thumbnail_breakpoints_width' => 768,
                        'dl_thumbnail_breakpoints_perpage' => 1,
                        'dl_thumbnail_breakpoints_space' => 30,
                    ],
                    [
                        'dl_thumbnail_breakpoints_width' => 576,
                        'dl_thumbnail_breakpoints_perpage' => 1,
                        'dl_thumbnail_breakpoints_space' => 30,
                    ],

                ],
                'title_field' => 'Max Width: {{{ dl_thumbnail_breakpoints_width }}}',
                'condition' => [
                    'dl_thumbnail_breakpoints_enable' => ['yes'],
                ],
            ]
        );

        $this->end_controls_section();
    }

    // Slider Thumbnail 
    public function _dl_thumbnail_content_controls()
    {
        $this->start_controls_section(
            '_dl_thumbnail_slider_content_section',
            [
                'label' => esc_html__('Thumbnail Content', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'dl_thumbsEnable' => ['yes'],
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            '_dl_thumbnail_number', [
                'label'       => __('Number', 'droit-addons-pro'),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'placeholder' => __('Enter Name', 'droit-addons-pro'),
                'default'     => __('', 'droit-addons-pro'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            '_dl_thumbnail_title', [
                'label'       => __('Title', 'droit-addons-pro'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Name', 'droit-addons-pro'),
                'default'     => __('', 'droit-addons-pro'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            '_dl_thumbnail_content', [
                'label' => __('Content', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter Content', 'droit-addons-pro'),
                'default' => __('Enter Content', 'droit-addons-pro'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'dl_thumb_image',
			[
				'label' => esc_html__( 'Thumb Image', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
        );
        
        do_action('dl_widgets/adslider/settings/repeater', $repeater);
        $this->add_control(
            '_dl_thumb_item_list',
            [
                'label' => __('Thumbnail', 'droit-addons-pro'),
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_dl_thumbnail_number' => __('01', 'droit-addons-pro'),
                        '_dl_thumbnail_title' => __('Education', 'droit-addons-pro'),
                        '_dl_thumbnail_content' => __(' “Droitadons presents your services with flexible, convenient and multipurpose layouts.“', 'droit-addons-pro'),
                    ],

                ],
                'title_field' => '{{{ _dl_thumbnail_title }}}',
            ]
        );

        $this->end_controls_section();
    }


    public function _styles_control(){
        $this->_dl_banner_content_style_controls();
        $this->_dl_banner_btn_style();
        $this->_dl_banner_btn_style_two();
        $this->_dl_banner_icon();
        $this->_dl_banner_thumnail_style();
        $this->_dl_banner_nav_style();

    }

    public function _dl_banner_content_style_controls(){
        $this->start_controls_section(
            '_dl_pro_content_style_general',
            [
                'label' => esc_html__('Content Style', 'droit-elementor-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'slider_align',
            [
                'label' => __('Alignment', 'droit-elementor-addons'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => '',
                'options' => [
                    'left' => [
                        'title' => __('Left', 'droit-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'droit-elementor-addons'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'droit-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .banner_slider_content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'_dl_banner_content_verticle_height',
			[
				'label' => __( 'Verticle Height', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'vh', 'px' ],
				'range' => [
					'vh' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
                    ],
                    'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					]
				],
                'default' => [
					'unit' => 'vh',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
        );
        
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => 'banner_content_title',
                'label' => __('Title Typography', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content h2',
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

        $this->add_control(
			'banner_title_color',
			[
				'label' => esc_html__( 'Title Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content h2' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_responsive_control(
			'_dl_banner_title_Spacing',
			[
				'label' => __( 'Title Bottom Spacing', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content h2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => 'banner_content_paragraph',
                'label' => __('Description Typography', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content p',
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

        $this->add_control(
			'banner_desc_color',
			[
				'label' => esc_html__( 'Desc Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content p' => 'color: {{VALUE}}',
				],
			]
		); 

        $this->add_responsive_control(
			'_dl_banner_description_Spacing',
			[
				'label' => __( 'description Bottom Spacing', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
        );
        $this->end_controls_section();
    }

    // button
    public function _dl_banner_btn_style()
    {
        $this->start_controls_section(
            '_dl_banner_btn_style_section',
            [
                'label' => esc_html__('Button One', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
			'_dl_banner_btn_style_tabs'
		);

		$this->start_controls_tab(
			'_dl_banner_btn_style_normal_tab',
			[
				'label' => __( 'Normal', 'droit-addons-pro' ),
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_banner_btn_typography',
                'label' => __( 'Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content a.theme_btn',
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_dl_banner_btn_background',
				'label' => __( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn',
			]
		);

        $this->add_control(
			'_dl_banner_btn_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
            '_dl_banner_btn_padding',
            [
                'label' => __( 'Padding', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => '_dl_banner_btn_border',
				'label' => __( 'Border', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn',
			]
		);
        $this->add_control(
			'_droit_banner_btn_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_dl_banner_btn_shadow',
				'label' => __( 'Box Shadow', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_dl_banner_btn_style_hover_tab',
			[
				'label' => __( 'Hover', 'droit-addons-pro' ),
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_dl_banner_btn_hover_background',
				'label' => __( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn:hover',
			]
		);
        $this->add_control(
			'_dl_banner_btn_hover_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'_dl_banner_btn_hover_border_color',
			[
				'label' => __( 'Border Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_dl_banner_btn_hover_box_shadow',
				'label' => __( 'Box Shadow', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();
    }

    public function _dl_banner_btn_style_two() {

        $this->start_controls_section(
            '_dl_banner_btn_style_section_two',
            [
                'label' => esc_html__('Button Two', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
			'_dl_banner_btn_style_tabs_two'
		);

		$this->start_controls_tab(
			'_dl_banner_btn_style_normal_tab_two',
			[
				'label' => __( 'Normal', 'droit-addons-pro' ),
			]
		);
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_banner_btn_typography_two',
                'label' => __( 'Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn_two ',
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_dl_banner_btn_background_two',
				'label' => __( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn_two',
			]
		);
        $this->add_control(
			'_dl_banner_btn_color_two',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn_two' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
            '_dl_banner_btn_padding_two',
            [
                'label' => __( 'Padding', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => '_dl_banner_btn_border_two',
				'label' => __( 'Border', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn_two',
			]
		);
        $this->add_control(
			'_droit_banner_btn_border_radius_two',
			[
				'label' => __( 'Border Radius', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn_two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_dl_banner_btn_box_shadow_two',
				'label' => __( 'Box Shadow', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn_two',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_dl_banner_btn_style_hover_tab_two',
			[
				'label' => __( 'Hover', 'droit-addons-pro' ),
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_dl_banner_btn_hover_background_two',
				'label' => __( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn_two:hover',
			]
		);
        $this->add_control(
			'_dl_banner_btn_hover_color_two',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn_two:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'_dl_banner_btn_hover_border_color_two',
			[
				'label' => __( 'Border Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn_two:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_dl_banner_btn_hover_box_shadow_two',
				'label' => __( 'Box Shadow', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content .theme_btn_two:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();
        
    } 

    public function _dl_banner_icon() {
        $this->start_controls_section(
            '_dl_banner_icon_style',
            [
                'label' => esc_html__('Icon', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
			'_dl_banner_control_tabs'
		);

		$this->start_controls_tab(
			'_dl_banner_icon',
			[
				'label' => __( 'Normal', 'droit-addons-pro' ),
			]
		);

        $this->add_control(
            '_dl_banner_btn_icon_Width',
            [
                'label' => __( 'Icon Size', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 35,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content a span.droit-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
   
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_dl_banner_btn_icon_background',
				'label' => __( 'Icon Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content a span.icon',
			]
		);
        $this->add_control(
			'_dl_banner_btn_icon_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content a span.icon' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'_droit_banner_btn_icon_border_radius',
			[
				'label' => __( 'Icon Border Radius', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content a span.icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
			'_dl_banner_icon_hover',
			[
				'label' => __( 'Hover', 'droit-addons-pro' ),
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_dl_banner_btn_hover_icon_background',
				'label' => __( 'Icon Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content a:hover span.icon',
			]
		);

        $this->add_control(
			'_dl_banner_btn_hover_icon_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider .dl_container .banner_slider_content a:hover span.icon' => 'color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();
    } 

    public function _dl_banner_thumnail_style()
    {
        $this->start_controls_section(
            '_dl_banner_thumbnail_style_section',
            [
                'label' => esc_html__('Thumbnail Setting', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dl_thumbsEnable' => ['yes'],
                ],
            ]
        );

        $this->start_controls_tabs(
			'_dl_banner_thumbnail_style_tabs'
		);

		$this->start_controls_tab(
			'_dl_banner_thumbnail_style_normal_tab',
			[
				'label' => __( 'Normal', 'droit-addons-pro' ),
			]
		);
        $this->add_responsive_control(
			'_dl_banner_thumbnail_size',
			[
				'label' => __( 'Size', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
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
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            '_dl_banner_thumbnail_position_control',
            [
                'label' => esc_html__('Position', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'relative'  => __( 'Default', 'droit-addons-pro' ),
                    'absolute'  => __( 'Absolute', 'droit-addons-pro' ),
                    'fixed'     => __( 'Fixed', 'droit-addons-pro' ),
                ],
                'default' => 'relative',
                'selectors' => [
                '{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs' => 'position: {{VALUE}}',],
            ]
        );

        $this->add_control(
            'dl_thumbnail_position',
            [
                'label' => __( '', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'Default', 'droit-addons-pro' ),
                'label_on' => __( 'Custom', 'droit-addons-pro' ),
                'return_value' => 'yes',
                'condition' => [
                    '_dl_banner_thumbnail_position_control' => ['absolute', 'relative', 'fixed']
                ]
            ]
        );

        $this->start_popover();

        $start = is_rtl() ? __( 'Right', 'droit-addons-pro' ) : __( 'Left', 'droit-addons-pro' );
        $end = ! is_rtl() ? __( 'Right', 'droit-addons-pro' ) : __( 'Left', 'droit-addons-pro' );

        $this->add_control(
            'dl_offset_orientation_h',
            [
                'label' => __( 'Horizontal Orientation', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'start',
                'options' => [
                    'start' => [
                        'title' => $start,
                        'icon' => 'eicon-h-align-left',
                    ],
                    'end' => [
                        'title' => $end,
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'classes' => 'elementor-control-start-end',
                'render_type' => 'ui',
               
            ]
        );

        $this->add_responsive_control(
            'dl_offset_x',
            [
                'label' => __( 'Offset', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vh' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => '0',
                ],
                'size_units' => [ 'px', '%', 'vw', 'vh' ],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .dl_banner_slider_area .gallery-thumbs' => 'left: {{SIZE}}{{UNIT}}',
                    'body.rtl {{WRAPPER}} .dl_banner_slider_area .gallery-thumbs' => 'right: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'dl_offset_orientation_h!' => 'end',
                ],
            ]
        );

        $this->add_responsive_control(
            'dl_offset_x_end',
            [
                'label' => __( 'Offset', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vh' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => '0',
                ],
                'size_units' => [ 'px', '%', 'vw', 'vh' ],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .dl_banner_slider_area .gallery-thumbs' => 'right: {{SIZE}}{{UNIT}}',
                    'body.rtl {{WRAPPER}} .dl_banner_slider_area .gallery-thumbs' => 'left: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'dl_offset_orientation_h' => 'end',
                ],
            ]
        );

        $this->add_control(
            'dl_offset_orientation_v',
            [
                'label' => __( 'Vertical Orientation', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'start',
                'options' => [
                    'start' => [
                        'title' => __( 'Top', 'droit-addons-pro' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'end' => [
                        'title' => __( 'Bottom', 'droit-addons-pro' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'render_type' => 'ui',
            ]
        );

        $this->add_responsive_control(
            'dl_offset_y',
            [
                'label' => __( 'Offset', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vh' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'size_units' => [ 'px', '%', 'vh', 'vw' ],
                'default' => [
                    'size' => '0',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs' => 'top: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'dl_offset_orientation_v!' => 'end',
                ],
            ]
        );

        $this->add_responsive_control(
            'dl_offset_y_end',
            [
                'label' => __( 'Offset', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vh' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'size_units' => [ 'px', '%', 'vh', 'vw' ],
                'default' => [
                    'size' => '0',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs' => 'bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'dl_offset_orientation_v' => 'end',
                ],
            ]
        );
       
        $this->end_popover();

        $this->add_responsive_control(
			'_dl_banner_thumbnail_padding_style',
			[
				'label' => __( 'Thumbnail Padding', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs .thumb_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_thumbnail_number_typography',
                'label' => __( 'Number Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs .thumb_item .number',
            ]
        );
        $this->add_control(
			'_dl_thumbnail_number_color',
			[
				'label' => __( 'Number Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs .thumb_item .number' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
            '_dl_thumbnail_number_spacing',
            [
                'label' => __( 'Number Bottom Spacing', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs .thumb_item .number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_thumbnail_title_typography',
                'label' => __( 'Title Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs .thumb_item h4',
            ]
        );
        $this->add_control(
			'_dl_thumbnail_title_color',
			[
				'label' => __( 'Title Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs .thumb_item h4' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
            '_dl_thumbnail_title_spacing',
            [
                'label' => __( 'Title Bottom Spacing', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs .thumb_item h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_thumnail_content_typography',
                'label' => __( 'Content Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs .thumb_item p',
            ]
        );
        $this->add_control(
			'_dl_thumbnail_content_color',
			[
				'label' => __( 'Content Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs .thumb_item p' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'dl_thumbnail_width',
			[
				'label' => esc_html__( 'Thumb Width', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .thumb_item img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'dl_thumbnail_height',
			[
				'label' => esc_html__( 'Thumb Height', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .thumb_item img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_tab();
        $this->start_controls_tab(
			'_dl_banner_thumbnail_active_tab',
			[
				'label' => __( 'Active', 'droit-addons-pro' ),
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_dl_banner_thumbnail_active_background',
				'label' => __( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs .swiper-slide-thumb-active .thumb_item',
			]
		);
        $this->add_control(
			'_dl_thumbnail_number_active_color',
			[
				'label' => __( 'Active Number Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs .swiper-slide-thumb-active .thumb_item .number' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'_dl_thumbnail_title_active_color',
			[
				'label' => __( 'Active Title Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs .swiper-slide-thumb-active .thumb_item h4' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'_dl_thumbnail_content_active_color',
			[
				'label' => __( 'Active Title Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_slider_area .gallery-thumbs .swiper-slide-thumb-active .thumb_item p' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();
    }

    public function _dl_banner_nav_style() {
        $this->start_controls_section(
            '_dl_banner_nav_style_section',
            [
                'label' => esc_html__('Navigation', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'dl_navigation_options',
			[
				'label' => esc_html__( 'Left Nav Icon', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

        $this->add_control(
			'dl_navigation_position',
			[
				'label' => esc_html__( 'Position', 'droit-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

        $this->add_responsive_control(
			'_dl_banner_pag_left_Spacing',
			[
				'label' => __( 'Left', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
                'default' => [
                    'unit' => '%',
                    'size' => 0
                ],
				'selectors' => [
					'{{WRAPPER}} .dl_banner_swiper_navigation .swiper_banner_nav_button.dl-slider-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'_dl_banner_pag_top_Spacing',
			[
				'label' => __( 'Top', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],

                'default' => [
                    'unit' => '%',
                    'size' => 50
                ],
				
				'selectors' => [
					'{{WRAPPER}} .dl_banner_swiper_navigation .swiper_banner_nav_button.dl-slider-prev' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_control(
			'dl_navigation_options_right',
			[
				'label' => esc_html__( 'Right Nav Icon', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

        $this->add_control(
			'dl_navigation_position_right',
			[
				'label' => esc_html__( 'Position', 'droit-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

        $this->add_responsive_control(
			'_dl_banner_nav_left_Spacing',
			[
				'label' => __( 'Left', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
                'default' => [
                    'unit' => '%',
                    'size' => 0
                ],
				
				'selectors' => [
					'{{WRAPPER}} .dl_banner_swiper_navigation .swiper_banner_nav_button.dl-slider-next' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'_dl_banner_nav_top_Spacing',
			[
				'label' => __( 'Top', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
                'default' => [
                    'unit' => '%',
                    'size' => 50
                ],
				
				'selectors' => [
					'{{WRAPPER}} .dl_banner_swiper_navigation .swiper_banner_nav_button.dl-slider-next' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_control(
			'dl_navigation_options_background',
			[
				'label' => esc_html__( 'Background', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

        $this->start_controls_tabs(
            'style_tabs'
        );
        
        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'droit-addons-pro' ),
            ]
        );

        $this->add_control(
			'dl_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_swiper_navigation .swiper_banner_nav_button' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'dl_nav_background',
				'label' => esc_html__( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .dl_banner_swiper_navigation .swiper_banner_nav_button',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'dl_nav_border',
				'label' => esc_html__( 'Border', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_banner_swiper_navigation .swiper_banner_nav_button',
			]
		);

        $this->add_control(
			'_droit_nav_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .dl_banner_swiper_navigation .swiper_banner_nav_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'droit-addons-pro' ),
            ]
        );

        $this->add_control(
			'dl_nav_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_swiper_navigation .swiper_banner_nav_button:hover' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'dl_nav_background_hover',
				'label' => esc_html__( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .dl_banner_swiper_navigation .swiper_banner_nav_button:hover',
			]
		);

        $this->add_control(
			'dl_border_color',
			[
				'label' => esc_html__( 'Border Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_banner_swiper_navigation .swiper_banner_nav_button:hover' => 'border-color: {{VALUE}}',
				],
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

        

        $banner_id = $this->get_id();

        $banner_settings = [];
        $banner_settings['slidesPerView'] = $dl_banner_slider_perpage;
        $banner_settings['loop'] = ($dl_banner_slider_loop == 'yes') ? true : false;
        $banner_settings['speed'] = $dl_banner_slider_speed;
        if( $dl_banner_slider_autoplay == true){
            $banner_settings['autoplay']['delay'] = $dl_banner_slider_auto_delay;
        } 
        
        $banner_settings['effect'] = $dl_banner_slider_effect;
        $banner_settings['spaceBetween'] = $dl_banner_slider_space;
        $banner_settings['slidesPerColumnFill'] = 'column';
        $banner_settings['centeredSlides'] = ($dl_banner_slider_centered == 'no') ? false : true;
        $banner_settings['centeredSlides'] = ($dl_banner_slider_centered == 'yes') ? true : false;
        $banner_settings['direction'] = ($dl_banner_slider_direction == 'yes') ? 'vertical' : 'horizontal';

        if( $dl_banner_slider_enable_slide_control == 'yes'){
            $banner_settings['navigation']['nextEl'] = '.dl-slider-next'.$banner_id;
            $banner_settings['navigation']['prevEl'] = '.dl-slider-prev'.$banner_id;
        }
        if( $dl_banner_slider_pagination == 'yes'){
            $banner_settings['pagination']['el'] = '.dl_banner_pag'.$banner_id;
            $banner_settings['pagination']['type'] = $dl_banner_slider_pagination_type;
            $banner_settings['pagination']['clickable'] = '!0';
        }
        if( $dl_breakpoints_enable == 'yes'){
            foreach($dl_breakpoints as $k=>$v){
                $width = $v['dl_breakpoints_width'];
                $banner_settings['breakpoints'][$width]['slidesPerView'] = $v['dl_breakpoints_perpage'];
                $banner_settings['breakpoints'][$width]['spaceBetween'] = $v['dl_breakpoints_space'];
                $banner_settings['breakpoints'][$width]['centeredSlides'] = $v['dl_breakpoints_center'];
            }
        }

        $banner_settings['dl_mouseover'] = ($dl_banner_slider_mouseover_enable == 'yes') ? true : false;
        $banner_settings['dl_autoplay'] = $dl_banner_slider_autoplay;

        if( $dl_thumbsEnable == 'yes'){
            $thum['thumbsEnable'] = ($dl_thumbsEnable == 'yes') ? true : false;
            $thum['spaceBetween'] = $dl_thumnail_slider_space;
            $thum['slidesPerView'] = $dl_thumnail_slider_perpage;
            $thum['centeredSlides'] = ($dl_thumbnail_slider_centered == 'no') ? false : true;
            $thum['centeredSlides'] = ($dl_thumbnail_slider_centered == 'yes') ? true : false;
        }

        if( $dl_thumbnail_breakpoints_enable == 'yes'){
            foreach($dl_thumbnail_breakpoints as $p=>$s){
                $width = $s['dl_thumbnail_breakpoints_width'];
                $thum['breakpoints'][$width]['slidesPerView'] = $s['dl_thumbnail_breakpoints_perpage'];
                $thum['breakpoints'][$width]['spaceBetween'] = $s['dl_thumbnail_breakpoints_space'];
                $thum['breakpoints'][$width]['centeredSlides'] = $s['dl_thumbnail_breakpoints_center'];
            }
        }
        
        ?>
            <section class="dl_banner_slider_area">
                <div class="dl_banner_slider swiper-container dl-slider-<?php echo esc_attr($banner_id);?>" data-settings='<?php echo json_encode($banner_settings, true);?>'>
                
                    <div class="swiper-wrapper">
                        <?php if (isset($_dl_banner_item_list) && !empty($_dl_banner_item_list)):
                            foreach ($_dl_banner_item_list as $s):
                        ?>
                        <div class="swiper-slide slider_item slider_bg_color" style="background-image: url('<?php echo esc_url( $s['_dl_banner_image']['url'] );?>');">
                            <div class="dl_container">
                                <div class="dl_row justify-content-center align-items-center">
                                    <div class="dl_col_lg_9">
                                        <div class="banner_slider_content">
                                            <?php if ( !empty($s['_dl_banner_title']) ) : ?>
                                                <h2 
                                                    <?php if(!empty($s['_dl_banner_title_animation'])) : ?>
                                                        data-animation="<?php echo esc_html($s['_dl_banner_title_animation']);?>"
                                                        data-delay="<?php echo esc_html($s['_dl_animation_delay'].'s');?>"
                                                    <?php endif ?>
                                                >
                                                    <?php echo esc_html($s['_dl_banner_title'])?></h2>
                                            <?php endif ?>
                                            <?php if ( !empty($s['_dl_banner_content']) ) : ?>
                                                <p 
                                                    <?php if(!empty($s['_dl_banner_content_animation'])) : ?>
                                                        data-animation="<?php echo esc_html($s['_dl_banner_content_animation']);?>"
                                                        data-delay="<?php echo esc_html($s['_dl_content_animation_delay'].'s');?>"
                                                    <?php endif ?>
                                                >
                                                    <?php echo esc_html($s['_dl_banner_content'])?>
                                                </p>
                                            <?php endif ?>
                                            <?php if(!empty($s['_dl_banner_button_text'])) : ?>
                                                <a href="<?php echo esc_url($s['_dl_banner_button_link']['url']);?>" 
                                                    <?php if(!empty($s['_dl_banner_button_animation'])) : ?>
                                                            data-animation="<?php echo esc_html($s['_dl_banner_button_animation']);?>"
                                                            data-delay="<?php echo esc_html($s['_dl_banner_animation_delay'].'s');?>"
                                                        <?php endif ?>
                                                    class="theme_btn hover_btn">
                                                    <?php if(!empty($s['_dl_banner_button_icon']['value'])) :?> 
                                                        <span class="droit-icon"><?php \Elementor\Icons_Manager::render_icon( $s['_dl_banner_button_icon']); ?></span> 
                                                    <?php endif ?>
                                                        <?php echo esc_html($s['_dl_banner_button_text'])?>
                                                </a>
                                            <?php endif ?>

                                            <?php if(!empty($s['_dl_banner_button_two_text'])) : ?>
                                                <a href="<?php echo esc_url($s['_dl_banner_button_two_link']['url']);?>" 
                                                    <?php if(!empty($s['animation_second_button'])) : ?>
                                                            data-animation="<?php echo esc_html($s['animation_second_button']);?>"
                                                            data-delay="<?php echo esc_html($s['_dl_banner_animation_delay_second'].'s');?>"
                                                        <?php endif ?>
                                                    class="theme_btn_two hover_btn_two">
                                                        <?php echo esc_html($s['_dl_banner_button_two_text'])?>
                                                </a>
                                            <?php endif ?>                                            

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php endforeach;
                            
                        endif;?>
                    </div>
        
                    <?php if( $dl_banner_slider_enable_slide_control == 'yes'){?>
                    <div class="dl_banner_swiper_navigation">
                        <div class="swiper_banner_nav_button dl-slider-prev dl-slider-prev<?php echo esc_attr($banner_id) ?>">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['dl_banner_slider_nav_left_icon']); ?>
                        </div>
                        <div class="swiper_banner_nav_button dl-slider-next dl-slider-next<?php echo esc_attr($banner_id) ?>">
                            <?php  \Elementor\Icons_Manager::render_icon( $settings['dl_banner_slider_nav_right_icon']); ?>
                        </div>
                    </div>
                    <?php }
                        if( $dl_banner_slider_pagination == 'yes'){?>
                        <div class="dl_swiper_banner_pagination dl_banner_pag<?php echo esc_attr($banner_id) ?>"></div>
                    <?php } ?>
                </div>

                <?php if( $dl_thumbsEnable == 'yes') { ?>
                    <div class="swiper-container gallery-thumbs dl-slider-thumbs-<?php echo esc_attr($banner_id);?>" data-settings='<?php echo json_encode($thum, true);?>'>
                        <div class="swiper-wrapper">
                            <?php if(isset($_dl_thumb_item_list) && !empty($_dl_thumb_item_list)):
                                foreach ($_dl_thumb_item_list as $t):
                            ?>
                                <div class="swiper-slide">
                                    <div class="thumb_item">
                                        <?php if(!empty($t['_dl_thumbnail_number'])): ?>
                                            <div class="number">
                                                <?php echo esc_html($t['_dl_thumbnail_number']) ?>
                                            </div>
                                        <?php endif ?>
                                        <?php if(!empty($t['_dl_thumbnail_title'])): ?>
                                            <h4>
                                                <?php echo esc_html($t['_dl_thumbnail_title']) ?>
                                            </h4>
                                        <?php endif ?>
                                        <?php if(!empty($t['_dl_thumbnail_content'])): ?>
                                            <p>
                                                <?php echo esc_html($t['_dl_thumbnail_content']) ?>
                                            </p>
                                        <?php endif ?>
                                        <?php if(!empty($t['dl_thumb_image'])): ?>
                                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($t, 'thumbnail', 'dl_thumb_image'); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                <?php  }  ?>
            </section>
        <?php
    }

    protected function content_template()
    {}
}