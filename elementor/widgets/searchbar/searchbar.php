<?php
namespace Elementor;

use \WP_Query;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class droit_portfolio_searchbar
 * @package droit_portfolioCore\Widgets
 */
class DRTH_ESS_searchbar extends Widget_Base {

    public function get_name() {
        return 'droit-searchbar-theme';
    }

    public function get_title() {
        return __( 'carspa Search', 'carspa-core' );
    }

    public function get_icon() {
        return 'dlicons-blog-post';
    }

    public function get_categories() {
        return [ 'drth_custom_theme' ];
    }


    public function get_style_depends() {
        return ['droit-partner-style'];
    }

	public function get_script_depends(){
		return ['droit-searchbar-script'];
	}


    protected function _register_controls() {


    $pricing_repeater = new \Elementor\Repeater();
        
    $this->start_controls_section(
        'drdt_searchbar_sections',
        [
            'label' => __( 'Search Icon', 'carspa-core' ),
        ]
    );

    $this->add_control(
        'search_icon',
        [
            'label' => __( 'Icon', 'text-domain' ),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-search',
                'library' => 'solid',
            ],
        ]
    );

    $this->end_controls_section();

    // Overlay Search Form
    $this->start_controls_section(
        'overlay_search_form',
        [
            'label' => __( 'Overlay Search Form', 'carspa-core' ),
        ]
    );

    $this->add_control(
        'overlay_search_icon',
        [
            'label' => __( 'Search Icon', 'text-domain' ),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-search',
                'library' => 'solid',
            ],
        ]
    );

    $this->add_control(
        'overlay_close_icon',
        [
            'label' => __( 'Close Icon', 'text-domain' ),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-window-close',
                'library' => 'solid',
            ],
        ]
    );

    $this->add_control(
        'overlay_placeholder_text',
        [
            'label' => __( 'Placeholder Text', 'text-domain' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Search here ...',
        ]
    );

    $this->end_controls_section();

    // ============================= Search Icon Style ============================= //
    $this->start_controls_section(
        'search_icon_style',
        [
            'label' => __( 'Search Icon', 'carspa-core' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );

    //------------------------- Start Search Icon Colors --------------------------//
    $this->start_controls_tabs(
        'search_icon_color_tabs'
    );

    // Normal Colors
    $this->start_controls_tab(
        'search_icon_normal_tabs', [
            'label' => __( 'Normal', 'carspa-core' ),
        ]
    );

    $this->add_control(
        'search_icon_normal_color',
        [
            'label' => __( 'Icon Color', 'carspa-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .nav-link i:before' => 'color: {{VALUE}} !important;',
            ],
        ]
    );

    $this->add_control(
        'search_icon_normal_opacity',
        [
            'label' => __( 'Opacity', 'carspa-core' ),
            'type' => Controls_Manager::NUMBER,
            'max' => 1,
            'min' => 0.10,
            'step' => 0.01,
            'selectors' => [
                '{{WRAPPER}} .nav-link i:before' => 'opacity: {{SIZE}};',
            ],
        ]
    );

    $this->end_controls_tab(); // End Normal Colors


    // Hover Colors
    $this->start_controls_tab(
        'search_icon_hover_tabs',
        [
            'label' => __( 'Hover', 'carspa-core' ),
        ]
    );

    $this->add_control(
        'search_icon_hover_color',
        [
            'label' => __( 'Icon Color', 'carspa-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .search_cart .nav-item:hover' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'search_icon_hover_opacity',
        [
            'label' => __( 'Opacity', 'carspa-core' ),
            'type' => Controls_Manager::NUMBER,
            'max' => 1,
            'min' => 0.10,
            'step' => 0.01,
            'selectors' => [
                '{{WRAPPER}} .search_cart .nav-item:hover' => 'opacity: {{SIZE}};',
            ],
        ]
    );

    $this->end_controls_tab(); // Hover Colors

    $this->end_controls_tabs(); // End Tabs

    $this->add_responsive_control(
        'search_icon_size',
        [
            'label' => __( 'Size', 'carspa-core' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .drdt-search-form > a' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'before',
        ]
    );

    $this->add_responsive_control(
        'search_icon_alignment',
        [
            'label' => __( 'Alignment', 'carspa-core' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => __( 'Left', 'carspa-core' ),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __( 'Center', 'carspa-core' ),
                    'icon' => 'eicon-text-align-center',
                ],
                'flex-end' => [
                    'title' => __( 'Right', 'carspa-core' ),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'center',
            'selectors' => [
                '{{WRAPPER}} .drdt-search-form' => 'justify-content: {{VALUE}};',
            ],
            'separator' => 'before',
        ]
    );


    $this->end_controls_section(); // End Search Icon Style


    //============================= Overlay search form ============================== //
    $this->start_controls_section(
        'overlay_search_form_icon_style',
        [
            'label' => __( 'Overlay Search Form', 'carspa-core' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'overlay_search_form_placeholder_typo',
            'label' => __( 'Placeholder Typography', 'carspa-core' ),
            'selector' => '{{WRAPPER}} .droit-search-box .drdt-input-group input::-webkit-input-placeholder',
        ]
    );

    $this->add_control(
        'overlay_search_form_placeholder_color',
        [
            'label' => __( 'Placeholder Color', 'carspa-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .droit-search-box .drdt-input-group input::-webkit-input-placeholder' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'overlay_search_form_icon_color',
        [
            'label' => __( 'Search Icon Color', 'carspa-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .drdt-input-group-append > .btn > i' => 'color: {{VALUE}};',
            ],
            'separator' => 'before'
        ]
    );

    $this->add_control(
        'overlay_search_form_close_icon_color',
        [
            'label' => __( 'Close Icon Color', 'carspa-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .drdt-input-group-append > .btn > i' => 'color: {{VALUE}};',
            ],
            'separator' => 'before'
        ]
    );

    $this->add_responsive_control(
        'overlay_search_form_icon_size',
        [
            'label' => __( 'Icon Size', 'carspa-core' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .drdt-input-group-append > .btn > i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'overlay_search_form_bg_divider',
        [
            'type' => Controls_Manager::DIVIDER,
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'overlay_search_form_bg_color',
            'label' => __( 'Background', 'carspa-core' ),
            'types' => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .droit-search-box:before',
        ]
    );

    $this->add_control(
        'overlay_search_form_bg_opacity',
        [
            'label' => __( 'Opacity', 'carspa-core' ),
            'type' => Controls_Manager::NUMBER,
            'max' => 1,
            'min' => 0.10,
            'step' => 0.01,
            'selectors' => [
                '{{WRAPPER}} .droit-search-box:before' => 'opacity: {{SIZE}};',
            ],
        ]
    );

    $this->end_controls_section(); // End Overlay search form

    }
    
    // HTML Render Function --------------------------------
    protected function render() {
    $settings = $this->get_settings(); 
    ?>
    <ul class="navbar-nav search_cart carspa">
        <li class="nav-item search"><a class="nav-link search-btn" href="javascript:void(0);"><i
                    class="icon-search"></i></a>
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="menu-search-form">
                <div class="input-group">
                    <input type="search" class="form-control" placeholder="<?php echo esc_attr_e( 'Search...', 'carspa' ) ?>" id="" value="<?php echo get_search_query(); ?>" name="s">
                    <button type="submit"><i class="ti-arrow-right"></i></button>
                </div>
            </form>
        </li>
    </ul>
<?php
    }

}
