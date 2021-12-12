<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Widgets;

use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Advance_Pricing\Advance_Pricing_Module as Module;
use \ELEMENTOR\Icons_Manager;
use \ELEMENTOR\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Advance_Pricing extends \ELEMENTOR\Widget_Base
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

    protected function get_control_id($control_id){
        return $control_id;
    }

    protected function _register_controls()
    {
        do_action('dl_widgets/adpricing/register_control/start', $this);

        // add content 
        $this->_content_control();
        
        //style
        $this->_styles_control();

        do_action('dl_widgets/adpricing/register_control/end', $this);

        // custom css hook
        do_action('dl_widget/section/style/custom_css', $this);
    }

    public function _content_control(){
        //start adpricing layout
        $this->start_controls_section(
            '_dl_pr_adpricing_layout_section',
            [
                'label' => __('Layout', 'droit-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_adpricing_skin',
            [
                'label' => esc_html__('Preset', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/add_pricing/control_presets', [
                    'switcher' => 'Switcher',
                    'tab' => 'Tab',
                ]),
                'default' => 'switcher',
            ]
        );


        do_action('dl_widgets/adpricing/layout/content', $this);

        $this->end_controls_section();
        //start adpricing layout end

        //start adpricing fields render
        $this->start_controls_section(
            '_dl_pr_adpricing_fields_section',
            [
                'label' => __('Items', 'droit-elementor-addons-pro'),
            ]
        );

        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            '_dl_field_title',
            [
                'label' => __('Label', 'droit-elementor-addons-pro'),
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
            '_dl_pro_adpricing_content_id', [
                'label' => esc_html__('Content', 'droit-elementor-addons-pro'),
                'type' => \DROIT_ELEMENTOR_PRO\DL_Controls_Manager::DLEDITOR,
                'label_block' => true,
                'default' => '',
            ]
        );
        
        $this->add_control(
            '_dl_pro_adpricing_switch',
            [
                'label' => __('Setup Switch', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'item_actions' =>[
                    'duplicate' => false,
                    'add' => false,
                    'remove' => false
                ],
                'fields' => $repeater->get_controls(),
                'default' => [
                   
                    [
                        '_dl_field_default' => 'yes',
                        '_dl_field_title' => 'Annual',
                    ],
                    [
                        '_dl_field_default' => 'no',
                        '_dl_field_title' => 'Lifetime',
                    ],
                    
                ],
                'title_field' => '<i class="eicon-editor-list-ul"></i> {{{ _dl_field_title }}}',
            ]
        );

        do_action('dl_widgets/adpricing/fields/content', $this);

        $this->end_controls_section();
        //start adpricing layout end

    }

    public function _styles_control(){
        //switcher control style here
        $this->start_controls_section(
            '_dl_pro_adv_tab_genaral_style_content',
            [
                'label' => __( 'Genaral', 'droit-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' =>[
                    $this->get_control_id('_dl_pro_adpricing_skin') => ['switcher'],
                ]
            ]
        );

        $this->add_control(
			'dl_adv_pricing_toggler_label_Alignment',
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
                'selectors' => [
					'{{WRAPPER}} .dl_switcher_control' => 'justify-content: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'dl_adv_pricing_toggler_label',
			[
				'label' => __( 'Label', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_switcher_control:not(.dl-active) .dl_toggler_label' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'dl_adv_pricing_toggler__active_label',
			[
				'label' => __( 'Not Active Label', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_switcher_control .dl_toggle + .dl_toggler_label, .dl_switcher_control .dl_toggler_label' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'dl_adv_pricing_toggler_not_active_label',
			[
				'label' => __( 'Active Label', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_switcher_control.dl-active .dl_toggle + .dl_toggler_label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'dl_switcher_control_spacing',
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
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_switcher_control' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
        //switcher control style end

        //switcher toggle tab control here
        $this->start_controls_section(
            '_dl_pro_adv_tab_toggle_style_content',
            [
                'label' => __( 'Toggle', 'droit-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' =>[
                    $this->get_control_id('_dl_pro_adpricing_skin') => ['switcher'],
                ]
            ]
        );

		$this->add_control(
			'dl_adv_pricing_toggler_height',
			[
				'label' => __( 'Height', 'droit-elementor-addons-pro' ),
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
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_switcher_control .dl_toggle' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'dl_adv_pricing_toggler_width',
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
					'size' => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_switcher_control .dl_toggle' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'dl_adv_pricing_toggler_style_tabs'
		);

		$this->start_controls_tab(
			'pricing_pro_style_normal_tab',
			[
				'label' => __( 'Normal', 'plugin-name' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'dl_adv_pricing_toggler_background',
				'label' => __( 'Background', 'droit-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .dl_switcher_control .dl_toggle',
			]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'dl_adv_pricing_toggler_border',
				'label' => __( 'Border', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_switcher_control .dl_toggle',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'pricing_pro_style_hover_tab',
			[
				'label' => __( 'Active', 'plugin-name' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'dl_adv_pricing_active_toggler_background',
				'label' => __( 'Background', 'droit-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .dl_switcher_control.dl-active .dl_toggle',
			]
		);
        $this->add_control(
			'dl_adv_pricing_active_toggler_border',
			[
				'label' => __( 'Border Color', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_switcher_control.dl-active .dl_toggle' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		// $this->end_controls_section();

		$this->add_control(
			'toggler_switcher',
			[
				'label' => __( 'Toggler Switcher', 'roit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'dl_adv_pricing_toggler_after_backgroundsize',
			[
				'label' => __( 'size', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => .1,
				'max' => 3,
				'step' => .1,
				'default' => 1.2,
                'selectors' => [
					'{{WRAPPER}} .dl_switcher_control .dl_toggle:after' => 'transform: scale({{VALUE}})',
				],
			]
		);
        
        $this->start_controls_tabs(
			'pro_pricing_style_tabs'
		);

		$this->start_controls_tab(
			'pricing_toggle_style_normal_tab',
			[
				'label' => __( 'Normal', 'droit-elementor-addons-pro' ),
			]
		);
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'dl_adv_pricing_toggler_after_background',
				'label' => __( 'Background', 'droit-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .dl_switcher_control .dl_toggle:after',
			]
		);
		$this->add_control(
			'dl_adv_pricing_toggler_after_top_position',
			[
				'label' => __( 'Top', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -100,
				'max' => 100,
				'step' => 1,
				'default' => -3,
                'selectors' => [
					'{{WRAPPER}} .dl_switcher_control .dl_toggle:after' => 'top: {{VALUE}}px',
				],
			]
		);
        $this->add_control(
			'dl_adv_pricing_toggler_after_left_position',
			[
				'label' => __( 'left', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -100,
				'max' => 100,
				'step' => 1,
				'default' => -5,
                'selectors' => [
					'{{WRAPPER}} .dl_switcher_control .dl_toggle:after' => 'left: {{VALUE}}px',
				],
			]
		);
        
		$this->end_controls_tab();

		$this->start_controls_tab(
			'pricing_toggle_style_hover_tab',
			[
				'label' => __( 'active', 'droit-elementor-addons-pro' ),
			]
		);
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'dl_adv_pricing_toggler_active_after_background',
				'label' => __( 'Background', 'droit-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .dl_switcher_control.dl-active .dl_toggle:after',
			]
		);
        $this->add_control(
			'dl_adv_pricing_toggler_active_after_top_position',
			[
				'label' => __( 'Top', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -100,
				'max' => 100,
				'step' => 1,
				'default' => -3,
                'selectors' => [
					'{{WRAPPER}} .dl_switcher_control.dl-active .dl_toggle:after' => 'top: {{VALUE}}px',
				],
			]
		);
        $this->add_control(
			'dl_adv_pricing_toggler_active_after_left_position',
			[
				'label' => __( 'left', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -100,
				'max' => 100,
				'step' => 1,
				'default' => 32,
                'selectors' => [
					'{{WRAPPER}} .dl_switcher_control.dl-active .dl_toggle:after' => 'left: {{VALUE}}px',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();
        //switcher toggle tab control end

		//switcher tab control style here
		$this->start_controls_section(
            '_dl_pro_adv_pricing_tab_genaral_style_content',
            [
                'label' => __( 'Genaral', 'droit-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' =>[
                    $this->get_control_id('_dl_pro_adpricing_skin') => ['tab'],
                ]
            ]
        );

        $this->add_control(
			'dl_adv_pricing_tab_label_Alignment',
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
                'selectors' => [
					'{{WRAPPER}} .dl_switcher_control' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'dl_adv_pricing_tab_label_gap',
			[
				'label' => __( 'Gap', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 10,
				'selectors' => ['{{WRAPPER}} .dl_switcher_control .dl_switcher_control_inner' => 'grid-gap: {{VALUE}}px'],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'droit-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .dl_switcher_control .dl_switcher_control_inner',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_switcher_control .dl_switcher_control_inner',
			]
		);
		$this->add_control(
			'pricing_avd_tab_style_padding',
			[
				'label' => __( 'Padding', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_switcher_control .dl_switcher_control_inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'pricing_tab_style_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_switcher_control .dl_switcher_control_inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		

        $this->end_controls_section();
        //switcher control style end

        //switcher toggle tab control here
        $this->start_controls_section(
            '_dl_pro_adv_pricing_tab_style_content',
            [
                'label' => __( 'Toggle', 'droit-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' =>[
                    $this->get_control_id('_dl_pro_adpricing_skin') => ['tab'],
                ]
            ]
        );


        $this->start_controls_tabs(
			'style_adv_pricing_tabs'
		);

		$this->start_controls_tab(
			'pricing_tab_style_normal_tab',
			[
				'label' => __( 'Normal', 'droit-elementor-addons-pro' ),
			]
		);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'dl_pricing_plan_tab_content_typography',
				'label' => __( 'Typography', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_pricing_plan_switcher .dl_switcher_control-item label',
			]
		);
		$this->add_control(
			'dl_pricing_plan_tab_title_color',
			[
				'label' => __( 'Title Color', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pricing_plan_switcher .dl_switcher_control-item label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'dl_pricing_plan_tab_title_padding',
			[
				'label' => __( 'Padding', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pricing_plan_switcher .dl_switcher_control-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'dl_pricing_plan_adv_tab_title_border_radius',
			[
				'label' => __( 'Border-radius', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pricing_plan_switcher .dl_switcher_control-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'dl_pricing_plan_tab_background',
				'label' => __( 'Background', 'droit-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .dl_pricing_plan_switcher .dl_switcher_control-item',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'dl_pricing_plan_tab_border',
				'label' => __( 'Border', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_pricing_plan_switcher .dl_switcher_control-item',
			]
		);
		$this->add_control(
			'pricing_avd_tab_style_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_switcher_control .dl_switcher_control-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->end_controls_tab();

		$this->start_controls_tab(
			'pricing_adv_tab_style_active_tab',
			[
				'label' => __( 'active', 'droit-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'dl_pricing_plan_active_tab_title_color',
			[
				'label' => __( 'Title Color', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pricing_plan_switcher .dl_switcher_control-item.on-select label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'dl_pricing_plan_tab_active_background',
				'label' => __( 'Background', 'droit-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .dl_pricing_plan_switcher .dl_switcher_control-item.on-select',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'dl_pricing_plan_tab_active_border',
				'label' => __( 'Border', 'droit-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_pricing_plan_switcher .dl_switcher_control-item.on-select',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();
        //switcher toggle tab control end
    }

    //Html render
    protected function render()
    {   
        $settings = $this->get_settings_for_display();
        extract($settings);
        
        $id = $this->get_id();
        
        ?>
        <?php
            if ( in_array( $_dl_pro_adpricing_skin, array( '', 'switcher' ), true ) ) {
                include 'style/default.php'; 	
            }else if ( in_array( $_dl_pro_adpricing_skin, array( 'tab' ), true ) ) {
                include 'style/tab.php'; 	
            }
        ?>
        
    <?php }

    protected function content_template()
    {}
}