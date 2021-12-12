<?php 

//  add custom postype 

$custom_postype = new \Dt_custom_postype\Dt_CustomPosttype;
$taxonomy = new \Dt_custom_postype\Dt_Taxonomies;

$custom_postype->dt_postype('service', 'Service', 'Services', array('title', 'editor', 'author', 'thumbnail', 'excerpt'));
$taxonomy->dt_taxonomy( 'Type', 'Type', 'Types', 'service');