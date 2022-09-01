<?php
namespace DROIT_ELEMENTOR_PRO\Widgets;


if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Pricing_Pro extends \Elementor\Widget_Base{

    public function get_name()
    {
        return 'dladdons-pricing-pro';
    }

    public function get_title()
    {
        return esc_html__( 'Pricing Pro', 'text-domain' );
    }

    public function get_icon()
    {
        return ' eicon-price-table addons-icon';
    }

    public function get_categories()
    {
        return ['droit_addons_pro'];
    }

    public function get_keywords()
    {
        return [ 'pricing','pricing-pro','Pricing pro','Droit','dl pricing pro'];
    }
	
    private function droit_render_currency_symbol( $symbol, $location ) {
        $currency_position = $this->get_settings( '_droit_pricing_pro_currency_position' );
        $location_setting = ! empty( $currency_position ) ? $currency_position : 'before';
        if ( ! empty( $symbol ) && $location === $location_setting ) {
            echo '<sup class="dl_currancy droit_currency_symbol droit-currency-symbol droit-currency--' . $location . '">'. $symbol .' </sup>';
        }
    }
    private function droit_get_currency_symbol( $symbol_name ) {
        $symbols = [
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'pound' => '&#163;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'baht' => '&#3647;',
            'yen' => '&#165;',
            'won' => '&#8361;',
            'guilder' => '&fnof;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'rupee' => '&#8360;',
            'indian_rupee' => '&#8377;',
            'real' => 'R$',
            'krona' => 'kr',
        ];
        return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
    }

    protected function register_controls()
    {
        do_action('dl_widgets/pricing_pro/register_control/start', $this);

        // add content 
        $this->__content_control();
        
        //style section
        $this->__style_control();
        
        do_action('dl_widgets/pricing_pro/register_control/end', $this);

        // by default
        do_action('dl_widget/section/style/custom_css', $this);
        
    }
    public function __content_control(){
        $this->header_control();
        $this->thumbnail_control();
        $this->currency_control();
        $this->feature_control();
        $this->description_control();
        $this->btn_control();
        $this->badge_control();
        $this->ordering_controls();
        //start subscribe layout end
    }
    //pricing header
    public function header_control(){
        $this->start_controls_section(
            '_dl_pro_pricing_content_section',
            [
                'label' => esc_html__('Header', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_control(
			'subtitle_icon',
			[
				'label' => __( 'Icon', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'fa4compatibility' => 'icon',
			]
		);
        $this->add_control(
			'_dl_pro_pricing_sub_title',
			[
				'label' => __( 'Sub Title', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'One of a kind platform. One of a kind price', 'droit-addons-pro' ),
                'dynamic' => [
                    'active' => true
                ]
			]
		);
        $this->add_control(
			'_dl_pro_pricing_title',
			[
				'label' => __( 'Title', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Unbelieveable Price', 'droit-addons-pro'),
                'dynamic' => [
                    'active' => true
                ]
			]
		);
        $this->end_controls_section();
    }
    //pricing thumbnail
    public function thumbnail_control(){
        $this->start_controls_section(
            '_dl_pro_pricing_thumbnail_section',
            [
                'label' => esc_html__('Thumbnail', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_control(
			'_dl_pro_pricing_thumbnail_image',
			[
				'label' => __( 'Choose Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        
        $this->end_controls_section();
    }
    //pricing currency
    public function currency_control(){

        $this->start_controls_section(
            '_droit_pricing_pro_currency_section',
            [
                'label' => esc_html__('Price', 'droit-elementor-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_droit_pricing_pro_enable_currency_price',
            [
                'label' => esc_html__('Show Price', 'droit-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            '_droit_pricing_pro_currency_symbol',
            [
                'label' => __( 'Currency Symbol', 'droit-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => __( 'None', 'droit-elementor-addons' ),
                    'dollar' => '&#36; ' . esc_html__( 'Dollar', 'droit-elementor-addons' ),
                    'euro' => '&#128; ' . esc_html__( 'Euro', 'droit-elementor-addons' ),
                    'baht' => '&#3647; ' . esc_html__( 'Baht', 'droit-elementor-addons' ),
                    'franc' => '&#8355; ' . esc_html__( 'Franc', 'droit-elementor-addons' ),
                    'guilder' => '&fnof; ' . esc_html__( 'Guilder', 'droit-elementor-addons' ),
                    'krona' => 'kr ' . esc_html__( 'Krona', 'droit-elementor-addons' ),
                    'lira' => '&#8356; ' . esc_html__( 'Lira', 'droit-elementor-addons' ),
                    'peseta' => '&#8359 ' . esc_html__( 'Peseta', 'droit-elementor-addons' ),
                    'peso' => '&#8369; ' . esc_html__( 'Peso', 'droit-elementor-addons' ),
                    'pound' => '&#163; ' . esc_html__( 'Pound Sterling', 'droit-elementor-addons' ),
                    'real' => 'R$ ' . esc_html__( 'Real', 'droit-elementor-addons' ),
                    'ruble' => '&#8381; ' . esc_html__( 'Ruble', 'droit-elementor-addons' ),
                    'rupee' => '&#8360; ' . esc_html__( 'Rupee', 'droit-elementor-addons' ),
                    'indian_rupee' => '&#8377; ' . esc_html__( 'Rupee (Indian)', 'droit-elementor-addons' ),
                    'shekel' => '&#8362; ' . esc_html__( 'Shekel', 'droit-elementor-addons' ),
                    'yen' => '&#165; ' . esc_html__( 'Yen/Yuan', 'droit-elementor-addons' ),
                    'won' => '&#8361; ' . esc_html__( 'Won', 'droit-elementor-addons' ),
                    'custom' => __( 'Custom', 'droit-elementor-addons' ),
                ],
                'default' => 'dollar',
                'condition' =>[
                    '_droit_pricing_pro_enable_currency_price' => ['yes'],
                ]
            ]
        );

        $this->add_control(
            '_droit_pricing_pro_currency_symbol_custom',
            [
                'label' => __( 'Custom Symbol', 'droit-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    '_droit_pricing_pro_enable_currency_price' => ['yes'],
                    '_droit_pricing_pro_currency_symbol' => ['custom'],
                ]
            ]
        );

        $this->add_control(
            '_droit_pricing_pro_price_text',
            [
                'label' => __( 'Price', 'droit-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '49',
                'condition' => [
                    '_droit_pricing_pro_enable_currency_price' => ['yes']
                ]
            ]
        );
        $this->add_control(
            '_droit_pricing_pro_currency_format',
            [
                'label' => __( 'Currency Format', 'droit-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ',' => '1.234,56 (Default)',
                    '' => '1,234.56',
                ],

                'condition' =>[
                    '_droit_pricing_pro_enable_currency_price' => ['yes'],
                ]
            ]
        ); 
        $this->add_control(
            '_droit_pricing_pro_sale',
            [
                'label' => __( 'Sale', 'droit-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'droit-elementor-addons' ),
                'label_off' => __( 'Off', 'droit-elementor-addons' ),
                'default' => '',
                'condition' => [
                    '_droit_pricing_pro_enable_currency_price' => ['yes'],
                ]
            ]
        );

        $this->add_control(
            '_droit_pricing_pro_original_price',
            [
                'label' => __( 'Original Price', 'droit-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '30',
                'condition' => [
                    '_droit_pricing_pro_enable_currency_price' => ['yes'],
                    '_droit_pricing_pro_sale' => ['yes'],
                ]
            ]
        );

        $this->add_control(
            '_droit_pricing_pro_period',
            [
                'label' => __( 'Period', 'droit-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '/ Monthly', 'droit-elementor-addons' ),
                'condition' => [
                    '_droit_pricing_pro_enable_currency_price' => ['yes'],
                ]
            ]
        );
        $this->add_control(
            '_droit_pricing_pro_period_position',
            [
                'label' => __( 'Position', 'droit-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'dl_beside' => __( 'Beside', 'droit-elementor-addons' ),
                    'dl_below' => __( 'Below', 'droit-elementor-addons' ),
                ],
                'default' => 'dl_beside',
                'condition' => [
                    '_droit_pricing_pro_period!' => '',
                    '_droit_pricing_pro_enable_currency_price' => ['yes'],
                ]
            ]
        );

        $this->end_controls_section();
    }
    //pricing feature
    public function feature_control(){
        $this->start_controls_section(
            '_dl_pro_pricing_Features_section',
            [
                'label' => esc_html__('Features', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => __( 'Text', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'List Item', 'droit-addons-pro' ),
				'default' => __( 'List Item', 'droit-addons-pro' ),
				'dynamic' => [
					'active' => true,
				],
				'description' => __( 'If you can use tooltip "{{Enter text}}"', 'droit-addons-pro' ),
			]
		);

		$repeater->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'fa4compatibility' => 'icon',
			]
		);

		$repeater->add_control(
			'tooltip_text',
			[
				'label' => __( 'Tooltip Text', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'I love PHP', 'droit-addons-pro' ),
				'default' => __( 'I love PHP', 'droit-addons-pro' ),
			]
		);

		$this->add_control(
			'icon_list',
			[
				'label' => __( 'Items', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => __( 'Tincidunt ut laoreet dolor', 'droit-addons-pro' ),
						'selected_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
						'tooltip_text' => 'I love PHP'
					],
					[
						'text' => __( 'Sed diam nonummy', 'droit-addons-pro' ),
						'selected_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
						'tooltip_text' => 'I love JAVA'
					],
					[
						'text' => __( 'Tincidunt ut laoreet dolor', 'droit-addons-pro' ),
						'selected_icon' => [
							'value' => 'fas fa-times',
							'library' => 'fa-solid',
						],
						'tooltip_text' => 'I love JavaScript'
					],
				],
				'title_field' => '{{{ elementor.helpers.renderIcon( this, selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
			]
		);

        $this->end_controls_section();
    }
    //pricing description
    public function description_control(){
        $this->start_controls_section(
            '_dl_pro_pricing_description_section',
            [
                'label' => esc_html__('Description', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'_dl_pro_pricing_description',
			[
				'label' => __( 'Description', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Default description', 'droit-addons-pro' ),
				'placeholder' => __( 'Type your description here', 'droit-addons-pro' ),
			]
		);
        $this->end_controls_section();
    }
    //peicing btn
    public function btn_control(){
        $this->start_controls_section(
            '_dl_pro_pricing_btn_section',
            [
                'label' => esc_html__('Button', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'_dl_pro_pricing_content',
			[
				'label' => __( 'Button Text', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Read More', 'droit-addons-pro' ),
				'placeholder' => __( 'Type your text here', 'droit-addons-pro' ),
			]
		);
        $this->add_control(
            '_dl_pro_pricing_content_link',
            [
                'label' => __('Link', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'droit-addons-pro'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $this->end_controls_section();
    }

    //peicing badge
    public function badge_control(){
        $this->start_controls_section(
            '_dl_pro_pricing_badge_section',
            [
                'label' => esc_html__('Badge', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'_dl_pro_pricing_badge_switcher',
			[
				'label' => __( 'Show Badge', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'_dl_pro_pricing_badge_text',
			[
				'label' => __( 'Badge Text', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Popular', 'droit-addons-pro' ),
                'dynamic' => [
                    'active' => true
                ],
                'condition' =>[
                    '_dl_pro_pricing_badge_switcher' => 'yes',
                ]
			]
		);
        $this->end_controls_section();
    }
    //Ordering Repeater
    public function ordering_controls(){
        $this->start_controls_section(
            '_dl_pro_pricing_repeater_order_section',
            [
                'label' => esc_html__('Content Ordering', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            '_dl_pro_pricing_order_enable',
            [
                'label' => __('Enable', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        $repeater->add_control(
            '_dl_pro_pricing_order_label',
            [
                'label' => __('Label', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::HIDDEN,
            ]
        );
        $repeater->add_control(
            '_dl_pro_pricing_order_id',
            [
                'label' => __('Id', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::HIDDEN,
            ]
        );
        
        $this->add_control(
            '_dl_pro_pricing_ordering_data',
            [
                'label' => __('Re-order', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'item_actions' =>[
                    'duplicate' => false,
                    'add' => false,
                    'remove' => false
                ],
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_dl_pro_pricing_order_enable' => 'yes',
                        '_dl_pro_pricing_order_label' => 'Sub Title',
                        '_dl_pro_pricing_order_id' => 'dl_sub_title',
                    ],
                    [
                        '_dl_pro_pricing_order_enable' => 'yes',
                        '_dl_pro_pricing_order_label' => 'Title',
                        '_dl_pro_pricing_order_id' => 'dl_pricing_title',
                    ],
                    [
                        '_dl_pro_pricing_order_enable' => 'yes',
                        '_dl_pro_pricing_order_label' => 'Thumbnail',
                        '_dl_pro_pricing_order_id' => 'dl_pricing_thumb',
                    ],
                    [
                        '_dl_pro_pricing_order_enable' => 'yes',
                        '_dl_pro_pricing_order_label' => 'Price',
                        '_dl_pro_pricing_order_id' => 'dl_pricing_numer',
                    ],
                    [
                        '_dl_pro_pricing_order_enable' => 'yes',
                        '_dl_pro_pricing_order_label' => 'Feature',
                        '_dl_pro_pricing_order_id' => 'dl_pricing_feature',
                    ],
                    [
                        '_dl_pro_pricing_order_enable' => 'yes',
                        '_dl_pro_pricing_order_label' => 'Button',
                        '_dl_pro_pricing_order_id' => 'pricing_btn',
                    ],
                    [
                        '_dl_pro_pricing_order_enable' => 'yes',
                        '_dl_pro_pricing_order_label' => 'Note',
                        '_dl_pro_pricing_order_id' => 'dl_pricing_note',
                    ],
                ],
                'title_field' => '<i class="eicon-editor-list-ul"></i>{{{ _dl_pro_pricing_order_label }}}',
            ]
        );
        $this->end_controls_section();
    }


    //style tab section
    public function __style_control(){
        $this ->general_style();
        $this ->header_control_style();
        $this ->thumb_control_style();
        $this ->price_control_style();
        $this ->feature_control_style();
        $this ->btn_control_style();
        $this ->note_control_style();
        $this ->badge_control_style();
        $this ->tooltip_control_style();
    }

    //pricing general
    public function general_style()
    {
        $this->start_controls_section(
            '_dl_pricing_pro_wrapper_section',
            [
                'label' => esc_html__('General', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            '_dl_pricing_pro_wrapper_align',
            [
                'label' => __('Alignment', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'droit-addons-pro'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'droit-addons-pro'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'droit-addons-pro'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .droit_pricing_pro_wrapper' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
			'_dl_pricing_pro_wrapper_padding',
			[
				'label' => __( 'Padding', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_dl_pricing_pro_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs(
			'pricing_pro_wrapper_style_tabs'
		);

		$this->start_controls_tab(
			'pricing_pro_normal_tab',
			[
				'label' => __( 'Normal', 'droit-addons-pro' ),
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_dl_pricing_pro_wrapper_background',
				'label' => __( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => '_dl_pricing_pro_border',
				'label' => __( 'Border', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_dl_pricing_pro_box_shadow',
				'label' => __( 'Box Shadow', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper',
			]
		);
		

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pricing_pro_hover_tab',
			[
				'label' => __( 'Hover', 'droit-addons-pro' ),
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_dl_pricing_pro_wrapper_hover_background',
				'label' => __( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper:hover',
			]
		);

        $this->add_control(
			'_dl_pricing_pro_hover_border',
			[
				'label' => __( 'Border Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'_dl_pricing_pro_hover_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper:hover .dl_pro_pricing_sub_title,
                    .droit_pricing_pro_wrapper:hover .dl_pro_pricing_title,
                    .droit_pricing_pro_wrapper:hover .droit-icon-list-item i,
                    .droit_pricing_pro_wrapper:hover .droit_pricing_feature_list,
                    .droit_pricing_pro_wrapper:hover .dl_pricing_note
                    ' => 'color: {{VALUE}} !important',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_dl_pricing_pro_hover_box_shadow',
				'label' => __( 'Box Shadow', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

        do_action('dl_pricing_pro_general_style', $this);
        $this->end_controls_section();
    }

    //pricing header
    public function header_control_style()
    {
        $this->start_controls_section(
            '_dl_pricing_pro_header_section',
            [
                'label' => esc_html__('Header', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'_dl_pricing_pro_sub_title',
			[
				'label' => __( 'Sub Title', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_dl_pricing_pro_sub_title_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_pricing_sub_title',
			]
		);
        $this->add_control(
			'_dl_pricing_pro_sub_title_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_pricing_sub_title' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
			'_dl_pricing_pro_sub_title_space',
			[
				'label' => __( 'Space', 'droit-addons-pro' ),
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
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_pricing_sub_title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_dl_pricing_pro_title',
			[
				'label' => __( 'Title', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_dl_pricing_pro_title_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_pricing_title',
			]
		);
        $this->add_control(
			'_dl_pricing_pro_title_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_pricing_title' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
			'_dl_pricing_pro_title_space',
			[
				'label' => __( 'Space', 'droit-addons-pro' ),
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
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_pricing_title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        do_action('dl_pricing_pro_heading_style', $this);
        $this->end_controls_section();
    }

    //pricing thumbnail
    public function thumb_control_style()
    {
        $this->start_controls_section(
            '_dl_pricing_pro_thumb_section',
            [
                'label' => esc_html__('Thumbnail', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
		

        $this->add_responsive_control(
			'_dl_pricing_pro_thumb_size',
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
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_pricing_thumb img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


        $this->add_responsive_control(
			'_dl_pricing_pro_thumb_space',
			[
				'label' => __( 'Space', 'droit-addons-pro' ),
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
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_pricing_thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        do_action('dl_pricing_pro_thumb_style', $this);
        $this->end_controls_section();
    }

    //feature
    public function price_control_style()
    {
        $this->start_controls_section(
			'_dl_pro_pricing_price_section',
			[
				'label' => __( 'Price', 'droit-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'_dl_pricing_pro_price_space',
			[
				'label' => __( 'Space', 'droit-addons-pro' ),
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
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .droit_pro_price.droit_pro_price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_dl_pro_pricing_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit_pro_price.droit_pro_price, .dl_currancy.droit_currency_symbol',
			]
		);
        $this->add_control(
			'_dl_pro_pricing_original_typography_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit_pro_price.droit_pro_price, .dl_currancy.droit_currency_symbol' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'_dl_pro_pricing_original_price',
			[
				'label' => __( 'Original Price', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_dl_pro_pricing_regular_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit_pro_price.droit_pro_price .droit-regular-price',
			]
		);
        $this->add_control(
			'_dl_pro_pricing_ragular_typography_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit_pro_price.droit_pro_price .droit-regular-price' => 'color: {{VALUE}}',
				],
			]
		);
		
        $this->add_control(
			'_dl_pro_pricing_price_symbol',
			[
				'label' => __( 'Symbol', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_dl_pro_pricing_symbol_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_currancy.droit_currency_symbol',
			]
		);
        $this->add_control(
			'_dl_pro_pricing_symbol_typography_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_currancy.droit_currency_symbol' => 'color: {{VALUE}}',
				],
			]
		);
			$this->add_responsive_control(
			'_dl_pro_pricing_symbol_position',
			[
				'label' => __( 'Position', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => -50,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_currancy.droit_currency_symbol' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_dl_pro_pricing_Period_price',
			[
				'label' => __( 'Price Priod', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_dl_pro_pricing_Period_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper span.droit_price_duration.droit-price-period',
			]
		);
        $this->add_control(
			'_dl_pro_pricing_Period_typography_color',
			[
				'label' => __( 'Color', 'droit-addons-pro'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper span.droit_price_duration.droit-price-period' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
    }

    //feature
    public function feature_control_style()
    {
        $this->start_controls_section(
			'section_icon_list',
			[
				'label' => __( 'Featute list', 'droit-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'_dl_pricing_pr_list_space',
			[
				'label' => __( 'Space', 'droit-addons-pro' ),
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
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .droit-icon-list-items' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'pricing_list_space',
			[
				'label' => __( 'Item Space', 'droit-addons-pro' ),
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
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .droit-icon-list-item' => 'padding-bottom: {{SIZE}}{{UNIT}}; margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'divider',
			[
				'label' => __( 'Divider', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'droit-addons-pro' ),
				'label_on' => __( 'On', 'droit-addons-pro' ),
				'selectors' => [
					'{{WRAPPER}} .droit-icon-list-item:not(:last-child):after' => 'content: ""',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label' => __( 'Style', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'solid' => __( 'Solid', 'droit-addons-pro' ),
					'double' => __( 'Double', 'droit-addons-pro' ),
					'dotted' => __( 'Dotted', 'droit-addons-pro' ),
					'dashed' => __( 'Dashed', 'droit-addons-pro' ),
				],
				'default' => 'solid',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .droit-icon-list-item:not(:last-child):after' => 'border-top-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_weight',
			[
				'label' => __( 'Weight', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .droit-icon-list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label' => __( 'Width', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'condition' => [
					'divider' => 'yes',
					'view!' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .droit-icon-list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_height',
			[
				'label' => __( 'Height', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'divider' => 'yes',
					'view' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .droit-icon-list-item:not(:last-child):after' => 'border-width: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'divider_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ddd',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .droit-icon-list-item:not(:last-child):after' => 'border-color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'more_options1',
			[
				'label' => __( 'Feature Icon', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-icon-list-item i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .droit-icon-list-item svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 14,
				],
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-icon-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .droit-icon-list-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'more_options',
			[
				'label' => __( 'Feature Text', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .droit-icon-list-item' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_indent',
			[
				'label' => __( 'Text Indent', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_feature_list' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .droit-icon-list-item, {{WRAPPER}} .droit-icon-list-item a',
			]
		);

		$this->end_controls_section();
    }

    // button
    public function btn_control_style()
    {
        $this->start_controls_section(
            '_dl_pro_pricing_btn_style_one_section',
            [
                'label' => esc_html__('Button', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_pro_pricing_btn_typography',
                'label' => __( 'Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_btn',
            ]
        );
        $this->add_control(
			'_dl_pro_pricing_btn_padding',
			[
				'label' => __( 'Padding', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_dl_pro_pricing_btn_border-radius',
			[
				'label' => __( 'Border Radius', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_dl_pro_pricing_btn_Spacing',
			[
				'label' => __( 'Spacing', 'droit-addons-pro' ),
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
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_btn' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->start_controls_tabs(
			'_dl_pro_pricing_btn_style_tabs'
		);

		$this->start_controls_tab(
			'_dl_pro_pricing_btn_style_normal_tab',
			[
				'label' => __( 'Normal', 'droit-addons-pro' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_dl_pro_pricing_btn_background',
				'label' => __( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_btn',
			]
		);
        $this->add_control(
			'_dl_pro_pricing_btn_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_btn' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => '_dl_pro_pricing_btn_border',
				'label' => __( 'Border', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_btn',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_dl_pro_pricing_btn_box_shadow',
				'label' => __( 'Box Shadow', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_dl_pro_pricing_btn_style_hover_tab',
			[
				'label' => __( 'Hover', 'droit-addons-pro' ),
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_dl_pro_pricing_btn_hover_background',
				'label' => __( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_btn:hover',
			]
		);
        $this->add_control(
			'_dl_pro_pricing_btn_hover_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_btn:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'_dl_pro_pricing_btn_hover_border_color',
			[
				'label' => __( 'Border Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_btn:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_dl_pro_pricing_btn_hover_box_shadow',
				'label' => __( 'Box Shadow', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

        do_action('dl_pro_pricing_btn_style', $this);

        $this->end_controls_section();
    }

    //pricing note
    public function note_control_style()
    {
        $this->start_controls_section(
            '_dl_pricing_pro_note_section',
            [
                'label' => esc_html__('Note', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_pricing_pro_note_typography',
                'label' => __( 'Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_note',
            ]
        );
        $this->add_control(
            '_dl_pricing_pro_note_color',
            [
                'label' => __( 'Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_note' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            '_dl_pricing_pro_note_space',
            [
                'label' => __( 'Space', 'droit-addons-pro' ),
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
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pricing_note' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        do_action('dl_pricing_pro_note_style', $this);
        $this->end_controls_section();
    }

    //pricing note
    public function badge_control_style()
    {
        $this->start_controls_section(
            '_dl_pricing_pro_badge_section',
            [
                'label' => esc_html__('Badge', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'_droit_pricing_pro_badge_left',
			[
				'label' => __( 'Left', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 2,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_badge' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_droit_pricing_pro_badge_top',
			[
				'label' => __( 'Top', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 2,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_badge' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_droit_pricing_pro_badge_rotae',
			[
				'label' => __( 'Transform', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'min' => -200,
					'max' => 200,
					'step' => 2,
				],
				'default' => [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_badge' => 'transform: rotate({{SIZE}}deg);',
				]
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_droit_pricing_pro_badge_background',
				'label' => __( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_badge',
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_droit_pricing_pro_badge_typography',
                'label' => __( 'Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_badge',
            ]
        );
        $this->add_control(
            '_droit_pricing_pro_badge_color',
            [
                'label' => __( 'Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_badge' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
			'_droit_pricing_pro_badge_padding',
			[
				'label' => __( 'Padding', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_droit_pricing_pro_badge_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_droit_pricing_pro_badge_box_shadow',
				'label' => __( 'Box Shadow', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit_pricing_pro_wrapper .dl_pro_badge',
			]
		);


        do_action('dl_pricing_pro_badge_style', $this);
        $this->end_controls_section();
    }

	//pricing note
    public function tooltip_control_style()
    {
        $this->start_controls_section(
            '_dl_pricing_pro_tooltip_section',
            [
                'label' => esc_html__('Tooltip', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_droit_pricing_pro_heighlighter_typography',
                'label' => __( 'Text Highlighter Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl-tooltip',
            ]
        );
		$this->add_control(
            '_droit_pricing_pro_heighlighter_color',
            [
                'label' => __( 'Heighlighter Text Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-tooltip' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_droit_pricing_pro_tooltip_background',
				'label' => __( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .dl-tooltip[data-tooltip]:before, {{WRAPPER}} .dl-tooltip[data-tooltip]:after',
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_droit_pricing_pro_tooltip_typography',
                'label' => __( 'Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl-tooltip[data-tooltip]:before',
            ]
        );
        $this->add_control(
            '_droit_pricing_pro_tooltip_color',
            [
                'label' => __( 'Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-tooltip[data-tooltip]:after' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
			'_droit_pricing_pro_tooltip_padding',
			[
				'label' => __( 'Padding', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .dl-tooltip[data-tooltip]:after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_droit_pricing_pro_tooltip_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .dl-tooltip[data-tooltip]:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_droit_pricing_pro_tooltip_box_shadow',
				'label' => __( 'Box Shadow', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl-tooltip[data-tooltip]:after',
			]
		);


        do_action('dl_pricing_pro_badge_style', $this);
        $this->end_controls_section();
    }

    //Html render
    protected function render()
    {   
        $settings = $this->get_settings_for_display();
        extract($settings);
		
        $fallback_defaults = [
			'fa fa-check',
			'fa fa-check',
			'fa fa-check',
		];

		$this->add_render_attribute( 'icon_list', 'class', 'droit-icon-list-items' );
		$this->add_render_attribute( 'list_item', 'class', 'droit-icon-list-item' );

        //Pricing
        $symbol = '';

        if ( ! empty( $_droit_pricing_pro_currency_symbol ) ) {
            if ( '_droit_pricing_pro_custom' !== $_droit_pricing_pro_currency_symbol ) {
                $symbol = $this->droit_get_currency_symbol( $_droit_pricing_pro_currency_symbol );
            } else {
                $symbol = $_droit_pricing_pro_currency_symbol_custom;
            }
        }
        $currency_format = empty( $_droit_pricing_pro_currency_format ) ? '.' : $_droit_pricing_pro_currency_format;
        $price = explode( $currency_format, $_droit_pricing_pro_price_text );
        $intpart = $price[0];
        $fraction = '';
        if ( 2 === count( $price ) ) {
            $fraction = $price[1];
        }

        $period_position = $_droit_pricing_pro_period_position;
        $period_element = '<span class="droit_price_duration droit-price-period " ' . $this->get_render_attribute_string( '_droit_pricing_pro_period' ) . '>' . $_droit_pricing_pro_period . '</span>';
       
        ?>
        <div class="droit_pricing_pro_wrapper">

            <?php if($_dl_pro_pricing_badge_switcher == 'yes'){ ?>
                <span class="dl_pro_badge"><?php echo esc_html($_dl_pro_pricing_badge_text) ?></span>
            <?php } ?>

            <?php
            $_ordering = $_dl_pro_pricing_ordering_data;
            foreach( $_ordering as $order ) :
                if('yes' !== $order['_dl_pro_pricing_order_enable'] ){
                    continue;
                }
                switch( $order['_dl_pro_pricing_order_id'] ):
                    case 'dl_sub_title':
                        if ( ! empty($_dl_pro_pricing_sub_title )) : ?>
                        <h5 class="dl_pro_pricing_sub_title">
							<?php \Elementor\Icons_Manager::render_icon( $settings['subtitle_icon'], [ 'aria-hidden' => 'true' ] );?>
							<?php echo $_dl_pro_pricing_sub_title; ?>
						</h5>
                        <?php endif;
                    break;

                    case 'dl_pricing_title':
                        if ( ! empty($_dl_pro_pricing_title )) : ?>
                        <h2 class="dl_pro_pricing_title"><?php echo $_dl_pro_pricing_title; ?></h2>
                        <?php endif;
                    break;

                    case 'dl_pricing_numer':
                    ?>
                    <?php if ($_droit_pricing_pro_enable_currency_price == 'yes'): ?>
                        <div class="dl_top_pricing_title">
                            <div class="droit_pro_price droit_pro_price <?php echo $period_position;?>">
                                <?php if ( 'yes' === $_droit_pricing_pro_sale && ! empty( $_droit_pricing_pro_original_price ) ) : ?>
                                    <span class="droit-regular-price"><?php echo esc_html($symbol . $_droit_pricing_pro_original_price); ?></span>
                                <?php endif; ?>
    
                                <?php $this->droit_render_currency_symbol( $symbol, 'before' ); ?>
    
                                <?php if ( ! empty( $intpart ) || 0 <= $intpart ) : ?>
                                    <span class="droit-pro-price-integer"><?php echo $intpart; ?></span>
                                <?php endif; ?>
    
                                <?php if ( '' !== $fraction || ( ! empty( $_droit_pricing_pro_period ) && 'beside' === $period_position ) ) : ?>
                                    <div class="droit-pro-price-price-after">
                                        <span class="droit-pro-price-floating"><?php echo $fraction; ?></span>
                                    </div>
                                <?php endif; ?>
    
                                <?php if ( ! empty( $_droit_pricing_pro_period ) ) : ?>
                                    <?php echo $period_element; ?>
                                <?php endif; ?>
    
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php
                        break; 

                        case 'dl_pricing_feature':
                        ?>
                        <ul <?php echo $this->get_render_attribute_string( 'icon_list' ); ?>>
                            <?php
                            foreach ( $settings['icon_list'] as $index => $item ) :
                                $migration_allowed = \Elementor\Icons_Manager::is_migration_allowed();
                                ?>
                            <li <?php echo $this->get_render_attribute_string( 'list_item' ); ?>>
                                <?php
                                // add old default
                                if ( ! isset( $item['icon'] ) && ! $migration_allowed ) {
                                    $item['icon'] = isset( $fallback_defaults[ $index ] ) ? $fallback_defaults[ $index ] : 'fa fa-check';
                                }
                                $migrated = isset( $item['__fa4_migrated']['selected_icon'] );
                                $is_new = ! isset( $item['icon'] ) && $migration_allowed;
                                if ( ! empty( $item['icon'] ) || ( ! empty( $item['selected_icon']['value'] ) && $is_new ) ) :
                                    ?>
                                <span class="droit-icon-list-icon">
                                    <?php
                                        if ( $is_new || $migrated ) {
                                            \Elementor\Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
                                        } else { ?>
                                    <i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
                                    <?php } ?>
                                </span>
                                <?php endif; ?>
                                <span class="droit_pricing_feature_list"><?php echo str_replace(['{{', '}}'], ['<span class="dl-tooltip" data-tooltip="'. esc_html($item['tooltip_text']) .'">', '</span>'], $item['text']); ?></span>
								
                            </li>
                        <?php endforeach;?>
                        </ul>
                    <?php
                    break;

                    case 'dl_pricing_thumb':
						if(!empty($_dl_pro_pricing_thumbnail_image)) {
							?>
								<div class="dl_pro_pricing_thumb">
									<img src="<?php echo esc_url($_dl_pro_pricing_thumbnail_image['url']) ?>" alt="">
								</div>
							<?php
						}
                    break;

                    case 'pricing_btn':
                        if ( ! empty ($_dl_pro_pricing_content_link)) : 
                            $target = $_dl_pro_pricing_content_link['is_external'] ? ' target="_blank"' : '';
                            $nofollow = $_dl_pro_pricing_content_link['nofollow'] ? ' rel="nofollow"' : '';
                        ?>
                        <div class="dl_pro_pricing_btn">
                            <a class="dl_btn btn_1 dl_pricing_btn" href="<?php echo esc_url($_dl_pro_pricing_content_link['url']);?>"
                                <?php echo esc_attr($target) . '' .esc_attr($nofollow);?>> <?php echo $_dl_pro_pricing_content; ?>
                            </a>
                        </div>
                    <?php endif;
                    break;

                    case 'dl_pricing_note':
                    if ( ! empty($_dl_pro_pricing_description )) : ?>
                        <p class="dl_pricing_note"><?php echo $_dl_pro_pricing_description; ?></p>
                    <?php endif;
                    break;

                endswitch;
            endforeach;
            ?>
        </div>
        <?php
    }

    protected function content_template()
    {}
}