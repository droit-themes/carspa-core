<?php
namespace DROIT_ELEMENTOR_PRO\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Global_Colors;
use \Elementor\Global_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Animated_Image extends Widget_Base{

    public function get_name()
    {
        return 'dladdons-animated-image';
    }

    public function get_title()
    {
        return esc_html__( 'Animated Image', 'droit-elementor-addons-pro' );
    }

    public function get_icon()
    {
        return 'eicon-animation addons-icon';
    }

    public function get_categories()
    {
        return ['droit_addons_pro'];
    }

    public function get_keywords()
    {
        return [ 'animation','amimated','animation-images','image' ];
    }

    protected function register_controls()
    {
        do_action('dl_widgets/animated-image/register_control/start', $this);

        // add content
        $this->_content_control();
        
        //style section
        $this->_styles_control();
        
        do_action('dl_widgets/animated-image/register_control/end', $this);

        // by default
        do_action('dl_widget/section/style/custom_css', $this);
        
    }

    public function _content_control(){
        //start subscribe layout
        $this->start_controls_section(
            '_dl_pro_animated_image_layout_section',
            [
                'label' => __('Images', 'droit-elementor-addons-pro'),
            ]
        );
        $this->add_control(
			'dl_parallax_image',
			[
				'label' => __( 'Choose Image', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_responsive_control(
			'dl_parallax_image_align',
			[
				'label' => __( 'Alignment', 'droit-elementor-addons-pro' ),
				'type' => \elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'droit-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'droit-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'droit-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

        
        $this->end_controls_section();

        $this->start_controls_section(
            '_dl_pro_animated_image_settings',
            [
                'label' => __('Data Parallax', 'droit-elementor-addons-pro'),
            ]
        );
        $this->add_control(
			'dl_pro_parallax_x',
			[
				'label' => __( 'Parallax x', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -400,
				'max' => 400,
				'step' => 1,
				'default' => 0,
			]
		);
        $this->add_control(
			'dl_pro_parallax_y',
			[
				'label' => __( 'Parallax Y', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -400,
				'max' => 400,
				'step' => 1,
				'default' => 50,
			]
		);
        $this->add_control(
			'dl_pro_parallax_rotateZ',
			[
				'label' => __( 'RotateZ', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -360,
				'max' => 360,
				'step' => 1,
				'default' => 0,
			]
		);

        $this->add_control(
			'dl_pro_parallax_from_scroll',
			[
				'label' => __( 'From Scroll', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -500,
				'max' => 500,
				'step' => 1,
				'default' => 0,
			]
		);

        $this->add_control(
			'dl_pro_parallax_distance',
			[
				'label' => __( 'Distance', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -500,
				'max' => 500,
				'step' => 1,
				'default' => 0,
			]
		);

        $this->add_control(
			'dl_pro_parallax_smoothness',
			[
				'label' => __( 'Smoothness', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -500,
				'max' => 500,
				'step' => 1,
				'default' => 0,
			]
		);
        $this->end_controls_section();
    }

    public function _styles_control(){

        $this->start_controls_section(
            '_dl_pr_animated_image_style_section',
            [
                'label' => esc_html__('Style', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_responsive_control(
			'dl_parallax_image_width',
			[
				'label' => __( 'Width', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'dl_parallax_image_height',
			[
				'label' => __( 'Height', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'dl_parallax_image_object-fit',
			[
				'label' => __( 'Object Fit', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'condition' => [
					'height[size]!' => '',
				],
				'options' => [
					'' => __( 'Default', 'droit-elementor-addons-pro' ),
					'fill' => __( 'Fill', 'droit-elementor-addons-pro' ),
					'cover' => __( 'Cover', 'droit-elementor-addons-pro' ),
					'contain' => __( 'Contain', 'droit-elementor-addons-pro' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} img' => 'object-fit: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'dl_parallax_image_border',
				'selector' => '{{WRAPPER}} img',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'dl_parallax_image_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'dl_parallax_image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} img',
			]
		);
        $this->end_controls_section();
    }


    //Html render
    protected function render()
    {   
        $settings = $this->get_settings_for_display();
        extract($settings);

        $parallax_settings = [];
        if ( ! empty($dl_pro_parallax_x)){
            $parallax_settings['x'] = $dl_pro_parallax_x;
        }
        if(!empty($dl_pro_parallax_y)){
            $parallax_settings['y'] = $dl_pro_parallax_y;
        }
        if(!empty($dl_pro_parallax_rotateZ)){
            $parallax_settings['rotateZ'] = $dl_pro_parallax_rotateZ;
        }
        if(!empty($dl_pro_parallax_from_scroll)){
            $parallax_settings['from-scroll'] = $dl_pro_parallax_from_scroll;
        }
        if(!empty($dl_pro_parallax_distance)){
            $parallax_settings['distance'] = $dl_pro_parallax_distance;
        }
        if(!empty($dl_pro_parallax_smoothness)){
            $parallax_settings['smoothness'] = $dl_pro_parallax_smoothness;
        }
        
        
        if ( empty( $settings['dl_parallax_image']['url'] ) ) {
			return;
		}
        ?>
           <div class="droit_parallax_img_wrapper">
                <img src=" <?php echo esc_url($settings['dl_parallax_image']['url']) ?>" alt="parallax-img" class="droit_parallax_img_inner"
                data-parallax='<?php echo json_encode($parallax_settings, true);?>'>
           </div>
        <?php
    }

    protected function content_template()
    {}
}