<?php
namespace Elementor;

use \WP_Query;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class droit_portfolio_slider
 * @package droit_portfolioCore\Widgets
 */
class DRTH_ESS_Pricing_Theme extends Widget_Base {

    public function get_name() {
        return 'droit-pricing-theme';
    }

    public function get_title() {
        return __( 'Pricing Table [Droit Elements]', 'droit_portfolio' );
    }

    public function get_icon() {
        return 'eicon-pricings';
    }

    public function get_categories() {
        return [ 'drth_custom_theme' ];
    }


    public function get_style_depends() {
        return ['droit-partner-style'];
    }

	public function get_script_depends(){
		return ['droit-portfolio-script'];
	}


    protected function register_controls() {


	    $pricing_repeater = new \Elementor\Repeater();
        // -------------------------------------------- Filtering
        $this->start_controls_section(
            'droit_pricing_section', [
                'label' => __( 'pricing Features', 'droit_portfolio' ),

            ]
        );
		$pricing_repeater->start_controls_tabs( 'pricing_plan_tabs' );
		$pricing_repeater->start_controls_tab(
			'pricing_plan_tab_heading',
			[
				'label' => __( 'Title', 'droit_portfolio' ),
			]
		);
		$pricing_repeater->add_control(
			'features_title_type',
			[
				'label' => __( 'Feature type', 'droit_portfolio' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'text' => [
						'title' => __( 'Text', 'droit_portfolio' ),
						'icon' => 'fa fa-font',
					],
					'image' => [
						'title' => __( 'Image', 'droit_portfolio' ),
						'icon' => 'fa fa-image',
					]
				],
				'default' => 'text',
				'toggle' => true,
				'separator' => 'before'
			]
		);
		$pricing_repeater->add_control(
		    'features_name', [
			    'label' => esc_html__( 'Feature Title', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'label_block' => true,
			    'default' => 'Saasland Theme',
				'condition' => [
					'features_title_type' => 'text'
				]
		    ]
	    );
		$pricing_repeater->add_control(
			'features_title_img_icon', [
				'label' => esc_html__( 'Feature', 'droit_portfolio' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'features_title_type' => 'image'
				]
			]
		);
		$pricing_repeater->end_controls_tab();

		/*----------------------------- Basic Plan ----------------------------------*/
		$pricing_repeater->start_controls_tab(
			'pricing_plan_tab_basic',
			[
				'label' => __( 'Basic', 'droit_portfolio' ),
			]
		);
		$pricing_repeater->add_control(
			'features_type',
			[
				'label' => __( 'Feature type', 'droit_portfolio' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'text' => [
						'title' => __( 'Text', 'droit_portfolio' ),
						'icon' => 'fa fa-font',
					],
					'icon' => [
						'title' => __( 'Icon', 'droit-addons-pro' ),
						'icon' => 'fa fa-surprise',
					],
					'image' => [
						'title' => __( 'Image', 'droit_portfolio' ),
						'icon' => 'fa fa-image',
					]
				],
				'default' => 'text',
				'toggle' => true,
				'separator' => 'before'
			]
		);
		$pricing_repeater->add_control(
			'plan_feature', [
				'label' => esc_html__( 'Feature', 'droit_portfolio' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'MultiPurpose Theme',
				'condition' => [
					'features_type' => 'text'
				]
			]
		);
		$pricing_repeater->add_control(
			'plan_icon',
			[
				'label'     => __( 'Icon', 'droit-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'features_type' => 'icon'
				]
			]
		);
		$pricing_repeater->add_control(
			'features_img_icon', [
				'label' => esc_html__( 'Feature', 'droit_portfolio' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'features_type' => 'image'
				]
			]
		);
		$pricing_repeater->end_controls_tab();

		/*----------------------------- Advanced Plan ----------------------------------*/
		$pricing_repeater->start_controls_tab(
			'pricing_plan_tab_advance',
			[
				'label' => __( 'Advance', 'droit_portfolio' ),
			]
		);
		$pricing_repeater->add_control(
			'advance_features_type',
			[
				'label' => __( 'Feature type', 'droit_portfolio' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'text' => [
						'title' => __( 'Text', 'droit_portfolio' ),
						'icon' => 'fa fa-font',
					],
					'icon' => [
						'title' => __( 'Icon', 'droit-addons-pro' ),
						'icon' => 'fa fa-surprise',
					],
					'image' => [
						'title' => __( 'Image', 'droit_portfolio' ),
						'icon' => 'fa fa-image',
					]
				],
				'default' => 'text',
				'toggle' => true,
				'separator' => 'before'
			]
		);
		$pricing_repeater->add_control(
			'advance_plan_feature', [
				'label' => esc_html__( 'Feature', 'droit_portfolio' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'MultiPurpose Theme',
				'condition' => [
					'advance_features_type' => 'text'
				]
			]
		);
		$pricing_repeater->add_control(
			'advance_pack_body_icon',
			[
				'label'     => __( 'Icon', 'droit-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'advance_features_type' => 'icon'
				]
			]
		);
		$pricing_repeater->add_control(
			'advance_features_img_icon', [
				'label' => esc_html__( 'Feature', 'droit_portfolio' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'advance_features_type' => 'image'
				]
			]
		);
		$pricing_repeater->end_controls_tab();

		/*----------------------------- Advanced Plan ----------------------------------*/
		$pricing_repeater->start_controls_tab(
			'pricing_plan_premium',
			[
				'label' => __( 'Premium', 'droit_portfolio' ),
			]
		);
		$pricing_repeater->add_control(
			'premium_features_type',
			[
				'label' => __( 'Feature type', 'droit_portfolio' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'text' => [
						'title' => __( 'Text', 'droit_portfolio' ),
						'icon' => 'fa fa-font',
					],
					'icon' => [
						'title' => __( 'Icon', 'droit-addons-pro' ),
						'icon' => 'fa fa-surprise',
					],
					'image' => [
						'title' => __( 'Image', 'droit_portfolio' ),
						'icon' => 'fa fa-image',
					]
				],
				'default' => 'text',
				'toggle' => true,
				'separator' => 'before'
			]
		);
		$pricing_repeater->add_control(
		    'premium_plan_feature', [
			    'label' => esc_html__( 'Feature', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'label_block' => true,
			    'default' => 'MultiPurpose Theme',
				'condition' => [
					'premium_features_type' => 'text'
				]
		    ]
	    );
		$pricing_repeater->add_control(
			'premium_pack_body_icon',
			[
				'label'     => __( 'Icon', 'droit-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'premium_features_type' => 'icon'
				]
			]
		);
	    $pricing_repeater->add_control(
		    'premium_features_img_icon', [
			    'label' => esc_html__( 'Feature', 'droit_portfolio' ),
			    'type' => Controls_Manager::MEDIA,
			    'condition' => [
					'premium_features_type' => 'image'
				]
		    ]
	    );

		$pricing_repeater->end_controls_tab();
		$pricing_repeater->end_controls_tabs();

	    $this->add_control(
		    'pricing_table_data',
		    [
			    'label' => __( 'Pricing Table', 'droit_portfolio' ),
			    'type' => \Elementor\Controls_Manager::REPEATER,
			    'fields' => $pricing_repeater->get_controls(),
			    'title_field' => '{{{ features_name }}}',
		    ]
	    );
        $this->end_controls_section();


		/**----------------------------Pricing Button------------------------------------------ */
		$this->start_controls_section(
            'pricing_table_button',
            [
                'label' => __( 'Pricing Header & Footer', 'droit_portfolio' )
            ]
        );
		$this->start_controls_tabs( 'pricing_button_tabs' );

		$this->start_controls_tab(
			'pricing_feature_title_tab',
			[
				'label' => __( 'Heading', 'droit_portfolio' ),
			]
		);
		$this->add_control(
		    'pricing_feature_title_heading', [
			    'label' => esc_html__( 'Image', 'droit_portfolio' ),
			    'type' => Controls_Manager::MEDIA,
		    ]
	    );
	    $this->add_control(
		    'pricing_feature_title_head', [
			    'label' => esc_html__( 'Heading Title', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'default' => 'Available pricing plan',
		    ]
	    );
		$this->end_controls_tab();


		$this->start_controls_tab(
			'pricing_button_tab_basic',
			[
				'label' => __( 'Basic', 'droit_portfolio' ),
			]
		);
		$this->add_control(
		    'basic_plan_header', [
			    'label' => esc_html__( 'Header', 'droit_portfolio' ),
			    'type' => Controls_Manager::HEADING,
		    ]
	    );
		$this->add_control(
		    'basic_plan_title', [
			    'label' => esc_html__( 'Plan Title', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'default' => 'Basic',
		    ]
	    );
		$this->add_control(
		    'basic_price_currency', [
			    'label' => esc_html__( 'Currency', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'default' => '$',
		    ]
	    );
		$this->add_control(
		    'basic_plan_price', [
			    'label' => esc_html__( 'Price', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'default' => '149',
		    ]
	    );
		$this->add_control(
		    'basic_plan_duration', [
			    'label' => esc_html__( 'Duration', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'default' => '/Per month',
		    ]
	    );
	    $this->add_control(
			'is_popular_pricing_basic',
			[
				'label' => __( 'Pricing is popular', 'droit_portfolio' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'droit_portfolio' ),
				'label_off' => __( 'Hide', 'droit_portfolio' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
		    'basic_plan_footer', [
			    'label' => esc_html__( 'Footer', 'droit_portfolio' ),
			    'type' => Controls_Manager::HEADING,
				'separator' => 'before'
		    ]
	    );
		$this->add_control(
		    'basic_btn_text', [
			    'label' => esc_html__( 'Button Label', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'label_block' => true,
			    'default' => 'Sign Up',
		    ]
	    );
		$this->add_control(
		    'basic_btn_url', [
			    'label' => esc_html__( 'Button URL', 'droit_portfolio' ),
			    'type' => Controls_Manager::URL,
			    'label_block' => true,
		    ]
	    );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'pricing_button_tab_advance',
			[
				'label' => __( 'Advance', 'droit_portfolio' ),
			]
		);
		$this->add_control(
		    'advance_plan_header', [
			    'label' => esc_html__( 'Header', 'droit_portfolio' ),
			    'type' => Controls_Manager::HEADING,
		    ]
	    );
		$this->add_control(
		    'advance_plan_title', [
			    'label' => esc_html__( 'Plan Title', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'default' => 'Advance',
		    ]
	    );
		$this->add_control(
		    'advance_price_currency', [
			    'label' => esc_html__( 'Currency', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'default' => '$',
		    ]
	    );
		$this->add_control(
		    'advance_plan_price', [
			    'label' => esc_html__( 'Price', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'default' => '149',
		    ]
	    );
		$this->add_control(
		    'advance_plan_duration', [
			    'label' => esc_html__( 'Duration', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'default' => '/Per month',
		    ]
	    );
        $this->add_control(
			'is_popular_pricing_advance',
			[
				'label' => __( 'Pricing is popular', 'droit_portfolio' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'droit_portfolio' ),
				'label_off' => __( 'Hide', 'droit_portfolio' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
		
		$this->add_control(
		    'advance_plan_footer', [
			    'label' => esc_html__( 'Footer', 'droit_portfolio' ),
			    'type' => Controls_Manager::HEADING,
				'separator' => 'before'
		    ]
	    );
		$this->add_control(
		    'advance_btn_text', [
			    'label' => esc_html__( 'Button Label', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'label_block' => true,
			    'default' => 'Sign Up',
		    ]
	    );
		$this->add_control(
		    'advance_btn_url', [
			    'label' => esc_html__( 'Button URL', 'droit_portfolio' ),
			    'type' => Controls_Manager::URL,
			    'label_block' => true,
		    ]
	    );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'pricing_button_tab_premium',
			[
				'label' => __( 'Premium', 'droit_portfolio' ),
			]
		);
		$this->add_control(
		    'premium_plan_header', [
			    'label' => esc_html__( 'Header', 'droit_portfolio' ),
			    'type' => Controls_Manager::HEADING,
		    ]
	    );
		$this->add_control(
		    'premium_plan_title', [
			    'label' => esc_html__( 'Plan Title', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'default' => 'Premium',
		    ]
	    );
		$this->add_control(
		    'premium_price_currency', [
			    'label' => esc_html__( 'Currency', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'default' => '$',
		    ]
	    );
		$this->add_control(
		    'premium_plan_price', [
			    'label' => esc_html__( 'Price', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'default' => '149',
		    ]
	    );
		$this->add_control(
		    'premium_plan_duration', [
			    'label' => esc_html__( 'Duration', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'default' => '/Per month',
		    ]
	    );
        $this->add_control(
			'is_popular_pricing_premium',
			[
				'label' => __( 'Pricing is popular', 'droit_portfolio' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'droit_portfolio' ),
				'label_off' => __( 'Hide', 'droit_portfolio' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
		    'premium_plan_footer', [
			    'label' => esc_html__( 'Footer', 'droit_portfolio' ),
			    'type' => Controls_Manager::HEADING,
				'separator' => 'before'
		    ]
	    );
		$this->add_control(
		    'premium_btn_text', [
			    'label' => esc_html__( 'Button Label', 'droit_portfolio' ),
			    'type' => Controls_Manager::TEXT,
			    'label_block' => true,
			    'default' => 'Sign Up',
		    ]
	    );
		$this->add_control(
		    'premium_btn_url', [
			    'label' => esc_html__( 'Button URL', 'droit_portfolio' ),
			    'type' => Controls_Manager::URL,
			    'label_block' => true,
		    ]
	    );
		$this->end_controls_tab();
		$this->end_controls_tabs();
        $this->end_controls_section();
    
    
        $this->start_controls_section(
            'pricing_button_style',
            [
                'label' => __( 'Button Style', 'droit_portfolio' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        //button Style Normal Style
        $this->start_controls_tabs('button_style_tabs');
        $this->start_controls_tab(
            'style_normal',
            [
                'label' => __( 'Normal', 'droit_portfolio' ),
            ]
        );
    
        $this->add_control(
            'btn_font_color', [
                'label' => esc_html__( 'Font color', 'droit_portfolio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_cu_btn.dark_bg.xl_btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'content_typo',
                'selector' => '
                    {{WRAPPER}} .dl_cu_btn.dark_bg.xl_btn',
            ]
        );

    
        $this->add_control(
            'btn_bg_color', [
                'label' => esc_html__( 'Background Color', 'droit_portfolio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_cu_btn.dark_bg.xl_btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
    
        $this->add_control(
            'cta_btn_border_color', [
                'label' => __( 'Border Color', 'droit_portfolio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_cu_btn.dark_bg.xl_btn' => 'border-color: {{VALUE}};',
                ],
            ]
        );
    
        $this->end_controls_tab();
        //Hover Color
        $this->start_controls_tab(
            'style_hover_btn',
            [
                'label' => __( 'Hover', 'droit_portfolio' ),
            ]
        );   
    
        $this->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'kidzo-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_cu_btn.dark_bg.xl_btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'droit_portfolio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_cu_btn.dark_bg.xl_btn:hover' => 'background: {{VALUE}};',
                ]
            ]
        );
    
        $this->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'droit_portfolio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_cu_btn.dark_bg.xl_btn' => 'border-color: {{VALUE}};',
                ]
    
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        
        $this->end_controls_section();

		/* ----------------------------Pricing Feature title Style---------------------------- */
		$this->start_controls_section(
            'pricing_table_feature_style',
            [
                'label' => __( 'Pricing Features Title Style', 'droit_portfolio' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pricing_plan_feature_title_typo',
                'selector' => '
					{{WRAPPER}} .dl_feature_list_table table tbody tr th:first-child,
					{{WRAPPER}} .dl_feature_list_table table tbody tr td:first-child
				',
            ]
        );
		$this->add_control(
            'pricing_plan_feature_title',
            [
                'label' => __( 'Feature Title Color', 'droit_portfolio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_feature_list_table table tbody tr th:first-child' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .dl_feature_list_table table tbody tr td:first-child' => 'color: {{VALUE}};'
                ],
            ]
        );
		$this->add_control(
            'pricing_plan_feature_bg',
            [
                'label' => __( 'Feature Title Background', 'droit_portfolio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_feature_list_table table thead tr th:first-child' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .dl_feature_list_table table tbody tr td:first-child' => 'background: {{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'pricing_plan_feature_border',
				'label' => __( 'Border', 'droit_portfolio' ),
				'selector' => '
					{{WRAPPER}} .dl_feature_list_table table tbody tr th:first-child,
					{{WRAPPER}} .dl_feature_list_table table tbody tr td:first-child
				',
			]
		);
        $this->end_controls_section();


		/**------------------------------Pricing style--------------------------------- */
		$this->start_controls_section(
            'pricing_table_style',
            [
                'label' => __( 'Pricing Feature Style', 'droit_portfolio' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'pricing_plan_bg',
            [
                'label' => __( 'Feature Title Background', 'droit_portfolio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_feature_list_table table thead tr th' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .dl_feature_list_table table tbody tr td' => 'background: {{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'pricing_plan_border_',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '
					.dl_feature_list_table td .feature-content
				',
			]
		);

		$this->add_control(
			'pricing_plan_feature_margin',
			[
				'label' => __( 'Margin', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_feature_list_table td .feature-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'pricing_plan_feature_padding',
			[
				'label' => __( 'Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_feature_list_table td .feature-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'p_icon_size',
			[
				'label' => __( 'Icon Size', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .dl_feature_list_table td .feature-content i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'p_icon_line',
			[
				'label' => __( 'Line', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .dl_feature_list_table td .feature-content i' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'p_icon_color',
			[
				'label' => __( 'Icon Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_feature_list_table td .feature-content i' => 'color: {{VALUE}}',
				],
			]
		);
        
        $this->end_controls_section();
        
        
        		/**------------------------------Pricing style--------------------------------- */
		$this->start_controls_section(
            'pricing_table_header_style',
            [
                'label' => __( 'Pricing Header Style', 'droit_portfolio' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'pricing_plan_title_color',
            [
                'label' => __( 'Plan Title Color', 'droit_portfolio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing_wrap h4' => 'color: {{VALUE}};',
                    
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'pricing_plan_title_typo',
                'selector' => '
                    {{WRAPPER}} .pricing_wrap h4',
            ]
        );
        $this->add_control(
            'pricing_plan_title_margin',
            [
                'label' => __( 'Margin', 'droit_portfolio' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing_wrap h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->end_controls_section();



    }
    
    // HTML Render Function --------------------------------
    protected function render() {
        $settings = $this->get_settings(); ?>

		<section class="dl_table_section" data-bg-color="#E5F8FF">
			<div class="dl_container">
				<div class="dl_row dl_justify_content_center">
					<div class="dl_col_lg_12">
						<div class="dl_table_container">
							<div class="dl_feature_list_table">
								<div class="dl_table_nav">
									<?php
									$pricing_items = $settings['pricing_table_data'];
									
									if( !empty( $settings['basic_plan_title'] ) ){
								    	echo '<button class="active">'. esc_html( $settings['basic_plan_title'] ) .'</button>';
									}
									
									if( !empty( $settings['advance_plan_title'] ) ){
								    	echo '<button>'. esc_html( $settings['advance_plan_title'] ) .'</button>';
									}
									
									if( !empty( $settings['premium_plan_title'] ) ){
								    	echo '<button>'. esc_html( $settings['premium_plan_title'] ) .'</button>';
									}
									?>
								</div>
								<table>
									<?php 										
									if( is_array( $pricing_items ) && $pricing_items > 0 ){ ?>
									<thead>
										<tr>
											<th>
												<?php echo '<span class="dl_price text-center">'. wp_get_attachment_image( $settings['pricing_feature_title_heading']['id'], 'full' ) .'</span>' ?>
												<?php echo '<span class="dl_price_title text-center">'. $settings['pricing_feature_title_head'] .'</span>' ?>
											</th>
											<th class="pricing_wrap price_popular_is">
											    <?php
											    if( !empty( $settings['is_popular_pricing_basic'] ) ){
											      echo '<div class="is_popular">'. esc_html__( 'POPULAR CHOICE', 'droit_portfolio' ) .'</div>';  
											    }
											    ?>
												<span class="dl_title"><?php echo esc_html( $settings['basic_plan_title'] ) ?></span>
												<?php echo '<span class="dl_price"> <span class="dl_currancy">'.esc_html($settings['basic_price_currency']).'</span> '.esc_html( $settings['basic_plan_price'] ).' <span class="dl_price_duration">'.esc_html( $settings['basic_plan_duration'] ).'</span> </span>' ?>
											</th>
											<th class="pricing_wrap price_popular_is">
											    <?php 
											    if( !empty( $settings['is_popular_pricing_advance'] ) ){
											      echo '<div class="is_popular">'. esc_html__( 'POPULAR CHOICE', 'droit_portfolio' ) .'</div>';  
											    }
											    ?>
												<span class="dl_title"><?php echo esc_html( $settings['advance_plan_title'] ) ?></span>
												<?php echo '<span class="dl_price"> <span class="dl_currancy">'.esc_html($settings['advance_price_currency']).'</span> '.esc_html( $settings['advance_plan_price'] ).' <span class="dl_price_duration">'.esc_html( $settings['advance_plan_duration'] ).'</span> </span>' ?>
											</th>
											<th class="pricing_wrap price_popular_is">
											    <?php 
											    if( !empty( $settings['is_popular_pricing_premium'] ) ){
											      echo '<div class="is_popular">'. esc_html__( 'POPULAR CHOICE', 'droit_portfolio' ) .'</div>';  
											    }
											    ?>
												<span class="dl_title"><?php echo esc_html( $settings['premium_plan_title'] ) ?></span>
												<?php echo '<span class="dl_price"> <span class="dl_currancy">'.esc_html($settings['premium_price_currency']).'</span> '.esc_html( $settings['premium_plan_price'] ).' <span class="dl_price_duration">'.esc_html( $settings['premium_plan_duration'] ).'</span> </span>' ?>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php

										foreach( $pricing_items as $pricing_data ){ ?>
											<tr>
												<?php 
												if( !empty( $pricing_data['features_name'] ) ){
													echo '<td><span class="feature-content">'. esc_html( $pricing_data['features_name'] ) .'</span></td>';
												}
												//Basic Plan ------------------------------------------------
												if( $pricing_data['features_type'] == 'image' ){
													echo '<td class="default"><span class="feature-content">'. wp_get_attachment_image( $pricing_data['features_img_icon']['id'], 'full' ) .'</span></td>';
												}
												elseif($pricing_data['features_type'] == 'icon' ){
													?>
													<td class="<?php echo esc_attr_e('elementor-repeater-item-'.$pricing_data['_id']);?>"><span class="feature-content">
														<?php  
															\Elementor\Icons_Manager::render_icon( $pricing_data['plan_icon']
															)?>
														</span></td>
													<?php	 
												}
												else{
													echo '<td class="default"><span class="feature-content">'. esc_html( $pricing_data['advance_plan_feature'], 'full' ) .'</span></td>';
												}
												
												//Advance Plan ------------------------------------------------
												if( $pricing_data['advance_features_type'] == 'image' ){
													echo '<td><span class="feature-content">'. wp_get_attachment_image( $pricing_data['advance_features_img_icon']['id'], 'full' ) .'</span></td>';
												}
												elseif($pricing_data['advance_features_type'] == 'icon' ){
													?>
													<td class="<?php echo esc_attr_e('elementor-repeater-item-'.$pricing_data['_id']);?>"><span class="feature-content">
														<?php  
															\Elementor\Icons_Manager::render_icon( $pricing_data['advance_pack_body_icon']
															)?>
														</span></td>
													<?php	 
												}
												else {
													echo '<td><span class="feature-content">'. esc_html( $pricing_data['advance_plan_feature'] ) .'</span></td>';
												}
												
												//Premium Plan ------------------------------------------------
												if( $pricing_data['premium_features_type'] == 'image' ){
													echo '<td><span class="feature-content">'. wp_get_attachment_image( $pricing_data['premium_features_img_icon']['id'], 'full' ) .'</span></td>';
												}
												elseif($pricing_data['premium_features_type'] == 'icon' ){
													?>
													<td class="<?php echo esc_attr_e('elementor-repeater-item-'.$pricing_data['_id']);?>"><span class="feature-content">
														<?php  
															\Elementor\Icons_Manager::render_icon( $pricing_data['premium_pack_body_icon']
															)?>
														</span></td>
													<?php	 
												}
												else {
													echo '<td><span class="feature-content">'. esc_html( $pricing_data['premium_plan_feature'] ) .'</span></td>';
												}
												?>

											</tr>
											<?php
										}
										echo'<tr><td></td>';
										if( !empty( $settings['basic_btn_text'] ) ){
											echo '<td class="default"><a href="'. esc_url( $settings['basic_btn_url']['url'] ) .'" class="dl_cu_btn dark_bg xl_btn">'. esc_html( $settings['basic_btn_text'] ) .'</a></td>';
										}
										if( !empty( $settings['advance_btn_text'] ) ){
											echo '<td><a href="'. esc_url( $settings['advance_btn_url']['url'] ) .'" class="dl_cu_btn dark_bg xl_btn">'. esc_html( $settings['advance_btn_text'] ) .'</a></td>';
										}
										if( !empty( $settings['premium_btn_text'] ) ){
											echo '<td><a href="'. esc_url( $settings['premium_btn_url']['url'] ) .'" class="dl_cu_btn dark_bg xl_btn">'. esc_html( $settings['premium_btn_text'] ) .'</a></td>';
										}
										echo '</tr></tbody>';
									}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
        
        <?php
    }


}
