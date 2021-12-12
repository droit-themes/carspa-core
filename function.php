<?php
// public function core
function drdt_th_core(){
    $obj = new \stdClass();
    $obj->self = \TH_ESSENTIAL\DRTH_Plugin::instance();
    $obj->version = \TH_ESSENTIAL\DRTH_Plugin::version();
    $obj->url = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url();
    $obj->dir = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_dir();
    $obj->assets = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'assets/';
    $obj->js = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'assets/js/';
    $obj->css = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'assets/css/';
    $obj->vendor = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'assets/vendor/';
    $obj->images = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'assets/images/';
    $obj->elementor = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'elementor/';
    $obj->elementor_dir = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_dir() . 'elementor/';
    $obj->framework = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'framework/';
    $obj->framework_dir = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_dir() . 'framework/';
    $obj->posttype = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'posttype/';
    $obj->posttype_dir = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_dir() . 'posttype/';
    $obj->core = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'core/';
    $obj->core_dir = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_dir() . 'core/';

    $obj->suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
    $obj->minify = '.min';
    
    return $obj;
}