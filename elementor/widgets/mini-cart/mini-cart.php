<?php
namespace DROIT_ELEMENTOR_PRO\Widgets;
use Elementor\Core\Schemes\Typography;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Mini_Cart extends \Elementor\Widget_Base {
	
    public function get_name() {
        return 'droit-woo-mini-cart';
    }

    public function get_title() {
        return esc_html__('Mini Cart', 'droit-addons-pro');
    }

    public function get_icon() {
        return 'eicon-basket-medium addons-icon';
    }

    public function get_categories() {
        return ['droit_addons_pro'];
    }

    public function get_keywords() {
        return [
            'Woocommerces',
            'woocommerces',
            'WC',
            'Woocommerces Cart',
            'Woocommerces Mini Cart',
            'woocommerces mini cart',
            'mini-cart',
            'cart',
            'mini cart',
            'droit Woocommerces',
            'dl Woocommerces',
            'droit',
            'dl',
            'addons',
            'addon',
            'pro',
        ];
    }

    protected function register_controls() {
        do_action('dl_widgets/mini-cart/register_control/start', $this);

        if( class_exists('\Woocommerce') ){
            // for layout
            $this->__minicart_settings();

            // for style controls
            $this->__styles();

        } else {
            $this->start_controls_section(
				'_section_woo',
				[
					'label' =>  __( 'Missing Notice', 'droit-addons-pro' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			$this->add_control(
				'_woo_missing_notice',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => sprintf(
						__( 'Hello %2$s, looks like %1$s is missing in your site. Please click on the link below and install/activate %1$s. Make sure to refresh this page after installation or activation.', 'droit-addons-pro' ),
						'<a href="'.esc_url( admin_url( 'plugin-install.php?s=Woocommerce&tab=search&type=term' ) ).'" target="_blank" rel="noopener">Woocommerce</a>',
						\wp_get_current_user()->display_name
					),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				]
			);

			if ( file_exists( WP_PLUGIN_DIR . '/woocommerce/woocommerce.php' ) ) {
				$link = wp_nonce_url( 'plugins.php?action=activate&plugin=woocommerce/woocommerce.php&plugin_status=all&paged=1', 'activate-plugin_woocommerce/woocommerce.php' );
			}else{
				$link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' );
			}

			$this->add_control(
				'_dl_woolist_install',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => '<a href="'. $link .'" target="_blank" rel="noopener">Click to install or activate Woocommerce</a>',
				]
			);
			$this->end_controls_section();
        }
       
        do_action('dl_widgets/mini-cart/register_control/end', $this);

        do_action('dl_widget/section/style/custom_css', $this);
    }

    // mini cart settings
    protected function __minicart_settings() {
        $this->start_controls_section(
			'dl_mini_cart_content_section',
			[
				'label' => __( 'General Settings', 'droit-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'dl_mini_cart_icons',
			[
				'label' => __( 'Cart Icon', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-shopping-basket',
					'library' => 'fa-solid',
                ],
			]
        );

        $this->add_control(
            'dl_mini_cart_show',
            [
                'label' => __( 'Show Cart Popup On', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'click',
				'options' => [
					'none' 	=> __( 'None', 'droit-addons-pro' ),
					'click' => __( 'Click', 'droit-addons-pro' ),
					'hover' => __( 'Hover', 'droit-addons-pro' ),
				],

            ]
        );

		$this->add_control(
			'dl_mini_cart_active_off_canvas',
			[
				'label'         => __( 'Enable Off Canvas', 'droit-addons-pro' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'default'       => 'no',
                'return_value'  => 'yes',
                'description' 	=> __( 'Turn on the switch if you want to see off canvas mini cart content.', 'droit-addons-pro' )
			]
		);
		
		$this->add_control(
			'dl_mini_cart_subtotal_show',
			[
				'label'         => __( 'Show Subtotal', 'droit-addons-pro' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'default'       => 'yes',
                'return_value'  => 'yes',
                'description' 	=> __( 'Turn off the switch if you want to don\'t see subtotal amount.', 'droit-addons-pro' )
			]
		);

        $this->add_control(
            'dl_mini_cart_subtotal_position',
            [
                'label' =>__( 'Set Subtotal Position', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'droit-addons-pro'),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __('Right', 'droit-addons-pro'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'right',
				'toggle' => false,
                'style_transfer' => true,
				'selectors_dictionary' => [
                    'left' => 'order: -1;',
                    'right' => 'order: 1;',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl-mini-cart-wrapper .dl-mini-cart-button .dl-mini-cart-total' => '{{VALUE}};'
				],
				'prefix_class' => 'dl-mini-cart-subtotal-position-',
				'condition'             => [
					'dl_mini_cart_subtotal_show' => 'yes',
				],
            ]
        );

        $this->add_responsive_control(
            'dl_mini_cart_alignment',
            [
                'label' =>__( 'Set Cart Alignment', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'droit-addons-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'droit-addons-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'droit-addons-pro' ),
						'icon' => 'eicon-text-align-right',
					]
				],
				'selectors_dictionary' => [
                    'left' => 'text-align: left;',
                    'center' => 'text-align: center;',
                    'right' => 'text-align: right;',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl-mini-cart-wrapper' => '{{VALUE}};'
				],
				'prefix_class' => 'dl-mini-cart%s-align-',
                'default' => 'left',
            ]
        );

        $this->end_controls_section();
    }

    // define style controls
    protected function __styles() {
        $this->__cart_btn_style();
		$this->__container_style();
		$this->__header_style();
		$this->__close_popup_style();
		$this->__item_style();
		$this->__subtotal_style();
		$this->__btn_style();
    }

    // mini cart style
	protected function __cart_btn_style() {

		$this->start_controls_section(
			'dl_mini_cart_button_section',
			[
				'label' => __( 'General Style', 'droit-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'dl_mini_cart_button_padding',
			[
				'label' => __( 'Padding', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dl_mini_cart_icon_size',
			[
				'label' => __( 'Icon Size', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-button i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dl-mini-cart-button svg' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dl_mini_cart_subtotal_space',
			[
				'label' => __( 'Space Between', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}}.dl-mini-cart-subtotal-position-right .dl-mini-cart-button .dl-mini-cart-total' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.dl-mini-cart-subtotal-position-left .dl-mini-cart-button .dl-mini-cart-total' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'dl_mini_cart_subtotal_show' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dl_mini_cart_button_typo',
				'label'    => __( 'Typography', 'droit-addons-pro' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .dl-mini-cart-button',
			]
		);

		$this->add_responsive_control(
			'dl_mini_cart_button_border_radius',
			[
				'label'      => __( 'Border Radius', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl-mini-cart-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'dl_mini_cart_button_shadow',
				'selector' => '{{WRAPPER}} .dl-mini-cart-button',
			]
		);

		$this->start_controls_tabs('mini_cart_button_color_tabs');
		$this->start_controls_tab(
			'dl_mini_cart_button_color_normal_tab',
			[
				'label' => __('Normal', 'droit-addons-pro')
			]
		);

		$this->add_control(
			'dl_mini_cart_button_normal_color',
			[
				'label'     => __( 'Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .dl-mini-cart-button svg'  => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'dl_mini_cart_button_normal_bg_color',
				'exclude' => [
					'classic' => 'image' // remove image bg option
				],
				'selector' => '{{WRAPPER}} .dl-mini-cart-button',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'dl_mini_cart_button_border',
				'label'     => __( 'Border', 'droit-addons-pro' ),
				'selector'  => '{{WRAPPER}} .dl-mini-cart-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'dl_mini_cart_button_color_hover_tab',
			[
				'label' => __('Hover', 'droit-addons-pro')
			]
		);

		$this->add_control(
			'dl_mini_cart_button_hover_color',
			[
				'label'     => __( 'Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .dl-mini-cart-button:hover svg'  => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'dl_mini_cart_button_hover_bg_color',
				'exclude' => [
					'classic' => 'image' // remove image bg option
				],
				'selector' => '{{WRAPPER}} .dl-mini-cart-button:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'dl_mini_cart_hover_button_border',
				'label'     => __( 'Border', 'droit-addons-pro' ),
				'selector'  => '{{WRAPPER}} .dl-mini-cart-button:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'dl_mini_cart_button_count_heading',
			[
				'label' => __( 'Item Count', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'dl_mini_cart_button_count_height',
			[
				'label' => __( 'Height', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 250,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-count' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'dl_mini_cart_button_count_width',
			[
				'label' => __( 'Width', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 250,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-count' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'dl_mini_cart_button_count_toggle',
			[
				'label' => __( 'Position', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'dl_mini_cart_button_count_x',
			[
				'label' => __( 'Horizontal', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					]
				],
				'style_transfer' => true,
				'render_type' => 'ui',
				'condition' => [
					'dl_mini_cart_button_count_toggle' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-count' => 'top: {{SIZE}}px;'
				]
			]
		);

		$this->add_responsive_control(
			'dl_mini_cart_button_count_y',
			[
				'label' => __( 'Vertical', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					]
				],
				'style_transfer' => true,
				'render_type' => 'ui',
				'condition' => [
					'dl_mini_cart_button_count_toggle' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-count' => 'right: {{SIZE}}px;'
				]
			]
		);

		$this->end_popover();

		$this->add_responsive_control(
			'dl_mini_cart_button_count_font_size',
			[
				'label' => __( 'Font Size', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-count' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dl_mini_cart_button_count_radius',
			[
				'label'      => __( 'Border Radius', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl-mini-cart-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'dl_mini_cart_button_count_shadow',
				'selector' => '{{WRAPPER}} .dl-mini-cart-count',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'        => 'dl_mini_cart_button_count_border',
				'label'       => __( 'Border', 'droit-addons-pro' ),
				'selector'    => '{{WRAPPER}} .dl-mini-cart-count',
			]
		);

		$this->start_controls_tabs('dl_mini_cart_button_count_tabs');
		$this->start_controls_tab(
			'dl_mini_cart_button_count_normal_tab',
			[
				'label' => __( 'Normal', 'droit-addons-pro' )
			]
		);

		$this->add_control(
			'dl_mini_cart_button_count_color',
			[
				'label'     => __( 'Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .dl-mini-cart-count' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dl_mini_cart_button_count_background_color',
			[
				'label'     => __( 'Background Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-count' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'dl_mini_cart_button_count_hover_tab',
			[
				'label' => __( 'Hover', 'droit-addons-pro' )
			]
		);

		$this->add_control(
			'dl_mini_cart_button_count_hover_color',
			[
				'label'     => __( 'Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .dl-mini-cart-button:hover .dl-mini-cart-count' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dl_mini_cart_button_count_hover_background_color',
			[
				'label'     => __( 'Background Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-button:hover .dl-mini-cart-count' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dl_mini_cart_button_count_hover_border_color',
			[
				'label'     => __( 'Border Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .dl-mini-cart-button:hover .dl-mini-cart-count' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

    // define container style control
    protected function __container_style(){

		$this->start_controls_section(
			'dl_mc_popup_body_section',
			[
				'label' => __( 'Popup Container', 'droit-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'             => [
					'dl_mini_cart_show!' => 'none',
				],
			]
		);

		$this->add_responsive_control(
			'dl_mc_popup_body_width',
			[
				'label' => __( 'Width', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dl_mc_popup_offset_x',
			[
				'label' => __( 'Offset X', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -1200,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup' => 'left: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'dl_mc_popup_body_padding',
			[
				'label'      => __( 'Padding', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl-mini-cart-popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dl_mc_popup_body_margin',
			[
				'label'      => __( 'Margin', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl-mini-cart-popup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dl_mc_popup_body_bg_color',
			[
				'label'     => __( 'Background Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'        => 'dl_mc_popup_body_border',
				'label'       => __( 'Border', 'droit-addons-pro' ),
				'placeholder' => '1px',
				'selector'    => '{{WRAPPER}} .dl-mini-cart-popup',
			]
		);

		$this->add_responsive_control(
			'dl_mc_popup_body_border_radius',
			[
				'label'      => __( 'Border Radius', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl-mini-cart-popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'dl_mc_popup_body_border_shadow',
				'selector' => '{{WRAPPER}} .dl-mini-cart-popup',
			]
		);

		$this->end_controls_section();
	}

    // header style
	protected function __header_style(){

		$this->start_controls_section(
			'dl_mc_popup_header_section',
			[
				'label' => __( 'Popup Header', 'droit-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'             => [
					'dl_mini_cart_show!' => 'none',
				],
			]
		);

		$this->add_control(
			'dl_mc_popup_header_content_padding',
			[
				'label'      => __( 'Padding', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dl_mc_popup_header_content_margin',
			[
				'label'      => __( 'Margin', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name'		 => 'dl_mc_popup_header_content_typo',
				'selector'	 => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-header .dl-mini-cart-popup-count-text-area, {{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-header .dl-mini-cart-popup-count-text-area a',
			]
		);



		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'        => 'dl_mc_popup_header_side_border',
				'label'       => __( 'Border', 'droit-addons-pro' ),
				'selector'    => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-header .dl-mini-cart-popup-count-text-area:before,{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-header .dl-mini-cart-popup-count-text-area:after',
			]
		);

		$this->add_responsive_control(
			'dl_mc_popup_header_side_border_space',
			[
				'label' => __( 'Border Space', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-header .dl-mini-cart-popup-count-text-area:before' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-header .dl-mini-cart-popup-count-text-area:after' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	// define container style control
    protected function __close_popup_style(){

		$this->start_controls_section(
			'dl_mc_closepopup_section',
			[
				'label' => __( 'Popup Close Icon', 'droit-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'             => [
					'dl_mini_cart_show!' => 'none',
				],
			]
		);

		$this->add_responsive_control(
			'dl_mc_closepopup_offset_x',
			[
				'label' => __( 'Offset X', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 350,
					],
					'%' => [
						'min' => -100,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-wrapper .dl-minicart-close-popup' => 'right: {{SIZE}}{{UNIT}};'
				]
			]
		);
		
		$this->add_responsive_control(
			'dl_mc_closepopup_icon_size',
			[
				'label' => __( 'Icon Size', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
					'%' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-wrapper .dl-minicart-close-popup i' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);
		
		$this->add_control(
			'dl_mc_closepopup_icon_color',
			[
				'label'     => __( 'Icon Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .dl-mini-cart-wrapper .dl-minicart-close-popup i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

    // define item style coontrol
    protected function __item_style(){

		$this->start_controls_section(
			'dl_mc_popup_item_section',
			[
				'label' => __( 'Popup Cart Item', 'droit-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'             => [
					'dl_mini_cart_show!' => 'none',
				],
			]
		);

		$this->add_control(
			'dl_mc_popup_item_border_color',
			[
				'label'     => __( 'Border Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dl_mc_popup_item_padding',
			[
				'label'      => __( 'Padding', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dl_mc_popup_item_border_width',
			[
				'label' => __( 'Border Width', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dl_mc_popup_item_title_heading',
			[
				'label' => __( 'Title', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name'		 => 'dl_mc_popup_item_title_typo',
				'selector'	 => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a:not(.remove)',
			]
		);

		$this->add_control(
			'dl_mc_popup_item_title_color',
			[
				'label'     => __( 'Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a:not(.remove)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'dl_mc_popup_item_quantity_heading',
			[
				'label' => __( 'Quantity', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name'		 => 'dl_mc_popup_item_quantity_typo',
				'selector'	 => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li .quantity',
			]
		);

		$this->add_control(
			'popup_item_quantity_color',
			[
				'label'     => __( 'Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li .quantity' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'dl_mc_popup_item_image_heading',
			[
				'label' => __( 'Product Image', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'        => 'dl_mc_popup_item_image_border',
				'label'       => __( 'Border', 'droit-addons-pro' ),
				'selector'    => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a > img',
			]
		);

		$this->add_control(
			'dl_mc_popup_item_image_border_radius',
			[
				'label'      => __( 'Border Radius', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'dl_mc_popup_item_image_shadow',
				'selector' => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a > img',
			]
		);

		$this->add_responsive_control(
			'dl_mc_popup_item_remove_heading',
			[
				'label' => __( 'Remove Button', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'dl_mc_popup_item_remove_height',
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
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a.remove' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'dl_mc_popup_item_remove_width',
			[
				'label' => __( 'Width', 'droit-addons-pro' ),
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
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a.remove' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dl_mc_popup_item_remove_typo',
				'label'    => __( 'Typography', 'droit-addons-pro' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a.remove',
			]
		);

		$this->add_control(
			'dl_mc_popup_item_remove_border_radius',
			[
				'label'      => __( 'Border Radius', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a.remove' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'dl_mc_popup_item_remove_shadow',
				'selector' => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a.remove',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'        => 'dl_mc_popup_item_remove_border',
				'label'       => __( 'Border', 'droit-addons-pro' ),
				'selector'    => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a.remove',
			]
		);

		$this->start_controls_tabs('dl_mc_popup_item_remove_color_tabs');
		$this->start_controls_tab(
			'dl_mc_popup_item_remove_color_normal_tab',
			[
				'label' => __( 'Normal', 'droit-addons-pro' )
			]
		);

		$this->add_control(
			'dl_mc_popup_item_remove_color',
			[
				'label'     => __( 'Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a.remove' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dl_mc_popup_item_remove_background_color',
			[
				'label'     => __( 'Background Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a.remove' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'dl_mc_popup_item_remove_color_hover_tab',
			[
				'label' => __( 'Hover', 'droit-addons-pro' )
			]
		);

		$this->add_control(
			'dl_mc_popup_item_remove_hover_color',
			[
				'label'     => __( 'Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a.remove:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dl_mc_popup_item_remove_hover_background_color',
			[
				'label'     => __( 'Background Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a.remove:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dl_mc_popup_item_remove_hover_border_color',
			[
				'label'     => __( 'Border Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body ul li a.remove:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

    // subtotal Style
	protected function __subtotal_style(){

		$this->start_controls_section(
			'dl_mc_popup_subtotal_section',
			[
				'label' => __( 'Popup Item Subtotal', 'droit-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'             => [
					'dl_mini_cart_show!' => 'none',
				],
			]
		);

		$this->add_control(
			'dl_mc_popup_subtotal_padding',
			[
				'label'      => __( 'Padding', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__total' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dl_mc_popup_subtotal_margin',
			[
				'label'      => __( 'Margin', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__total' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dl_mc_popup_subtotal_title_heading',
			[
				'label' => __( 'Title', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dl_mc_popup_subtotal_title_typo',
				'label'    => __( 'Typography', 'droit-addons-pro' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__total strong',
			]
		);

		$this->add_control(
			'dl_mc_popup_subtotal_title_color',
			[
				'label'     => __( 'Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__total strong' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'dl_mc_popup_subtotal_price_heading',
			[
				'label' => __( 'Price', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dl_mc_popup_subtotal_price_typo',
				'label'    => __( 'Typography', 'droit-addons-pro' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__total .amount',
			]
		);

		$this->add_control(
			'dl_mc_popup_subtotal_price_color',
			[
				'label'     => __( 'Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__total .amount' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

    // popup button Style
	protected function __btn_style(){

		$this->start_controls_section(
			'dl_mc_popup_button_section',
			[
				'label' => __( 'Popup Button', 'droit-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'             => [
					'dl_mini_cart_show!' => 'none',
				],
			]
		);

		// for view cart btn
		$this->add_responsive_control(
			'dl_mc_view_cart_button_heading',
			[
				'label' => __( 'Cart View', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'dl_mc_view_cart_button_padding',
			[
				'label' => __( 'Padding', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(1)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dl_mc_view_cart_button_typo',
				'label'    => __( 'Typography', 'droit-addons-pro' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(1)',
			]
		);

		$this->add_responsive_control(
			'dl_mc_view_cart_button_border_radius',
			[
				'label'      => __( 'Border Radius', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(1)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'dl_mc_view_cart_button_border',
				'label'     => __( 'Border', 'droit-addons-pro' ),
				'selector'  => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(1)',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'dl_mc_view_cart_button_shadow',
				'selector' => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(1)',
			]
		);

		$this->start_controls_tabs('dl_mc_view_cart_button_color_tabs');
		$this->start_controls_tab(
			'dl_mc_view_cart_button_color_normal_tab',
			[
				'label' => __('Normal', 'droit-addons-pro')
			]
		);

		$this->add_control(
			'dl_mc_view_cart_button_normal_color',
			[
				'label'     => __( 'Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(1)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'dl_mc_view_cart_button_normal_bg_color',
				'exclude' => [
					'classic' => 'image'
				],
				'selector' => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(1)',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'dl_mc_view_cart_button_color_hover_tab',
			[
				'label' => __('Hover', 'droit-addons-pro')
			]
		);

		$this->add_control(
			'dl_mc_view_cart_button_hover_color',
			[
				'label'     => __( 'Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(1):hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'dl_mc_view_cart_button_hover_bg_color',
				'exclude' => [
					'classic' => 'image'
				],
				'selector' => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(1):hover',
			]
		);

		$this->add_control(
			'dl_mc_view_cart_button_hover_border_color',
			[
				'label'     => __( 'Border Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(1):hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); // end view cart

		// start popup checkout btn
		$this->add_responsive_control(
			'dl_mc_checkout_button_heading',
			[
				'label' => __( 'Cart Checkout', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'dl_mc_checkout_button_padding',
			[
				'label' => __( 'Padding', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(2)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dl_mc_checkout_button_typo',
				'label'    => __( 'Typography', 'droit-addons-pro' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(2)',
			]
		);

		$this->add_responsive_control(
			'dl_mc_checkout_button_border_radius',
			[
				'label'      => __( 'Border Radius', 'droit-addons-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(2)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'dl_mc_checkout_button_border',
				'label'     => __( 'Border', 'droit-addons-pro' ),
				'selector'  => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(2)',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'dl_mc_checkout_button_shadow',
				'selector' => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(2)',
			]
		);

		$this->start_controls_tabs('checkout_button_color_tabs');
		$this->start_controls_tab(
			'dl_mc_checkout_button_color_normal_tab',
			[
				'label' => __('Normal', 'droit-addons-pro')
			]
		);

		$this->add_control(
			'dl_mc_checkout_button_normal_color',
			[
				'label'     => __( 'Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(2)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'dl_mc_checkout_button_normal_bg_color',
				'exclude' => [
					'classic' => 'image'
				],
				'selector' => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(2)',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'dl_mc_checkout_button_color_hover_tab',
			[
				'label' => __('Hover', 'droit-addons-pro')
			]
		);

		$this->add_control(
			'dl_mc_checkout_button_hover_color',
			[
				'label'     => __( 'Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(2):hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'dl_mc_checkout_button_hover_bg_color',
				'exclude' => [
					'classic' => 'image'
				],
				'selector' => '{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(2):hover',
			]
		);

		$this->add_control(
			'dl_mc_checkout_button_hover_border_color',
			[
				'label'     => __( 'Border Color', 'droit-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl-mini-cart-popup .dl-mini-cart-popup-body .woocommerce-mini-cart__buttons .button:nth-child(2):hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

	}

    // rander preview
    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        if( !class_exists('\Woocommerce') ){
            echo drdt_kses_html('Please setup WooCommerce Plugin');
            return;
        }

		$dl_mini_cart_control = ($dl_mini_cart_show !== 'none') ? 'dl-mini-cart-on-' . esc_attr( $dl_mini_cart_show ) : '';
		$dl_mini_cart_offcanvas = ($dl_mini_cart_active_off_canvas === 'yes') ? 'dl-mini-cart-off-canvas' : '';
	?>

		<div class="dl-mini-cart-wrapper <?php echo esc_attr($dl_mini_cart_offcanvas);?>">
			<div class="dl-mini-cart-inner">

				<div class="dl-mini-cart-button <?php echo esc_attr($dl_mini_cart_control); ?>">
					<div class="dl-mini-cart-count-area">
						<span class="dl-mini-cart-icon">
							<?php
								if ( isset($dl_mini_cart_icons) && ($dl_mini_cart_icons['value']) ) {
									\Elementor\Icons_Manager::render_icon( $dl_mini_cart_icons, [ 'aria-hidden' => 'true' ] );
								} else { ?>
									<i class="fas fa-shopping-basket" aria-hidden="true"></i>
									<?php
								}
							?>
						</span>
						<span class="dl-mini-cart-count">
							<?php echo ( WC()->cart != '' ) ? WC()->cart->get_cart_contents_count() : ''; ?>
						</span>
					</div>

					<?php if( $dl_mini_cart_subtotal_show == 'yes' ){ ?>
						<div class="dl-mini-cart-total">
							<?php echo ( WC()->cart != '' ) ? WC()->cart->get_cart_total() : ''; ?>
						</div>
					<?php } ?>

				</div>

				<?php if( $dl_mini_cart_show !== 'none' ){ ?>
					<div class="dl-mini-cart-popup">
						<span class="dl-minicart-close-popup"><i class="far fa-times-circle"></i></span>
						<div class="dl-mini-cart-popup-header">
								<div class="dl-mini-cart-popup-count-text-area">
									<span class="dl-mini-cart-popup-count"><?php echo ( WC()->cart != '' ) ?  WC()->cart->get_cart_contents_count() : '' ; ?></span>
									<span class="dl-mini-cart-popup-count-text"><?php esc_html_e( 'items', 'droit-addons-pro' ); ?></span>
								</div>
						</div>
						<div class="dl-mini-cart-popup-body">
							<div class="widget_shopping_cart_content">
								<?php ( WC()->cart != '' ) ? woocommerce_mini_cart() : ''; ?>
							</div>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>

    <?php     
    }

}