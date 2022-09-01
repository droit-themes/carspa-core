<?php
namespace DROIT_ELEMENTOR_PRO;

use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Controls_Stack;
use \Elementor\Element_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Parallax{

	private static $instance;

	public static function url(){
        if (defined('DROIT_ADDONS_PRO_FILE_')) {
            $file = trailingslashit(plugin_dir_url( DROIT_EL_PRO_FILE )). 'modules/controls/sections/parallax/';
        } else {
            $file = trailingslashit(plugin_dir_url( __FILE__ ));
        }
		return $file;
	}

	public static function dir(){
		if (defined('DROIT_ADDONS_PRO_FILE_')) {
            $file = trailingslashit(plugin_dir_path( DROIT_EL_PRO_FILE )). 'modules/controls/sections/parallax/';
        } else {
            $file = trailingslashit(plugin_dir_path( __FILE__ ));
        }
		return $file;
	}

	public static function version(){
		if( defined('DROIT_ADDONS_VERSION_PRO') ){
            return DROIT_EL_PRO_VERSION;
        } else {
            return apply_filters('dladdons_pro_version', '1.0.0');
        }
        
	}

	public function init() {
         
		add_action('wp_enqueue_scripts', [$this, 'register_frontend_scripts']);
		add_action('elementor/frontend/before_enqueue_scripts', [$this, 'editor_scripts'], 99);
		add_action( 'elementor/element/section/section_layout/after_section_end', [$this, 'register_controls' ], 10 );
        add_action( 'elementor/frontend/section/before_render', [ $this, 'dl_before_render' ], 10, 1 );

        add_action( 'elementor/section/print_template', [ $this, 'dl_print_template' ], 10, 2 );
	}
	public function register_frontend_scripts() {
		wp_enqueue_style( 'animate', self::url() . 'assets/css/animate.css' , null, self::version() );
		wp_enqueue_style( 'dladdons-parallax-style', self::url() . 'assets/css/style.css' , null, self::version() );
		wp_enqueue_script( 'wow', self::url() . 'assets/js/wow.min.js', array('jquery'), self::version(), false );
		//wp_enqueue_script( 'dl-parallax', self::url() . 'assets/js/parallax.min.js', array('jquery'), self::version(), false );
		wp_enqueue_script( 'dl-parallax-move', self::url() . 'assets/js/parallax.move.js', array('jquery'), self::version(), false );
		wp_enqueue_script( 'dl-parallax-scrolling', self::url() . 'assets/js/parallax.scrolling.js', array('jquery'), self::version(), false );
	}

	public function editor_scripts(){
		wp_enqueue_script( 'dladdons-parallax-section-init', self::url() . 'assets/js/scripts.js', array( 'jquery', 'elementor-frontend' ), self::version(), true );
	}

	public function register_controls($control)
    {
        $id = $control->get_id();
        if ( 'section' === $control->get_name() ) {
            $control->start_controls_section(
                'dl_parallax_section',
                [
                    'label' => __( 'Parallax Effect', 'droit-elementor-addons-pro' ) . _droit_get_icon(),
                    'tab' => Controls_Manager::TAB_LAYOUT,
                ]
            );

            $control->add_control(
                'dl_parallax_enable',
                [
                    'label' => __( 'Enable Paralax', 'droit-elementor-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'droit-elementor-addons-pro' ),
                    'label_off' => __( 'No', 'droit-elementor-addons-pro' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            
            $repeater = new Repeater();


            $repeater->add_control(
                'item_source',
                [
                    'label' => esc_html__( 'Item source', 'droit-elementor-addons-pro'  ),
                    'type' => Controls_Manager::HIDDEN,
                    'label_block' => false,
                    'toggle' => false,
                    'default' => 'image',
                    'classes' => 'elementor-control-start-end',
                    'render_type' => 'ui',
    
                ]
            );

            $repeater->add_control(
                'image',[
                    'label' => esc_html__('Choose Image', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::MEDIA,
                    'condition' => [
                        'item_source' => 'image',
                    ],
                ]
            );


            $repeater->add_responsive_control(
                'dl_item_width',
                [
                    'label' => __( 'Size', 'elementor' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => __( 'Default', 'elementor' ),
                        'inherit' => __( 'Full Width', 'elementor' ) . ' (100%)',
                        'auto' => __( 'Inline', 'elementor' ) . ' (auto)',
                        'initial' => __( 'Custom', 'elementor' ),
                    ],
                    'selectors_dictionary' => [
                        'inherit' => '100%',
                    ],
                    'prefix_class' => 'elementor-widget%s__width-',
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element > .layer > *' => 'width: {{VALUE}}; max-width: {{VALUE}}',
                    ],
                ]
            );
    
            $repeater->add_responsive_control(
                'dl_width_custom_width',
                [
                    'label' => __( 'Custom Width', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'condition' => [
                        'dl_item_width' => 'initial',
                    ],
                    'device_args' => [
                        Controls_Stack::RESPONSIVE_TABLET => [
                            'condition' => [
                                'dl_item_width' => [ 'initial' ],
                            ],
                        ],
                        Controls_Stack::RESPONSIVE_MOBILE => [
                            'condition' => [
                                'dl_item_width' => [ 'initial' ],
                            ],
                        ],
                    ],
                    'size_units' => [ 'px', '%', 'vw' ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element > .layer > *' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );
    
            $repeater->add_responsive_control(
                'dl_width_vertical_align',
                [
                    'label' => __( 'Vertical Align', 'elementor' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [
                            'title' => __( 'Start', 'elementor' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'elementor' ),
                            'icon' => 'eicon-v-align-middle',
                        ],
                        'flex-end' => [
                            'title' => __( 'End', 'elementor' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'condition' => [
                        'dl_item_width!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element > .layer > *' => 'align-self: {{VALUE}}',
                    ],
                ]
            );

            $repeater->add_control(
                'dl_item_position',
                [
                    'label' => __( 'Position', 'droit-elementor-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => __( 'Default', 'your-plugin' ),
                    'label_on' => __( 'Custom', 'your-plugin' ),
                    'return_value' => 'yes',
                ]
            );
    
            $repeater->start_popover();
    
            $start = is_rtl() ? __( 'Right', 'elementor' ) : __( 'Left', 'elementor' );
            $end = ! is_rtl() ? __( 'Right', 'elementor' ) : __( 'Left', 'elementor' );

            $repeater->add_control(
                'dl_offset_orientation_h',
                [
                    'label' => __( 'Horizontal Orientation', 'elementor' ),
                    'type' => Controls_Manager::CHOOSE,
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

            $repeater->add_responsive_control(
                'dl_offset_x',
                [
                    'label' => __( 'Offset', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
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
                        'body:not(.rtl) {{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element' => 'left: {{SIZE}}{{UNIT}}',
                        'body.rtl {{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element' => 'right: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'dl_offset_orientation_h!' => 'end',
                    ],
                ]
            );

            $repeater->add_responsive_control(
                'dl_offset_x_end',
                [
                    'label' => __( 'Offset', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
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
                        'body:not(.rtl) {{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element' => 'right: {{SIZE}}{{UNIT}}',
                        'body.rtl {{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element' => 'left: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'dl_offset_orientation_h' => 'end',
                    ],
                ]
            );

            $repeater->add_control(
                'dl_offset_orientation_v',
                [
                    'label' => __( 'Vertical Orientation', 'elementor' ),
                    'type' => Controls_Manager::CHOOSE,
                    'toggle' => false,
                    'default' => 'start',
                    'options' => [
                        'start' => [
                            'title' => __( 'Top', 'elementor' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'end' => [
                            'title' => __( 'Bottom', 'elementor' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'render_type' => 'ui',
                    
                ]
            );

            $repeater->add_responsive_control(
                'dl_offset_y',
                [
                    'label' => __( 'Offset', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
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
                        '{{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element' => 'top: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'dl_offset_orientation_v!' => 'end',
                    ],
                ]
            );

            $repeater->add_responsive_control(
                'dl_offset_y_end',
                [
                    'label' => __( 'Offset', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
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
                        '{{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element' => 'bottom: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'dl_offset_orientation_v' => 'end',
                    ],
                ]
            );
           
            $repeater->end_popover();

            $repeater->add_control(
                'dl_zindex',   [
                    'label' => esc_html__('z-index', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __( 'Set z-index for the current layer, default 5', 'droit-elementor-addons-pro' ),
                    'default' => esc_html__('5', 'droit-elementor-addons-pro'),
                    'selectors' => [
                        "{{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element" => 'z-index: {{UNIT}}',
                    ],
                ]
            );
            $repeater->add_control(
                'dl_item_opacity',
                [
                    'label' => esc_html__( 'Opacity', 'droit-elementor-addons-pro'  ),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __( 'Set the layer opacity', 'droit-elementor-addons-pro' ),
                    'default' => 1,
                    'min' => 0,
                    'step' => .1,
                    'selectors' => [
                        "{{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element > .layer > *" => 'opacity:{{UNIT}}'
                    ],
                ]
            );


            $repeater->add_control(
                'dl_parallax_heading',
                [
                    'label' => __( 'Parallax Settings', 'plugin-name' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );


            $repeater->add_control(
                'dl_parallax_data_popup',
                [
                    'label' => __( 'Data', 'droit-elementor-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => __( 'Default', 'your-plugin' ),
                    'label_on' => __( 'Custom', 'your-plugin' ),
                    'return_value' => 'yes',
                ]
            );
    
            $repeater->start_popover();

            $repeater->add_control(
                'dl_parallax_translate_heading',
                [
                    'label' => __( 'Translate (X, Y)', 'droit-elementor-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'condition' => [
                        'dl_parallax_data_popup' => 'yes',
                    ]
                ]
            );
            $repeater->add_control(
                'dl_translate_x_axix', [
                    'label' => esc_html__( 'X axis', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 0,
                    'condition' => [
                        'dl_parallax_data_popup' => 'yes',
                    ],
                    'frontend_available' => true,
                    'render_type' => 'none',
                ]
            );

            $repeater->add_control(
                'dl_translate_y_axix', [
                    'label' => esc_html__( 'Y axis', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 100,
                    'condition' => [
                        'dl_parallax_data_popup' => 'yes',
                    ],
                    'frontend_available' => true,
                    'render_type' => 'none',
                ]
            );

            $repeater->add_control(
                'dl_parallax_rotate_heading',
                [
                    'label' => __( 'Rotate (X, Y, Z)', 'droit-elementor-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'dl_parallax_data_popup' => 'yes',
                    ]
                ]
            );

            $repeater->add_control(
                'dl_rotate_x_axix', [
                    'label' => esc_html__( 'X axis', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '',
                    'condition' => [
                        'dl_parallax_data_popup' => 'yes',
                    ],
                    'frontend_available' => true,
                    'render_type' => 'none',
                ]
            );

            $repeater->add_control(
                'dl_rotate_y_axix', [
                    'label' => esc_html__( 'Y axis', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '',
                    'condition' => [
                        'dl_parallax_data_popup' => 'yes',
                    ],
                    'frontend_available' => true,
                    'render_type' => 'none',
                ]
            );
            $repeater->add_control(
                'dl_rotate_z_axix', [
                    'label' => esc_html__( 'Z axis', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '',
                    'condition' => [
                        'dl_parallax_data_popup' => 'yes',
                    ],
                    'frontend_available' => true,
                    'render_type' => 'none',
                ]
            );

            $repeater->add_control(
                'dl_parallax_scale_heading',
                [
                    'label' => __( 'Scale (X, Y, Z)', 'droit-elementor-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'dl_parallax_data_popup' => 'yes',
                    ],
                    
                ]
            );

            $repeater->add_control(
                'dl_scale_x_axix', [
                    'label' => esc_html__( 'X axis', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '',
                    'condition' => [
                        'dl_parallax_data_popup' => 'yes',
                    ],
                    'frontend_available' => true,
                    'render_type' => 'none',
                ]
            );

            $repeater->add_control(
                'dl_scale_y_axix', [
                    'label' => esc_html__( 'Y axis', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '',
                    'condition' => [
                        'dl_parallax_data_popup' => 'yes',
                    ],
                    'frontend_available' => true,
                    'render_type' => 'none',
                ]
            );
            $repeater->add_control(
                'dl_scale_z_axix', [
                    'label' => esc_html__( 'Z axis', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '',
                    'condition' => [
                        'dl_parallax_data_popup' => 'yes',
                    ],
                    'frontend_available' => true,
                    'render_type' => 'none',
                ]
            );


            $repeater->add_control(
                'dl_item_depth',
                [
                    'label' => esc_html__( 'Depth', 'droit-elementor-addons-pro'  ),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __( 'Set the layer Depth', 'droit-elementor-addons-pro' ),
                    'default' => .10,
                    'min' => -10,
                    'step' => .1,
                    'separator' => 'before',
                    'condition' => [
                        'dl_parallax_data_popup' => 'yes',
                    ],
                ]
            );

            $repeater->end_popover();


            $repeater->add_control(
                'dl_wow_heading',
                [
                    'label' => __( 'Wow', 'plugin-name' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $repeater->add_control(
                'dl_wow_enable',
                [
                    'label'       => __( 'Enable Wow', 'droit-elementor-addons-pro' ),
                    'type'        => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'droit-elementor-addons-pro' ),
                    'label_off' => __( 'No', 'droit-elementor-addons-pro' ),
                    'return_value' => 'enable',
                    'default' => '',
                ]
            );

            $repeater->add_control(
                'dl_animation',
                [
                    'label' => __( 'Entrance Animation', 'elementor' ),
                    'type' => Controls_Manager::ANIMATION,
                    'frontend_available' => true,
                    'condition' => [
                        'dl_wow_enable!' => '',
                    ],
                    'selectors' => [
                        "{{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element" => '-webkit-animation-name:{{UNIT}}',
                        "{{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element" => 'animation-name:{{UNIT}}',
                    ],
                ]
            );
    
           
            $repeater->add_control(
                'dl_animation_duration',
                [
                    'label' => __( 'Animation Duration', 'elementor' ) . ' (ms)',
                    'type' => Controls_Manager::NUMBER,
                    'default' => '',
                    'min' => 0,
                    'step' => .1,
                    'condition' => [
                        'dl_animation!' => '',
                        'dl_wow_enable!' => '',
                    ],
                    'frontend_available' => true,
                    'selectors' => [
                        "{{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element" => '-webkit-animation-duration:{{UNIT}}s;',
                        "{{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element" => 'animation-duration:{{UNIT}}s;',
                    ],
                ]
            );
    
            $repeater->add_control(
                'dl_animation_delay',
                [
                    'label' => __( 'Animation Delay', 'elementor' ) . ' (ms)',
                    'type' => Controls_Manager::NUMBER,
                    'default' => '',
                    'min' => 0,
                    'step' => .1,
                    'condition' => [
                        'dl_animation!' => '',
                        'dl_wow_enable!' => '',
                    ],
                    'frontend_available' => true,
                    'selectors' => [
                        "{{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element" => '-webkit-animation-delay:{{UNIT}}s;',
                        "{{WRAPPER}} {{CURRENT_ITEM}}.dl_parallax_element" => 'animation-delay:{{UNIT}}s;',
                    ],
                ]
            );


            $repeater->add_control(
                'dl_responsive_description',
                [
                    'raw' => __( 'Responsive visibility will take effect only on preview or live page, and not while editing in Elementor.', 'elementor' ),
                    'type' => Controls_Manager::RAW_HTML,
                    'content_classes' => 'elementor-descriptor',
                ]
            );
    
            $repeater->add_control(
                'dl_hide_tablet',
                [
                    'label' => __( 'Hide On Tablet', 'elementor' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'prefix_class' => 'elementor-',
                    'label_on' => __( 'Hide', 'elementor' ),
                    'label_off' => __( 'Show', 'elementor' ),
                    'return_value' => 'hidden-tablet',
                ]
            );
    
            $repeater->add_control(
                'dl_hide_mobile',
                [
                    'label' => __( 'Hide On Mobile', 'elementor' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'prefix_class' => 'elementor-',
                    'label_on' => __( 'Hide', 'elementor' ),
                    'label_off' => __( 'Show', 'elementor' ),
                    'return_value' => 'hidden-phone',
                ]
            );

            $control->add_control(
                'dl_parallax_repeater_data',
                [
                    'label' => esc_html__( 'Items', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'frontend_available' => true,
                    'title_field' => '{{{ item_source }}}',
                    'condition' => [
                        'dl_parallax_enable' => 'yes',
                    ],
    
                ]
            );

            
            $control->add_control(
                'dl_parallaxmove_enable',
                [
                    'label' => __( 'Enable Mouse Move', 'droit-elementor-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'droit-elementor-addons-pro' ),
                    'label_off' => __( 'No', 'droit-elementor-addons-pro' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'dl_parallax_enable' => 'yes',
                    ],
                    'separator' => 'before',
                    
                ]
            );

            $control->add_control(
                'dl_parallax_scalar_heading',
                [
                    'label' => __( 'Scalar (X, Y)', 'droit-elementor-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'condition' => [
                        'dl_parallaxmove_enable' => 'yes',
                    ],
                    
                ]
            );

            $control->add_control(
                'dl_scalar_x_axix', [
                    'label' => esc_html__( 'X axis', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '10.0',
                    'condition' => [
                        'dl_parallaxmove_enable' => 'yes',
                    ],
                    'frontend_available' => true,
                    'render_type' => 'none',
                ]
            );

            $control->add_control(
                'dl_scalar_y_axix', [
                    'label' => esc_html__( 'Y axis', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '8.0',
                    'condition' => [
                        'dl_parallaxmove_enable' => 'yes',
                    ],
                    'frontend_available' => true,
                    'render_type' => 'none',
                ]
            );

            $control->end_controls_section();

        }
    }

    public function dl_before_render( $element ) {
		$settings = $element->get_settings_for_display();

        $sctionEnable = isset($settings['dl_parallax_enable']) ? $settings['dl_parallax_enable'] : 'no';

        if ( 'section' === $element->get_name() && $sctionEnable == 'yes') {
            
            $attr['class'] = 'dl-paralax-section';
            $repeater = isset($settings['dl_parallax_repeater_data']) ? $settings['dl_parallax_repeater_data'] : [];
            if( !empty($repeater) ){
                $attr['data-dl_parallax'] = wp_json_encode( $repeater );
            }

            $attr['data-dl_move'] = wp_json_encode(
                [
                    'dl_parallaxmove_enable' => $settings['dl_parallaxmove_enable'],
                    'dl_scalar_x_axix' => $settings['dl_scalar_x_axix'],
                    'dl_scalar_y_axix' => $settings['dl_scalar_y_axix']
                ]
            );
		    
            $element->add_render_attribute(
                '_wrapper',
                $attr
            );
        }

	}

    public function dl_print_template( $template, $widget ) {

		if ( $widget->get_name() !== 'section' ) {
			return $template;
		}
		ob_start();
		?>
		<# if( 'yes' === settings.dl_parallax_enable ) {
			view.addRenderAttribute( 'dl_parallax_render', 'id', 'dl_parallax_ele-' + view.getID() );
			view.addRenderAttribute( 'dl_parallax_render', 'class', 'dl_parallax_ele-wrapper' );
            view.addRenderAttribute( 'dl_parallax_render', 'data-dl_parallax', JSON.stringify( settings.dl_parallax_repeater_data ) );

            view.addRenderAttribute( 'dl_parallaxmove_render', 'data-dl_move', JSON.stringify( {'dl_parallaxmove_enable' : settings.dl_parallaxmove_enable, 'dl_scalar_x_axix' : settings.dl_scalar_x_axix, 'dl_scalar_y_axix' : settings.dl_scalar_y_axix} ) );

		#>  
            
			<div {{{ view.getRenderAttributeString( 'dl_parallax_render' ) }}} {{{ view.getRenderAttributeString( 'dl_parallaxmove_render' ) }}}></div>
		<# } #>

		<?php
		$paralax_content = ob_get_contents();
		ob_end_clean();

		$template = $paralax_content . $template;

		return $template;
	}
    
	public static function instance(){
        if( is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
}
