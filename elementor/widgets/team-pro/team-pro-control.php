<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Team_Pro;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
use \DROIT_ELEMENTOR_PRO\Content_Typography;
use \DROIT_ELEMENTOR_PRO\Image;
use \DROIT_ELEMENTOR_PRO\Position;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {exit;}

abstract class Team_Pro_Control extends Widget_Base
{

    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    public function get_pro_teams_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }
    
    //Preset
    public function _dl_pro_teams_preset_controls()
    {
        $this->start_controls_section(
            '_dl_pr_teams_layout_section',
            [
                'label' => __('Layout', 'droit-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_teams_skin',
            [
                'label' => esc_html__('Preset', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/team/control_presets', [
                    '' => 'Select',
                ]),
                'default' => '',
            ]
        );

        $this->add_control(
            '_dl_pro_teams_skin_mode',
            [
                'label' => esc_html__('Mode', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/team/mode/control_presets', [
                    '' => 'Top',
                    'layout-mode-left' => 'Left',
                    'layout-mode-right' => 'Right',
                    'layout-mode-bottom' => 'Bottom',
                ]),
                'default' => '',
                'condition' => [
                    $this->get_control_id('_dl_pro_teams_skin') => [''],
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function _dl_pro_team_style_controls()
    {
        $this->_dl_pro_teams_content_controls();
        $this->_dl_pro_teams_social_controls();
        $this->_dl_pro_team_general_style_controls();
        $this->_dl_pro_team_image_style_controls();
        $this->_dl_pro_team_designation_style_controls();
        $this->_dl_pro_team_text_style_controls();
        $this->_dl_pro_team_social_style_controls();
    }
    // Team Content
        public function _dl_pro_teams_content_controls()
        {
            $this->start_controls_section(
                '_dl_pro_team_content_section',
                [
                    'label' => __('Content', 'droit-elementor-addons-pro'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        $this->get_control_id('_dl_pro_teams_skin') => [''],
                    ],
                ]
            );
            $this->_dl_pro_teams_data_controls();

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnail',
                    'default' => 'full',
                    'exclude' => ['custom'],
                    'separator' => 'none',
                ]
            );
            $this->end_controls_section();
        }
        // Team data
        protected function _dl_pro_teams_data_controls()
        {
            $this->add_control(
                '_dl_pro_team_name', [
                    'label' => __('Name', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __('Enter Name', 'droit-elementor-addons-pro'),
                    'default' => __('Brooklyn Sim', 'droit-elementor-addons-pro'),
                    'label_block' => true,
                    'description' => __('This text display in name section. NB: Keep empty for hide.', 'droit-elementor-addons-pro'),
                ]
            );

            $this->add_control(
                '_dl_pro_team_designation', [
                    'label' => __('Designation', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __('Enter Position', 'droit-elementor-addons-pro'),
                    'default' => __('Software Engineer', 'droit-elementor-addons-pro'),
                    'label_block' => true,
                    'description' => __('This text display in designation section. NB: Keep empty for hide.', 'droit-elementor-addons-pro'),
                ]
            );

            $this->add_control(
                '_dl_pro_team_description', [
                    'label' => __('Description', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'show_label' => true,
                    'default' => '<p>' . __('Contrary to popular belief, Lorem Ipsum is not simply random text  piece of classical Latin.', 'droit-elementor-addons-pro') . '</p>',
                    'description' => __('This text display in content section. NB: Keep empty for hide.', 'droit-elementor-addons-pro'),
                ]
            );

            $this->add_control(
                '_dl_pro_team_image', [
                    'label' => __('Image', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'show_label' => true,
                    'description' => __('This image display in image section. NB: Keep empty for hide.', 'droit-elementor-addons-pro'),
                ]
            );
            do_action('dl_pro_team_content', $this);
        }
        // Team Social
        public function _dl_pro_teams_social_controls()
        {
            $this->start_controls_section(
                '_dl_pro_team_social_section',
                [
                    'label' => __('Social', 'droit-elementor-addons-pro'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        $this->get_control_id('_dl_pro_teams_skin') => [''],
                    ],
                ]
            );
            $this->add_control(
                '_dl_pro_team_social_show',
                [
                    'label' => __('Show/Hide', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'return_value' => 'yes',
                    'seperator' => 'before',
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                '_dl_pro_team_social_icon',
                [
                    'label' => 'Icon',
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'social',
                    'default' => [
                        'value' => 'fab fa-facebook',
                        'library' => 'fa-brands',
                    ],
                    'show_label' => true,
                ]
            );

            $repeater->add_control(
                '_dl_pro_team_social_link',
                [
                    'label' => __('Link', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => __('https://your-link.com', 'droit-elementor-addons-pro'),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                ]
            );

            do_action('dl_widgets/teams/pro/social/repeater', $repeater);

            $this->add_control(
                '_dl_pro_teams_socials',
                [
                    'label' => __('Social', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'condition' => [
                        $this->get_control_id('_dl_pro_team_social_show') => ['yes'],
                    ],
                    'default' => [
                        [
                            '_dl_pro_team_social_icon' => [
                                'value' => 'fab fa-facebook',
                                'library' => 'fa-brands',
                            ],
                        ],
                        [
                            '_dl_pro_team_social_icon' => [
                                'value' => 'fab fa-pinterest',
                                'library' => 'fa-brands',
                            ],
                        ],
                        [
                            '_dl_pro_team_social_icon' => [
                                'value' => 'fab fa-twitter',
                                'library' => 'fa-brands',
                            ],
                        ],
                    ],
                    'title_field' => '<i class="{{{ _dl_pro_team_social_icon.value }}}"></i>',
                ]
            );
            $this->end_controls_section();
        }
        // General
        public function _dl_pro_team_general_style_controls()
        {
            
            $this->start_controls_section(
                '_dl_pro_teams_general_style_section',
                [
                    'label' => esc_html__('General', 'droit-elementor-addons-pro'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        $this->get_control_id('_dl_pro_teams_skin') => [''],
                    ],
                ]
            );
            $this->add_responsive_control(
                '_dl_pro_teams_content_margin_general',
                [
                    'label' => __('Margin', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'isLinked' => true,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_team_member_info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                '_dl_pro_teams_content_padding_general',
                [
                    'label' => __('Padding', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'isLinked' => true,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_team_member_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background',
                    'label' => __( 'Background', 'droit-elementor-addons-pro' ),
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_team_member_info',
                ]
            );
            $this->add_control(
                '_dl_pro_teams_content_radius_general',
                [
                    'label' => __('Border Radius', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'isLinked' => true,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_team_member_info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                '_dl_pro_position_control',
                [
                    'label' => esc_html__('Position', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => false,
                    'options' => [
                        'relative'  => __( 'Default', 'droit-elementor-addons-pro' ),
                        'absolute' => __( 'Absolute', 'droit-elementor-addons-pro' ),
                        'fixed' => __( 'Fixed', 'droit-elementor-addons-pro' ),
                    ],
                    'default' => 'relative',
                    'selectors' => [
                    '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_team_member_info' => 'position: {{VALUE}}',],
                ]
            );

            $this->add_control(
                'dl_item_position',
                [
                    'label' => __( '', 'droit-elementor-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => __( 'Default', 'droit-elementor-addons-pro' ),
                    'label_on' => __( 'Custom', 'droit-elementor-addons-pro' ),
                    'return_value' => 'yes',
                    'condition' => [
                        '_dl_pro_position_control' => ['absolute', 'fixed']
                    ]
                ]
            );
    
            $this->start_popover();
    
            $start = is_rtl() ? __( 'Right', 'elementor' ) : __( 'Left', 'elementor' );
            $end = ! is_rtl() ? __( 'Right', 'elementor' ) : __( 'Left', 'elementor' );


            $this->add_control(
                'dl_width',
                [
                    'label' => __('Width Setting', 'droit-elementor-addons-pro'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
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
                    'size_units' => [ 'px', '%', 'vw', 'vh' ],
                    'selectors' => [
                        '{{WRAPPER}} .dl_team_member_info' => 'width: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_control(
                'dl_offset_orientation_h',
                [
                    'label' => __( 'Horizontal Orientation', 'elementor' ),
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
                    'label' => __( 'Offset', 'elementor' ),
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
                        'body:not(.rtl) {{WRAPPER}} .dl_team_member_info' => 'left: {{SIZE}}{{UNIT}}',
                        'body.rtl {{WRAPPER}} .dl_team_member_info' => 'right: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'dl_offset_orientation_h!' => 'end',
                    ],
                ]
            );

            $this->add_responsive_control(
                'dl_offset_x_end',
                [
                    'label' => __( 'Offset', 'elementor' ),
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
                        'body:not(.rtl) {{WRAPPER}} .dl_team_member_info' => 'right: {{SIZE}}{{UNIT}}',
                        'body.rtl {{WRAPPER}} .dl_team_member_info' => 'left: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'dl_offset_orientation_h' => 'end',
                    ],
                ]
            );

            $this->add_control(
                'dl_offset_orientation_v',
                [
                    'label' => __( 'Vertical Orientation', 'elementor' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
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

            $this->add_responsive_control(
                'dl_offset_y',
                [
                    'label' => __( 'Offset', 'elementor' ),
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
                        '{{WRAPPER}} .dl_team_member_info' => 'top: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'dl_offset_orientation_v!' => 'end',
                    ],
                ]
            );

            $this->add_responsive_control(
                'dl_offset_y_end',
                [
                    'label' => __( 'Offset', 'elementor' ),
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
                        '{{WRAPPER}} .dl_team_member_info' => 'bottom: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'dl_offset_orientation_v' => 'end',
                    ],
                ]
            );
           
            $this->end_popover();

            $this->add_responsive_control(
                '_dl_pro_teams_align',
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
                        '{{WRAPPER}} .dl-team-member-wrapper-pro' => 'text-align: {{VALUE}}',
                    ],
                ]
            );
            do_action('dl_widgets/team/pro/style/general', $this);
            $this->end_controls_section();
        }
        //Team Name
        public function _dl_pro_team_name_style_controls()
        {
            do_action('dl_widgets/team/pro/section/style/name/before', $this);

            $this->start_controls_tabs('_dl_pro_teams_name_tabs');

            $this->start_controls_tab('_dl_pro_teams_name_normal_tab',
                [
                    'label' => esc_html__('Normal', 'droit-elementor-addons-pro'),
                ]
            );
            $this->_dl_pro_teams_name_normal_controls();
            $this->end_controls_tab();

            $this->end_controls_tab();

            $this->start_controls_tab('_dl_pro_teams_name_hover',
                [
                    'label' => esc_html__('Hover', 'droit-elementor-addons-pro'),
                ]
            );
            $this->_dl_pro_team_name_hover_controls();
            $this->end_controls_tab();

            $this->end_controls_tabs();
            do_action('dl_widgets/team/pro/section/style/name/inner', $this);
            // $this->end_controls_section();
            do_action('dl_widgets/team/pro/section/style/name/after', $this);
        }
        //Team Name Normal
        protected function _dl_pro_teams_name_normal_controls()
        {
            $this->add_group_control(
                Content_Typography::get_type(),
                [
                    'name' => 'name_typographys',
                    'label' => __('Typography', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-team-member-wrapper-pro .team--name',
                    'fields_options' => [
                        'typography' => [
                            'default' => '',
                        ],
                        'name_typographys' => 'custom',
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

            do_action('dl_widgets/team/pro/section/style/name/normal', $this);
            $this->add_responsive_control(
                '_dl_pro_teams_name_margin',
                [
                    'label' => __('Margin', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'isLinked' => true,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .team--name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            do_action('dl_widgets/team/pro/section/style/name/normal/gaping', $this);
            do_action('dl_widgets/team/pro/section/style/name/normal/bottom', $this);
        }
        //Team Name Hover
        protected function _dl_pro_team_name_hover_controls()
        {

            $this->add_control(
                '_dl_pro_teams_hover_name_color',
                [
                    'label' => __('Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro:hover .team--name' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                '_dl_pro_teams_hover_name_transition',
                [
                    'label' => __( 'Transition Duration', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 3,
                            'step' => 0.1,
                        ],
                    ],
                    'render_type' => 'ui',
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro:hover .team--name' => 'transition: {{SIZE}}s',
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .team--name' => 'transition: {{SIZE}}s',
                    ],
                ]
            );
            do_action('dl_widgets/team/pro/section/style/name/hover', $this);
        }
        //Team Image
        public function _dl_pro_team_image_style_controls()
        {
            do_action('dl_widgets/team/pro/section/style/image/before', $this);
            $this->start_controls_section(
                '_dl_pro_teams_image_style_section',
                [
                    'label' => esc_html__('Image', 'droit-elementor-addons-pro'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        $this->get_control_id('_dl_pro_teams_skin') => [''],
                    ],
                ]
            );

            $this->start_controls_tabs('_dl_pro_teams_image_tabs');

            $this->start_controls_tab('_dl_pro_teams_image_normal_tab',
                [
                    'label' => esc_html__('Normal', 'droit-elementor-addons-pro'),
                ]
            );
            $this->_dl_pro_teams_image_normal_controls();
            $this->_dl_pro_teams_image_position_normal_controls();
            $this->end_controls_tab();

            $this->end_controls_tab();

            $this->start_controls_tab('_dl_pro_teams_image_hover',
                [
                    'label' => esc_html__('Hover', 'droit-elementor-addons-pro'),
                ]
            );
            $this->_dl_pro_team_image_hover_controls();
            $this->end_controls_tab();

            $this->end_controls_tabs();
            do_action('dl_widgets/team/pro/section/style/image/inner', $this);
            $this->end_controls_section();
            do_action('dl_widgets/team/pro/section/style/image/after', $this);
        }
        //Team Image Normal
        protected function _dl_pro_teams_image_normal_controls()
        {
            $this->add_group_control(
                Image::get_type(),
                [
                    'name' => 'image_typographys',
                    'label' => __('Image Setting', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_team_member_thumb img',
                    'fields_options' => [
                        'typography' => [
                            'default' => '',
                        ],
                        'image_typographys' => 'custom',
                        'image_width' => [
                            'default' => [
                                'size' => '',
                                'unit' => 'px',
                            ],
                        ],
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => '_dl_pro_teams_image_before',
                    'label' => __( 'Background', 'droit-elementor-addons-pro'),
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_team_member_thumb:before',
                ]
            );

            do_action('dl_widgets/team/pro/section/style/image/normal/bottom', $this);
        }
        //Team Image Position Normal
        protected function _dl_pro_teams_image_position_normal_controls()
        {

            $this->add_control(
                '_dl_pro_teams_image_position_toggle',
                [
                    'label' => __('Position', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => __('None', 'droit-elementor-addons-pro'),
                    'label_on' => __('Custom', 'droit-elementor-addons-pro'),
                    'return_value' => 'yes',
                    'default' => '',
                ]
            );
            $this->start_popover();
            $this->add_responsive_control(
                '_dl_pro_team_image_position_horizontal',
                [
                    'label' => __('Horizontal', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem'],
                    'condition' => [
                        $this->get_control_id('_dl_pro_teams_image_position_toggle') => ['yes'],
                    ],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        'em' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        'rem' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                    ],
                    'render_type' => 'ui',
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_team_member_thumb img' => 'transform: translateY({{SIZE}}{{UNIT}})',
                    ],
                ]
            );
            $this->add_responsive_control(
                '_dl_pro_team_image_position_verticale',
                [
                    'label' => __('Vertical', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem'],
                    'condition' => [
                        $this->get_control_id('_dl_pro_teams_image_position_toggle') => ['yes'],
                    ],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        'em' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        'rem' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_team_member_thumb img' => 'margin-left:{{SIZE}}{{UNIT}}',
                    ],
                ]
            );
            $this->end_popover();

        }
        //Team Image Hover
        protected function _dl_pro_team_image_hover_controls()
        {
            $this->add_control(
                '_dl_pro_teams_hover_animation',
                [
                    'label' => __('Hover Animation', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::HOVER_ANIMATION,
                ]
            );

            do_action('dl_widgets/team/pro/section/style/image/hover', $this);
        }
        //Team Designation
        public function _dl_pro_team_designation_style_controls()
        {
            do_action('dl_widgets/team/pro/section/style/name/before', $this);
            $this->start_controls_section(
                '_dl_pro_teams_designation_style_section',
                [
                    'label' => esc_html__('Designation', 'droit-elementor-addons-pro'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->start_controls_tabs('_dl_pro_teams_designation_tabs');

            $this->start_controls_tab('_dl_pro_teams_designation_normal_tab',
                [
                    'label' => esc_html__('Normal', 'droit-elementor-addons-pro'),
                ]
            );
            $this->_dl_pro_teams_designation_normal_controls();
            $this->end_controls_tab();

            $this->end_controls_tab();

            $this->start_controls_tab('_dl_pro_teams_designation_hover',
                [
                    'label' => esc_html__('Hover', 'droit-elementor-addons-pro'),
                ]
            );
            $this->_dl_pro_team_designation_hover_controls();
            $this->end_controls_tab();

            $this->end_controls_tabs();
            do_action('dl_widgets/team/pro/section/style/name/inner', $this);
            $this->end_controls_section();
            do_action('dl_widgets/team/pro/section/style/name/after', $this);
        }
        //Team Designation Normal
        protected function _dl_pro_teams_designation_normal_controls()
        {

            $this->add_group_control(
                Content_Typography::get_type(),
                [
                    'name' => 'designation_typographys',
                    'label' => __('Typography', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-team-member-wrapper-pro .team--designation',
                    'fields_options' => [
                        'typography' => [
                            'default' => '',
                        ],
                        'designation_typographys' => 'custom',
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
                '_dl_pro_teams_name_designation_margin',
                [
                    'label' => __('Margin', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'isLinked' => true,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .team--designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            do_action('dl_widgets/team/pro/section/style/name/normal/gaping', $this);
            do_action('dl_widgets/team/pro/section/style/name/normal/bottom', $this);
        }
        //Team Designation Hover
        protected function _dl_pro_team_designation_hover_controls()
        {

            $this->add_control(
                '_dl_pro_teams_hover_designation_color',
                [
                    'label' => __('Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro:hover .team--designation' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                '_dl_pro_teams_hover_designation_transition',
                [
                    'label' => __( 'Transition Duration', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 3,
                            'step' => 0.1,
                        ],
                    ],
                    'render_type' => 'ui',
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro:hover .team--designation' => 'transition: {{SIZE}}s',
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .team--designation' => 'transition: {{SIZE}}s',
                    ],
                ]
            );
            do_action('dl_widgets/team/pro/section/style/name/hover', $this);
        }
        //Team Text
        public function _dl_pro_team_text_style_controls()
        {
            do_action('dl_widgets/team/pro/section/style/text/before', $this);

            $this->start_controls_section(
                '_dl_pro_teams_text_style_section',
                [
                    'label' => esc_html__('Content', 'droit-elementor-addons-pro'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'more_options',
                [
                    'label' => __( 'Title', 'droit-elementor-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->_dl_pro_team_name_style_controls();

            $this->_dl_pro_teams_text_normal_controls();

            $this->end_controls_tab();

            do_action('dl_widgets/team/pro/section/style/text/inner', $this);
            $this->end_controls_section();
            do_action('dl_widgets/team/pro/section/style/text/after', $this);
        }

        //Team Text Normal
        protected function _dl_pro_teams_text_normal_controls()
        {
            $this->add_control(
                'more_optionse',
                [
                    'label' => __( 'Description', 'plugin-name' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Content_Typography::get_type(),
                [
                    'name' => 'text_typographys',
                    'label' => __('Typography', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-team-member-wrapper-pro .team--content p',
                    'fields_options' => [
                        'typography' => [
                            'default' => '',
                        ],
                        'text_typographys' => 'custom',
                        'font_family' => [
                            'default' => '',
                        ],
                        'font_color' => [
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

            do_action('dl_widgets/team/pro/section/style/text/normal', $this);
            $this->add_control(
                '_dl_pro_teams_text_margin',
                [
                    'label' => __('Margin', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'isLinked' => true,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .team--content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            do_action('dl_widgets/team/pro/section/style/text/normal/gaping', $this);
            do_action('dl_widgets/team/pro/section/style/text/normal/bottom', $this);
        }
       
        //Team Social
        public function _dl_pro_team_social_style_controls()
        {
            do_action('dl_widgets/team/pro/section/style/social/before', $this);
            $this->start_controls_section(
                '_dl_pro_teams_social_style_section',
                [
                    'label' => esc_html__('Social', 'droit-elementor-addons-pro'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->start_controls_tabs('_dl_pro_teams_social_tabs');

            $this->start_controls_tab('_dl_pro_teams_social_normal_tab',
                [
                    'label' => esc_html__('Normal', 'droit-elementor-addons-pro'),
                ]
            );
            $this->_dl_pro_teams_social_normal_controls();
            $this->end_controls_tab();

            $this->end_controls_tab();

            $this->start_controls_tab('_dl_pro_teams_social_hover',
                [
                    'label' => esc_html__('Hover', 'droit-elementor-addons-pro'),
                ]
            );
            $this->_dl_pro_team_social_hover_controls();
            $this->end_controls_tab();

            $this->end_controls_tabs();
            do_action('dl_widgets/team/pro/section/style/social/inner', $this);
            $this->end_controls_section();
            do_action('dl_widgets/team/pro/section/style/social/after', $this);
        }
        //Team Social Normal
        protected function _dl_pro_teams_social_normal_controls()
        {

            $this->add_control(
                '_dl_pro_teams_social_color',
                [
                    'label' => __('Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_social_icon a' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                '_dl_pro_teams_social_bg',
                [
                    'label' => __('Background Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_social_icon a' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => '_dl_pro_teams_social_border',
                    'label' => __('Border', 'droit-elementor-addons-pro'),
                    'fields_options' => [
                        'border' => [
                            'default' => '',
                        ],
                        'width' => [
                            'default' => [
                                'top' => '',
                                'bottom' => '',
                                'left' => '',
                                'right' => '',
                                'unit' => '',
                            ],
                        ],
                        'color' => [
                            'default' => '',
                        ],
                    ],
                    'selector' => '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_social_icon a',
                ]
            );
            $this->add_responsive_control(
                '_dl_pro_teams_social_border_radius',
                [
                    'label' => __('Border Radius', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'isLinked' => true,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_social_icon a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                '_dl_pro_teams_social_padding',
                [
                    'label' => __('Padding', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'isLinked' => true,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_social_icon a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                '_dl_pro_teams_social_size',
                [
                    'label' => __('Size', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', 'rem', 'vw'],
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
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_social_icon a' => 'font-size: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                '_dl_pro_teams_social_gap',
                [
                    'label' => __('Gaping', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'size' => '',
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_social_icon a' => 'margin-left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            do_action('dl_widgets/team/pro/section/style/social/normal', $this);
            $this->end_popover();
            $this->add_group_control(
                Position::get_type(),
                [
                    'name' => 'social_position',
                    'label' => __('Position', 'droit-elementor-addons-pro'),
                    'selector' => '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_social_icon',
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
            
            do_action('dl_widgets/team/pro/section/style/social/normal/gaping', $this);
            
            do_action('dl_widgets/team/pro/section/style/social/normal/bottom', $this);
        }
        //Team Social Hover
        protected function _dl_pro_team_social_hover_controls()
        {

            $this->add_control(
                '_dl_pro_teams_hover_social_color',
                [
                    'label' => __('Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_social_icon a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                '_dl_pro_teams_social_hover_bg',
                [
                    'label' => __('Background Color', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_social_icon a:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                '_dl_pro_teams_social_border_radius_hover',
                [
                    'label' => __('Border Radius', 'droit-elementor-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'isLinked' => true,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_social_icon a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_control(
                '_dl_pro_teams_hover_social_transition',
                [
                    'label' => __( 'Transition Duration', 'droit-elementor-addons-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 3,
                            'step' => 0.1,
                        ],
                    ],
                    'render_type' => 'ui',
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_social_icon a:hover' => 'transition: {{SIZE}}s',
                        '{{WRAPPER}} .dl-team-member-wrapper-pro .dl_social_icon a' => 'transition: {{SIZE}}s',
                    ],
                ]
            );
            do_action('dl_widgets/team/pro/section/style/social/hover', $this);
        }
}
