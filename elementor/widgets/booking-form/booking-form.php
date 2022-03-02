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
class DRTH_ESS_Booking_Form extends Widget_Base {

    public function get_name() {
        return 'droit-booking-form';
    }

    public function get_title() {
        return __( 'Booking Form [Droit Elements]', 'droit_portfolio' );
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
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


    protected function _register_controls() {


	    $pricing_repeater = new \Elementor\Repeater();
        // -------------------------------------------- Filtering
        $this->start_controls_section(
            'dorit_booking_form', [
                'label' => __( 'Form Features', 'droit_portfolio' ),

            ]
        );

        $this->add_control(
			'booking_form_title',
			[
				'label' => esc_html__( 'Title', 'carspa-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Schedule Auto Service', 'carspa-core' ),
				'placeholder' => esc_html__( 'Schedule Auto Service', 'carspa-core' ),
			]
		);
        $this->add_control(
			'booking_form_description',
			[
				'label' => esc_html__( 'Description', 'carspa-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'To schedule an appointment give us a call at 1-800-123-4567 or fill out the form below with your information and requested services.                ', 'carspa-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'carspa-core' ),
			]
		);

        $this->add_control(
			'get_contact_form',
			[
				'label' => esc_html__( 'Show Elements', 'carspa-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => $this->get_contact_form_list()
			]
		);

        $this->end_controls_section();
        $this->start_controls_section(
			'section_style_for_Content',
			[
				'label' => esc_html__( 'Content', 'carspa-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_responsive_control(
			'section_content_title',
			[
				'label' => esc_html__( 'Title Margin', 'carspa-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .modal-title-main' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'section_content_content',
			[
				'label' => esc_html__( 'Content Margin', 'carspa-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .book-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
        // Button setting 
        $this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'carspa-core' ),
			]
		);
        $this->add_control(
			'button_type',
			[
				'label' => esc_html__( 'Type', 'carspa-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'carspa-core' ),
					'info' => esc_html__( 'Info', 'carspa-core' ),
					'success' => esc_html__( 'Success', 'carspa-core' ),
					'warning' => esc_html__( 'Warning', 'carspa-core' ),
					'danger' => esc_html__( 'Danger', 'carspa-core' ),
				],
				'prefix_class' => 'elementor-button-',
			]
		);
        $this->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'carspa-core' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Appointment', 'carspa-core' ),
				'placeholder' => esc_html__( 'Appointment', 'carspa-core' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'carspa-core' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'carspa-core' ),
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'carspa-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'carspa-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'carspa-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'carspa-core' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'carspa-core' ),
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
				'label' => esc_html__( 'Size', 'carspa-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => self::get_button_sizes(),
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'carspa-core' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'carspa-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'carspa-core' ),
					'right' => esc_html__( 'After', 'carspa-core' ),
				],
				'condition' => [
					'selected_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'carspa-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__( 'View', 'carspa-core' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control(
			'button_css_id',
			[
				'label' => esc_html__( 'Button ID', 'carspa-core' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
				'title' => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'carspa-core' ),
				'description' => sprintf(
					/* translators: 1: Code open tag, 2: Code close tag. */
					esc_html__( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows %1$sA-z 0-9%2$s & underscore chars without spaces.', 'carspa-core' ),
					'<code>',
					'</code>'
				),
				'separator' => 'before',

			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Button', 'carspa-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .elementor-button',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .elementor-button',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'carspa-core' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'carspa-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'carspa-core' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .elementor-button',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'carspa-core' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => esc_html__( 'Text Color', 'carspa-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button:hover, {{WRAPPER}} .elementor-button:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-button:hover svg, {{WRAPPER}} .elementor-button:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background_hover',
				'label' => esc_html__( 'Background', 'carspa-core' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .elementor-button:hover, {{WRAPPER}} .elementor-button:focus',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'carspa-core' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button:hover, {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'carspa-core' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .elementor-button',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'carspa-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-button',
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' => esc_html__( 'Padding', 'carspa-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
    }
    
    // HTML Render Function --------------------------------
    protected function render() {
        $settings = $this->get_settings(); 
        $this->add_render_attribute( 'wrapper', 'class', 'elementor-button-wrapper' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['link'] );
			$this->add_render_attribute( 'button', 'class', 'elementor-button-link' );
		}

		$this->add_render_attribute( 'button', 'class', 'elementor-button' );
		$this->add_render_attribute( 'button', 'class', 'display-booking-form-button' );
		$this->add_render_attribute( 'button', 'role', 'button' );

		if ( ! empty( $settings['button_css_id'] ) ) {
			$this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
		}

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['size'] );
		}

		if ( $settings['hover_animation'] ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<a <?php $this->print_render_attribute_string( 'button' ); ?>>
				<?php $this->render_text(); ?>
			</a>
		</div>
        <div class="display-booking-form">
            <div class="booking-form-content">
                 <a class="close-booking-form" href="">X</a>
                 <h4 class="modal-title-main"><?php echo carspa_return($settings['booking_form_title']); ?></h4>
                 <div class="book-description">
                   <?php echo carspa_return($settings['booking_form_description']); ?>
                 </div>  
               <?php echo do_shortcode('[contact-form-7 id="'.$settings['get_contact_form'].'" title="Contact form 1"]'); ?>
            </div>
        </div>
        <?php 
    }

    public function get_contact_form_list() {

        $list = [];
        $posts = get_posts(array(
            'post_type'     => 'wpcf7_contact_form',
            'numberposts'   => -1
        ));
        foreach($posts as $post) {
             $list[$post->ID] = $post->post_title; 
        }
        return $list;
    }
    public static function get_button_sizes() {
		return [
			'xs' => esc_html__( 'Extra Small', 'carspa-core' ),
			'sm' => esc_html__( 'Small', 'carspa-core' ),
			'md' => esc_html__( 'Medium', 'carspa-core' ),
			'lg' => esc_html__( 'Large', 'carspa-core' ),
			'xl' => esc_html__( 'Extra Large', 'carspa-core' ),
		];
	}
    protected function render_text() {
		$settings = $this->get_settings_for_display();

		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		if ( ! $is_new && empty( $settings['icon_align'] ) ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			//old default
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
		<span <?php $this->print_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
			<span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
				<?php if ( $is_new || $migrated ) :
					Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
				else : ?>
					<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
				<?php endif; ?>
			</span>
			<?php endif; ?>
			<span <?php $this->print_render_attribute_string( 'text' ); ?>><?php $this->print_unescaped_setting( 'text' ); ?></span>
		</span>
		<?php
	}

}
?>

