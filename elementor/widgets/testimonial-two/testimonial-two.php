<?php
namespace Elementor;
use \Elementor\Widget_Base;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class case-studies
 * @package case-studies\Widgets
 */
class DRTH_ESS_Testimonial_two extends Widget_Base {

    public function get_name() {
        return 'testimonial-two';
    }

    public function get_title() {
        return __( 'Carspa Testimonial', 'carspa_core' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'drth_custom_theme' ];
    }

    protected function register_controls() {
        $this-> elementor_content_control();
    }

    public function elementor_content_control() {
        // ------------------------------ Testimonials ------------------------------ //
        $this->start_controls_section(
            'content_sec', [
                'label' => __( 'Testimonials', 'carspa-core' ),
            ]
        );

        $testimonials_1 = new \Elementor\Repeater();
        
        $testimonials_1->add_control(
            'subject', [
                'label' => __( 'Subject', 'carspa-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Development Quality' , 'carspa-core' ),
                'label_block' => true,
            ]
        );

        $testimonials_1->add_control(
            'name', [
                'label' => __( 'Client Name', 'carspa-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Mark Tony' , 'carspa-core' ),
                'label_block' => true,
            ]
        );

        $testimonials_1->add_control(
            'designation', [
                'label' => __( 'Designation', 'carspa-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Software Developer' , 'carspa-core' ),
            ]
        );

        $testimonials_1->add_control(
            'content', [
                'label' => __( 'Content', 'carspa-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $testimonials_1->add_control(
            'testimonial_image', [
                'label' => __( 'Author image', 'carspa-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $testimonials_1->add_control(
            'testimonial_features', [
                'label' => __( 'Features image', 'carspa-core' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
					'active' => true,
				],
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
            ]
        );
        $testimonials_1->add_control(
            'testimonial_quote', [
                'label' => __( 'Quote image', 'carspa-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'testimonials', [
                'label' => __( 'Testimonials', 'carspa-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $testimonials_1->get_controls(),
                'title_field' => '{{{ name }}}',
                'prevent_empty' => false
            ]
        ); //End Testimonials
        $this->end_controls_section();

        $this->start_controls_section(
            'testimonial_style', [
                'label' => __( 'Style', 'carspa-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'star_options',
			[
				'label' => esc_html__( 'Icon', 'carspa-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
            'star_color', [
                'label' => __( 'Color', 'carspa-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .__star_icon i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
			'title_options',
			[
				'label' => esc_html__( 'Title', 'carspa-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
            'title_color', [
                'label' => __( 'Color', 'carspa-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feedback_slider_inner .feedback_content h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .feedback_slider_inner .feedback_content h2',
                'separator' => 'after',
			]
		);
        $this->add_control(
			'content_options',
			[
				'label' => esc_html__( 'Content', 'carspa-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
            'content_color', [
                'label' => __( 'Color', 'carspa-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .__content' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .__content',
                'separator' => 'after',
			]
		);
        $this->add_responsive_control(
			'margin-content',
			[
				'label' => esc_html__( 'Margin', 'carspa_core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator' => 'after',
			]
		);
        $this->add_control(
			'info_options',
			[
				'label' => esc_html__( 'Information', 'carspa-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
            'name_color', [
                'label' => __( 'Color', 'carspa-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .__name' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .__name',
                
			]
		);
        $this->add_control(
			'info_designation',
			[
				'label' => esc_html__( 'Job Position', 'carspa-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
            'position_color', [
                'label' => __( 'Color', 'carspa-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .designation' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'position_typography',
				'selector' => '{{WRAPPER}} .designation',
                
			]
		);
        $this->end_controls_section();

    }

    // HTML Render Function --------------------------------
    protected function render() {
        $this->load_widget_script();
        $settings = $this->get_settings_for_display();
        extract($settings); // Array to variable conversation
        $testimonials = isset($settings['testimonials']) ? $settings['testimonials'] : '';

    ?>
        <div class="gallery"> 
            <div class="swiper-container feedback-slider">
                <div class="swiper-wrapper">
                    <?php
                        if($testimonials){
                        foreach($testimonials as $testimonial){
                    ?>
                        <div class="swiper-slide">
                            <div class="d-flex feedback_slider_inner">
                            <?php  echo wp_get_attachment_image($testimonial['testimonial_quote']['id'], 'small quote') ?>
                                <div class="feedback_author_img">
                                     <img src="<?php echo esc_url($testimonial['testimonial_features']['url']); ?>" alt="img">
                                </div>
                                <div class="feedback_content">
                                    <div class="__star_icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h2 class="wow fadeInUp" data-wow-delay="0.1s"><?php echo esc_html($testimonial['subject']); ?></h2>
                                    <?php echo !empty($testimonial['content']) ? "<p class='__content wow fadeInUp' data-wow-delay='0.2s'>{$testimonial['content']}</p>" : ''; ?>
                                    <div class="buttom_box wow fadeInUp" data-wow-delay="0.3s">
                                        <img src="<?php echo esc_url($testimonial['testimonial_image']['url']); ?>" alt="">
                                        <div class="author_text">
                                            <?php if ( !empty($testimonial['name']) ) : ?>
                                                <h4 class="__name"><?php echo esc_html($testimonial['name']); ?> </h4>
                                            <?php endif; ?>
                                            <?php if ( !empty($testimonial['designation']) ) : ?>
                                                    <h4 class="designation"><?php echo esc_html($testimonial['designation']); ?> </h4>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    <?php
                        }
                    }
                    ?>
                    
                </div>
                
            </div>
            <div class="swiper-button-next">
                <i class=" eicon-arrow-right"></i>
            </div>
            <div class="swiper-button-prev">
                <i class=" eicon-arrow-left"></i>
            </div>
            
        </div>
 
    <?php
   
  }
  public function load_widget_script(){
    if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
           var slider = new Swiper(".swiper-container.feedback-slider", {
            speed: 2500,
            slidesPerView: 1,
            centeredSlides: false,
            spaceBetween: 30,
            loop: true,
            loopedSlides: 3,
            autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            },
            navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
            },
            pagination: {
            el: ".swiper-pagination",
            clickable: true,
            },
        });

        // var thumbs = new Swiper(".swiper-container.gallery-thumbs", {
        //     slidesPerView: 3,
        //     spaceBetween: 10,
        //     centeredSlides: true,
        //     loop: true,
        //     slideToClickedSlide: true,
            
        // });
        // slider.controller.control = thumbs;
        // thumbs.controller.control = slider;
        </script>
        <?php
    }
}
}