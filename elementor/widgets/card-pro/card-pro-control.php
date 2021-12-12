<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Card_Pro;

use \DROIT_ELEMENTOR_PRO\Content_Typography;
use \DROIT_ELEMENTOR_PRO\Image;
use \DROIT_ELEMENTOR_PRO\Button;
use \DROIT_ELEMENTOR_PRO\Button_Size;
use \DROIT_ELEMENTOR_PRO\Button_Hover;
use \DROIT_ELEMENTOR_PRO\Position;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Scheme_Typography;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {exit;}

abstract class Card_Pro_Control extends Widget_Base
{
    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    public function get_pro_cards_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }
    //Preset
    public function _dl_pro_cards_preset_controls()
    {
        $this->start_controls_section(
            '_dl_pro_cards_preset_section',
            [
                'label' => __('Preset', 'droit-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_cards_skin',
            [
                'label' => esc_html__('Design Layout', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/card/control_presets', [
                    '_skin_1' => 'Design 1',
                ]),
                
                'default' => '_skin_1',
            ]
        );

        $this->end_controls_section();
    }

    public function _dl_pro_card_style_one_controls()
    {
        $this->_dl_pro_cards_content_one_controls();
        $this->_dl_pro_card_ordering_controls();
        $this->_dl_pro_card_general_style_one_controls();
        $this->_dl_pro_card_image_style_one_controls();
        $this->_dl_pro_card_content_style_one_controls();
        $this->_dl_pro_card_btn_style_one_controls();
    }
    //Card Content
    public function _dl_pro_cards_content_one_controls()
    {
        $this->start_controls_section(
            '_dl_pro_card_content_section_one',
            [
                'label' => __('Content', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_cards_skin') => ['_skin_1'],
                ],
            ]
        );
        $this->_dl_pro_cards_data_one_controls();
        
        $this->end_controls_section();
    }
   
    //Card data
    protected function _dl_pro_cards_data_one_controls()
    {
        $this->add_control(
            '_dl_pro_card_content_image', [
                'label' => __('Image', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'show_label' => false,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_one',
                'default' => 'full',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );
        $this->add_responsive_control(
			'_dl_pro_card_content_image_align',
			[
				'label' => __( 'Layout', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'droit-elementor-addons-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'top' => [
						'title' => __( 'Center', 'droit-elementor-addons-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'droit-elementor-addons-pro' ),
						'icon' => 'fa fa-align-right',
					],
                    'bottom' => [
                        'title' => __( 'Bottom', 'droit-elementor-addons-pro' ),
                        'icon' => 'fa fa-align-center',
                    ],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);

        $this->add_control(
            '_dl_pro_card_content_heading', [
                'label' => __('Heading', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Heading', 'droit-elementor-addons-pro'),
                'default' => __('Droit Heading', 'droit-elementor-addons-pro'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            '_dl_pro_card_content_desc', [
                'label' => __('Description', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter Text', 'droit-elementor-addons-pro'),
                'default' => __('Unwind in our Superior Rooms featuring dramatic Barcelona views created by elevated
                stays on the 21st floor or higher.', 'droit-elementor-addons-pro'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
			'_dl_pro_card_btn_content',
			[
				'label' => __( 'Button Text', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Read More', 'droit-elementor-addons-pro' ),
				'placeholder' => __( 'Type your text here', 'droit-elementor-addons-pro' ),
			]
		);
        $this->add_control(
            '_dl_pro_card_content_link',
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
            ]
        );
        do_action('dl_pro_cards_content_one', $this);
    }

    // Ordering Repeater
    public function _dl_pro_card_ordering_controls(){
        $this->start_controls_section(
            '_dl_pro_card_repeater_order_section',
            [
                'label' => esc_html__('Content Ordering', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            '_dl_pro_card_order_enable',
            [
                'label' => __('Enable', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        $repeater->add_control(
            '_dl_pro_card_order_label',
            [
                'label' => __('Label', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::HIDDEN,
            ]
        );
        $repeater->add_control(
            '_dl_pro_card_order_id',
            [
                'label' => __('Id', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::HIDDEN,
            ]
        );
        
        $this->add_control(
            '_dl_pro_card_ordering_data',
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
                        '_dl_pro_card_order_enable' => 'yes',
                        '_dl_pro_card_order_label' => 'Title',
                        '_dl_pro_card_order_id' => 'card_title',
                    ],
                    [
                        '_dl_pro_card_order_enable' => 'yes',
                        '_dl_pro_card_order_label' => 'Description',
                        '_dl_pro_card_order_id' => 'card_description',
                    ],
                    [
                        '_dl_pro_card_order_enable' => 'yes',
                        '_dl_pro_card_order_label' => 'Buttom',
                        '_dl_pro_card_order_id' => 'card_btn',
                    ],
                ],
                'title_field' => '<i class="eicon-editor-list-ul"></i>{{{ _dl_pro_card_order_label }}}',
            ]
        );
        $this->end_controls_section();
    }

    //General
    public function _dl_pro_card_general_style_one_controls()
    {
        $this->start_controls_section(
            '_dl_pro_cards_general_style_one_section',
            [
                'label' => esc_html__('General', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_cards_skin') => ['_skin_1'],
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_cards_align_one',
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
                'desktop_default' => '',
                'tablet_default' => '',
                'mobile_default' => '',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .dl-pro-card-content' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        do_action('dl_pro_cards_general_one', $this);
        $this->end_controls_section();
    }

    //Card Image
    public function _dl_pro_card_image_style_one_controls()
    {
        $this->start_controls_section(
            '_dl_pro_cards_image_style_one_section',
            [
                'label' => esc_html__('Image', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_cards_skin') => ['_skin_1'],
                    $this->get_control_id('_dl_pro_card_content_image!') => '',
                ],
            ]
        );
        $this->add_control(
			'_dl_pro_cards_image_align',
			[
				'label' => __( 'Alignment', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Left', 'droit-elementor-addons-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'droit-elementor-addons-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'droit-elementor-addons-pro' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
                'condition' => [
                    $this->get_control_id('_dl_pro_card_content_image_align') => ['top', 'bottom'],
                ],
                'selectors'   => [
                    '{{WRAPPER}} .dl_pro_card_img ' => 'justify-content: {{VALUE}};',
                ],
			]
		);

        $this->add_control(
			'_dl_pro_cards_image_vartical_align',
			[
				'label' => __( 'Alignment', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Top', 'droit-elementor-addons-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'droit-elementor-addons-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => __( 'Bottom', 'droit-elementor-addons-pro' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
                'condition' => [
                    $this->get_control_id('_dl_pro_card_content_image_align') => ['left', 'right'],
                ],
                'selectors'   => [
                    '{{WRAPPER}} .dl-pro-card-content' => 'align-items: {{VALUE}};',
                ],

			]
		);
        $this->add_control(
			'_dl_pro_cards_image_width',
			[
				'label' => __( 'Width', 'droit-elementor-addons-pro' ),
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
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_card_img' => 'flex: {{SIZE}}{{UNIT}} 0 0;',
				],
                'condition' => [
                    $this->get_control_id('_dl_pro_card_content_image_align') => ['left','right'],
                ],
			]
		);
        $this->add_control(
			'_dl_pro_cards_image_margin_right',
			[
				'label' => __( 'Spacing', 'droit-elementor-addons-pro' ),
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
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_card_img' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    $this->get_control_id('_dl_pro_card_content_image_align') => ['left'],
                ],
			]
		);
        $this->add_control(
			'_dl_pro_cards_image_margin_left',
			[
				'label' => __( 'Spacing', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
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
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_card_img' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    $this->get_control_id('_dl_pro_card_content_image_align') => ['right'],
                ],
			]
		);
        $this->add_control(
			'_dl_pro_cards_image_margin_top',
			[
				'label' => __( 'Spacing', 'droit-elementor-addons-pro' ),
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
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_card_img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    $this->get_control_id('_dl_pro_card_content_image_align') => ['top'],
                ],
			]
		);
        $this->add_control(
			'_dl_pro_cards_image_margin_bottom',
			[
				'label' => __( 'Spacing', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
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
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_card_img' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    $this->get_control_id('_dl_pro_card_content_image_align') => ['bottom'],
                ],
			]
		);
        $this->add_group_control(
            Image::get_type(),
            [
                'name' => 'button_image_setting',
                'label' => __('Image Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-pro-card-content .dl_card_img',
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
                
            ]
        );
        do_action('dl_pro_cards_image_one', $this);
        $this->end_controls_section();
    }

    //Card content
    public function _dl_pro_card_content_style_one_controls()
    {
        $this->start_controls_section(
            '_dl_pro_cards_heading_style_one_section',
            [
                'label' => esc_html__('Content', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_dl_pro_cards_content_bg_one',
                'label' => __('Background', 'droit-elementor-addons-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .dl_pro_card_content_wrapper',
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_cards_content_box_padding_one',
            [
                'label' => __('Padding', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_card_content_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_cards_content_box_border_radius_one',
            [
                'label' => __('Border Radius', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_card_content_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_pro_cards_content_box_shadow_one',
                'label' => __('Box Shadow', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl_pro_card_content_wrapper',
            ]
        );
        $this->add_control(
			'_dl_pro_cards_content_box_width',
			[
				'label' => __( 'Width', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
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
					'{{WRAPPER}} .dl_pro_card_content_wrapper' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            Position::get_type(),
            [
                'name' => '_dl_pro_cards_content_box_position',
                'label' => __('Position', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .dl_pro_card_content_wrapper',
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
        $this->add_control(
			'dl_pro_card_content_wrapper_z_index',
			[
				'label' => __( 'z index', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 1,
                'selectors' => [
					'{{WRAPPER}} .dl_pro_card_content_wrapper' => 'z-index: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'_dl_pro_card_heading',
			[
				'label' => __( 'Title', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => '_dl_pro_card_heading_style',
				'label' => __( 'Typography', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_pro_card_title .dl_title',
            ]
        );
        $this->add_control(
			'_dl_pro_card_heading_color',
			[
				'label' => __( 'Title Color', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_card_title .dl_title' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'_dl_pro_card_heading_Spacing',
			[
				'label' => __( 'Spacing', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .dl_pro_card_title .dl_title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
       
        do_action('dl_pro_cards_title_style_one', $this);

        $this->add_control(
			'_dl_pro_card_description',
			[
				'label' => __( 'Description', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => '_dl_pro_card_description_style',
				'label' => __( 'Typography', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_pro_card_desc .dl-desc',
            ]
        );
        $this->add_control(
			'_dl_pro_card_description_color',
			[
				'label' => __( 'Color', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_card_desc .dl-desc' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'_dl_pro_card_description_Spacing',
			[
				'label' => __( 'Spacing', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .dl_pro_card_desc .dl-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        do_action('dl_pro_cards_description_style_one', $this);

        do_action('dl_pro_cards_content_style_one', $this);

        $this->end_controls_section();
    }

    //Card button
    public function _dl_pro_card_btn_style_one_controls()
    {
        $this->start_controls_section(
            '_dl_pro_cards_btn_style_one_section',
            [
                'label' => esc_html__('Button', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => '_dl_pro_cards_btn_typography',
                'label' => __( 'Typography', 'droit-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_pro_card_btn .dl_card_btn',
            ]
        );
        $this->add_control(
			'_dl_pro_cards_btn_padding',
			[
				'label' => __( 'Padding', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_card_btn .dl_card_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_dl_pro_cards_btn_border-radius',
			[
				'label' => __( 'Border Radius', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_card_btn .dl_card_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_dl_pro_card_btn_Spacing',
			[
				'label' => __( 'Spacing', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .dl_pro_card_btn .dl_card_btn' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->start_controls_tabs(
			'_dl_pro_cards_style_tabs'
		);

		$this->start_controls_tab(
			'_dl_pro_cards_style_normal_tab',
			[
				'label' => __( 'Normal', 'droit-elementor-addons-pro' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => '_dl_pro_cards_btn_background',
				'label' => __( 'Background', 'droit-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .dl_pro_card_btn .dl_card_btn',
			]
		);
        $this->add_control(
			'_dl_pro_cards_btn_color',
			[
				'label' => __( 'Title Color', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_card_btn .dl_card_btn' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => '_dl_pro_cards_btn_border',
				'label' => __( 'Border', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_pro_card_btn .dl_card_btn',
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_dl_pro_cards_btn_box_shadow',
				'label' => __( 'Box Shadow', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_pro_card_btn .dl_card_btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_dl_pro_cards_style_hover_tab',
			[
				'label' => __( 'Hover', 'droit-elementor-addons-pro' ),
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => '_dl_pro_cards_btn_hover_background',
				'label' => __( 'Background', 'droit-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .dl_pro_card_btn .dl_card_btn:hover',
			]
		);
        $this->add_control(
			'_dl_pro_cards_btn_hover_color',
			[
				'label' => __( 'Color', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_card_btn .dl_card_btn:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'_dl_pro_cards_btn_hover_border_color',
			[
				'label' => __( 'Border Color', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .dl_pro_card_btn .dl_card_btn:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_dl_pro_cards_btn_hover_box_shadow',
				'label' => __( 'Box Shadow', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_pro_card_btn .dl_card_btn:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


        
        do_action('dl_pro_cards_content_style_one', $this);

        $this->end_controls_section();
    }
}