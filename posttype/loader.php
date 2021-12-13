<?php
namespace Carspacore\Posttype;
defined( 'ABSPATH' ) || exit;


use \Carspacore\DRTH_Plugin as DR_Plugin;

class Loader{

	private static $instance;

	public static function elementor_url(){
		return DR_Plugin::dtdr_th_url().'posttype/';
	}

	public static function elementor_dir(){
		return DR_Plugin::dtdr_th_dir().'posttype/';
	}

	public function _init(){
		// load files
		
		
	}


	public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

}