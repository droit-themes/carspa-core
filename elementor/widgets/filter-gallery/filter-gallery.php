<?php
namespace Elementor;

if (!defined('ABSPATH')) {exit;}

class DRTH_ESS_Filter_Gallery extends Widget_Base{

    public function get_name()
    {
        return 'drth-filter-gallery';
    }

    public function get_title()
    {
        return esc_html__( 'Filter Gallery', 'text-domain' );
    }

    public function get_icon()
    {
        return 'eicon-image-before-after addons-icon';
    }

    public function get_categories()
    {
        return ['drth_custom_theme'];
    }

    public function get_keywords()
    {
        return [ 'filter gallery', 'masonry gallery', 'grid gallery', 'mixin gallery'];
    }
    public function get_script_depends() {
		return [];
	}

    protected function _register_controls()
    {
        do_action('dl_widgets/filter_gallery/register_control/start', $this);

        // add content 
        $this->_content_control();
        
        //style section
        $this->_styles_control();
        
        do_action('dl_widgets/filter_gallery/register_control/end', $this);

        // by default
        do_action('dl_widget/section/style/custom_css', $this);
        
    }

    public function _content_control(){
        //start subscribe layout
        $this->start_controls_section(
            '_dl_pro_filter_gallery_layout_section',
            [
                'label' => __('Layout', 'text-domain'),
            ]
        );

        $this->end_controls_section();
        //start subscribe layout end

    }

    public function _styles_control(){

        $this->start_controls_section(
            '_dl_pro_filter_galleryt_style_section',
            [
                'label' => esc_html__('Style', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,

            ]
        );



        $this->end_controls_section();
    }

    //Html render
    protected function render()
    {   
        $settings = $this->get_settings_for_display();
        extract($settings);

        // render
        ?>
        <div class="dl_filter_gallery" id="dl_filter_<?php echo esc_attr($this->get_id());?>">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="dl_data_filter">
                                <button class="dl_data_filter_item current" data-filter="*">All</button>
                                <button class="dl_data_filter_item" data-filter=".Interior">Interior</button>
                                <button class="dl_data_filter_item" data-filter=".Architecture">Architecture</button>
                                <button class="dl_data_filter_item" data-filter=".Building">Building</button>
                                <button class="dl_data_filter_item" data-filter=".Exterior">Exterior</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dl_filter_gallery_wrapper dl_addons_grid_wrapper dl_grid_metro" data-layout="masonry" data-gutter="10" data-columns="3">
                                <div class="dl_addons_grid">
                                    <div class="grid-sizer"></div>
                                    <div class="dl_filter_item Interior" data-width="1" data-height="2">
                                        <div class="dl_filter_item-height">
                                            <div class="dl_sp_portfolio_wrapper_style_03 dl_sp_border_wrapper">
                                                <a href="#" class="dl_sp_portfolio_thumb">
                                                    <img src="<?php echo trailingslashit(plugin_dir_url( __FILE__ ));?>/assets/images/portfolio/portfolio-masonry/portfolio-1.jpg" alt="#">
                                                </a>
                                                <div class="dl_sp_portfolio_content dl_sp_border_effect">
                                                    <h3 class="dl_portfolio_title"> <a href="#">Discover Architecture</a> </h3>
                                                    <p class="dl_portfolio_desc">At vero eos et accusamus et iusto odio dignissimos ducimus 
                                                        qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas 
                                                        molestias excepturi sint occaecati cupiditate non provident
                                                    </p>
                                                    <a class="dl_light_btn" href="<?php echo trailingslashit(plugin_dir_url( __FILE__ ));?>/assets/images/portfolio/portfolio-masonry/portfolio-1.jpg"><i class="linearicons-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dl_filter_item Architecture" data-width="1" data-height="1">  
                                        <div class="dl_filter_item-height">
                                            <div class="dl_sp_portfolio_wrapper_style_03 dl_sp_border_wrapper">
                                                <a href="#" class="dl_sp_portfolio_thumb">
                                                    <img src="<?php echo trailingslashit(plugin_dir_url( __FILE__ ));?>/assets/images/portfolio/portfolio-masonry/portfolio-2.jpg" alt="#">
                                                </a>
                                                <div class="dl_sp_portfolio_content dl_sp_border_effect">
                                                    <h3 class="dl_portfolio_title"> <a href="#">Discover Architecture</a> </h3>
                                                    <p class="dl_portfolio_desc">At vero eos et accusamus et iusto odio dignissimos ducimus 
                                                        qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas 
                                                        molestias excepturi sint occaecati cupiditate non provident
                                                    </p>
                                                    <a class="dl_light_btn" href="<?php echo trailingslashit(plugin_dir_url( __FILE__ ));?>/assets/images/portfolio/portfolio-masonry/portfolio-2.jpg"><i class="linearicons-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dl_filter_item Interior" data-width="1" data-height="1">
                                        <div class="dl_filter_item-height">
                                            <div class="dl_sp_portfolio_wrapper_style_03 dl_sp_border_wrapper">
                                                <a href="#" class="dl_sp_portfolio_thumb">
                                                    <img src="<?php echo trailingslashit(plugin_dir_url( __FILE__ ));?>/assets/images/portfolio/portfolio-masonry/portfolio-3.jpg" alt="#">
                                                </a>
                                                <div class="dl_sp_portfolio_content dl_sp_border_effect">
                                                    <h3 class="dl_portfolio_title"> <a href="#"> Discover Architecture</a></h3>
                                                    <p class="dl_portfolio_desc">At vero eos et accusamus et iusto odio dignissimos ducimus 
                                                        qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas 
                                                        molestias excepturi sint occaecati cupiditate non provident
                                                    </p>
                                                    <a class="dl_light_btn" href="<?php echo trailingslashit(plugin_dir_url( __FILE__ ));?>/assets/images/portfolio/portfolio-masonry/portfolio-3.jpg"><i class="linearicons-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dl_filter_item Architecture" data-width="2" data-height="2">
                                        <div class="dl_filter_item-height">
                                            <div class="dl_sp_portfolio_wrapper_style_03 dl_sp_border_wrapper">
                                                <a href="#" class="dl_sp_portfolio_thumb">
                                                    <img src="<?php echo trailingslashit(plugin_dir_url( __FILE__ ));?>/assets/images/portfolio/portfolio-masonry/portfolio-4.jpg" alt="#">
                                                </a>
                                                <div class="dl_sp_portfolio_content dl_sp_border_effect">
                                                    <h3 class="dl_portfolio_title"> <a href="#"> Discover Architecture</a></h3>
                                                    <p class="dl_portfolio_desc">At vero eos et accusamus et iusto odio dignissimos ducimus <br>
                                                        qui blanditiis praesentium voluptatum deleniti atque corrupti<br> quos dolores et quas 
                                                        molestias excepturi sint occaecati <br> cupiditate non provident
                                                    </p>
                                                    <a class="dl_light_btn" href="<?php echo trailingslashit(plugin_dir_url( __FILE__ ));?>/assets/images/portfolio/portfolio-masonry/portfolio-4.jpg"><i class="linearicons-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dl_filter_item Interior Exterior" data-width="1" data-height="1">
                                        <div class="dl_filter_item-height">
                                            <div class="dl_sp_portfolio_wrapper_style_03 dl_sp_border_wrapper">
                                                <a href="#" class="dl_sp_portfolio_thumb">
                                                    <img src="<?php echo trailingslashit(plugin_dir_url( __FILE__ ));?>/assets/images/portfolio/portfolio-masonry/portfolio-5.jpg" alt="#">
                                                </a>
                                                <div class="dl_sp_portfolio_content dl_sp_border_effect">
                                                    <h3 class="dl_portfolio_title"> <a href="#">Discover Architecture</a> </h3>
                                                    <p class="dl_portfolio_desc">At vero eos et accusamus et iusto odio dignissimos ducimus 
                                                        qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas 
                                                        molestias excepturi sint occaecati cupiditate non provident
                                                    </p>
                                                    <a class="dl_light_btn" href="<?php echo trailingslashit(plugin_dir_url( __FILE__ ));?>/assets/images/portfolio/portfolio-masonry/portfolio-5.jpg"><i class="linearicons-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dl_filter_item Exterior" data-width="1" data-height="2">
                                        <div class="dl_filter_item-height">
                                            <div class="dl_sp_portfolio_wrapper_style_03 dl_sp_border_wrapper">
                                                <a href="#" class="dl_sp_portfolio_thumb">
                                                    <img src="<?php echo trailingslashit(plugin_dir_url( __FILE__ ));?>/assets/images/portfolio/portfolio-masonry/portfolio-6.jpg" alt="#">
                                                </a>
                                                <div class="dl_sp_portfolio_content dl_sp_border_effect">
                                                    <h3 class="dl_portfolio_title"> <a href="#"> Discover Architecture</a></h3>
                                                    <p class="dl_portfolio_desc">At vero eos et accusamus et iusto odio dignissimos ducimus 
                                                        qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas 
                                                        molestias excepturi sint occaecati cupiditate non provident
                                                    </p>
                                                    <a class="dl_light_btn" href="<?php echo trailingslashit(plugin_dir_url( __FILE__ ));?>/assets/images/portfolio/portfolio-masonry/portfolio-6.jpg"><i class="linearicons-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dl_filter_item Building" data-width="1" data-height="1">
                                        <div class="dl_filter_item-height">
                                            <div class="dl_sp_portfolio_wrapper_style_03 dl_sp_border_wrapper">
                                                <a href="#" class="dl_sp_portfolio_thumb">
                                                    <img src="<?php echo trailingslashit(plugin_dir_url( __FILE__ ));?>/assets/images/portfolio/portfolio-masonry/portfolio-7.jpg" alt="#">
                                                </a>
                                                <div class="dl_sp_portfolio_content dl_sp_border_effect">
                                                    <h3 class="dl_portfolio_title"> <a href="#">Discover Architecture</a> </h3>
                                                    <p class="dl_portfolio_desc">At vero eos et accusamus et iusto odio dignissimos ducimus 
                                                        qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas 
                                                        molestias excepturi sint occaecati cupiditate non provident
                                                    </p>
                                                    <a class="dl_light_btn" href="<?php echo trailingslashit(plugin_dir_url( __FILE__ ));?>/assets/images/portfolio/portfolio-masonry/portfolio-7.jpg"><i class="linearicons-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }

    protected function content_template()
    {}
}