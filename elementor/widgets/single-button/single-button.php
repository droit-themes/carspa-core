<?php
namespace DROIT_ELEMENTOR_PRO\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Single_Button extends \Elementor\Widget_Base {

    public function get_name() {
        return 'droit-single-button';
    }

    public function get_title() {
        return esc_html__( 'Carspa Button', 'carspa-core' );
    }

    public function get_icon() {
        return 'eicon-button addons-icon';
    }

    public function get_categories() {
        return [ 'drth_custom_theme' ];
    }

    public function get_keywords() {
        return [
        'button',
        'dl button',
        'dual',
        'button pro',
        'droit button',
        'droit',
        'dl',
        'pro',
        ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_btn', [
                'label' => __( 'Button', 'carspa-core' ),
            ]
        );

        $this->add_control(
            'btn_style',
            [
                'label' => __( 'Button Type', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'default'=> esc_html__( 'Default', 'carspa-core' ),
                    'three_d_btn' => esc_html__( '3D Button (Underneath Bottom)', 'carspa-core' ),
                    'three_d_btn2' => esc_html__( '3D Button (Underneath Top)', 'carspa-core' ),
                    'line' => esc_html__( 'Line Button', 'carspa-core' ),
                    'linestyle2' => esc_html__( 'Line Button style 2', 'carspa-core' ),
                    'linestyle3' => esc_html__( 'Line Button style 3', 'carspa-core' ),
                    'divider_btn' => esc_html__( 'Divider Button', 'carspa-core' ),
                    'circle_btn' => esc_html__( 'Circle Button', 'carspa-core' ),
                ],
                'label_block' => true,
                'default' => 'default',
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__( 'Button Title', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Learn More'
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'carspa-core' ),
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', 'carspa-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'carspa-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'carspa-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'carspa-core' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
                'default' => '',
            ]
        );

        $this->add_control(
            'size',
            [
                'label' => __( 'Size', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'sm',
                'options' => array(
                    'xs' => __( 'Extra Small', 'carspa-core' ),
                    'sm' => __( 'Small', 'carspa-core' ),
                    'md' => __( 'Medium', 'carspa-core' ),
                    'lg' => __( 'Large', 'carspa-core' ),
                    'xl' => __( 'Extra Large', 'carspa-core' ),
                ),
                'style_transfer' => true,
                'condition' => [
                    'btn_style!' => 'linestyle2',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'btn-icon',
            [
                'label' => __( 'Button Icon', 'carspa-core' ),
                'condition' => [
                    'btn_style!' => 'linestyle2',
                ]
            ]
        );

        $this->add_control(
            'btn_icon',
            [
                'label' => __( 'Icon', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'ti-arrow-right',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'icon_align',
            [
                'label' => __( 'Icon Position', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left' => __( 'Before', 'carspa-core' ),
                    'right' => __( 'After', 'carspa-core' ),
                ],
            ]
        );

        //========================= Icon Indent ==================================== //
        $this->start_controls_tabs('icon_indent_tabs');

        $this->start_controls_tab(
            'icon_indent_normal_tabs', [
                'label' => __( 'Normal', 'carspa-core' ),
            ]
        );

        $this->add_control(
            'icon_normal_indent',
            [
                'label' => __( 'Icon Spacing', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ub-btn .elementor-align-icon-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ub-btn .elementor-align-icon-left i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_indent_hover_tabs', [
                'label' => __( 'Hover', 'carspa-core' ),
            ]
        );

        $this->add_control(
            'icon_hover_indent',
            [
                'label' => __( 'Icon Spacing', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ub-btn:hover .elementor-align-icon-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ub-btn:hover .elementor-align-icon-left i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs(); // End Icon indent

        $this->add_control(
            'icon_hover_animation',
            [
                'label'   => __( 'Hover Animation', 'carspa-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT2,
                'options' => [
                        'bounce'             => 'bounce',
                        'flash'              => 'flash',
                        'pulse'              => 'pulse',
                        'rubberBand'         => 'rubberBand',
                        'shake'              => 'shake',
                        'swing'              => 'swing',
                        'tada'               => 'tada',
                        'wobble'             => 'wobble',
                        'jello'              => 'jello',
                        'bounceIn'           => 'bounceIn',
                        'bounceInDown'       => 'bounceInDown',
                        'bounceInUp'         => 'bounceInUp',
                        'bounceOut'          => 'bounceOut',
                        'bounceOutDown'      => 'bounceOutDown',
                        'bounceOutLeft'      => 'bounceOutLeft',
                        'bounceOutRight'     => 'bounceOutRight',
                        'bounceOutUp'        => 'bounceOutUp',
                        'fadeIn'             => 'fadeIn',
                        'fadeInDown'         => 'fadeInDown',
                        'fadeInDownBig'      => 'fadeInDownBig',
                        'fadeInLeft'         => 'fadeInLeft',
                        'fadeInLeftBig'      => 'fadeInLeftBig',
                        'fadeInRightBig'     => 'fadeInRightBig',
                        'fadeInUp'           => 'fadeInUp',
                        'fadeInUpBig'        => 'fadeInUpBig',
                        'fadeOut'            => 'fadeOut',
                        'fadeOutDownBig'     => 'fadeOutDownBig',
                        'fadeOutLeft'        => 'fadeOutLeft',
                        'fadeOutLeftBig'     => 'fadeOutLeftBig',
                        'fadeOutRightBig'    => 'fadeOutRightBig',
                        'fadeOutUp'          => 'fadeOutUp',
                        'fadeOutUpBig'       => 'fadeOutUpBig',
                        'flip'               => 'flip',
                        'flipInX'            => 'flipInX',
                        'flipInY'            => 'flipInY',
                        'flipOutX'           => 'flipOutX',
                        'flipOutY'           => 'flipOutY',
                        'fadeOutDown'        => 'fadeOutDown',
                        'lightSpeedIn'       => 'lightSpeedIn',
                        'lightSpeedOut'      => 'lightSpeedOut',
                        'rotateIn'           => 'rotateIn',
                        'rotateInDownLeft'   => 'rotateInDownLeft',
                        'rotateInDownRight'  => 'rotateInDownRight',
                        'rotateInUpLeft'     => 'rotateInUpLeft',
                        'rotateInUpRight'    => 'rotateInUpRight',
                        'rotateOut'          => 'rotateOut',
                        'rotateOutDownLeft'  => 'rotateOutDownLeft',
                        'rotateOutDownRight' => 'rotateOutDownRight',
                        'rotateOutUpLeft'    => 'rotateOutUpLeft',
                        'rotateOutUpRight'   => 'rotateOutUpRight',
                        'slideInUp'          => 'slideInUp',
                        'slideInDown'        => 'slideInDown',
                        'slideInLeft'        => 'slideInLeft',
                        'slideInRight'       => 'slideInRight',
                        'slideOutUp'         => 'slideOutUp',
                        'slideOutDown'       => 'slideOutDown',
                        'slideOutLeft'       => 'slideOutLeft',
                        'slideOutRight'      => 'slideOutRight',
                        'zoomIn'             => 'zoomIn',
                        'zoomInDown'         => 'zoomInDown',
                        'zoomInLeft'         => 'zoomInLeft',
                        'zoomInRight'        => 'zoomInRight',
                        'zoomInUp'           => 'zoomInUp',
                        'zoomOut'            => 'zoomOut',
                        'zoomOutDown'        => 'zoomOutDown',
                        'zoomOutLeft'        => 'zoomOutLeft',
                        'zoomOutUp'          => 'zoomOutUp',
                        'hinge'              => 'hinge',
                        'rollIn'             => 'rollIn',
                        'rollOut'            => 'rollOut'
                ],
                'prefix_class' => 'ub-btn-icon-',
                'default' => 'none',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

       
        $this->start_controls_section(
            'section_btn_effects',
            [
                'label' => __( 'Button Effects', 'carspa-core' ),
                'condition' => [
                    'btn_style!' => [ 'linestyle2', 'circle_btn' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'hover_animation',
            [
                'label' => __( 'Hover Effect', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__('None', 'carspa-core'),
                    'pulse' => esc_html__('Pulse wind expand', 'carspa-core'),
                    'left2right' => esc_html__('Left-Right Transition', 'carspa-core'),
                ],
                'separator' => 'before',
                'default' => 'none',
            ]
        );

        $this->end_controls_section();

       
        $this->start_controls_section(
            'style_button', [
                'label' => __( 'Style Button', 'carspa-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'typography_btn',
                'selector' => '
                    {{WRAPPER}} .ub-btn, 
                    {{WRAPPER}} .learn_btn,
                    {{WRAPPER}} .discover_button .agency_learn_btn
                ',
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );



        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'carspa-core' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ub-btn' => 'fill: {{VALUE}}; color: {{VALUE}};',
                    '{{WRAPPER}} .learn_btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .shop_about_content .agency_learn_btn:after' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .discover_button .agency_learn_btn' => 'fill: {{VALUE}}; color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_color',
                'label' => __( 'Background Color', 'carspa-core' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .ub-btn:not(.three_d_btn), {{WRAPPER}} .ub-btn:not(.three_d_btn2), {{WRAPPER}} .ub-btn.three_d_btn .elementor-button-text',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_normal_box_shadow',
                'label' => __( 'Box Shadow', 'carspa-core' ),
                'selector' => '{{WRAPPER}} .ub-btn, {{WRAPPER}} .learn_btn',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'carspa-core' ),
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label' => __( 'Text Color', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ub-btn:not(.ub-animation-left2right):hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ub-btn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ub-btn.ub-animation-left2right::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ub-btn.ub-animation-left2right:hover i' => 'color: {{VALUE}}; transition: margin 0.5s linear, color 0.6s;',
                    '{{WRAPPER}} .agency_learn_btn:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_learn_btn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .h_text_btn:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .shop_about_content .agency_learn_btn:hover:after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_background_hover_color',
                'label' => __( 'Background Color', 'carspa-core' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '
                    {{WRAPPER}} .ub-btn:not(.three_d_btn):not(.three_d_btn2):not(.ub-animation-left2right):hover, 
                    {{WRAPPER}} .ub-btn.three_d_btn .elementor-button-text:hover, 
                    {{WRAPPER}} .elementor-button.ub-animation-left2right::after,
                    {{WRAPPER}} .three_d_btn2::before
                ',
            ]
        );

        $this->add_control(
            'expand_color',
            [
                'label' => __( 'Pulse Expand Color', 'carspa-core' ),
                'description' => __( 'RGBA color (with alpha value) recommended.', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .but-btn.ub-animation-pulse::before' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'btn_style' => 'default',
                    'hover_animation' => 'pulse',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_hover_box_shadow',
                'label' => __( 'Box Shadow', 'carspa-core' ),
                'selector' => '{{WRAPPER}} .ub-btn:hover, {{WRAPPER}} .learn_btn:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs(); 


        $this->add_responsive_control(
            'text_padding',
            [
                'label' => __( 'Padding', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ub-btn:not(.three_d_btn)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .three_d_btn .elementor-button-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'btn_style!' => 'linestyle2',
                ]
            ]
        );

        $this->end_controls_section();


        
        $this->start_controls_section(
            'style_three_d_btn', [
                'label' => __( 'Style 3D Button', 'carspa-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'btn_style' => ['three_d_btn'],
                ]
            ]
        );

        $this->add_control(
            'shadow_color1',
            [
                'label' => __( 'Underneath Fold Color', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .three_d_btn2' => 'box-shadow: 0 6px 0 {{shadow_color1.VALUE}}, 0 10px 15px {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'shadow_color2',
            [
                'label' => __( 'Shadow Color', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .three_d_btn' => 'box-shadow: 0 6px 0 {{shadow_color1.VALUE}}, 0 10px 15px {{VALUE}}',
                ],
                'condition' => [
                    'btn_style' => 'three_d_btn',
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'style_button_icon', [
                'label' => __( 'Button Icon', 'carspa-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'btn_style!' => 'linestyle2',
                ]
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ub-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ub-btn svg' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_box_size',
            [
                'label' => __( 'Icon Box Size', 'carspa-core' ),
                'description' => __( 'The icon box size is square. Will apply the same size on Height and Width.', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ub-btn i' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ub-btn svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label' => __( 'Border Radius', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ub-btn i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ub-btn svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

     
        $this->start_controls_tabs( 'btn_icon_tabs' );

        $this->start_controls_tab(
            'btn_icon_style_normal', [
                'label' => __( 'Normal', 'carspa-core' ),
            ]
        );

        $this->add_control(
            'icon_color_normal', [
                'label' => __( 'Icon Color', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .ub-btn i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ub-btn svg' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color_normal', [
                'label' => __( 'Background Color', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ub-btn i' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ub-btn svg' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn_icon_style_hover', [
                'label' => __( 'Hover', 'carspa-core' ),
            ]
        );

        $this->add_control(
            'icon_color_hover', [
                'label' => __( 'Icon Color', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .ub-btn:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ub-btn:hover svg' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color_hover', [
                'label' => __( 'Background Color', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ub-btn:hover i' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ub-btn:hover svg' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section(); 

        
        $this->start_controls_section(
            'style_border_sec', [
                'label' => __( 'Border', 'carspa-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'selector' => '{{WRAPPER}} .ub-btn',
            ]
        );

        $this->add_control(
            'is_btm_line',
            [
                'label' => __( 'Bottom Line', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'carspa-core' ),
                'label_off' => __( 'No', 'carspa-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'btn_style' => 'line',
                ]
            ]
        );

        $this->add_responsive_control(
            'line_border_spacing', [
                'label' => __( 'Bottom Line Spacing', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ub-btn.ub-btn-line::before' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'btn_style' => 'line',
                ]
            ]
        );

        $this->start_controls_tabs( 'tabs_border_style' );

        $this->start_controls_tab(
            'tab_border_normal',
            [
                'label' => __( 'Normal', 'carspa-core' ),
            ]
        );
        
        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ub-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ub-btn.three_d_btn .elementor-button-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .ub-btn',
            ]
        );

        $this->add_control(
            'button_btm_line_color',
            [
                'label' => __( 'Bottom Line Color', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ub-btn.ub-btn-line::before' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'btn_style' => 'line',
                    'is_btm_line' => 'yes',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_border_hover',
            [
                'label' => __( 'Hover', 'carspa-core' ),
            ]
        );
        
        $this->add_control(
            'border_radius_hover',
            [
                'label' => __( 'Border Radius', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ub-btn:not(.three_d_btn):not(.three_d_btn2):not(.ub-animation-left2right):hover'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
                    '{{WRAPPER}} .ub-btn.three_d_btn .elementor-button-text:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-button.ub-animation-left2right::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .three_d_btn2::before'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .ub-btn:hover',
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ub-btn:hover, {{WRAPPER}} .ub-btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_btm_line_color',
            [
                'label' => __( 'Bottom Line Color', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ub-btn.ub-btn-line::after' => 'background-color: {{VALUE}} !important; border-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'btn_style' => 'line',
                    'is_btm_line' => 'yes',
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'border_widths',
            [
                'label' => __( 'Border Width', 'carspa-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                'default' => [
                    'unit' => '%',
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .agency_learn_btn:after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render icon widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty($settings['hover_animation']) || empty($settings['icon_hover_animation']) ) {
            wp_deregister_style( 'animate' );
        }

        if ( !empty($settings['btn_style'] && $settings['btn_style'] != 'linestyle2' && $settings['btn_style'] != 'circle_btn' ) ) {
            $this->add_render_attribute('button', 'class', 'ub-btn');
        }

        if ( !empty($settings['btn_style'] && $settings['btn_style'] == 'linestyle2' ) ) {
            $this->add_render_attribute('button', 'class', 'agency_learn_btn learn_btn mt-0');
        }
       

        if ( !empty($settings['btn_style'] && $settings['btn_style'] == 'normal' ) ) {
            $this->add_render_attribute('button', 'class', 'ub-btn-normal');
        }

        if ( !empty($settings['btn_style']) && $settings['btn_style'] == 'line' && $settings['is_btm_line'] == 'yes' ) {
            $this->add_render_attribute('button', 'class', 'ub-btn-line');
        }

        if ( !empty($settings['btn_style']) && $settings['btn_style'] == 'line' ) {
            $this->add_render_attribute('button', 'class', 'ub-btn-link');
        }

        if ( $settings['btn_style'] == 'default' || !isset($settings['btn_style']) ) {
            $this->add_render_attribute('button', 'class', 'elementor-button');
        }

        if ( $settings['btn_style'] == 'three_d_btn' ) {
            $this->add_render_attribute('button', 'class', 'elementor-button three_d_btn');
        }

        if ( $settings['btn_style'] == 'three_d_btn2' ) {
            $this->add_render_attribute('button', 'class', 'elementor-button three_d_btn2');
        }

        if ( $settings['btn_style'] == 'divider_btn' ) {
            $this->add_render_attribute('button', 'class', 'elementor-button discover_button');
        }

        if ( $settings['btn_style'] == 'circle_btn' ) {
            $this->add_render_attribute('button', 'class', 'post_btn');
        }

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'button', $settings['link'] );
            $this->add_render_attribute( 'button', 'class', 'elementor-button-link' );
        }

        $this->add_render_attribute( 'button', 'role', 'button' );

        if ( ! empty( $settings['button_css_id'] ) ) {
            $this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
        }

        if ( ! empty( $settings['size'] ) ) {
            $this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['size'] );
        }

        if ( !empty($settings['hover_animation']) ) {
            $this->add_render_attribute( 'button', 'class', 'ub-animation-' . $settings['hover_animation'] );
            if ( $settings['hover_animation'] == 'left2right' && $settings['btn_style'] == 'line' ) {
                $this->add_render_attribute( 'button', 'data-text', $settings['text'] );
            }
        }

        $icon_animation = !empty($settings['icon_hover_animation']) ? $settings['icon_hover_animation'] : '';

        if ( !empty( $settings['btn_style'] == 'divider_btn' ) ) {
            ?>
            <a <?php echo $this->get_render_attribute_string('button') ?>>
                <?php $this->render_divider_btn(); ?>
            </a>
            <?php
        } elseif (!empty( $settings['btn_style'] == 'linestyle2' )){
             ?>
            <div class="shop_about_content">
                <a <?php echo $this->get_render_attribute_string('button') ?> data-text="<?php echo esc_attr( $settings['text'] ); ?>">
                    <?php $this->render_text(); ?>
                </a>
            </div>
             <?php 
        } elseif ( !empty( $settings['btn_style'] == 'circle_btn' ) ) {
            ?>
            <a <?php echo $this->get_render_attribute_string('button') ?>>
                <?php \Elementor\Icons_Manager::render_icon( $settings['btn_icon'] ); ?>
            </a>
            <?php
        }
        else { ?>
            <a <?php echo $this->get_render_attribute_string('button') ?>>
                <?php $this->render_text(); ?>
            </a>
            <?php
        }

        if ( !empty($icon_animation) ) { ?>
            <script>
                jQuery(document).ready(function () {
                    jQuery('.ub-btn-icon-<?php echo esc_js($icon_animation) ?> .ub-btn').hover( function () {
                        jQuery('.ub-btn-icon-<?php echo esc_js($icon_animation) ?> .ub-btn i').css('animation', '<?php echo esc_js($icon_animation) ?> 0.9s')}, function () {
                        jQuery('.ub-btn-icon-<?php echo esc_js($icon_animation) ?> .ub-btn i').css('animation', 'none')
                    })
                })
            </script>
            <?php
        }
    }

    /**
     * Render button text.
     *
     * Render button widget text.
     *
     * @since 1.5.0
     * @access protected
     */
    protected function render_text() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['icon_align'] ) ) {
            $settings['icon_align'] = $this->get_settings( 'icon_align' );
        }

        $this->add_render_attribute( [
            'content-wrapper' => [
                'class' => 'elementor-button-content-wrapper',
            ],
            'icon-align' => [
                'class' => [
                    'elementor-button-icon',
                    'elementor-align-icon-' . $settings['icon_align'],
                ],
            ],
            'text' => [
                'class' => 'elementor-button-text',
            ],
        ] );

        $this->add_inline_editing_attributes( 'text', 'none' );
        ?>

        <span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
            <span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
                <?php \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </span>
            <span <?php echo $this->get_render_attribute_string( 'text' ); ?>>
                <?php echo esc_html($settings['text']); ?>
            </span>
		</span>
        <?php
    }

    //============== Divider Button
    protected function render_divider_btn() {

        if ( empty( $settings['icon_align'] ) ) {
            $settings['icon_align'] = $this->get_settings( 'icon_align' );
        }

        $this->add_render_attribute( [
            'content-wrapper' => [
                'class' => 'elementor-button-content-wrapper',
            ],
            'icon-align' => [
                'class' => [
                    'elementor-button-icon',
                    'elementor-align-icon-' . $settings['icon_align'],
                ],
            ],
            'text' => [
                'class' => 'elementor-button-text agency_learn_btn h_text_btn',
            ],
        ] );

        $this->add_inline_editing_attributes( 'text', 'none' );

        $settings = $this->get_settings_for_display();
        ?>
        <span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
            <span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
                <?php \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </span>
            <span <?php echo $this->get_render_attribute_string( 'text' ); ?> data-text="<?php echo esc_attr($settings['text']) ?>">
                <?php echo esc_html($settings['text']); ?>
            </span>
        </span>
        <?php
    }
}