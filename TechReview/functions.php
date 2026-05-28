<?php
function techreview_enqueue_styles() {
    wp_enqueue_style(
        'techreview-inter-font',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        array(),
        null
        
    );
    wp_enqueue_style('techreview-style', get_stylesheet_uri());
    wp_enqueue_script( 'techreview-slider-js', get_template_directory_uri() . '/assets/js/slider.js', array(), '1.0', true );
}
add_action('wp_enqueue_scripts', 'techreview_enqueue_styles');

function techreview_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'primary' => 'Primary Menu',
    ));
}
add_action('after_setup_theme', 'techreview_setup');



require get_template_directory() . '/inc/acf-blocks.php';
require get_template_directory() . '/inc/cpt.php';