<?php
namespace Carspacore\Elementor;
defined( 'ABSPATH' ) || exit;

use \Carspacore\DRTH_Plugin as DR_Plugin;

class Widgets_Loader{


    private static $instance;
    
    private static $elementor;

    private $widgets = [];

    public static function widgets_url(){
		return DR_Plugin::dtdr_th_url().'elementor/widgets/';
	}

	public static function widgets_dir(){
		return DR_Plugin::dtdr_th_dir().'elementor/widgets/';
	}

    public static function version(){
		if( defined('DROIT_ADDONS_VERSION_PRO') ){
			return DROIT_ADDONS_VERSION_PRO;
		} else {
			return apply_filters('dladdons_pro_version', '1.0.0');
		}
		
	}

    public static function widget_map() {

        return apply_filters('drth_elementor_widgets_loading', [
            
            'advance-slider' => [
                'title' => __( 'Advanced Slider', 'carspa-core' ),
                'js' => [''],
                'css' => [''],
                'vendor' => [
                    'css' => ['swiper'],
                    'js'  => ['swiper']
                ],
                'source' => 'addons',
            ],
       
            'image-compare' => [
                'title' => __( 'Image Compare', 'carspa-core' ),
                'js' => ['compare/js/imagesloaded.js', 'compare/js/jquery.event.move.js', 'compare/js/jquery.twentytwenty.js'],
                'css' => ['compare/css/twentytwenty.css'],
                'source' => 'addons',
            ],

            'advanced-tab' => [
                'title' => __( 'Advanced Tab', 'carspa-core' ),
                'js' => [''],
                'css' => [''],
                'source' => 'addons',
            ],

            'pricing-pro' => [
                'title' => __( 'Pricing Pro', 'carspa-core' ),
                'js' => [''],
                'css' => [''],
                'source' => 'addons',
            ],

            'breadcrumbs' => [
                'title' => __( 'Breadcrumbs', 'carspa-core' ),
                'js' => [''],
                'css' => [''],
                'source' => 'addons',
            ],

            'animated-image' => [
                'title' => __( 'Animated Image', 'carspa-core' ),
                'js' => [''],
                'css' => [''],
                'source' => 'addons',
            ], 

            'services' => [
                'title' => __( 'Services', 'carspa-core' ),
                'js' => ['js/services.js'],
                'css' => ['css/services.css'],
                'source' => 'local',
            ],

            'pricing-theme' => [
                'title' => __( 'Pricing', 'carspa-core' ),
                'js' => ['js/pricing.js'],
                'css' => ['css/pricing.css'],
                'source' => 'local',
            ],

            'nav' => [
                'title' => __( 'carspa Nav', 'carspa-core' ),
                'js' => [''],
                'css' => ['css/nav.css'],
            ],

            'sitelogo' => [
                'title' => __( 'Site Logo', 'carspa-core' ),
                'js' => [''],
                'css' => ['css/sitelogo.css'],
            ],
            
            'searchbar' => [
                'title' => __( 'Carspa Search', 'carspa-core' ),
                'js' => ['js/custome.js'],
                'css' => ['css/searchbar.css'],
            ],

            'subscriber' => [
                'title' => __( 'subscriber', 'carspa-core' ),
                'js' => [''],
                'css' => [''],
                'source' => 'addons',
            ],


        ]);
    }

    public function load(){
        
        add_action('init', [$this, 'render_css']);
        // load script global
        add_action('elementor/frontend/before_register_scripts', [$this, 'script_load'], 998);
        add_action('wp_enqueue_scripts', [$this, 'script_load'], 999);
        
        if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( '\Elementor\Plugin::instance' ) ) {
            self::$elementor = \Elementor\Plugin::instance();
            
            add_action( 'elementor/elements/categories_registered', [$this, 'register_category' ] );
            add_action( 'elementor/widgets/widgets_registered', [$this, 'register_widgets' ] );

        }

        add_filter( 'upload_mimes', [$this, 'svg_mime_add']);
    }

    public function script_load(){
        
        // load global widgets css
        wp_enqueue_style('drth-theme-styles', self::widgets_url() . 'widgets.css', [], self::version());   
        
        // load js files
        $this->widgets = self::widget_map();
        if( !empty($this->widgets) ){
            foreach($this->widgets as $k=>$v){

                // check pro widgets
                $source = isset($v['source']) ? $v['source'] : 'local';
                $key =  str_replace(['-', ' '], ['_', ''], $k) ;

                if( did_action('droitPro/loaded') &&  $source == 'addons'){
                    continue;
                }
                // end check pro widgets

                $js_arr = isset($v['js']) ? $v['js'] : [];

                $js_vendor = isset($v['vendor']['js']) ? $v['vendor']['js'] : [];
                $css_vendor = isset($v['vendor']['css']) ? $v['vendor']['css'] : [];
                // js vendor loading
                if( !empty($js_vendor) ){
                    foreach($js_vendor as $jv){
                        wp_enqueue_script($jv);
                    }
                }
                // css vendor
                if( !empty($css_vendor) ){
                    foreach($css_vendor as $cv){
                        wp_enqueue_style($cv);
                    }
                }

                $files_default = 'dl_'.strtolower( str_replace(['-', ' '], ['_', ''], $k) ).'.min.js';
                
                if( !in_array($files_default, $js_arr) ){
                    array_push($js_arr, $files_default);
                }

                if( empty($js_arr) ){
                    continue;
                }
                $m = 1;
                foreach($js_arr as $cs){
                    $files = self::widgets_dir() . strtolower($k) .'/scripts/' . $cs;
                    if( is_readable($files) && is_file($files) ){
                        wp_enqueue_script('drth-' . strtolower($k) . '-'.$m, self::widgets_url() . strtolower($k) .'/scripts/' . $cs, [], self::version(), true);
                        $m++;
                    }
                }

            }
        }

        // load global widgets js
        wp_enqueue_script('drth-theme-script', self::widgets_url() . 'widgets.js', ['jquery'], self::version(), true);
        wp_localize_script(
            'drth-theme-script',
            'dlth_theme',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'admin_url' => admin_url('post.php'),
                'wp_nonce' => wp_create_nonce('dlth_theme_widget_nonce'),
                'dl_pro' => did_action('droitPro/loaded') ? 'yes' : 'no'
            )
        );

    }

    public function render_css(){

        $cssFiles = self::widgets_dir() . 'widgets.css';
        if( filesize($cssFiles) > 0 && !DRO_TH_ESS_CSS_RENDER ){
            return file_get_contents($cssFiles);
        }
        $this->widgets = self::widget_map();
        $css = '';
        if( !empty($this->widgets) ){
            foreach($this->widgets as $k=>$v){

                // check pro widgets
                $source = isset($v['source']) ? $v['source'] : 'local';
                $key =  str_replace(['-', ' '], ['_', ''], $k) ;

                if( did_action('droitPro/loaded') &&  $source == 'addons'){
                    //continue;
                }
                // end check pro widgets

                $css_arr = isset($v['css']) ? $v['css'] : [];
                // default css load
                $files_default = 'dl_'.strtolower( str_replace(['-', ' '], ['_', ''], $k) ).'.min.css';
                
                if( !in_array($files_default, $css_arr) ){
                    array_push($css_arr, $files_default);
                }
                if( !empty($css_arr) ){
                    foreach($css_arr as $cs){
                        $files = self::widgets_dir() . strtolower($k) .'/scripts/' . $cs;
                        if( is_readable($files) && is_file($files) ){
                            $css .= file_get_contents($files);
                        }
                    }
                    
                }
            }
        }

        $css = DR_Plugin::css_minify($css);
        file_put_contents($cssFiles, $css);

        return $css;
    }
    
    public function register_category( ) {
		 if( ! did_action('droitPro/loaded') ){
            \Elementor\Plugin::$instance->elements_manager->add_category(
                'drth_custom_theme_pro',
                [
                    'title' => esc_html__( 'Theme Essential', 'carspa-core' ),
                    'icon'  => 'fa fa-plug',
                ]
            );
        }
        \Elementor\Plugin::$instance->elements_manager->add_category(
            'drth_custom_theme',
            [
                'title' => esc_html__( 'Theme Essential Free', 'carspa-core' ),
                'icon'  => 'fa fa-plug',
            ]
        );

    }

    public function register_widgets(){

        $this->widgets = self::widget_map();

        if( !empty($this->widgets) ){
            foreach($this->widgets as $k=>$v){
                
                $files = self::widgets_dir() . strtolower($k) .'/'. strtolower($k) .'.php';

                $clsssName = str_replace([' ', '-', ''], '_', ucwords(str_replace([' ', '-', ''], ' ', $k)) );
                
                $class = "\Elementor\DRTH_ESS_".$clsssName;
                $class2 = "\DROIT_ELEMENTOR_PRO\Widgets\Droit_Addons_".$clsssName;

                if( did_action('droitPro/loaded')){
                    $file = drdt_core()->widgets_pro_dir . strtolower($k) .'/'. strtolower($k) .'.php';
                    if ( is_readable( $file)) {
                       $files = $file;
                       $clsssName = str_replace([' ', '-', ''], '_', ucwords(str_replace([' ', '-', ''], ' ', $k)) );
                       $class = "\DROIT_ELEMENTOR_PRO\Widgets\Droit_Addons_".$clsssName;
                    }
                    
                } else{
                    $control = self::widgets_dir() . strtolower($k) .'/'. strtolower($k) . '-control.php';
                    if( is_readable($control) && is_file($control) ){
                        require_once( $control );
                    }
                    $module = self::widgets_dir() . strtolower($k) .'/'. strtolower($k) . '-module.php';
                    if( is_readable($module) && is_file($module) ){
                        require_once( $module );
                    }
                }
                
                if( !is_readable($files) || !is_file($files) ){
                    continue;
                }

                require_once( $files );
                
                $class = class_exists($class2) ? $class2 : $class;

                if( class_exists($class) ){
                    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class() );
                }

            }
        }
    }
    public function svg_mime_add($mimes){
        $mimes['svg'] = 'image/svg+xml';
		return $mimes;
    }

    public static function _instance(){
        if( is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
}