<?php

function estate_pro_enqueue_assets() {
    wp_enqueue_style( 'estate-pro-style', get_stylesheet_uri(), array(), '1.0' );
    wp_enqueue_script( 'estate-pro-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'estate_pro_enqueue_assets' );

function estate_pro_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'estate_pro_theme_setup' );