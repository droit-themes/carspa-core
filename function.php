<?php
// public function core
function drdt_th_core(){
    $obj = new \stdClass();
    $obj->self = \Carspacore\DRTH_Plugin::instance();
    $obj->version = \Carspacore\DRTH_Plugin::version();
    $obj->url = \Carspacore\DRTH_Plugin::dtdr_th_url();
    $obj->dir = \Carspacore\DRTH_Plugin::dtdr_th_dir();
    $obj->assets = \Carspacore\DRTH_Plugin::dtdr_th_url() . 'assets/';
    $obj->js = \Carspacore\DRTH_Plugin::dtdr_th_url() . 'assets/js/';
    $obj->css = \Carspacore\DRTH_Plugin::dtdr_th_url() . 'assets/css/';
    $obj->vendor = \Carspacore\DRTH_Plugin::dtdr_th_url() . 'assets/vendor/';
    $obj->images = \Carspacore\DRTH_Plugin::dtdr_th_url() . 'assets/images/';
    $obj->elementor = \Carspacore\DRTH_Plugin::dtdr_th_url() . 'elementor/';
    $obj->elementor_dir = \Carspacore\DRTH_Plugin::dtdr_th_dir() . 'elementor/';
    $obj->framework = \Carspacore\DRTH_Plugin::dtdr_th_url() . 'framework/';
    $obj->framework_dir = \Carspacore\DRTH_Plugin::dtdr_th_dir() . 'framework/';
    $obj->posttype = \Carspacore\DRTH_Plugin::dtdr_th_url() . 'posttype/';
    $obj->posttype_dir = \Carspacore\DRTH_Plugin::dtdr_th_dir() . 'posttype/';
    $obj->core = \Carspacore\DRTH_Plugin::dtdr_th_url() . 'core/';
    $obj->core_dir = \Carspacore\DRTH_Plugin::dtdr_th_dir() . 'core/';

    $obj->suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
    $obj->minify = '.min';
    
    return $obj;
}